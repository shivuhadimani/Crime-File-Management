<?php
include '../class/db.inc.php';
include '../class/exe.inc.php';
include '../includes/checkforlogin.php';
$obj=new logincheck;
if($obj->CheckForLogin()===0)
  header('location:../');
if(isset($_POST['username']) && isset($_POST['userpassword']) && isset($_POST['passw']) && isset($_POST['sid']))
  if(!empty($_POST['username']) && !empty($_POST['userpassword']) && !empty($_POST['passw']) && !empty($_POST['sid']))
  {
    $username=$_POST['username'];
    $userpass=$_POST['userpassword'];
    $passw=$_POST['passw'];
    $sid=$_POST['sid'];
    if(md5($userpass)===$_SESSION['userpass'])
    {
      $query="SELECT * FROM `police` WHERE `username`='$username' AND `pass`='".md5($passw)."' AND `stat_id`!=$sid";
      $db=new database;
      $db->connect();
      $qobj=new queryexc;
      $data=$qobj->exc($db->con,$query);
      if($data[0]!==0)
      {
        $query="UPDATE `working` SET `upto`='".date('Y-n-j')."' WHERE `user_name`='$username' AND `station_id`=".$data[1]['stat_id']."";
        $query1="UPDATE `police` SET `stat_id`=$sid WHERE `username`='$username'";
        $query2="INSERT INTO `working` VALUES ('$username',$sid,'".date('Y-n-j')."','0000-00-00')";
        if($qobj->qexc($db->con,$query) && $qobj->qexc($db->con,$query1) && $qobj->qexc($db->con,$query2))
          echo "<script>alert('Transfered successfullly takke the transfer copy')</script>";
        else
          echo "<script>alert('Something went wrong, immediately meet manager')</script>";
      }else
      {
        echo "<script>alert('Missmatch of the detials found or trying to post him to same station')</script>";
      }
    }else
    {
      echo "<script>alert('Missmatch of the detials found')</script>";
    }
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
  <body>
    <?php include 'header.php'; ?>
    <?php if(!isset($_GET['username'])): ?>
      <h2><font color="white">Please enter username to transfer</font></h2>
      <form class="" action="transfer.php" method="GET">
        <input type="text" name="username" value="" placeholder="Username" required="required" id="inp" style="margin-left:80px;">
        <input type="submit" name="" value="Check" style="width:80px;">
      </form>
    <?php endif; ?>
    <?php if (isset($_GET['username'])): ?>
      <?php if (!empty($_GET['username'])): ?>
        <?php
          $query="SELECT * FROM `police` WHERE `username`='".$_GET['username']."'";
          $db=new database;
          $db->connect();
          $qobj=new queryexc;
          $data=$qobj->exc($db->con,$query);
          if($data[0]==1)
          {
            ?>
            <form class="" action="transfer.php" method="POST" style="margin-left:50px;">
              <input type="text" id="inp" name="username" value="<?php echo $_GET['username']; ?>" placeholder="Username" readonly reuired><br>
              <select class="" name="sid" id="inp">
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
              <input type="password" name="userpassword" id="inp" value="" placeholder="your password" required="required"><br>
              <input type="password" name="passw" value="" id="inp" placeholder="<?php echo $_GET['username']."'s";?> password"><br>
              <input type="submit" name="" value="Transfer" id="inp" style="width:120px">
            </form>
            <?php
          }else
          {
              ?>
              <h1 style="margin-left:20px">NO records found</h1>
              <?php
          }
        ?>
      <?php endif; ?>
    <?php endif; ?>
  </body>
</html>
