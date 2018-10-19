<?php
include '../class/db.inc.php';
include '../class/exe.inc.php';
include '../includes/checkforlogin.php';
$obj=new logincheck;
if($obj->CheckForLogin()===0)
  header('location:../');
  if(isset($_POST['id']) && isset($_POST['passw']))
    if(!empty($_POST['id']) && !empty($_POST['passw']))
    {
      $id=$_POST['id'];
      $pass=$_POST['passw'];
      if($_SESSION['userpass']===md5($pass))
      {
        $db=new database;
        $db->connect();
        $qexc=new queryexc;
        $query="DELETE FROM `criminal_causes` WHERE `criminal_id`=$id";
        if($qexc->qexc($db->con,$query))
        {
          $query="DELETE FROM `criminal` WHERE `id`=$id";
          unlink("../criminals/".$id.".jpg");
          if(!($qexc->qexc($db->con,$query)))
            echo "<script>alert('Please try again')</script>";
        }else
        {
          echo "<script>alert('Please try again')</script>";
        }
      }
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
      <h2><font color="white">Please enter Crminal ID to Remove</font></h2>
      <form class="" action="removecriminal.php" method="GET">
        <input type="text" name="username" value="" placeholder="Criminal ID" required="required" id="inp" style="margin-left:80px;">
        <input type="submit" name="" value="Check" style="width:80px;">
      </form>
    <?php endif; ?>
    <?php if (isset($_GET['username'])): ?>
        <?php
          if (!empty($_GET['username']))
          {
            $query="SELECT * FROM `criminal` WHERE `id`=".$_GET['username'];
            $db=new database;
            $db->connect();
            $qobj=new queryexc;
            $data=$qobj->exc($db->con,$query);
            if($data[0]!==0)
            {
            ?>
          <font color="white">
          <form class="" action="removecriminal.php" method="POST">
          <table width="100%">
            <tr>
            <th>
            <table border="0px">
              <tr>
                <th>Criminal</th><th><?php echo $data[1]['id']; ?></th>
              </tr>
              <input type="hidden" name="id" value="<?php echo $data[1]['id']; ?>">
              <tr>
                <th>Name</th><th><?php echo $data[1]['name']; ?></th>
              </tr>
              <tr>
                <th>Address</th><th><?php echo $data[1]['address']; ?></th>
              </tr>
              <tr>
                <th>Date of birth</th><th><?php echo $data[1]['dob']; ?></th>
              </tr>
              <tr>
                <th>Phone Number</th><th><?php echo $data[1]['phone_no']; ?></th>
              </tr>
              <tr>
                <th>Identy Card</th><th><?php echo $data[1]['id_card']; ?></th>
              </tr>
              <tr>
                <th>Identy Card Number</th><th><?php echo $data[1]['id_no']; ?></th>
              </tr>
              <tr>
                <th>Most Wnated status</th><th><?php echo $data[1]['most_wanted']; ?></th>
              </tr>
              <tr>
                <th>Please confirm by your password</th><th><input type="password" name="passw" value="" placeholder="Password" required id="inp"> </th>
              </tr>
              <tr>
                <th></th><th><input type="Submit" name="" value="remove" required="required" style="background-color: silvers;width:80px;"></th>
              </tr>
            </table>
          </th>
          <th>
            <table>
              <tr>
                <img src="../criminals/<?php echo $data[1]['id'] ?>.jpg" alt="" height="300px" width="260px">
              </tr>
            </table>
          </th></tr>
          </table>
        </form>
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
