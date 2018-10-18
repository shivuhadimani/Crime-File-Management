<?php
  include '../includes/checkforlogin.php';
  include '../class/db.inc.php';
  include '../class/exe.inc.php';
  $login=new logincheck;
  if($login->CheckForLogin())
  {
    header('location:homepage.php');
  }else if(isset($_POST['username']) && isset($_POST['passw']) && isset($_POST['t1']) && isset($_POST['t2']) && isset($_POST['t3']) && isset($_POST['t4']))
  {
    $username=$_POST['username'];
    $password=$_POST['passw'];
    $pin=$_POST['t1'].$_POST['t2'].$_POST['t3'].$_POST['t4'];
    $query="SELECT * FROM `police` WHERE `username`='$username' AND `pass`='".md5($password)."' AND `pin`='$pin'";
    $queryclass=new queryexc;
    $db=new database;
    $db->connect();
    $data=$queryclass->exc($db->con,$query);
    echo $query;
    if($data[0]===1)
    {
      $_SESSION['username']=$username;
      $_SESSION['userpass']=md5($password);
      $_SESSION['email']=$data[1]['email'];
      header('location:homepage.php');
    }else
    {
      echo "<script>alert('mismatching details')</script>";
      header('location:../index.php');
    }
  }else
  {
    header('location:../index.php');
  }
?>
