<?php


namespace App\Models;


abstract class MellonVars
{
    protected static $mellonVars = [];

    public static function setMellonVars()
    {
        if (!empty(self::$mellonVars)) {
            return self::$mellonVars;
        }
        $hasMellon = false;
        foreach ($_SERVER as $key => $value) {
            if (substr($key, 0, 7) == 'MELLON_' && $key != 'MELLON_NAME_ID') {
                $hasMellon = true;
                $fld = substr($key, 7);
                self::$mellonVars[$fld] = $value;
            }

        }

        if($hasMellon)
        {
            self::$mellonVars['urn_val'] =  self::$mellonVars['urn:idauto_net:saml:attribute:employeeType'];
        }

        return self::$mellonVars;
    }

    public static function getUserSsoParam($param='')
    {
        if(env('APP_ENV') == 'local' || env('APP_ENV') == 'testing') {
            self::$mellonVars = [
                'JobTitle' => 'Contractor',
                'mail' => 'jmoser2@wcpss.net',
                'schoolCode' => 920910,
                'urn:idauto_net:saml:attribute:employeeType' => 'Contractor',
                'department' => 'Technology Services - 910',
                'memberOf' => 'CN=TechnologySvcs OrgChg,OU=Roles,DC=wcpss,DC=meta;CN=WCPSS Staff Directory Sync to O365,OU=Roles,DC=wcpss,DC=meta;CN=FGPP_Employees,OU=Roles,DC=wcpss,DC=meta;CN=WCPSS All Staff Group,OU=Roles,DC=wcpss,DC=meta;CN=MSLIC-MSTeams,OU=Roles,DC=wcpss,DC=meta;CN=TechnologySvcs Staff Group,OU=Roles,DC=wcpss,DC=meta;CN=cherwell technology,OU=Roles,DC=wcpss,DC=meta;CN=Migration 40,OU=Roles,DC=wcpss,DC=meta;CN=WCPSS - Contractor Accounts,OU=Roles,DC=wcpss,DC=meta;CN=MFA,OU=Roles,DC=wcpss,DC=meta;CN=Migrated Staff,OU=Roles,DC=wcpss,DC=meta;CN=MSLIC-A3-TSD,OU=Roles,DC=wcpss,DC=meta;CN=Technology Contractors,OU=Roles,DC=wcpss,DC=meta;CN=AdobeSpark-LIC-Staff,OU=Roles,DC=wcpss,DC=meta;CN=MSLIC-A3-Staff-Default,OU=Roles,DC=wcpss,DC=meta',
                'name' => 'Jeff Moser',
            ];
        }

        self::setMellonVars();
        self::mapMellonVars();


		if (empty($param)) {
			return self::$mellonVars;
		}

        if (!isset(self::$mellonVars[$param])) {
            return null;
        }

        return self::$mellonVars[$param];
    }


    private static function mapMellonVars()
    {
        $swap = [
            'schoolCode' => 'school_code',
            'JobTitle' => 'job_title',
        ];
        foreach (self::$mellonVars as $key => $val) {
            if (array_key_exists($key, $swap)) {
                self::$mellonVars[$swap[$key]] = $val;
                unset(self::$mellonVars[$key]);
            }
        }
    }
}

