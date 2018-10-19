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
    #tabcol
    {
      margin-left:10px;
      width: 150px;
      padding: 1px 3px 1px 3px;
    }
    #tabrow
    {
      margin-left: 20px;
      padding-left: 20px;
    }
  </style>
  <body>
    <?php include 'header.php'; ?>
    <?php if(!isset($_GET['username'])): ?>
      <h2><font color="white">Please enter username to view</font></h2>
      <form class="" action="viewstaff.php" method="GET">
        <input type="text" name="username" value="" placeholder="Username" required="required" id="inp" style="margin-left:80px;">
        <input type="submit" name="" value="Check" style="width:80px;">
      </form>
    <?php endif; ?>
    <?php if (isset($_GET['username'])): ?>
        <?php
          if (!empty($_GET['username']))
          {
            $query="SELECT `username`,`name`,`police`.`address`,`dob`,`phoneno`,`email`,`police_station`.`address` as `poladdress` FROM `police`,`police_station` WHERE `username`='".$_GET['username']."' AND `stat_id`=`id`";
            $db=new database;
            $db->connect();
            $qobj=new queryexc;
            $data=$qobj->exc($db->con,$query);
            if($data[0]!==0)
            {
              $query="SELECT `station_id`,`from_when`,`upto`,`address`  FROM `working`,`police_station` WHERE `police_station`.`id`=`working`.`station_id` AND `user_name`='".$_GET['username']."'";
              $obj=new queryexc;
              $data1=$obj->exc($db->con,$query);
        ?>
        <font color="white">
          <table border="0px" style="margin-left:40px;">
              <tr>
                <th>
                  <table border="0px">
                    <tr id="tabrow">
                      <th id="tabcol">Username</th><th id="tabcol"><?php echo $data[1]['username']; ?></th>
                    </tr>
                    <tr id="tabrow">
                      <th id="tabcol">Name</th><th id="tabcol"><?php echo $data[1]['name']; ?></th>
                    </tr>
                    <tr id="tabrow">
                      <th id="tabcol">Address</th><th id="tabcol"><?php echo $data[1]['address']; ?></th>
                    </tr>
                    <tr id="tabrow">
                      <th id="tabcol">Date of birth</th><th id="tabcol"><?php echo $data[1]['dob']; ?></th>
                    </tr>
                    <tr id="tabrow">
                      <th id="tabcol">Phone Number</th><th id="tabcol"><?php echo $data[1]['phoneno']; ?></th>
                    </tr>
                    <tr id="tabrow">
                      <th id="tabcol">Email</th><th id="tabcol"><?php echo $data[1]['email']; ?></th>
                    </tr>
                    <tr id="tabrow">
                      <th id="tabcol">Working station</th><th id="tabcol"><?php echo $data[1]['poladdress']; ?></th>
                    </tr>
                  </table>
                </th>
                <th>
                  <table border="3px">
                    <tr>
                      <th>Police station  ID</th>
                      <th>Address</th>
                      <th>Service started</th>
                      <th>Service ended</th>
                    </tr>
                    <?php
                      for ($i=1; $i <= $data1[0] ; $i++)
                      {
                        echo "<tr id=\"tabrow\"><th id=\"tabcol\">".$data1[$i]['station_id']."</th><th id=\"tabcol\">".$data1[$i]['address']."</th><th id=\"tabcol\">".$data1[$i]['from_when']."</th><th id=\"tabcol\">";
                        if($data1[$i]['upto']=='0000-00-00')
                          echo "Current</th></tr>";
                        else
                          echo $data1[$i]['upto']."</th></tr>";
                      }
                    ?>
                  </table>
                </th>
              </tr>
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
