<?php
/**
 * query execution and send the data in the array format
 */
class queryexc
{
  function __construct()
  {
    $this->data=array("");
    $this->num=0;
  }
  public function exc($query,$connection)
  {
    $this->query_exc($query,$connection);
    return $this->get_data();
  }
  public function qexc($query,$connection)
  {
    if(mysqli_query($connection,$query))
    {
      return true;
    }else
    {
      return false;
    }
  }
  private function query_exc($query,$connect1)
  {
    @$this->quexe=mysqli_query($connect1,$query);
    @$this->num=mysqli_num_rows($this->quexe);
  }
  private function get_data()
  {
    $this->data[0]=$this->num;
    for($i=0;$i < $this->num;$i++)
    {
      @$tempdata=mysqli_fetch_assoc($this->quexe);
      array_push($this->data,$tempdata);
    }
    return $this->data;
  }
}
?>
