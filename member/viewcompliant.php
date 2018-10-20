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
      color:White;
    }

  </style>
  <body>
    <?php include 'header.php'; ?>
    <?php if(!isset($_GET['username'])): ?>
      <h2><font color="white">Please enter Compliant ID to view</font></h2>
      <form class="" action="viewcompliant.php" method="GET">
        <input type="text" name="username" value="" placeholder="Compliant ID" required="required" id="inp" style="margin-left:80px;">
        <input type="submit" name="" value="Check" style="width:80px;">
      </form>
    <?php endif; ?>
    <?php if (isset($_GET['username'])): ?>
      <?php
        if (!empty($_GET['username']))
        {
          $query="SELECT `compliant`.`id` as `cid`,`suspect_name`,`suspect_address`,`place_happened`,`date_happened`,`time_happened`,`status`,`police_station`.`address` as `paddress`,`type_crime`,`username` FROM `compliant`,`police_station`,`police` WHERE `compliant`.`id`=".$_GET['username']." AND `station_id`=`police_station`.`id` AND `police_id`=`username`";
          $db=new database;
          $db->connect();
          $qobj=new queryexc;
          $data=$qobj->exc($db->con,$query);
          if($data[0]!==0)
          {
          ?>
        <table width="100%" style="margin-left:20px;">
            <tr>
            <th>
              <font color="white">
            <table border="0px">
              <tr id="cid">
                <th>Compliant ID</th><th><?php echo $data[1]['cid']; ?></th>
              </tr>
              <tr id="cid">
                <th>Suspect name</th><th><?php echo $data[1]['suspect_name']; ?></th>
              </tr>
              <tr id="cid">
                <th>Suspect address</th><th><?php echo $data[1]['suspect_address']; ?></th>
              </tr>
              <tr id="cid">
                <th>Place of crime</th><th><?php echo $data[1]['place_happened']; ?></th>
              </tr>
              <tr id="cid">
                <th>Date of Crime</th><th><?php echo $data[1]['date_happened']; ?></th>
              </tr>
              <tr id="cid">
                <th>Time of crime</th><th><?php echo $data[1]['time_happened']; ?></th>
              </tr>
              <tr id="cid">
                <th>Type of crime</th><th><?php echo $data[1]['type_crime']; ?></th>
              </tr>
              <tr id="cid">
                <th>Incharge Station</th><th><?php echo $data[1]['paddress']; ?></th>
              </tr>
              <tr id="cid">
                <th>Complaint Taken By</th><th><?php echo $data[1]['username']; ?></th>
              </tr>
            </table>
            </font>
          </th>
          <th>
            <font color="white" size="6px">
            <h3>Click on the criminals name to view</h3>
            <table>
              <?php
                $qobj1=new queryexc;
                $query="SELECT `name`,`id` FROM `compliant_criminal`,`criminal` WHERE `criminal_id`=`id` AND `comp_id`=".$_GET['username'];
                $data1=$qobj1->exc($db->con,$query);
                for ($i=1; $i <= $data1[0] ; $i++)
                {
                  echo "<tr><th><a href=\"viewcriminal.php?username=".$data1[$i]['id']."\" target=\"_blank\" >".$data1[$i]['name']."</a></th></tr>";
                }
              ?>
            </table>
          </font>
          </th>
        </tr>
      </table>
      <font color="white">
        <h3>Click on the witness name to view there details</h3>
        <table>
          <?php
            $qobj2=new queryexc;
            $query="SELECT `name`,`id`,`report` FROM `comp_wit`,`witness` WHERE `wit_id`=`id` AND `comp_id`=".$_GET['username'];
            $data2=$qobj2->exc($db->con,$query);
            for ($i=1; $i <= $data2[0] ; $i++)
            {
              echo "<tr><th><a href=\"viewwitness.php?username=".$data2[$i]['id']."\" target=\"_blank\" >".$data2[$i]['name']."</a></th><th>".$data2[$i]['report']."</th></tr>";
            }
          ?>
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
