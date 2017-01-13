<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of database
 *
 * @author Joerg.Gulde das Genie !
 */
class database {

    /**
     * 
     * @staticvar type $connection
     * @return type
     */
    private function db_connect() {

        $connection;

        // Try and connect to the database, if a connection has not been established yet
        if(!isset($connection)) {
            $config = parse_ini_file('../config.ini'); // Load configuration
            $connection = mysqli_connect($config['host'], $config['username'], $config['password'], $config['dbname']);
            mysqli_set_charset($connection, "UTF-8");
        }

        // If connection was not successful, return error
        if($connection === false) {
            return mysqli_connect_error();
        }
        return $connection;
    }

    private function db_close($connection) {
//        Close connection
        mysqli_close($connection);
    }

    /**
     * 
     * @param type $email
     * @param type $pwd
     * @return boolean
     */
    public function login($email, $pwd) {
//        Call the connect function of this class
        $conn = $this->db_connect();
//        Get the password from the database for given email
        $q = "SELECT password, uId FROM user WHERE email = '" . $email . "'";
        $data = mysqli_query($conn, $q);
        $pass;
        $uid;
        if($data->num_rows > 0) {
            while($row = mysqli_fetch_assoc($data)) {
                $pass = $row['password'];
                $uId = $row['uId'];
            }
        } else {
            return false;
        }
        if($pwd == $pass) {
            session_start();
            $_SESSION['uId']= $uId;
            return true;
        } else {
            return false;
        }
        $this->db_close($conn);
    }

    /**
     * 
     * this function creates a new user in database | das auch sandro sowas versteht
     * 
     * @param type $email
     * @param type $pwd
     * @param type $fName
     * @param type $lName
     * @param type $ort
     * @param type $strasse
     * @return boolean
     */
    public function createUser($email, $pwd, $fName, $lName, $ort, $strasse) {
        $conn = $this->db_connect();
        $q = "SELECT * FROM user WHERE email = '" . $email . "';";
        $data = mysqli_query($conn, $q);
        if($data->num_rows > 0) {
            $this->db_close($conn);
            return false;
        } else {
            $q = "INSERT INTO user (email, password, fistName, lastName, fsOrt, streetNr) "
                    . "VALUES ('" . $email . "','" . $pwd . "','" . $fName . "','" . $lName . "','" . $ort . "','" . $strasse . "')";
            mysqli_query($conn, $q);
            $this->db_close($conn);
            return true;
        }
    }
    
/**
 * 
 * @param type $uId
 * @return type
 */
    public function loadUserById($uId) {
        $conn = $this->db_connect();
        $q = "SELECT * FROM user WHERE uId = '" . $uId . "';";
        $data = mysqli_query($conn, $q);
        $this->db_close($conn);
        return $row = mysqli_fetch_assoc($data);
        
    }
    
    public function editUser($email, $pw, $fName, $lName, $ort, $street){ 
    }
    
    /**
     * 
     * @param type $fsOrt
     * @return type
     */
    public function loadOrtById($fsOrt){
         $conn = $this->db_connect();
         $q = "SELECT plz, ortName FROM ort WHERE oId = '" . $fsOrt . "';";
         $data= mysqli_query($conn, $q);
         $this->db_close($conn);
         return $row = mysqli_fetch_assoc($data);
    }

}

