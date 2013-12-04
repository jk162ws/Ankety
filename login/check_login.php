<?php
    require '../db/DDLQueries.php';
    
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
    $password = hash("sha256", mysql_real_escape_string(stripslashes(filter_input(INPUT_POST, "password"))));

    $sql="SELECT * FROM $tbl_name" . " WHERE " . DDLQueries::$KEY_USER_LOGIN . " like '" . $login . 
        "' and " . DDLQueries::$KEY_USER_PASSWORD . " like '" . $password . "';";
    $result=mysql_query($sql);

    // Mysql_num_row is counting table row
    $count=mysql_num_rows($result);

    // If result matched $myusername and $mypassword, table row must be 1 row

    if($count==1){

        // Register $myusername, $mypassword and redirect to file "login_success.php"
        session_start();
        $_SESSION['login'] = "1";
        $_SESSION['user'] = $login;
        header("location:login_success.php");
    }
    else {
        echo "Nesprávne prihlasovacie meno alebo heslo";
    }