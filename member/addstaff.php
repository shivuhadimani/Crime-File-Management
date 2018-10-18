<?php
include '../class/db.inc.php';
include '../class/exe.inc.php';
include '../includes/checkforlogin.php';
$obj=new logincheck;
if($obj->CheckForLogin()===0)
  header('location:../');
if(isset($_POST['username']) && isset($_POST['name']) && isset($_POST['passw']) && isset($_POST['add']) && isset($_POST['grade']) && isset($_POST['pin']) && isset($_POST['dob']) && isset($_POST['age']) && isset($_POST['phoneno']) && isset($_POST['email']) && isset($_POST['station']))
  if(!empty($_POST['username']) && !empty($_POST['name']) && !empty($_POST['passw']) && !empty($_POST['add']) && !empty($_POST['grade']) && !empty($_POST['pin']) && !empty($_POST['dob']) && !empty($_POST['age']) && !empty($_POST['phoneno']) && !empty($_POST['email']) && !empty($_POST['station']))
  {
    $username=$_POST['username'];
    $name=$_POST['name'];
    $pass=$_POST['passw'];
    $add=$_POST['add'];
    $grade=$_POST['grade'];
    $pin=$_POST['pin'];
    $dob=$_POST['dob'];
    $age=$_POST['age'];
    $phone=$_POST['phoneno'];
    $email=$_POST['email'];
    $station=$_POST['station'];
    $query="SELECT * FROM `police` WHERE `username`='$username'";
    $db=new database;
    $qexc=new queryexc;
    $db->connect();
    $data=$qexc->exc($db->con,$query);
    if($data[0]===0)
    {
      $query="INSERT INTO `police` VALUES ('$username','$name','".md5($pass)."','$add',$grade,'$pin','$dob',$age,'$phone','$email',$station)";
      $target="profile/";
      $target = $target.$username.'.jpg';
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
        if($qexc->qexc($db->con,$query))
        {
          $query="INSERT INTO `working` VALUES ('$username',$station,'".date("Y-n-j")."','')";
          if($qexc->qexc($db->con,$query))
          {

          }else
          {
              echo "<script>alert('Please contact maanager immeditaly data insertion error')</script>";
          }
        }
    }else
    {
        echo "<script>Please choose another username</script>";
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
    <title>Crime | Add staff</title>
  </head>
  <link rel="stylesheet" href="../css/inside.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
  <script src="../js/inside.js" charset="utf-8"></script>
  <body>
    <?php include 'header.php'; ?>
    <form class="" action="addstaff.php" method="POST" enctype="multipart/form-data">
      <table>
        <tr>
          <th>
            <div class="form1">
              <input type="text" id="inp1" required="required" class="username" name="username" onchange="checkuser()" value="" placeholder="Username"><span id="username"></span><br>
              <input type="text" id="inp" required="required" name="name" value="" placeholder="Full Name"><br>
              <input type="password" name="passw" id="passw" required="required" value="" placeholder="Password">&nbsp;&nbsp;&nbsp;&nbsp; <span onmouseover="showpass()" id="showpas"><i class="fas fa-eye"></i>Show password</span><br>
              <input type="text" name="add" id="inp" value="" required="required" placeholder="Address"><br>
              <select class="" name="grade" id="inp">
                <option value="1">Select grade</option>
              </select><br>
              <input type="password" name="pin" value="" placeholder="Security PIN" required="required" id="inp" maxlength="4"><br>
              <input type="date" name="dob" value="" placeholder="Date of birth" id="inp"  required="required"><br>
              <input type="number" name="age" value="" placeholder="Age" id="inp"  required="required"><br>
              <input type="text" name="phoneno" value="" placeholder="Phone Number" id="inp" required="required"><br>
              <input type="email" name="email" value="" placeholder="Email" id="inp" required="required"><br>
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
              <input type="submit" name="sub" value="Add Staff" id="inp" required="required">
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
