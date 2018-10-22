<?php
include '../class/db.inc.php';
include '../class/exe.inc.php';
include '../includes/checkforlogin.php';
$obj=new logincheck;
if($obj->CheckForLogin()===0)
  header('location:../');
if(isset($_POST['compno']) && isset($_POST['charges']))
  if(!empty($_POST['compno']) && !empty($_POST['charges']))
  {
    $query="SELECT * FROM `charge_sheet` WHERE `comp_id`=".$_POST['compno'];
    $db=new database;
    $q1=new queryexc;
    $db->connect();
    $data1=$q1->exc($db->con,$query);
    if($data1[0]===0)
    {
      $query="INSERT INTO `charge_sheet` VALUES ('',".$_POST['compno'].",'".$_POST['charges']."')";
      $target="../chargesheet/";
      $target = $target.$_POST['compno'].'.pdf';
      $file_type=$_FILES['file']['type'];
      if(!($file_type=="application/pdf"))
        echo "<script>alert('only pdf files are accepted')</script>";
      else if (move_uploaded_file($_FILES["file"]["tmp_name"], $target))
        if(!($q1->qexc($db->con,$query)))
        {
            echo "<script>alert('Please try again');</script>";
        }
      }else
      {
        echo "<script>alert('CHARGE SHEET is already added');</script>";
      }
  }else
  {
    echo "<script>alert('Please fill all details');</script>";
  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Crime | REGISTER CHARGE SHEET</title>
    <link rel="stylesheet" href="../css/inside.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    function checkforcompliantid()
    {
      var comp_no=document.getElementById('compno').value;
      if(comp_no!="")
      {
        var req = new XMLHttpRequest();
        var url="checkforcompliant.php";
        var variable="comp_id="+comp_no;
        req.open("POST",url,true);
        req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        req.onreadystatechange=function(){
          if(req.readyState==4 && req.status==200)
          {
            var returndata=req.responseText;
            if(returndata=="error")
            {
                document.getElementById('mybutton').disabled=true;
                document.getElementById('checkforid').innerHTML="<font color=\"black\">Please check your compliant number again, or charge sheet is added</font>";
            }
            else if(returndata=="correct")
            {
              document.getElementById('mybutton').disabled=false;
              document.getElementById('checkforid').innerHTML="<font color=\"black\"><a href=\"viewcompliant.php?username="+comp_no+"\" target=\"_blank\">Click here to view compliant</a></font>";
            }
            else
              alert("Something went wrong try again,Try again later");
          }
        }
        req.send(variable);
      }else
      {
          alert('Please fill the compliant field')
      }
    }
    </script>
  </head>
  <style media="screen">
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
    <?php include 'header.php';
      $query="SELECT `AUTO_INCREMENT` AS `mainid` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'Crimedatabase' AND TABLE_NAME = 'charge_sheet'";
      $db=new database;
      $db->connect();
      $qq=new queryexc;
      $data=$qq->exc($db->con,$query);
    ?>
    <form class="form2" action="registercharge.php" method="POST" enctype="multipart/form-data" >
      <table>
        <tr>
          <font color="white">FIR Number: &nbsp;&nbsp;&nbsp;&nbsp; <?php echo "    ".$data[1]['mainid']; ?></font>
        </tr>
        <tr>
          <th><input type="number" name="compno" value="" id="compno" placeholder="Compliant Number" onchange="checkforcompliantid()" required /></th><th><span id="checkforid"></span> </th>
        </tr>
        <tr>
          <th><textarea name="charges" rows="8" cols="40" maxlength="150" id="inp" style="border-radius: 6px;border-width: 2px;border-bottom-color: black" placeholder="CHARGES, please separte with comma's" required></textarea></th>
        </tr>
        <tr>
          <th><input type="file" name="file" accept="application/pdf" id="inp" value=""></th><th><font color="white">Report in PDF is only allowed</font></th>
        </tr>
        <tr>
          <th><input type="submit" id="mybutton" name="" disabled value="REGISTER FIR" style="margin-left: 40px;margin-top: 6px;width:140px;"> </th>
        </tr>
      </table>
    </form>
  </body>
</html>
