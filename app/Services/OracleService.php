<?php


namespace App\Services;


use App\Models\CurrentUser;
use App\Models\Oracle;

class OracleService extends Oracle
{
    private static $instance;


    // consider using APPS.WCS_ACTIVE_SUPERVISORS_V for list of supervisors?
    // consider APPS.WCS_BAAS_ACTIVE_POSITIONS_V for list of position names?

    public function __construct()
    {
        parent::__construct();
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new OracleService();
        }
    }


    public static function getEmployeeData($email, $personId='')
    {
        $where = "WHERE ppf.email_address = '$email'";
        if ($personId) {
            $where = "WHERE ppf.person_id = $personId";
        }

        // try regular employees first
        $query = "SELECT ppf.person_id, ppf.employee_number, ppf.full_name, ppf.email_address,
                       ppf.effective_start_date, ppf.effective_end_date,ppf.person_type_id,
                       apps.wcs_uwcprep_pkg.Getalluserpersontypes(ppf.person_id, sysdate) AS person_type,
                       sup.organization, sup.empdff_supervisor_id, sup.asn_supervisor_id,
                       sup.org_code, sup.position_name
                    FROM   apps.per_all_people_f ppf
                    JOIN apps.wcs_evproj_per_supervisor_v sup on sup.person_id = ppf.person_id
                    $where
                    AND (apps.WCS_UWCPREP_PKG.getalluserpersontypes(ppf.person_id, sysdate) like 'Employee%'
                    OR apps.WCS_UWCPREP_PKG.getalluserpersontypes(ppf.person_id, sysdate) like 'Cont%')
                        AND Trunc(sysdate) BETWEEN ppf.effective_start_date
                    AND ppf.effective_end_date";

        $results = self::fetchGenericResults($query);
        if (count($results) == 1) {
            return $results[0];
        } elseif (count($results) == 0) {
            return self::employeeDataFailsafe($email);
        }
        return [];
    }

    private static function employeeDataFailsafe($email)
    {
        $query = "select ppf.person_id, ppf.employee_number, ppf.full_name,
                        ppf.email_address, ppf.effective_start_date, ppf.effective_end_date,
                        ppf.person_type_id,
                        apps.WCS_UWCPREP_PKG.getalluserpersontypes(ppf.person_id, sysdate) AS person_type,
                        hou.name AS organization_name,
                        ppd.segment1 AS position_name
                    from apps.per_all_people_f ppf
                    inner join apps.PER_ALL_ASSIGNMENTS_F paf on ppf.person_id = paf.person_id
                    inner join apps.WCS_AUX_HR_ALL_POSITIONS_F_V papf on papf.position_id = paf.position_id
                    inner join apps.PER_POSITION_DEFINITIONS ppd on ppd.position_definition_id = papf.position_definition_id
                    inner join apps.HR_ALL_ORGANIZATION_UNITS hou on hou.organization_id = paf.organization_id
                    where ppf.email_address = '$email'
                        and trunc(sysdate) BETWEEN ppf.effective_start_date AND ppf.effective_end_date
                        and trunc(sysdate) BETWEEN paf.effective_start_date AND paf.effective_end_date
                        and paf.primary_flag = 'Y' AND paf.assignment_status_type_id = 1";

        $results = self::fetchGenericResults($query);
        if (count($results) == 1) {
            return $results[0];
        }
        return [];
    }

    public static function getContractorAsManager($managerId)
    {
        $query = "select ctr.person_number AS person_id, ctr.full_name, ctr.organization_name AS organization,
                    ctr.email_address, ctr.job AS position_name
                    from APPS.WCS_CONTRACTORS_V ctr
                    where ctr.person_number = $managerId";

        $results = self::fetchGenericResults($query);
        if (count($results) == 1) {
            return $results[0];
        }
        return [];
    }

    public static function getContractorData($email)
    {
//        $query = "select ctr.person_number, ctr.person_type, ctr.organization_name,
//                        ctr.location, ctr.job, ctr.email_address, ctr.full_name,
//                        ppf.person_id as manager_id
//                    from APPS.WCS_CONTRACTORS_V ctr
//                    join apps.per_all_people_f ppf on ppf.email_address = ctr.supervisor_emailid
//                    where ctr.email_address = '$email'
//                    and trunc(sysdate) between ppf.effective_start_date and ppf.effective_end_date";

        $query = "select ctr.person_number, ctr.person_type, ctr.organization_name,
                        ctr.location, ctr.job, ctr.email_address, ctr.full_name,
                        ctr.supervisor_emailid as manager_email
                    from APPS.WCS_CONTRACTORS_V ctr
                    where ctr.email_address = '$email'";

        $results = self::fetchGenericResults($query);
        if (count($results) == 1) {
            return $results[0];
        }
        return [];
    }

    public static function getContractorManagerId($managerEmail)
    {
        $query = "select person_id
                    from apps.per_all_people_f
                    where email_address = '$managerEmail'
                    and trunc(sysdate) between effective_start_date and effective_end_date";

        $results = self::fetchGenericResults($query);
        if ($results) {
            return $results[0]['person_id'];
        }
        return null;
    }


    public static function isValidEmployee($personId)
    {
//        $query = "select ppf.person_type_id,
//                    apps.WCS_UWCPREP_PKG.getalluserpersontypes(ppf.person_id, sysdate) AS person_type
//                    from apps.per_all_people_f ppf
//                    where trunc(sysdate) BETWEEN ppf.effective_start_date AND ppf.effective_end_date
//                    and ppf.person_id = $personId
//                        and ppf.person_type_id in (43, 44, 46, 47, 49, 72, 76)";
        $query = "SELECT *
                    FROM APPS.WCS_EVPROJ_PER_SUPERVISOR_V
                    WHERE person_id = $personId";

        $result = self::fetchGenericResults($query);
        if (empty($result)) {
            return false;
        }
        return true;
//        return self::filterPersonTypes($result[0]);
    }


    public static function getPersonPositionNameByPersonID($id) {
        $result = self::fetchByPersonID($id);
        if(!empty($result)) {
            return $result['position_name'];
        }

        return 'Unknown';
    }


    public static function getPersonNameByPersonID($id) {
        $result = self::fetchByPersonID($id);
        if(!empty($result)) {
            return $result['full_name'];
        }
        return null;
    }


    public static function getPersonIdByEmail($email) {
        $result = self::fetchByEmail($email);
        if(!empty($result)) {
            return $result['person_id'];
        }
        return [];
    }


    public static function getPersonEmailByPersonID($id) {
        $result = self::fetchByPersonID($id);
        if(!empty($result)) {
            return $result['email_address'];
        }

        return [];
    }


    public static function getUserInfoByPersonId( $id = NULL )
    {
		$result = self::fetchByPersonID($id);
        if(!empty($result)) {
            return $result;
        }

        return [];
    }


    public static function getUsersManagersByEmail( $email )
    {
        $query = "SELECT sup.empdff_supervisor_id, sup.asn_supervisor_id
               FROM APPS.WCS_EVPROJ_PER_SUPERVISOR_V sup
               WHERE email_address = '" . $email . "'";

        $empResult = self::fetchGenericResults($query);

        if (!empty($empResult[0])) {
            $result = [];
            foreach ($empResult[0] as $key => $val) {
                $result[] = $val;
            }
        } else {// missed there, try the contractors view
            $contractorResult = self::getContractorData($email); // -> gives supervisor_emailid
            if (!empty($contractorResult)) {
                $result = self::getPersonIdByEmail($contractorResult['supervisor_emailid']);
            }
        }

        if (is_array($result)) {
            $personIds = implode(',', $result);
        } else {
            $personIds = $result;
        }

        $filterQuery = "select ppf.person_id, ppf.employee_number, ppf.full_name, ppf.email_address,
            ppf.effective_start_date, ppf.effective_end_date, ppf.person_type_id,
            apps.WCS_UWCPREP_PKG.getalluserpersontypes(ppf.person_id, sysdate) AS person_type
            from apps.per_all_people_f ppf
            where ppf.person_id in ($personIds)
            and trunc(sysdate) BETWEEN ppf.effective_start_date AND ppf.effective_end_date
            and ppf.email_address is not null
            and ppf.person_type_id in (43, 44, 46, 47, 49, 72, 76)";

        $valid = [];
        $results = self::fetchGenericResults($filterQuery);
        foreach ($results as $result) {
            $isValid = self::filterPersonTypes($result);
            if ($isValid) {
                $valid[] = $result;
            }
        }

        return $valid;
    }


    protected static function prepareStatement($query)
    {
        if( function_exists('oci_connect') ) {
            $statement = oci_parse(self::$connection, $query);
            oci_execute($statement);
            return $statement;
        }
    }

    protected static function fetchGenericResults($query)
    {
        self:: getInstance();

        $result = [];
        $counter = 0;
        $stmt = self::prepareStatement($query);
        while( $result_temp = oci_fetch_object($stmt) ) {
            foreach ($result_temp as $key => $value) {
                $result[$counter][strtolower($key)] = $value;
            }
            $counter++;
        }
        return $result;
    }


    public static function getUsersForUnitTests($limit=null, $offset=null)
    {
        self::getInstance();

        if ($limit) {
            $limit = "fetch next $limit rows only";
        }
        if ($offset) {
            $offset = "offset $offset rows";
        }

        $query = "select ppf.person_id, ppf.employee_number, ppf.full_name,
                    ppf.email_address, ppf.effective_start_date, ppf.effective_end_date,
                    ppf.person_type_id,
                    apps.WCS_UWCPREP_PKG.getalluserpersontypes(ppf.person_id, sysdate) AS person_type
                    from apps.per_all_people_f ppf
                    where trunc(sysdate) BETWEEN ppf.effective_start_date AND ppf.effective_end_date
                    and ppf.email_address is not null
                        and ppf.person_type_id in (43, 44, 46, 47, 49, 72, 76)
                        $offset $limit";

        $valid = [];
        $results = self::fetchGenericResults($query);
        foreach ($results as $result) {
            $isValid = self::filterPersonTypes($result);
            if ($isValid) {
                $valid[] = $result;
            }
        }

        return $valid;
    }


    private static function fetchByPersonID($id)
    {
        $data = self::getEmployeeData('', $id);
        if ($data) {
            return $data;
        }
        return self::getContractorAsManager($id);
    }


    private static function fetchByEmail($email)
    {
        return self::getEmployeeData($email);
    }


    private static function filterPersonTypes($person) {
        $isValidPerson = false;
        switch ($person['person_type_id']) {
            case 43:
            case 44:
                $isValidPerson = true;
                break;
            case 46:
                if ($person['person_type'] == 'Ex-Emp and Contractor'
                    || $person['person_type'] == 'Ex-Emp and Contractor,Ex-applicant') {
                    $isValidPerson = true;
                }
                break;
            case 47:
                if ($person['person_type'] == 'Applicant and Contractor'
                    || $person['person_type'] == 'Ex-Emp and Contractor') {
                    $isValidPerson = true;
                }
                break;
            case 49:
            case 72:
                if ($person['person_type'] == 'Contractor') {
                    $isValidPerson = true;
                }
                break;
            case 76:
                if ($person['person_type'] == 'Ex-Emp and Contractor') {
                    $isValidPerson = true;
                }
                break;
            default:
                // nope...
        }

        return $isValidPerson;
    }

}

