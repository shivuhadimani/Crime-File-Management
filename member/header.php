<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">CRIME DATABASE</a>
    </div>
      <ul class="nav navbar-nav">
        <li><a href="homepage.php">Home</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">STAFF<span class="caret"></span></a>
          <ul class="dropdown-menu">
             <li><a href="addstaff.php">Add staff</a></li>
             <li><a href="updatestaff.php">Upadte staff</a></li>
             <li><a href="transfer.php">Transfer staff</a></li>
             <li><a href="viewstaff.php">View staff</a></li>
           </ul>
        </li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">CRIMINAL<span class="caret"></span></a>
          <ul class="dropdown-menu">
             <li><a href="addcriminal.php">Add criminal</a></li>
             <li><a href="removecriminal.php">Remove criminal</a></li>
             <li><a href="viewcriminal.php">View criminal</a></li>
           </ul>
        </li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">WITNESS<span class="caret"></span></a>
          <ul class="dropdown-menu">
             <li><a href="addwitness.php">Add witness</a></li>
             <li><a href="removewitness.php">Remove witness</a></li>
             <li><a href="viewwitness.php">View witness</a></li>
           </ul>
        </li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">COMPLIANT/FIR<span class="caret"></span></a>
          <ul class="dropdown-menu">
             <li><a href="addcompliant.php">Add compliant/FIR</a></li>
             <li><a href="updatecompliant.php">Update compliant/FIR</a></li>
             <li><a href="statuscompliant.php">Status compliant/FIR</a></li>
             <li><a href="viewcompliant.php">View compliant/FIR</a></li>
           </ul>
        </li>
        <li>
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">CHARGE SHEET<span class="caret"></span></a>
          <ul class="dropdown-menu">
             <li><a href="registercharge.php">Register Charge sheet</a></li>
             <li><a href="viewchargesheet.php">View charge sheet</a></li>
           </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>  LOGOUT</a></li>
      </ul>
  </div>
</nav>
