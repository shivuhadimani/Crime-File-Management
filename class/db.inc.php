<?php
session_start();
/**
 *Database connection class
 */
class database
{
  function __construct()
  {
    $this->user='root';
    $this->password='';
    $this->dbname='Crimedatabase';
    $this->host='localhost';
  }
  public function connect()
  {
    $this->connect_db();
  }
  private function connect_db()
  {
    if(@$this->con=mysqli_connect($this->host,$this->user,$this->password,$this->dbname))
    {
      if(@$this->dbcon=mysqli_select_db($this->con,$this->dbname))
      {
      }else
      {
        die('<h1><center>Server hangup, try again later<center></h1>');

      }
    }else
    {
        die('<h1><center>Establishment of connection to databse is not possible now, try again later<center></h1>');
    }
  }
}
?>
