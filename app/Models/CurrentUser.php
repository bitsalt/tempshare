<?php


namespace App\Models;


use App\Services\DepartmentService;
use App\Services\OracleService;
use App\Services\ResponderService;

/**
 * This is not s regular Laravel model. It's just a Plain Old PHP Object
 * (do you think POPO will become a thing? I thought of it here first!)
 *
 * Class CurrentUser
 * @package App\Models
 */
class CurrentUser
{
    private $personId;
    private $employeeNumber;
    private $employeeType;
    private $name;
    private $email;
    private $departmentName;
    private $departmentId;
    private $personType;
    private $positionName;
    private $schoolCode;
    private $urnValue;
    private $userObjectType = 'userVars';
    private $managers = [];


    public function setCurrentUserData($email)
    {
        $this->email = $email;

        // try regular employees first
        $userData = OracleService::getEmployeeData($email);

        // ...or is this a contractor?
        if(empty($userData)) {
            $userData = OracleService::getContractorData($email);

            // if nothing by now, this is not a valid user
            if (empty($userData)) {
                $this->setFailedUserData();
                return false;
            }
            // get manager data separately
            $userData['manager_id'] = OracleService::getContractorManagerId($userData['manager_email']);
        }

        foreach ($userData as $key => $value) {
            switch ($key) {
                case 'employee_number':
                    $this->employeeNumber = $value;
                    break;
                case 'person_number':
                case 'person_id':
                    $this->personId = $value;
                    break;
                case 'full_name':
                    $this->name = $value;
                    break;
                case 'organization_name':
                case 'organization':
                    $this->departmentName = $value;
                    break;
                case 'person_type':
                case 'employee_type':
                    $this->personType = $value;
                    break;
                case 'job':
                case 'position_name':
                    $this->positionName = $value;
                    break;
                case 'manager_id':
                case 'empdff_supervisor_id':
                case 'asn_supervisor_id':
                    if ($value !== null && OracleService::isValidEmployee($value)) {
                        $this->addManager($value);
                    }
                    break;
                case 'org_code':
                    $this->schoolCode = $value;
                    break;
            }
        }

        // position_name can be missing for contractors
        if ($this->positionName == null && $this->personType != null) {
            $this->positionName = $this->personType;
        }

        if ($this->departmentName == null && $this->personType == 'Contractor') {
            $this->departmentName = 'Contractor - Unknown';
            $this->departmentId = DepartmentService::getDepartmentIdByName('Contractor - Unknown');
        }

        return true;
    }

    public function isContractor()
    {
        return $this->personType == 'Contractor';
    }

    public function isEmployee()
    {
        return $this->personType == 'Employee';
    }

    public function toArray() {
        return [
            'mail' => $this->email,
            'name' => $this->name,
            'person_type' => $this->personType,
            'person_id' => $this->personId,
            'employee_number' => $this->employeeNumber,
            'employee_type' => $this->employeeType,
            'department' => $this->departmentId,
            'department_name' => $this->departmentName,
            'position_name' => $this->positionName,
            'school_code' => $this->schoolCode,
            'urn_val' => $this->urnValue,
        ];
    }

    public function setUrnValue($value)
    {
        $this->urnValue = $value;
    }

    public function setDefaultSchoolCode($schoolCode)
    {
        if (!$this->schoolCode) {
            $this->schoolCode = $schoolCode;
        }
    }

    public function setFailedUserData()
    {
        if (!$this->name) {
            $this->name = 'Unknown';
        }
        if (!$this->schoolCode) {
            $this->schoolCode = 0;
        }
        if (!$this->personId) {
            $this->personId = 0;
        }
        if (!$this->positionName) {
            $this->positionName = 'Unknown';
        }

        // set to null rather than an empty array
        $this->mangers = null;
    }


    public function setUserObjectType($type)
    {
        $this->userObjectType = $type;
    }

    public function getUserObjectType()
    {
        return $this->userObjectType;
    }


    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getUrnValue()
    {
        return $this->urnValue;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getPersonId()
    {
        return $this->personId;
    }

    /**
     * @return mixed
     */
    public function getDepartmentId()
    {
        return $this->departmentId;
    }

    /**
     * @return mixed
     */
    public function getPositionName()
    {
        return $this->positionName;
    }

    /**
     * @return mixed
     */
    public function getSchoolCode()
    {
        return $this->schoolCode;
    }

    /**
     * @return array
     */
    public function getManagers(): array
    {
        return $this->managers;
    }

    private function addManager($managerId)
    {
        if ($managerId && !in_array($managerId, $this->managers)) {
            $this->managers[] = "$managerId";
        }
    }

}
