<?php
include '../class/db.inc.php';
include '../class/exe.inc.php';
include '../includes/checkforlogin.php';
$obj=new logincheck;
if($obj->CheckForLogin()===0)
  header('location:../');
  if(isset($_POST['username']) && isset($_POST['name'])&& isset($_POST['add']) && isset($_POST['dob']) && isset($_POST['phoneno']) && isset($_POST['email']))
    if(!empty($_POST['username']) && !empty($_POST['name']) && !empty($_POST['add']) && !empty($_POST['dob']) && !empty($_POST['phoneno']) && !empty($_POST['email']))
    {
      $username=$_POST['username'];
      $name=$_POST['name'];
      $address=$_POST['add'];
      $dob=$_POST['dob'];
      $phoneno=$_POST['phoneno'];
      $email=$_POST['email'];
      $query="UPDATE `police` SET `name`='$name',`address`='$address',`dob`='$dob',`phoneno`='$phoneno',`email`='$email' WHERE `username`='".$username."'";
      $db=new database;
      $qexc=new queryexc;
      $db->connect();
      if(!($qexc->qexc($db->con,$query)))
        echo "<script>alert('Please try again')</script>";
    }else
    {
        echo "<script>alert('Please fill all details')</script>";
    }
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
      width: 100px;
    }
    tr
    {
      margin-left: 20px;
      padding-left: 20px;
    }
  </style>
  <body>
    <?php include 'header.php'; ?>
    <?php if(!isset($_GET['username'])): ?>
      <h2><font color="white">Please enter username to update</font></h2>
      <form class="" action="updatestaff.php" method="GET">
        <input type="text" name="username" value="" placeholder="Username" required="required" id="inp" style="margin-left:80px;">
        <input type="submit" name="" value="Check" style="width:80px;">
      </form>
    <?php endif; ?>
    <?php if (isset($_GET['username'])): ?>
        <?php
          if (!empty($_GET['username']))
          {
            $query="SELECT * FROM `police` WHERE `username`='".$_GET['username']."'";
            $db=new database;
            $db->connect();
            $qobj=new queryexc;
            $data=$qobj->exc($db->con,$query);
            if($data[0]!==0)
            {
            ?>
          <form class="" action="updatestaff.php" method="POST">
          <table border="0px">
            <tr>
              <th>Username</th><th><?php echo $data[1]['username']; ?></th>
            </tr>
            <tr>
              <th><input type="hidden" name="username" value="<?php echo $data[1]['username']; ?>" placeholder="Full name" required="required"></th>
            </tr>
            <tr>
              <th>Name</th><th><input type="text" name="name" value="<?php echo $data[1]['name']; ?>" placeholder="Full name" required="required"></th>
            </tr>
            <tr>
              <th>Address</th><th><input type="text" name="add" value="<?php echo $data[1]['address']; ?>" placeholder="Address" required="required"></th>
            </tr>
            <tr>
              <th>Date of birth</th><th><input type="date" name="dob" value="<?php echo $data[1]['dob']; ?>" placeholder="Date of birth" required="required"></th>
            </tr>
            <tr>
              <th>Phone Number</th><th><input type="text" name="phoneno" value="<?php echo $data[1]['phoneno']; ?>" placeholder="Phone Number" required="required"></th>
            </tr>
            <tr>
              <th>Email</th><th><input type="email" name="email" value="<?php echo $data[1]['email']; ?>" placeholder="Email" required="required"></th>
            </tr>
            <tr>
              <th></th><th><input type="Submit" name="" value="update" required="required"></th>
            </tr>
          </table>
        </form>
        <?php }else
              {
                echo "<h1><font>No records found</font></h1>";
              }
            }
        ?>
    <?php endif; ?>
  </body>
</html>
