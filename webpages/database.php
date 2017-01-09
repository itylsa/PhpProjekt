<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of database
 *
 * @author Joerg.Gulde der Spast
 */
class database {

    private function db_connect() {

        static $connection;

        // Try and connect to the database, if a connection has not been established yet
        if(!isset($connection)) {
            $config = parse_ini_file('../config.ini'); // Load configuration
            $connection = mysqli_connect($config['host'], $config['username'], $config['password'], $config['dbname']);
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

    public function login($email, $pwd) {
//        Call the connect function of this class
        $connection = $this->db_connect();
//        Get the password from the database for given email
        $q = "SELECT password FROM user WHERE email = '" . $email . "'";
        $data = mysqli_query($connection, $q);
        $pass;
        if($data->num_rows > 0) {
            while($row = mysqli_fetch_assoc($data)) {
                $pass = $row['password'];
            }
        }
        if($pwd == $pass) {
            return true;
        } else {
            return false;
        }
        $this->db_close($connection);
    }

}