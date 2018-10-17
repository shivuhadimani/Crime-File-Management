<?php
include "class/db.inc.php";
$db= new database;
$db->connect();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Crime File management</title>
  </head>
  <link href='https://fonts.googleapis.com/css?family=Roboto:500,300,400' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
  <link rel="stylesheet" href="css/main.css">
  <script src="js/main.js" charset="utf-8"></script>
  <body class="indexclass">
    <div style="height:80px">
      <h1 class="striped">Crime Database <button type="button" style="float:right;height:50px;width:150px;background-color:white;text-decoration:none; margin-top:0px;color=black;border-radius:15px;border:none" align="right">LOGIN<i class="fa fa-user-circle-o" style="font-size:48px;color:red"></i></button></h1>
    </div>
    <center style="margin-top:0px;"><font color="black" style="font-size:40px;">Most wanted</font></center>
    <hr>
    <?php
      $query="SELECT * FROM `criminal` WHERE `most_wanted`='yes'";
      include 'class/exe.inc.php';
      $q=new queryexc;
      $data=$q->exc($db->con,$query);
      echo "<marquee class=\"marqphoto\" onmouseover=\"this.stop()\" onmouseout=\"this.start()\">";
      echo "<div class=\"row\">";
      for($i=1;$i<=$data[0];$i++)
      {
        echo "<div class=\"column\"><img src=\"criminals/".$data[$i]['id'].".jpg\" alt=\"criminals/".$data[$i]['id'].".jpeg\"  onerror=this.src=\"criminals/".$data[$i]['id'].".jpeg\" height=\"255px\" width=\"180px\"><br><font size=\"5px\">";
        @$arr = explode("#", $data[$i]['identifications']);
        echo "identifications:<br><ul>";
        for($j=0;$j<count($arr);$j++)
          echo "<li>".$arr[$j]."</li>";
        echo "</ul></font></div>";
      }
      echo "</marquee>";
    ?>

    </marquee>
  </body>
</html>
