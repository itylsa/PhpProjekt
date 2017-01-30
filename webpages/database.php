<?php

class database {

    /**
     *
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
    public function login($args) {
//        Call the connect function of this class
        $conn = $this->db_connect();
        $email = $args['email'];
        $pwd = $args['pw'];
//        Get the password from the database for given email
        $q = "SELECT password, uId FROM user WHERE email = '" . $email . "';";
        $data = mysqli_query($conn, $q);
        $pass = '';
        $uId = '';
        if($data->num_rows > 0) {
            $row = mysqli_fetch_assoc($data);
            $pass = $row['password'];
            $uId = $row['uId'];
        } else {
            $this->db_close($conn);
            return false;
        }
        if($pwd == $pass) {
            session_start();
            $_SESSION['uId'] = $uId;
            $this->db_close($conn);
            return true;
        } else {
            $this->db_close($conn);
            return false;
        }
    }

    /**
     *
     *
     * this function creates a new user in database | das auch sandro sowas versteht
     * @param type $email
     * @param type $pwd
     * @param type $fName
     * @param type $lName
     * @param type $ort
     * @param type $strasse
     * @return boolean
     */
    public function createUser($args) {
        $conn = $this->db_connect();
        $email = $args['email'];
        $pwd = $args['pwd'];
        $fName = $args['firstName'];
        $lName = $args['lastName'];
        $ort = null;
        if($args['plz'] != null && $args['plz'] != '' && $args['place'] != null && $args['place'] != '') {
            $ort = $this->loadOrtByPlzOrt($args['plz'], $args['place']);
        }
        $strasse = $args['street'];
        $q = "SELECT * FROM user WHERE email = '" . $email . "';";
        $data = mysqli_query($conn, $q);
        if($data->num_rows > 0) {
            $this->db_close($conn);
            return false;
        } else {
            if($ort != null) {
                $q = "INSERT INTO user (email, password, fistName, lastName, fsOrt, streetNr) "
                        . "VALUES ('" . $email . "','" . $pwd . "','" . $fName . "','" . $lName . "','" . $ort . "','" . $strasse . "')";
            } else {
                $q = "INSERT INTO user (email, password, fistName, lastName, streetNr) "
                        . "VALUES ('" . $email . "','" . $pwd . "','" . $fName . "','" . $lName . "','" . $strasse . "')";
            }
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
    public function loadUserById() {
        $conn = $this->db_connect();
        session_start();
        $uId = $_SESSION['uId'];
        $q = "SELECT * FROM user WHERE uId = '" . $uId . "';";
        $data = mysqli_query($conn, $q);
        $this->db_close($conn);
        return mysqli_fetch_array($data, MYSQLI_NUM);
    }

    public function editUser($email, $pw, $fName, $lName, $street, $ort, $plz, $uId) {
        $conn = $this->db_connect();
        $oid = $this->loadOrtByPlzOrt($plz, $ort);
        if(!isset($oid)) {
            $this->db_close($conn);
            return "Fehler! Ort nicht gefunden";
        }
        $q = "SELECT uId FROM user WHERE email = '" . $email . "' AND uId != '" . $uId . "' ;";
        $data = mysqli_query($conn, $q);
        if($data->num_rows > 0) {
            $this->db_close($conn);
            return "Fehler! Mail schon vergeben";
        }
        $q = "UPDATE user SET email='" . $email . "', password='" . $pw . "', fistName='" . $fName . "', lastName='" . $lName . "', "
                . "fsOrt= '" . $oid . "' , streetNr='" . $street . "' WHERE uId = '" . $uId . "'";
        $data = mysqli_query($conn, $q);
        $this->db_close($conn);
        return true;
    }

    public function editOrt() {

    }

    /**
     *
     * @param type $fsOrt
     * @return type
     */
    public function loadOrtById($args) {
        $fsOrt = $args['placeId'];
        $conn = $this->db_connect();
        $q = "SELECT plz, ortName FROM ort WHERE oId = '" . $fsOrt . "';";
        $data = mysqli_query($conn, $q);
        $this->db_close($conn);
        return mysqli_fetch_array($data, MYSQLI_NUM);
    }

    public function loadOrtByPlzOrt($plz, $ort) {
        $conn = $this->db_connect();
        $q = "SELECT oId FROM ort WHERE plz = '" . $plz . "' and ortName = '" . $ort . "';";
        $data = mysqli_query($conn, $q);
        return mysqli_fetch_assoc($data)['oId'];
    }

    public function newPassword($args) {
        $conn = $this->db_connect();
        $email = $args['email'];
        $password = $args['pwd'];
        $q = "SELECT * FROM user WHERE email = '" . $email . "';";
        $data = mysqli_query($conn, $q);
        if($data->num_rows > 0) {
            $q = "UPDATE user SET password = '" . $password . "' WHERE email = '" . $email . "'";
            mysqli_query($conn, $q);
            return true;
        } else {
            return false;
        }
    }

    public function getAllPlaces() {
        $conn = $this->db_connect();
        $q = "SELECT * FROM ort";
        $data = mysqli_query($conn, $q);
        $this->db_close($conn);
        return mysqli_fetch_all($data, MYSQLI_NUM);
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

    public function addPlace($args) {
        $plz = $args['plz'];
        $place = $args['place'];
        $conn = $this->db_connect();
        $q = "SELECT * FROM ort WHERE plz = '" . $plz . "' and ortName = '" . $place . "';";
        $data = mysqli_query($conn, $q);
        if($data->num_rows > 0) {
            return false;
        }
        $q = "INSERT INTO ort (plz, ortName) VALUES ('" . $plz . "', '" . $place . "');";
        mysqli_query($conn, $q);
        $this->db_close($conn);
        return true;
    }

}
