<?php
include '../class/db.inc.php';
if(isset($_SESSION['username']))
{
  unset($_SESSION['username']);
  unset($_SESSION['userpass']);
  unset($_SESSION['email']);
  session_destroy();
}
header('location:../');
?>
