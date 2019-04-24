<!--Make sure you enter appropriate db name, image path and table name -->
<?php 
  session_start(); 
  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location:login.php");
  }
?>


<?php
//session.start();
if (isset($_POST['collaborate']) )
{
    $conn=mysqli_connect('localhost','root','');
    mysqli_select_db($conn,'authentication');
    
    
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
    <link rel="icon" href="logo.PNG" type="image/png" >
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
  <style>
    /* Remove the navbar's default rounded borders and increase the bottom margin */ 
    .navbar {
      margin-bottom: 50px;
      border-radius: 0;
    }
    
    /* Remove the jumbotron's default bottom margin */ 
     .jumbotron {
      margin-bottom: 0;
    }
   
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
  </style> 
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">(logo)</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
         <li><a href="#">About</a></li>
        <li><a href="#">Settings</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
         <?php
                if(isset($_POST["logout"]))
                   {
                       session_destroy();
                       header('location:login.php');
                   }
            ?>
           
      <ul class="nav navbar-nav navbar-right">
        <li><form method="post">
                    <button name="logout" class="btn btn-danger my-2">Logout</button>
            </form></li>
      </ul>
    </div>
  </div>
</nav>

 

  	<!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>
    
      <?php  if (isset($_SESSION['username'])) : ?>
            <h3 style="margin-left:70px;">Welcome <strong><?php echo $_SESSION['username']; ?></strong></h3>
          
            <!-- <p> Upcoming Events!</p> -->    
  
  <?php
$conn = mysqli_connect("localhost","root","","authentication");
//if (isset($_POST['login_user'])) {
//$username = mysqli_real_escape_string($conn, $_POST['username']);
//$_SESSION['username']=$username;}
/* if($conn-> connect_error){
  die("Connection failed:" . $conn -> connect_error); 
}
$sql = "SELECT events.eid,events.ename,events.username FROM events INNER JOIN registration on events.username=registration.username where events.username= '{$_SESSION['username']}' ";
$result = $conn-> query($sql);
if($result-> num_rows > 0){
  while($row = $result-> fetch_assoc()){
  echo '<div class="container">    
  <div class="row">
  <div class="col-sm-4"> 
      <div class="panel panel-primary">
        <div class="panel-heading">Event </div>
        <div class="panel-body"><img src="images.jpg" class="img-responsive" style="width:50%" alt="Image"></div>
        <p style="margin-left:5px">Event ID :'. $row["eid"] ."</br>
        <p style='margin-left:5px'>Event name: ". $row["ename"].'</br>
      </div>
      </div>
      </div>
    </div>';
    } 
}
*/
?>



<div class="container" >
  <h2></h2>
 
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
    <li><a data-toggle="tab" href="#menu1">Find other events</a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <h3>Your Events</h3>
      <p>Here's a list of your events:</p>
    <?php
        $ceid=array();
        $curr=$_SESSION['username'];
   $sql = "SELECT events.eid,events.ename,events.username,events.descr FROM events INNER JOIN speakers on events.eid=speakers.eid and speakers.sname='$curr'"; // and users.type= '{$_SESSION['type']}' 
$result = $conn-> query($sql);
if($result-> num_rows > 0){
  while($row = $result-> fetch_assoc())
  {
       array_push($ceid,$row["eid"]);
	  //$total = "SELECT sponsoramt FROM events,users WHERE events.username=users.username and users.username= '{$_SESSION['username']}'";
	  //$result = $conn-> query($total);
	  //echo $result['total'];
         $v0=$row["eid"];
          echo '<div class="container">    
              <div class="row"><div class="col-sm-4"> 
                <div class="panel panel-primary">
                <div class="panel-heading"><a href="event.php?var='.$v0.'" style="color:black;">Event</a></div>
                <div class="panel-body"><img src="TEDx.jpg" class="img-responsive" style="width:100%" alt="Image"></div><p style="margin-left:5px">Event ID :'. $row["eid"] ."</br><p style='margin-left:5px'>Event name: ". $row["ename"]."</br><p style='margin-left:5px'>Organiser: ". $row["username"].'</br><p style="margin-left:5px">Description:'. $row["descr"].'</br></br>
                <div class="panel-footer"></div>
                </div>
               </div>';}
    }
else{
    echo '<div> <h4> You have no events </h4></div>';
}
       // print_r($ceid);
    ?>
    </div>
  
    </div>
    </div>
     

  
      <div id="menu1" class="tab-pane fade" >
        <h3>All Events</h3>
        <p>Here's a list of all available events:</p>
        <?php
          $curr=$_SESSION['username'];
         // session_start();
    $sql = "SELECT events.eid,events.ename,events.username,events.descr FROM events where events.CurrSpeakers < events.numspeakers and events.verified=0 and events.eid not in(SELECT eid from speakers where sname='$curr')" ;
    // where events.username= '{$_SESSION['username']}' ";
$result = $conn-> query($sql);
if($result-> num_rows > 0){
  while($row = $result-> fetch_assoc()){
      $v0=$row["eid"];
          echo '<div class="container">    
              <div class="row"><div class="col-sm-4"> 
                <div class="panel panel-primary">
                <div class="panel-heading"><a href="event.php?var='.$v0.'" style="color:black;">Event</a></div>
                <div class="panel-body"><img src="TEDx.jpg" class="img-responsive" style="width:100%" alt="Image"></div><p style="margin-left:5px">Event ID :'. $row["eid"] ."</br><p style='margin-left:5px'>Event name: ". $row["ename"]."</br><p style='margin-left:5px'>Organiser: ". $row["username"].'</br><p style="margin-left:5px">Description : '.$row["descr"].'</br></br>
                <button style="margin-left:5px;margin-bottom:15px;background-color:navy;"><a style="color:white;" href="request.php?id='.$row["eid"].'"><h4>Speak in event</h4></a></button>
                <div class="panel-footer"></div>
                </div>
               </div>';
  
  }
    }
    ?>
      </div>
      </div>
    </div>


    <!-- logged in user information -->
    	
    <?php endif ?>
 	


		
</body>
</html>