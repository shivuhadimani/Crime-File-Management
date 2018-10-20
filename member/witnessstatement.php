<?php
include '../class/db.inc.php';
include '../class/exe.inc.php';
include '../includes/checkforlogin.php';
$obj=new logincheck;
if($obj->CheckForLogin()===0)
  header('location:../');
if(isset($_POST['cid']) && isset($_POST['witid']) && isset($_POST['state']))
{
  if(!empty($_POST['cid']) && !empty($_POST['witid']) && !empty($_POST['state']))
  {
    $q="SELECT * FROM `comp_wit` WHERE `comp_id`=".$_POST['cid']." AND `wit_id`=".$_POST['witid'];
    $db=new database;
    $db->connect();
    $qq=new queryexc;
    $data=$qq->exc($db->con,$q);
    if($data[0]===0)
    {
      $q="INSERT INTO `comp_wit` VALUES (".$_POST['cid'].",".$_POST['witid'].",'".$_POST['state']."')";
      if($qq->qexc($db->con,$q))
        echo "correct";
      else
        echo "error";
    }else
    {
      echo "error";
    }
  }
}
?>
