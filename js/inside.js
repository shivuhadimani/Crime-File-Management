function showpass() {
  if(document.getElementById('passw').type=="text")
  {
    document.getElementById('passw').type="password";
    document.getElementById('showpas').innerHTML="<i class=\"fas fa-eye\"></i>Show password";
  }else {
    document.getElementById('passw').type="text";
    document.getElementById('showpas').innerHTML="<i class=\"fas fa-eye\"></i>Hide password";
  }
}
function preview_image(event)
{
 var reader = new FileReader();
 reader.onload = function()
 {
  var output = document.getElementById('output_image');
  output.src = reader.result;
 }
 reader.readAsDataURL(event.target.files[0]);
}
function checkuser()
{
  var id=document.getElementById('inp1').value;
  if(id!="")
  {
    var req = new XMLHttpRequest();
    var url="checkuser.php";
    var variable="user="+id;
    req.open("POST",url,true);
    req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    req.onreadystatechange=function(){
      if(req.readyState==4 && req.status==200)
      {
        var returndata=req.responseText;
        if(returndata=="error")
        {
          document.getElementById('username').innerHTML="<font color=\"black\">Already username is used!!!!!</font>";
        }else if(returndata=="correct")
        {
          document.getElementById('username').innerHTML="<font color=\"Black\">Username is available</font>";
        }else
          alert("Something went wrong try again,Try again later");
      }
    }
    req.send(variable);
  }else
  {
      alert('Please fill the Username field')
  }
}
