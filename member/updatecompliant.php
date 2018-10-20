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
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
  <script src="../js/inside.js" charset="utf-8"></script>
  <script type="text/javascript">
  function updatestatus(par)
  {
    var status=document.getElementById('status').value;
    if(status!="")
    {
      var req = new XMLHttpRequest();
      var url="updatestatus.php";
      var variable="cid="+par+"&status="+status;
      req.open("POST",url,true);
      req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
      req.onreadystatechange=function(){
        if(req.readyState==4 && req.status==200)
        {
          var returndata=req.responseText;
          if(returndata=="error")
            alert("Status is not updated, please try again later");
          else if(returndata=="correct")
            alert("Status is updated successfully");
          else
            alert("Something went wrong try again,Try again later");
        }
      }
      req.send(variable);
    }else
    {
        alert('Please fill the status field');
    }
  }
  function addcriminal(par)
  {
    var cid=document.getElementById('criminalid').value;
    if(cid!="")
    {
      var req = new XMLHttpRequest();
      var url="addcriminaltocase.php";
      var variable="cid="+par+"&crimiid="+cid;
      req.open("POST",url,true);
      req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
      req.onreadystatechange=function(){
        if(req.readyState==4 && req.status==200)
        {
          var returndata=req.responseText;
          if(returndata=="error")
            alert("Criminal is not added, beacause criminal is not exist or already added");
          else if(returndata=="correct")
            alert("Criminal is added successfully");
          else
            alert("Something went wrong try again,Try again later");
        }
      }
      req.send(variable);
    }else
    {
        alert('Please fill the criminal id field');
    }
  }
  function removecriminal(par)
  {
    var cid=document.getElementById('criminalidremove').value;
    if(cid!="")
    {
      var req = new XMLHttpRequest();
      var url="removecriminaltocase.php";
      var variable="cid="+par+"&crimiid="+cid;
      req.open("POST",url,true);
      req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
      req.onreadystatechange=function(){
        if(req.readyState==4 && req.status==200)
        {
          var returndata=req.responseText;
          if(returndata=="error")
            alert("Criminal is not present in record");
          else if(returndata=="correct")
            alert("Criminal is successfully removed");
          else
            alert("Something went wrong try again,Try again later");
        }
      }
      req.send(variable);
    }else
    {
        alert('Please fill the criminal id field');
    }
  }
  function addwitness(par)
  {
    var wid=document.getElementById('witnessid').value;
    var state=document.getElementById('witnessstatement').value;
    if(cid!="" && state!="")
    {
      var req = new XMLHttpRequest();
      var url="witnessstatement.php";
      var variable="cid="+par+"&witid="+wid+"&state="+state;
      req.open("POST",url,true);
      req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
      req.onreadystatechange=function(){
        if(req.readyState==4 && req.status==200)
        {
          var returndata=req.responseText;
          if(returndata=="error")
            alert("Witness is already present in record");
          else if(returndata=="correct")
            alert("Witness is successfully added");
          else
            alert("Something went wrong try again,Try again later");
        }
      }
      req.send(variable);
    }else
    {
        alert('Please fill the witness field ans witness statement field');
    }
  }
  function removewitness(par)
  {
    var wid=document.getElementById('witnessidremove').value;
    if(wid!="")
    {
      var req = new XMLHttpRequest();
      var url="removewitnesstocase.php";
      var variable="cid="+par+"&wid="+wid;
      req.open("POST",url,true);
      req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
      req.onreadystatechange=function(){
        if(req.readyState==4 && req.status==200)
        {
          var returndata=req.responseText;
          if(returndata=="error")
            alert("Witness is not present in record");
          else if(returndata=="correct")
            alert("Witness is successfully removed");
          else
            alert("Something went wrong try again,Try again later");
        }
      }
      req.send(variable);
    }else
    {
        alert('Please fill the criminal id field');
    }
  }
  </script>
  <style media="screen">
    th
    {
      margin-left:10px;
      width: 180px;
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
      <h2><font color="white">Please enter Complaint ID to Update</font></h2>
      <form class="" action="updatecompliant.php" method="GET">
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
                <font color="white">s
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
              <input type="text" name="" value="<?php echo $data[1]['status']; ?>" id="status" style="width:400px;margin-right:20px;"><button type="button" name="" onclick="updatestatus(<?php echo $data[1]['cid']; ?>)">Update status</button> <br><br>
              <input type="text" name="" id="criminalid" value="" placeholder="Criminal ID" required>
              <button type="button" name="" onclick="addcriminal(<?php echo $data[1]['cid']; ?>)">Add Criminal</button>
              <br><br>
              <input type="text" name="" id="criminalidremove" value="" placeholder="Criminal ID" required>
              <button type="button" name="" onclick="removecriminal(<?php echo $data[1]['cid']; ?>)">Remove Criminal</button>
              <br><br>
              <input type="text" name="" id="witnessidremove" value="" placeholder="Witness ID" required>
              <button type="button" name="" onclick="removewitness(<?php echo $data[1]['cid']; ?>)">Remove Witness</button>
              <br><br>
              <input type="text" name="" id="witnessid" value="" placeholder="Witness ID" required style="margin-bottom:10px;"><br>
              <textarea name="" id="witnessstatement" value="" placeholder="Witness Statement" required style="height:100px;width:400px;margin-bottom:10px"></textarea><br>
              <button type="button" name="" onclick="addwitness(<?php echo $data[1]['cid']; ?>)">Add Witness</button>
              <br><br>
            </th></tr>
            </table>
        <?php }else
              {
                echo "<h1><font>No records found</font></h1>";
              }
            }
        ?>
    <?php endif; ?>
  </body>
</html>
