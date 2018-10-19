<?php
include '../class/db.inc.php';
include '../class/exe.inc.php';
include '../includes/checkforlogin.php';
$obj=new logincheck;
if($obj->CheckForLogin()===0)
  header('location:../');
if(isset($_POST['name']) && isset($_POST['occup']) && isset($_POST['add']) && isset($_POST['identity']) && isset($_POST['idnum']) && isset($_POST['dob']) && isset($_POST['age']) && isset($_POST['phoneno']) && isset($_POST['idcardtype']) && isset($_POST['mw']))
  if(!empty($_POST['name']) && !empty($_POST['occup']) && !empty($_POST['add']) && !empty($_POST['identity']) && !empty($_POST['idnum']) && !empty($_POST['dob']) && !empty($_POST['age']) && !empty($_POST['phoneno']) && !empty($_POST['idcardtype']) && !empty($_POST['mw']))
  {
    $query="SELECT MAX(`id`) AS `max` FROM `criminal` WHERE 1";
    $db1=new database;
    $qexc3=new queryexc;
    $db1->connect();
    $data4=$qexc3->exc($db1->con,$query);
    $id=$data4[1]['max']+1;
    $name=$_POST['name'];
    $occup=$_POST['occup'];
    $add=$_POST['add'];
    $identity=$_POST['identity'];
    $idnum=$_POST['idnum'];
    $dob=$_POST['dob'];
    $age=$_POST['age'];
    $phone=$_POST['phoneno'];
    $idcardtype=$_POST['idcardtype'];
    $mw=$_POST['mw'];
    $query="SELECT * FROM `crime_type` WHERE 1";
    $qexc4=new queryexc;
    $data5=$qexc4->exc($db1->con,$query);
    $check=0;
    for ($i=1; $i < $data5[0]; $i++)
      if(isset($_POST[$data5[$i]['id']]))
        $check=1;
    if($check===0)
    {
      echo "<script>alert('selected none of the crime');</script>";
    }else
    {
      if($mw==1)
        $mw="yes";
      else
        $mw="no";
      $identity=str_replace(',','#',$identity);
      $query="INSERT INTO `criminal` VALUES ('','$name',$age,'$dob','$occup','$phone','$identity','$idnum','$idcardtype','$mw','$add')";
      $target="../criminals/";
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
          $query="";
          for ($i=1; $i < $data5[0]; $i++)
            if(isset($_POST[$data5[$i]['id']]))
            {
              $query="INSERT INTO `criminal_causes` VALUES ($id,".$data5[$i]['id'].")";
              $qexc3->qexc($db1->con,$query);
            }
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
    <form class="" action="addcriminal.php" method="POST" enctype="multipart/form-data">
      <table>
        <tr>
          <th>
            <div class="form1">
              <font color="white">Criminal id:
              <?php
                $query="SELECT MAX(`id`) AS `max` FROM `criminal` WHERE 1";
                $db=new database;
                $qexc1=new queryexc;
                $db->connect();
                $data1=$qexc1->exc($db->con,$query);
                echo "   ".$data1[1]['max']+1;
              ?>
              </font>
              <br>
              <input type="text" id="inp" required="required" name="name" value="" placeholder="Full Name"><br>
              <input type="text" name="add" id="inp" value="" required="required" placeholder="Address"><br>
              <input type="text" name="occup" value="" placeholder="Occupication" id="inp" required><br>
              <input type="date" name="dob" value="" placeholder="Date of birth" id="inp"  required="required"><br>
              <input type="number" name="age" value="" placeholder="Age" id="inp"  required="required"><br>
              <input type="text" name="phoneno" value="" placeholder="Phone Number" id="inp" required="required"><br>
              <input type="text" name="identity" value="" placeholder="identity marks" id="inp" required><br>
              <input type="text" name="idnum" value="" placeholder="ID NUMBER" id="inp" required><br>
              <input type="text" name="idcardtype" value="" placeholder="ID CARD" id="inp" required><br>
              <font color="white">
              Most wanted <input type="radio" name="mw" value="1" checked style="margin-left: 5px;">YES <input type="radio" name="mw" value="2"  style="margin-left: 5px;">NO <br>
              Select the crimes he did
              <br>
              <?php
                $query="SELECT * FROM `crime_type` WHERE 1";
                $db=new database;
                $qexc2=new queryexc;
                $db->connect();
                $data2=$qexc2->exc($db->con,$query);
                for ($i=1; $i <= $data2[0]; $i++)
                {
              ?>
                <input type="radio" name="<?php echo $data2[$i]['id']; ?>" value="<?php echo $data2[$i]['id']; ?>" style="margin-left: 5px;"><?php echo $data2[$i]['crime_name']; ?>
              <?php
                  if($i%4==0)
                    echo "<br>";
                }
              ?>
            </font>
              <input type="submit" name="sub" value="Add Criminal" id="inp" required="required"><br>
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
