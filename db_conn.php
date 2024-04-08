<?php
$server_name='Localhost';
$db_user='root';
$db='Jamii1_hospital';
$pass='';

$conn =new mysqli($server_name,$db_user,$pass,$db);
if(!$conn){
 die('connection failed');
}
// else{
//     echo 'connection successfully';
// }
?>