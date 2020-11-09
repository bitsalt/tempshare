<?php


namespace App\Models;


class Oracle
{
    private static $credentials = [];
    protected static $connection;
    private static $instance;


    public function __construct()
    {
        self::configureConnection();
        if (self::$credentials != []) {
            self::connect();
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Oracle();
        }

    }


    protected static function configureConnection()
    {
        if (self::$connection != null) {
            return true;
        }

        self::$credentials = [
            'user' => env('ORACLE_USER'),
            'password' => env('ORACLE_PASSWORD'),
            'connection' => "(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(COMMUNITY = TCP)(PROTOCOL = TCP)
                (HOST = ".env('ORACLE_HOST').")
                (PORT = ".env('ORACLE_PORT').")))
                (CONNECT_DATA = (SERVICE_NAME = ".env('ORACLE_SID').")))",
        ];
//        self::$credentials = [
//            'user' => config('database.connections.oracle.username'),
//            'password' => config('database.connections.oracle.password'),
//            'connection' => "(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(COMMUNITY = TCP)(PROTOCOL = TCP)
//                (HOST = ".config('database.connections.oracle.host').")
//                (PORT = ".config('database.connections.oracle.port').")))
//                (CONNECT_DATA = (SERVICE_NAME = ".config('database.connections.oracle.sid').")))",
//        ];
    }

    public static function connect(): void
    {
        //$connect = array();

        if (function_exists('oci_connect')) {
            try {
                $connect = oci_connect(
                    self::$credentials['user'],
                    self::$credentials['password'],
                    self::$credentials['connection']);
                    self::$connection = $connect;
            } catch (\ErrorException $e) {
                echo 'No connection to Oracle is available...'; dd($e);
            }

        }

    }

}
