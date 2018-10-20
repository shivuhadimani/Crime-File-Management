<?php
include '../class/db.inc.php';
include '../class/exe.inc.php';
include '../includes/checkforlogin.php';
$obj=new logincheck;
if($obj->CheckForLogin()===0)
  header('location:../');
if(isset($_POST['cid']) && isset($_POST['crimiid']))
{
  if(!empty($_POST['cid']) && !empty($_POST['crimiid']))
  {
    $q="SELECT * FROM `compliant_criminal` WHERE `comp_id`=".$_POST['cid']." AND `criminal_id`=".$_POST['crimiid'];
    $db=new database;
    $db->connect();
    $qq=new queryexc;
    $data=$qq->exc($db->con,$q);
    if($data[0]===0)
    {
      $q="INSERT INTO `compliant_criminal` VALUES (".$_POST['cid'].",".$_POST['crimiid'].")";
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
