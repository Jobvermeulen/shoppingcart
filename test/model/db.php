<?php
    class db 
    {
        //Hold instance of self
        private static $instance;
        //db details
        private $dbHost = 'localhost';
        private $dbUsername = 'jobvewi308_PHP';
        private $dbPassword = 'Zw3mm3n=18';
        private $dbName = 'jobvewi308_PHP';

        //connection to db
        public $con;

        //Create instance of class
        public static function getInstance() 
        {
            if(!isset(self::$instance)) {
                self::$instance = new self;
            }
            return self::$instance;
        }

        //Function to connect to db
        public function __construct() 
        {  
            //Connect and select the database
            $this->con = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);
        }
    }