<?php
include '../class/db.inc.php';
include '../class/exe.inc.php';
include '../includes/checkforlogin.php';
$obj=new logincheck;
if($obj->CheckForLogin()===0)
  header('location:../');
if(isset($_POST['comp_id']))
{
  if(!empty($_POST['comp_id']))
  {
    $q="SELECT * FROM `compliant` WHERE `compliant`.`id`=".$_POST['comp_id']." AND `compliant`.`id` NOT IN (SELECT `comp_id` FROM `charge_sheet` WHERE 1)";
    $db=new database;
    $db->connect();
    $qq=new queryexc;
    $data=$qq->exc($db->con,$q);
    if($data[0]===1)
      echo "correct";
    else
      echo "error";
  }
}
?>
