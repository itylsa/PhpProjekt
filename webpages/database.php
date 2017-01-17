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

        static $connection;

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
        $pass = '';
        $uid = '';
        if($data->num_rows > 0) {
            $row = mysqli_fetch_assoc($data);
            $pass = $row['password'];
            $uid = $row['uId'];
        } else {
            $this->db_close($conn);
            return false;
        }
        if($pwd == $pass) {
            session_start();
            $_SESSION['uid'] = $uid;
            $this->db_close($conn);
            return true;
        } else {
            $this->db_close($conn);
            return false;
        }
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

    public function loadUserById($userId) {
        $conn = $this->db_connect();
        $q = "SELECT * FROM user WHERE uId = '" . $uId . "';";
        $data = mysqli_query($conn, $q);
        $this->db_close($conn);
        return $row = mysqli_fetch_assoc($data);
    }

    public function editUser($email, $pw, $fName, $lName, $ort, $street) {
        $data;
        $conn = $this->db_connect();
        $q = "SELECT * FROM user WHERE email = '" . $uId . "';";
        $data = mysqli_query($conn, $q);
        $this->db_close($conn);
    }

    public function loadOrtById($oId) {
        $data;
        $conn = $this->db_connect();
        $q = "SELECT * FROM ort WHERE oId = '" . $oId . "';";
        $data = mysqli_query($conn, $q);
        $this->db_close($conn);
    }

    public function newPassword($email, $password) {
        $conn = $this->db_connect();
        $q = "SELECT * FROM user WHERE email = '" . $email . "';";
        $data = mysqli_query($conn, $q);
        if($data->num_rows > 0) {
            $q = "UPDATE user SET password = '" . $password . "' WHERE email = '" . $email . "'";
            return mysqli_query($conn, $q);
        } else {
            return false;
        }
    }

    public function getAllPlaces() {
        $conn = $this->db_connect();
        $q = "SELECT * FROM ort";
        $data = mysqli_query($conn, $q);
        $this->db_close($conn);
        return $data;
    }

    public function checkIfEmailExists($email) {
        $conn = $this->db_connect();
        $q = "SELECT email FROM user WHERE email = '" . $email . "';";
        $data = mysqli_query($conn, $q);
        if($data->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

}
