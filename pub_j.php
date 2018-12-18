<?php require ('zdb.php');?>
<?php require ('zauthen.php');?>
<?php require ('z_sess_okay.php');?>
<?php require ('q_script.php');?>
<?php date_default_timezone_set("America/New_York");?>
<?php

$now = date('m-d-Y h:i:s A');
$did = $username . $now . "discuss";
$jid = $_GET['jid'];

if(empty($jid)){
	exit('<h1>Oops. <a href="index.php">Leave</a></h1>');
}
$sql = "SELECT * FROM user WHERE username = '$username'";
$result = mysqli_query($dataBase,$sql) or die(mysqli_query($dataBase));
$row = mysqli_fetch_array($result);
$image = $row['image'];
if(empty($image)){
	$image = 'einstein.png';
}

$sqlj = "SELECT * FROM journals WHERE jid = '$jid'";
$resultj = mysqli_query($dataBase,$sqlj) or die(mysqli_query($dataBase));
$rowj = mysqli_fetch_array($resultj);
$imagej = $rowj['profileimage'];
$usernamej = $rowj['username'];
$journalj = $rowj['journal'];
$categoryj = $rowj['category'];
$timej = $rowj['time'];
if(empty($imagej)){
	$imagej = 'einstein.png';
}

if($resultj->num_rows === 0){
	exit('<h1>Oops. <a href="index.php">Leave</a></h1>');
}
$sqld = "SELECT * FROM discussions WHERE jid = '$jid'";
$resultd = mysqli_query($dataBase,$sqld) or die(mysqli_query($dataBase));
$rowd    = mysqli_fetch_array($resultd);

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
     			<div class="jumbotron text-center header bg-1">
     				<h1 style=""><k style='color:black;'>Demonstration Version</k> myJournal&copy;<?php echo date('Y');?></h1>
     			</div>
     		</div>
     	</div>
     </div>
    
     <div class="container-fluid">
     	<div class="row">
     		<div class="col-lg-12">
     			<div class="jumbotron text-center header bg-6">
     				<h1>myJournal</h1>
     				<h5 style="color:greenyellow;">Welcome <?php echo $username;?></h5>
     				<div class="thumbnail text-center dash">
     				<a href="home.php?user=<?php echo $username;?>">Home</a> |
     					<a href="my_page.php?user=<?php echo $username;?>">Your Page</a> |
     					<a href="j.php?user=<?php echo $username;?>">Your Journals</a> |
     					<a href="new.php?user=<?php echo $username;?>">Notifications</a> |
     					<a href="logout.php" style="color:red;font-weight:600;">Logout</a>
     				</div>
     			</div>
     		</div>
     	</div>
     </div>
  
     
     

       
      <div class="container-fluid">
     	<div class="row">
     		<div class="col-lg-12">
     			<div class="jumbotron text-left bg-1 set">
    			    <?php
					if($usernamej != $username){
					
					?>
    			    <form method="post">
    			    	<button class="btn btn-default" style="padding:0px;border-radius:0px;" disabled>flag this</button>
    			    </form>
    			    <?php
					}
					?>
     			    <b><i>posted by:</i> <a href="user-page.php?user=<?php echo $usernamej;?>"><?php echo $usernamej;?></a></b>
     			  <br>  <b>post date: <?php echo $timej;?></b>
     			    <br>
     			    image
     			    <b>
     			     <br>
     			    <i>featured in:</i> <?php echo "<a href='cat.php?cid=$categoryj'>$categoryj</a>";?></b>
     			    <br>
     			    
     				<a href="#" style="color:black;font-weight:500;"><?php echo $journalj;?></a>
     			</div>
     		</div>
     	</div>
     </div>
  
      <div class="container-fluid">
     	<div class="row">
     		<div class="col-lg-12">
     			<div class="jumbotron text-left bg-2 set">
     			   <form method="POST">
     			   <input type="hidden" name="toPerson" value="<?php echo $usernamej;?>" style="color:black;">
     			   <input type="hidden" name="fromPerson" value="<?php echo $username;?>" style="color:black;">
     			   <input type="hidden" name="did" value="<?php echo $did;?>" style="color:black;">
     			   <input type="hidden" name="jid" value="<?php echo $jid;?>" style="color:black;">
     			   <input type="hidden" name="image" value="<?php echo $image;?>" style="color:black;">
     			   <input type="hidden" name="time" value="<?php echo $now;?>" style="color:black;">
     			   	<div class="form-group">
     			   		<textarea class="form-control" rows="5" placeholder="Reply to this journal" maxlength="300" name="discuss" required></textarea>
     			   		<br>
     			   		<button type="submit" name="send" class="btn btn-warning send">Send</button>
     			   	</div>
     			   	
     			   </form>
     			</div>
     		</div>
     	</div>
     </div>
    

    
     <div class="container-fluid">
     	<div class="row">
     		<div class="col-lg-12">
     		    <div class="thumbnail text-left bg-5 set" style="border-color:white;">
     		    	<span class="glyphicon glyphicon-comment" style="color:purple;"></span>  <?php echo $resultd->num_rows;?>
     		    </div>
     		        <?php
					 $discuss = "SELECT * FROM discussions WHERE jid = '$jid' ORDER BY id DESC LIMIT 15";
                     $resdis = mysqli_query($dataBase,$discuss);
                     while($rowdis = $resdis->fetch_assoc()) {
						 $fromPerson = $rowdis['fromPerson'];
						 $discussr   = $rowdis['discuss'];
						 $did        = $rowdis['did'];
						 $jid        = $rowdis['jid'];
						 $image      = $rowdis['image'];
						 $time       = $rowdis['time'];
                    
				  ?>
     			<div class="jumbotron text-left bg-1 set">
                 <a href="user-page.php?user=<?php echo $fromPerson;?>" style=""><?php echo $fromPerson;?> said:</a>
                 <figcaption style="color:black;"><b><i><?php echo $discussr;?></i></b></figcaption>
                 <b style="color:black;">posted on <?php echo $time;?></b>
     			</div>
     			
     			<?php
		           }
			   ?>
			   
			   <?php
				if($resultd->num_rows === 0){
					echo "<h4 style='color:purple' class='set'>Nothing Yet</h4>";
				}else{
				?>
			   <a href="full.php?jid=<?php echo $jid;?>" style="color:green;font-size:1.4em;" class="set">View All Comments</a>
			   
			   <?php
				}
			   ?>
     		</div>
     	</div>
     </div>
     <br>
      <div class="container-fluid">
     	<div class="row">
     		<div class="col-lg-12">
     			<div class="jumbotron text-center bg-9">
     				<h1>Check This Out</h1>
     			</div>
     		</div>
     	</div>
     </div>
     
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
  
    
      <div class="container-fluid">
     	<div class="row">
     		<div class="col-lg-12">
     			<div class="jumbotron text-center bg-1 opac">
                <a href="" id="think">Think Inc.</a>     				
     			</div>
     		</div>
     	</div>
     </div>
     
    
	</body>
</html>