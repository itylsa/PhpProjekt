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

    public function editUser($args) {
        $conn = $this->db_connect();
        $email = $args['email'];
        $pwd = $args['pwd'];
        $fName = $args['firstName'];
        $lName = $args['lastName'];
        $ort = null;
        if($args['plz'] != null && $args['plz'] != '' && $args['place'] != null && $args['place'] != '') {
            $ort = $this->loadOrtByPlzOrt($args['plz'], $args['place']);
        }
        $street = $args['street'];
        $q = null;
        session_start();
        $uId = $_SESSION['uId'];
        $q = "SELECT uId FROM user WHERE email = '" . $email . "' AND uId != '" . $uId . "' ;";
        $data = mysqli_query($conn, $q);
        if($data->num_rows > 0) {
            $this->db_close($conn);
            return "Fehler! Mail schon vergeben";
        }
        if($ort != null) {
            $q = "UPDATE user SET email='" . $email . "', password='" . $pwd . "', fistName='" . $fName . "', lastName='" . $lName . "', "
                    . "fsOrt= '" . $ort . "' , streetNr='" . $street . "' WHERE uId = '" . $uId . "'";
        } else {
            $q = "UPDATE user SET email='" . $email . "', password='" . $pwd . "', fistName='" . $fName . "', lastName='" . $lName . "', "
                    . "streetNr='" . $street . "' WHERE uId = '" . $uId . "'";
        }
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
        $this->plzPlaceExists($plz, $ort);
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

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
    }

    public function deleteUser() {
        session_start();
        $uId = $_SESSION['uId'];
        $conn = $this->db_connect();
        $q1 = 'DELETE FROM user WHERE uId = "' . $uId . '";';
        mysqli_query($conn, $q1);
        $this->db_close($conn);
    }

    public function checkUserLogged() {
        session_start();
        if(isset($_SESSION['uId']) && $_SESSION['uId'] != null && $_SESSION['uId'] != '') {
            $uId = $_SESSION['uId'];
            $conn = $this->db_connect();
            $q = "SELECT uId FROM user WHERE uId = '" . $uId . "';";
            $data = mysqli_query($conn, $q);
            $this->db_close($conn);
            if($data->num_rows > 0) {
                return 'logged';
            } else {
                return 'doesntExist';
            }
        } else {
            return 'notLogged';
        }
    }

    public function checkUserExists() {
        session_start();
        $uId = null;
        if(isset($_SESSION['uId'])) {
            $uId = $_SESSION['uId'];
        }
        if($uId != null && $uId != '') {
            $conn = $this->db_connect();
            $q = "SELECT uId FROM user WHERE uId = '" . $uId . "';";
            $data = mysqli_query($conn, $q);
            $this->db_close($conn);
            if($data->num_rows > 0) {
                return true;
            } else {
                return false;
            }
        }
        return true;
    }

    public function getAnnonces() {
        session_start();
        $uId = $_SESSION['uId'];
        $conn = $this->db_connect();
        $q = "SELECT * FROM annonce WHERE fsUser = '" . $uId . "'";
        $data = mysqli_query($conn, $q);
        $this->db_close($conn);
        if($data->num_rows > 0) {
            return mysqli_fetch_all($data, MYSQLI_NUM);
        } else {
            return false;
        }
    }

    public function createAnnonce($title, $text, $category, $files) {
        $path = '..\\uploadedFiles';
        $files = $this->reArrayFiles($files);
        if(!file_exists($path)) {
            mkdir($path);
        }
        foreach($files as $key => $file) {
            $name = $file['name'];
            move_uploaded_file($file['tmp_name'], "$path\\$name");
        }
    }

    public function getUserName() {
        $userName = $this->loadUserById();
        return $userName;
    }

    public function plzPlaceExists($plz, $place) {
        $conn = $this->db_connect();
        $q = "SELECT plz, ortName FROM ort WHERE plz = '$plz' and ortName = '$place'";
        $data = mysqli_query($conn, $q);
        if($data->num_rows == 0) {
            $q = "INSERT INTO ort (plz, ortName) VALUES ('$plz', '$place');";
            $data = mysqli_query($conn, $q);
        }
        $this->db_close($conn);
    }

    public function getPlz($args) {
        $place = $args['place'];
        $conn = $this->db_connect();
        $q = "SELECT DISTINCT plz FROM ort WHERE ortName LIKE '%$place%';";
        $data = mysqli_query($conn, $q);
        return mysqli_fetch_all($data, MYSQLI_NUM);
        $this->db_close($conn);
    }

    public function getPlaces($args) {
        $plz = $args['plz'];
        $conn = $this->db_connect();
        $q = "SELECT DISTINCT ortName FROM ort WHERE plz LIKE '%$plz%';";
        $data = mysqli_query($conn, $q);
        return mysqli_fetch_all($data, MYSQLI_NUM);
        $this->db_close($conn);
    }

    public function getAllCategories() {
        $conn = $this->db_connect();
        $q = "SELECT name FROM label;";
        $data = mysqli_query($conn, $q);
        $this->db_close($conn);
        return mysqli_fetch_all($data, MYSQLI_NUM);
    }

    function reArrayFiles($file_post) {
        $file_ary = array();
        $file_count = count($file_post['name']);
        $file_keys = array_keys($file_post);

        for($i = 0; $i < $file_count; $i++) {
            foreach($file_keys as $key) {
                $file_ary[$i][$key] = $file_post[$key][$i];
            }
        }

        return $file_ary;
    }

}
