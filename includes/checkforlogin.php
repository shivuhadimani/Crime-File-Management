<?php
/**
 * to check the admin as loged in or not
 */
class logincheck
{
  public function CheckForLogin()
  {
    if(isset($_SESSION['username']) && isset($_SESSION['userpass']))
    {
      $admin=$_SESSION['username'];
      $pass=$_SESSION['userpass'];
      if(!empty($admin) && !empty($pass))
      {
        $this->query="SELECT * FROM `police` WHERE `username`='".$admin."' AND `pass`='".$pass."'";
        return $this->querycheck();
      }else
      {
          return 0;
      }
    }else
    {
        return 0;
    }
  }
  public function querycheck()
  {
    $q=new queryexc;
    $db=new database;
    $db->connect();
    $this->data=$q->exc($db->con,$this->query);
    if($this->data[0])
    {
      if($this->data[1]['email']===$_SESSION['email'])
        return 1;
      else
        return 0;
    }else
      return 0;
  }
}

 ?>
