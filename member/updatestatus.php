<?php
include '../class/db.inc.php';
include '../class/exe.inc.php';
include '../includes/checkforlogin.php';
$obj=new logincheck;
if($obj->CheckForLogin()===0)
  header('location:../');
if(isset($_POST['cid']) && isset($_POST['status']))
{
  if(!empty($_POST['cid']) && !empty($_POST['status']))
  {
    $q="UPDATE `compliant` SET `status`='".$_POST['status']."' WHERE `id`=".$_POST['cid'];
    $db=new database;
    $db->connect();
    $qq=new queryexc;
    if($qq->exc($db->con,$q))
      echo "correct";
    else
      echo "error";
  }
}
?>
