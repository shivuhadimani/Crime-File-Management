<?php
include '../class/db.inc.php';
include '../class/exe.inc.php';
include '../includes/checkforlogin.php';
$obj=new logincheck;
if($obj->CheckForLogin()===0)
  header('location:../');
if(isset($_POST['supname']) && isset($_POST['crime']) && isset($_POST['add']) && isset($_POST['station']) && isset($_POST['place']) && isset($_POST['datehap']) && isset($_POST['timehap']))
  if(!empty($_POST['supname']) && !empty($_POST['crime']) && !empty($_POST['add']) && !empty($_POST['station']) && !empty($_POST['place']) && !empty($_POST['datehap']) && !empty($_POST['timehap']))
  {
    $query="SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'Crimedatabase' AND TABLE_NAME = 'criminal'";
    $db1=new database;
    $qexc3=new queryexc;
    $db1->connect();
    $data4=$qexc3->exc($db1->con,$query);
    $id=$data4[1]['AUTO_INCREMENT'];
    $supname=$_POST['supname'];
    $crime=$_POST['crime'];
    $add=$_POST['add'];
    $station=$_POST['station'];
    $place=$_POST['place'];
    $datehap=$_POST['datehap'];
    $timehap=$_POST['timehap'];
    $query="SELECT * FROM `police` WHERE `username`='".$_SESSION['username']."' AND `stat_id`=$station";
    $qexc4=new queryexc;
    $data5=$qexc4->exc($db1->con,$query);
    if($data5[0]===0)
    {
      echo "<script>alert('Trying to register compliant to another station');</script>";
    }else
    {
      $query="INSERT INTO `compliant` VALUES ('','$supname','$crime',$station,'".$_SESSION['username']."','$place','$datehap','$timehap','$add','Added to database,need to check')";
      if(!($qexc3->qexc($db1->con,$query)))
      {
          echo "<script>alert('Error while adding, please try again')</script>";
      }
    }
  }else
  {
      echo "<script>alert('Please fill all the details')</script>";
  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Crime | Add Criminal</title>
  </head>
  <link rel="stylesheet" href="../css/inside.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
  <script src="../js/inside.js" charset="utf-8"></script>
  <body>
    <?php include 'header.php'; ?>
    <form class="" action="addcompliant.php" method="POST">
      <table>
        <tr>
          <th>
            <div class="form1">
              <font color="white">Compliant ID:
              <?php
                $query="SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'Crimedatabase' AND TABLE_NAME = 'compliant'";
                $db=new database;
                $qexc1=new queryexc;
                $db->connect();
                $data1=$qexc1->exc($db->con,$query);
                echo "   ".$data1[1]['AUTO_INCREMENT'];
              ?>
              </font>
              <br>
              <input type="text" id="inp" required="required" name="supname" value="" placeholder="Suspect Name"><br>
              <input type="text" name="crime" id="inp" value="" required="required" placeholder="Crime"><br>
              <select class="" name="station" id="inp">
                <?php
                  $query="SELECT * FROM `police_station` WHERE 1";
                  $db=new database;
                  $db->connect();
                  $q=new queryexc;
                  $data=$q->exc($db->con,$query);
                  for ($i=1; $i <= $data[0]; $i++)
                    echo "<option value=\"".$data[$i]['id']."\">".$data[$i]['address']."</option>";
                ?>
              </select><br>
              <input type="text" name="place" value="" placeholder="Place crime happened" id="inp" required="required"><br>
              <input type="date" name="datehap" value="" placeholder="Date Crime happened" id="inp" required><font color="white">  Date of crime</font><br>
              <input type="time" name="timehap" value="" placeholder="Time of crime" id="inp" required><font color="white">  Time of crime</font><br>
              <input type="text" name="add" value="" placeholder="Suspect Address" id="inp" required><br>
              <input type="submit" name="sub" value="Add Compliant" id="inp" required="required" style="width:140px"><br>
            </div>
          </th>
        </tr>
      </table>
    </form>
  </body>
</html>
