<?php
    // connect database 
    $db_host = "localhost";
    $db_user = "root";
    $db_password = "123456";
    $db_name = "songs";

    $mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);
    $mysqli->set_charset("utf8");

    // check connection error 
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    } else {
        // echo "Connect success.";

    }

    //$kw = $_GET['kw'];
     $kw = $_POST['kw'];
     $typ = $_POST['typ'];
     if($typ == ""){
        $sql = "SELECT *
            FROM song
            WHERE NameSong LIKE '%$kw%'OR Artist_Name LIKE '%$kw%'OR Lyrics LIKE '%$kw%'";
    $result = $mysqli->query($sql);
    }
    else{
        $sql = "SELECT *
            FROM song
            WHERE NameSong LIKE '%$kw%'AND Artist_Name LIKE '%$typ%'";
    $result = $mysqli->query($sql);
    }

    $arr = array();
    if ($result->num_rows > 0){
        
        while($row = $result->fetch_object())
        {
            $arr[] = $row;
        }
    } else {
         echo "Not found.";
    }
    echo json_encode($arr);

    