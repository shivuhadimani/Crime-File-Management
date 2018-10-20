<?php
include '../class/db.inc.php';
include '../class/exe.inc.php';
include '../includes/checkforlogin.php';
$obj=new logincheck;
if($obj->CheckForLogin()===0)
  header('location:../');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Crime | Home Page</title>
  </head>
  <link rel="stylesheet" href="../css/inside.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="../js/inside.js" charset="utf-8"></script>
  <style media="screen">
    th
    {
      margin-left:10px;
      width: 200px;
      margin-top: 10px;
      margin-right: 10px;
      padding-top: 10px;
      padding-bottom: 10px;
    }
    tr
    {
      margin-left: 20px;
      padding-left: 20px;
    }
    input
    {
      color:black;
    }
  </style>
  <body>
    <?php include 'header.php'; ?>
    <?php if(!isset($_GET['username'])): ?>
      <h2><font color="white">Please enter Complaint ID to get status</font></h2>
      <form class="" action="statuscompliant.php" method="GET">
        <input type="text" name="username" value="" placeholder="Compliant ID" required="required" id="inp" style="margin-left:80px;">
        <input type="submit" name="" value="Check" style="width:80px;">
      </form>
    <?php endif; ?>
    <?php if (isset($_GET['username'])): ?>
        <?php
          if (!empty($_GET['username']))
          {
            $query="SELECT * FROM `compliant` WHERE `id`=".$_GET['username'];
            $db=new database;
            $db->connect();
            $qobj=new queryexc;
            $data=$qobj->exc($db->con,$query);
            if($data[0]!==0)
            {
            ?>
          <font color="white">
            <h3>Status : <?php echo $data[1]['status'] ?></h3>
          </font>
        <?php }else
              {
                echo "<h1><font>No records found</font></h1>";
              }
            }
        ?>
    <?php endif; ?>
  </body>
</html>
