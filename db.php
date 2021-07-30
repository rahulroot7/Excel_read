<?php
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'excel_read';
  
$db = new mysqli($db_host, $db_username, $db_password, $db_name);
  
if($db->connect_error){
    die("Unable to connect database: " . $db->connect_error);
}

// if (!empty($sheetData)) {
//             for ($i=1; $i<count($sheetData); $i++) {
//                 $name = $sheetData[$i][1];
//                 $email = $sheetData[$i][2];
//                 $db->query("INSERT INTO USERS(name, email) VALUES('$name', '$email')");
//             }
//         }