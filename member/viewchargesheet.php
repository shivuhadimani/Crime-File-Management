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
    a
    {
      text-decoration: none;
      color: black;
    }
    a:visited
    {
      color: black;
    }
    a:hover
    {
      color:white;
    }
  </style>
  <body>
    <?php include 'header.php'; ?>
    <?php if(!isset($_GET['chargeno'])): ?>
      <h2><font color="white">Please enter Chargesheet ID to view</font></h2>
      <form class="" action="viewchargesheet.php" method="GET">
        <input type="text" name="chargeno" value="" placeholder="Charge sheet NO" required="required" id="inp" style="margin-left:80px;">
        <input type="submit" name="" value="Check" style="width:80px;">
      </form>
    <?php endif; ?>
    <?php if (isset($_GET['chargeno'])): ?>
        <?php
          if (!empty($_GET['chargeno']))
          {
            $query="SELECT * FROM `charge_sheet` WHERE `id`=".$_GET['chargeno'];
            $db=new database;
            $db->connect();
            $qobj=new queryexc;
            $data=$qobj->exc($db->con,$query);
            if($data[0]!==0)
            {
            ?>
          <font color="white">
          <table width="100%" style="margin-left:20px;ss">
            <tr>
            <th>
            <table border="0px">
              <tr>
                <th>Charge sheet ID</th><th><?php echo $data[1]['id']; ?></th>
              </tr>
              <tr>
                <th>Compliant ID</th><th><?php echo $data[1]['comp_id']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="viewcompliant.php?username=<?php echo $data[1]['comp_id']; ?>" target="_blank">View Compliant</a> </th>
              </tr>
              <tr>
                <th>Charges</th><th><?php echo $data[1]['charges']; ?></th>
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
