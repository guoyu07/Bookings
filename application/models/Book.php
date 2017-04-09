<?php

class Application_Model_Book
{

    public function bookRoom($array)
    {
        $dbTableBooking = new Application_Model_DbTable_Booking();
        $dbTableBooking->insert($array);
    }


    public function getBookings() //queries db
    {

        $dbTableBooking = new Application_Model_DbTable_Booking();
        try{
            $row = $dbTableBooking->fetchAll($dbTableBooking->select());
        }
        catch (Exception $e){
            throw new Exception('DB does not exist', 504);
        }
        return $row;

    }

    public function newConfig($dbname, $username, $password)
    {
        // Load all sections from an existing config file, while skipping the extends.
        $config = new Zend_Config_Ini(APPLICATION_PATH.'/configs/application.ini',
            null,
            array(
                'skipExtends'        => true,
                'allowModifications' => true)
                );

        // Modify a values in application.ini
        $config->production->resources->db->params->dbname = $dbname;
        $config->production->resources->db->params->username = $username;
        if(!isset($password)){
            $config->production->resources->db->params->password = "";
        }else{
            $config->production->resources->db->params->password = $password;
        }

        // Write the config file

        $writer = new Zend_Config_Writer_Ini(array('config'   => $config,
            'filename' => APPLICATION_PATH.'/configs/application.ini'));
        $writer->write(); //of of writing to application.ini

        //assign db params for use in db creation

        $host       =   $config->production->resources->db->params->host;
        $db_username=   $config->production->resources->db->params->username;
        $db_pwd     =   $config->production->resources->db->params->password;
        $db_name    =   $config->production->resources->db->params->dbname;

        //create database
        $sql = file_get_contents(APPLICATION_PATH.'/roombooker_db.sql');

        try {
            $dbh = new PDO("mysql:host=$host", $db_username, $db_pwd);

            $dbh->exec("CREATE DATABASE `$db_name`;
                        USE `$db_name`;");
            //or die(print_r($dbh->errorInfo(), true));
            $dbh->exec($sql);//or die(print_r($dbh->errorInfo(), true));

        } catch (PDOException $e) {
            die("DB ERROR: ". $e->getMessage());
        }

    }

}

