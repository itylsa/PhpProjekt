<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of database
 *
 * @author heiko.goehler
 */

 $config = parse_ini_file('../config.ini'); 
 $connection = mysqli_connect('localhost',$config['username'],$config['password'],$config['dbname']);

    
class database {
    
    
    function db_connect() {
        
    static $connection;             
    
     // Try and connect to the database, if a connection has not been established yet
    if(!isset($connection)) {       
        $config = parse_ini_file('../config.ini'); // Load configuration 
        $connection = mysqli_connect($config['host'],$config['username'],$config['password'],$config['dbname']);
    }

    // If connection was not successful, do something !!!!ö
    if($connection === false) {
        return mysqli_connect_error(); 
    }
    return $connection;
}

function login($email, $pwd) {
        return false;

}
