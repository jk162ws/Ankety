<?php
    require_once '../db/DDLQueries.php';
    require_once '../core/User.php';
    
    $host="localhost"; // Host name
    $username="root"; // Mysql username
    $dbpassword="wtwtwt"; // Mysql password
    $db_name="anketovy_system"; // Database name
    $tbl_name = DDLQueries::$TABLE_USERS; // Table name

    // Connect to server and select databse.
    mysql_connect($host, $username, $dbpassword) or die("cannot connect");
    mysql_select_db($db_name)or die("cannot select DB");

    // username and password sent from form
    $login = mysql_real_escape_string(stripslashes(filter_input(INPUT_POST, "login")));
    $password = mysql_real_escape_string(stripslashes(filter_input(INPUT_POST, "password")));
    $email = mysql_real_escape_string(stripslashes(filter_input(INPUT_POST, "email")));

    $sql="SELECT * FROM $tbl_name" . " WHERE " . DDLQueries::$KEY_USER_LOGIN . " like '" . $login . "';";
    $result=mysql_query($sql);

    // Mysql_num_row is counting table row
    $count=mysql_num_rows($result);

    if($count==0) {
        $user = new User($login, $email, $password, null);
        $query = "INSERT INTO " . DDLQueries::$TABLE_USERS . " VALUES ('" .
                $user->getLogin() . "', '" . $user->getEmail() . "', '" . hash("sha256", $user->getPassword()) . "');";
        mysql_query($query);
        header("location:../index.php");
    }
    else {
        echo "Používateľ s takým menom už existuje";
    }