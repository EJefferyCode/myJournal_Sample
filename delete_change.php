<?php require ('zdb.php');?>
<?php require ('zauthen.php');?>
<?php require ('z_sess_okay.php');?>
<?php date_default_timezone_set("America/New_York");?>
<?php
$remove = $_GET['remove'];
$did = $_GET['did'];
$now = date('m-d-Y h:i:s A');

$sql = "SELECT * FROM user WHERE username = '$username'";
$result = mysqli_query($dataBase,$sql) or die(mysqli_query($dataBase));
$row = mysqli_fetch_array($result);
$image = $row['image'];
if(empty($image)){
	$image = 'einstein.png';
}


$sqlj = "SELECT * FROM journals WHERE jid = '$remove'";
$resultj = mysqli_query($dataBase,$sqlj) or die(mysqli_query($dataBase));
$rowj = mysqli_fetch_array($resultj);

$journal = $rowj['journal'];



$sqld = "SELECT * FROM discussions WHERE did = '$did'";
$resultd = mysqli_query($dataBase,$sqld) or die(mysqli_query($dataBase));
$rowd = mysqli_fetch_array($resultd);

$discuss = $rowd['discuss'];


?>

<!DOCTYPE html>
<html>
 <head>
    <meta charset="utf-8">
     <meta name="viewport" content="width=device-width,initial-scale=1">
     <title>Questioner</title>
     <meta name="description" content="Ask The Internet Anything">
     <meta name="keywords" content="questions,answers">
      <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
     <link rel="stylesheet" href="views.css">
    </head>
    
    <body class="example">
<!--
    <h1>home</h1>
    <a href="logout.php">logout</a>
-->
     <div class="container-fluid">
     	<div class="row">
     		<div class="col-lg-12">
     			<div class="jumbotron text-center header bg-6">
     				<h1><a href='home.php?user=<?php echo $username;?>' style="color:white;text-decoration:none;">myJournal</a></h1>
     				<h5 style="color:greenyellow;">Welcome <?php echo $username;?></h5>
     				<div class="thumbnail text-center dash">
     					<a href="my_page.php?user=<?php echo $username;?>">Your Page</a> |
     					<a href="j.php?user=<?php echo $username;?>">Your Journals</a> |
     					<a href="new.php?user=<?php echo $username;?>">Notifications</a> |
     					<a href="logout.php" style="color:red;font-weight:600;">Logout</a>
     				</div>
     			</div>
     		</div>
     	</div>
     </div>
  
   
      <?php
       if($remove != ''){		
	  ?>
       <div class="container-fluid">
     	<div class="row">
     		<div class="col-lg-12">
     			<div class="jumbotron text-center bg-9">
    			    <form method="POST">
     			   	
     			   	<button type="submit" class="btn btn-danger" name="remove" style="padding:1px; border-radius:0px;" disabled>Remove For Good</button>
     			   </form>
     			   <h3><?php echo $journal;?></h3>
     			  
     			</div>
     		</div>
     	</div>
     </div>
     
<?php
	   }
	?>
     
     
     
       <?php
       if($did != ''){		
	  ?>
       <div class="container-fluid">
     	<div class="row">
     		<div class="col-lg-12">
     			<div class="jumbotron text-center bg-9">
    			    <form method="POST">
     			   	
     			   	<button type="submit" class="btn btn-danger" name="removedid" style="padding:1px; border-radius:0px;" disabled>Remove For Good</button>
     			   </form>
     			   <h3><?php echo $discuss;?></h3>
     			  
     			</div>
     		</div>
     	</div>
     </div>
     
<?php
	   }
	?>

     
     
      <div class="container-fluid">
     	<div class="row">
     		<div class="col-lg-12">
     			<div class="jumbotron text-center bg-10">
     			    <a href="#">myJournal &copy; <?php echo date('Y');?></a> |
     				<a href="">contact us</a> |
     				<a href="settings.php?user=<?php echo $username;?>">account settings</a>
     			</div>
     		</div>
     	</div>
     </div>
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
    
    
    
    
    
    
	</body>
</html>