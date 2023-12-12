<?php ob_start(); ?>
<?php
#header
@header('Content-Type: application/json');
@header("Access-Control-Allow-Origin: *");
@header('Access-Control-Allow-Headers: X-Requested-With, content-type, access-control-allow-origin, access-control-allow-methods, access-control-allow-headers');
?>
<?php
#connection and data include  OR require
require ("../config/config_db.php");
//print_r($conn);
?>
<?php
#input
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $content = @file_get_contents('php://input');
    $json_data = @json_decode($content, true);
    //print_r($json_data);
    $inputEmail = trim($json_data["email"]);
    $inputPassword = trim($json_data["password"]);
    $session = trim($json_data["session"]);
}else{
    ob_end_clean();
    @header("HTTP/1.0 412 Precondition Failed");
    die();
}
?>
<?php
#process
$strSQL="SELECT * FROM customer WHERE email = '".$inputEmail."' ";
$query = @mysqli_query($conn,$strSQL);
$resultQuery = @mysqli_fetch_array($query);
print_r($resultQuery);

if(trim($resultQuery['email']) !="" && trim($resultQuery['password']) == $inputPassword){
    $result=1;
    $message ="เข้าสู่ระบบ";
    $strSQL="UPDATE customer SET session='".$session."' WHERE email ='".$resultQuery['email']."' ";
    $query = @mysqli_query($conn,$strSQL);
}else{
    $result=0;
    $message ="เข้าสู่ระบบไม่สำเร็จ";
}
?>
<?php
#output
ob_end_clean();
@mysqli_close($conn);
echo $json_response = json_encode(array("result"=>$result,"message"=>$message));
_log_customer_login($content,$json_response);
exit;
?>
<?php
#log function
#ใครเรียกใช้งาน? #เวลาที่เรียกใช้งาน?   #ส่งอะไรมา?  #เราตอบอะไรกลับ?
function _log_customer_login($content,$json_response){
    $ip = $_SERVER['REMOTE_ADDR'];
    $date = @date("Y-m-d H:i:s");
    $_log = "\n".$date." ".$ip." request:".$content." response:".$json_response;
    $objFopen=@fopen("log/_log_customer_login.log","a+"); #a a+ w w+
    @fwrite($objFopen,$_log);
    @fclose($objFopen);
}

?>