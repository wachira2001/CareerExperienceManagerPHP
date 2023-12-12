<?php ob_start(); ?>
<?php
    #header
    @header('Content-Type: application/json');
    @header("Access-Control-Allow-Origin: *");
    @header('Access-Control-Allow-Headers: X-Requested-With, content-type, access-control-allow-origin, access-control-allow-methods, access-control-allow-headers');
?>
<?php
    require ("../config/config_db.php");
//print_r($conn);
?>
<?php
#input
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $content = @file_get_contents('php://input');
    $json_data = @json_decode($content, true);
    $band = trim($json_data["band"]);
}else{
    ob_end_clean();
    @header("HTTP/1.0 412 Precondition Failed");
    die();
}
?>
<?php
    $strSQL = "SELECT * FROM bis41_car";
    $query = @mysqli_query($conn,$strSQL);
    $datalist =array();
    while($resultQuery = @mysqli_fetch_array($query)){
        $regis = $resultQuery['car_regis'];
        $band = $resultQuery['car_band'];
        $series = $resultQuery['car_series'];
        $rate = $resultQuery['car_rate'];
        $num = $resultQuery['car_num'];
        $datalist[] = array("regis"=>$regis,"band"=>$band, "series"=>$series, "rate"=>$rate,"num"=>$num);
}
?>
<?php
#output
    ob_end_clean();
    @mysqli_close($conn);
    if($query){
        echo $json_response = json_encode(array("result"=>1,"message"=>"พบข้อมูล","datalist"=>$datalist));
    }else{
        echo $json_response = json_encode(array("result"=>0,"message"=>"ไม่พบข้อมูล","datalist"=>null));
    }
    exit;
?>