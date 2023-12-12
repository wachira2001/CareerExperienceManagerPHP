<?php
    $serverName = "db"; //localhost
    $userName = "root";
    $userPassword = "MYSQL_ROOT_PASSWORD";
    $dbName = "MYSQL_DATABASE";
?>

<?php
    $conn = @mysqli_connect($serverName,$userName,$userPassword,$dbName);
//    global $conn;
?>

<?php
    // @date_default_timezone_set("Asia/Bangkok");
    // @mysqli_set_charset($conn, "utf-8");
    // @mysqli_query($conn, "SET NAMES UTF8");
?>

<?php
    // $strSQL = "SELECT * FROM product";
    // $query = @mysqli_query($conn, $strSQL);
    // // $resultObj = @mysqli_fetch_array($query, MYSQLI_ASSOC);
    // // print_r($resultObj)

    // while ($resultObj = mysqli_fetch_array($query, MYSQLI_ASSOC)){
    //     print_r($resultObj);
    // }
?>