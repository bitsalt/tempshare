<?php


namespace App\Services;

use App\Models\CurrentUser;
use App\Models\MellonVars;

class EnvironmentService
{
    private static $instance;
    private static $session;


    public function __construct()
    {
        // need models? Pull them in here
    }



    /**
     * @param $session
     * @return CurrentUser
     */
    public static function getCurrentUser(CurrentUser &$user, $session)
    {
        if (isset($session['devUserVars'])) {
            $devUserObject = $session['devUserVars'];
            $user = unserialize($devUserObject);
        } elseif (isset($session['userVars'])) {
            $userObject = $session['userVars'];
            $user = unserialize($userObject);
        } else {
            self::$session = $session;
            self::setUserVars($user);
            $userObject = serialize($user);
            session(['userVars' => $userObject]);
        }

//        echo 'user: <pre>'; print_r($user->toArray()); echo '</pre>';
    }


    public static function refreshSessionData(CurrentUser $user) {
        $userObject = serialize($user);
        session([$user->getUserObjectType() => $userObject]);
    }

    // direct dev user request to remove user emulation
    public static function removeOverride($request)
    {
        session()->forget('devUserVars');
        session(['dev_override' => false]);
    }

    // direct dev user request for user emulation
    public static function setUserVarsForEmulation(CurrentUser $user)
    {
        // fill in the blanks
        $user->setUrnValue('Emulated');
        $user->setDefaultSchoolCode(00000);
        $user->setUserObjectType('devUserVars');

        $devUserObject = serialize($user);
        session(['devUserVars' => $devUserObject]);
        session(['dev_override' => true]);
        return true;
    }


    private static function setUserVars(CurrentUser $currentUser)
    {
        $mellonVars = MellonVars::getUserSsoParam();
        $currentUser->setUrnValue($mellonVars['urn:idauto_net:saml:attribute:employeeType']);
        if($mellonVars['urn:idauto_net:saml:attribute:employeeType'] == 'Student') {
            return $currentUser;
        } else {
            $currentUser->setDefaultSchoolCode($mellonVars['school_code']);
            $currentUser->setCurrentUserData($mellonVars['mail']);
        }

    }


    private static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new EnvironmentService();
        }

    }

}
