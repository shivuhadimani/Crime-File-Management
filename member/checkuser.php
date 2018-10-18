<?php
include '../class/db.inc.php';
include '../class/exe.inc.php';
include '../includes/checkforlogin.php';
$obj=new logincheck;
if($obj->CheckForLogin()===0)
  header('location:../');
if(isset($_POST['user']))
{
  if(!empty($_POST['user']))
  {
    $q="SELECT * FROM `police` WHERE `username`='".$_POST['user']."'";
    $db=new database;
    $db->connect();
    $qq=new queryexc;
    $data=$qq->exc($db->con,$q);
    if($data[0]==0)
      echo "correct";
    else
      echo "error";
  }
}
?>
