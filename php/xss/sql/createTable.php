<?php
    require_once "pdo.php";
    ini_set('display_errors', "On");
    function create_Account(){

    $sql = "CREATE DATABASE XssSample";
    $result = $pdo->query($sql);

    $sql = "use XssSample";
    $result = $pdo->query($sql);

    $sql = "CREATE TABLE account(
        username TEXT,
		email TEXT,
		password TEXT
	)";
    $result = $pdo->query($sql);

    }

    function create_sns(){
        global $pdo;
        $sql = "use XssSample";
        $result = $pdo->query($sql);

        $sql = "CREATE TABLE sns(
            username TEXT,
            email TEXT,
            TEXT TEXT,
            Date DATETIME
        )";
        $result = $pdo->query($sql);
    
    }
    create_sns();
?>