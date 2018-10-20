<?php
include '../class/db.inc.php';
include '../class/exe.inc.php';
include '../includes/checkforlogin.php';
$obj=new logincheck;
if($obj->CheckForLogin()===0)
  header('location:../');
if(isset($_POST['name']) && isset($_POST['occup']) && isset($_POST['add']) && isset($_POST['idnum']) && isset($_POST['dob']) && isset($_POST['age']) && isset($_POST['phoneno']) && isset($_POST['idcardtype']))
  if(!empty($_POST['name']) && !empty($_POST['occup']) && !empty($_POST['add']) && !empty($_POST['idnum']) && !empty($_POST['dob']) && !empty($_POST['age']) && !empty($_POST['phoneno']) && !empty($_POST['idcardtype']))
  {
    $query="SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'Crimedatabase' AND TABLE_NAME = 'witness'";
    $db1=new database;
    $qexc3=new queryexc;
    $db1->connect();
    $data4=$qexc3->exc($db1->con,$query);
    $id=$data4[1]['AUTO_INCREMENT'];
    $name=$_POST['name'];
    $occup=$_POST['occup'];
    $add=$_POST['add'];
    $idnum=$_POST['idnum'];
    $dob=$_POST['dob'];
    $age=$_POST['age'];
    $phone=$_POST['phoneno'];
    $idcardtype=$_POST['idcardtype'];
    $query="INSERT INTO `witness` VALUES ('','$name',$age,'$dob','$occup','$phone','$idnum','$idcardtype','$add')";
    $target="../witness/";
    $target = $target.$id.'.jpg';
    $uploadOk = 1;
    $imageFileType = pathinfo($target,PATHINFO_EXTENSION);
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check===false)
      $uploadOk=0;
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg")
      $uploadOk=0;
    if ($uploadOk===0)
      echo "<script>alert('only image files are accepted')</script>";
    else if (move_uploaded_file($_FILES["image"]["tmp_name"], $target))
      if($qexc3->qexc($db1->con,$query))
      {

      }else {
        echo "<script>alert('something went wrong')</script>";
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
    <form class="" action="addwitness.php" method="POST" enctype="multipart/form-data">
      <table>
        <tr>
          <th>
            <div class="form1">
              <font color="white">Witness id:
             <?php
                $query="SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'Crimedatabase' AND TABLE_NAME = 'witness'";
                $db=new database;
                $qexc1=new queryexc;
                $db->connect();
                $data1=$qexc1->exc($db->con,$query);
                echo "   ".$data1[1]['AUTO_INCREMENT'];
              ?>
              </font>
              <br>
              <input type="text" id="inp" required="required" name="name" value="" placeholder="Full Name"><br>
              <input type="text" name="add" id="inp" value="" required="required" placeholder="Address"><br>
              <input type="text" name="occup" value="" placeholder="Occupication" id="inp" required><br>
              <input type="date" name="dob" value="" placeholder="Date of birth" id="inp"  required="required"><br>
              <input type="number" name="age" value="" placeholder="Age" id="inp"  required="required"><br>
              <input type="text" name="phoneno" value="" placeholder="Phone Number" id="inp" required="required"><br>
              <input type="text" name="idnum" value="" placeholder="ID NUMBER" id="inp" required><br>
              <input type="text" name="idcardtype" value="" placeholder="ID CARD" id="inp" required><br>
              <input type="submit" name="sub" value="Add Witness" id="inp" required="required"><br>
            </div>
          </th>
          <th>
            <div class="form2" align="right">
              <div id="wrapper">
                <input type="file" accept="image/*" onchange="preview_image(event)" name="image" required="required">
                <img id="output_image"/>
              </div>
            </div>
          </th>
        </tr>
      </table>
    </form>
  </body>
</html>
