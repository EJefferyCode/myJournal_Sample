<?php require('zdb.php');?>
<?php include('zauthen.php');?>
<?php include('z_sess_index.php');?>
<?php include('login_s.php');?>
<?php date_default_timezone_set("America/New_York");?>


<!DOCTYPE html>
<html>
 <head>
    <meta charset="utf-8">
     <meta name="viewport" content="width=device-width,initial-scale=1">
     <title>myJournal</title>
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
     			<div class="jumbotron text-center header bg-1">
     				<h1>myJournal</h1>
     				<h5><a href="join.php">Signup | It's Free!</a></h5>
     				<div class="thumbnail text-center login">
     					<form method="POST">
     					<h5>Already A Member? Login</h5>
     						<div class="form-group">
     							<input type="text" name="username" class="form-control" placeholder="username" required>
     						</div>
     						<div class="form-group">
     							<input type="password" name="password" class="form-control" placeholder="password" required>
     						</div>
     						<button type="submit" name="go" class="btn btn-success" style="width:100%;">Enter</button>
     					</form>
     				</div>
     				<a href="forgot.php?user=null">forgot username | password</a>
     			</div>
     		</div>
     	</div>
     </div>
     
       
       <div class="container-fluid">
     	<div class="row">
     		<div class="col-lg-12">
     			<div class="jumbotron text-center header bg-2">
     				<h1>create journals</h1>
     			</div>
     			<div class="jumbotron text-center header bg-3">
     				<h1>meet new people</h1>
     			</div>
     		</div>
     	</div>
     </div>
     
     
     <div class="container-fluid">
     	<div class="row">
     		<div class="col-lg-12">
     			<div class="jumbotron text-center header bg-4">
     				<b>myJournal &copy;<?php echo date('Y');?></b> |
     				<a href="">contact us</a>
     			</div>
     			
     		</div>
     	</div>
     </div>
     
     
     
     
       <div class="container-fluid">
     	<div class="row">
     		<div class="col-lg-12">
     			<div class="jumbotron text-center bg-3 opac">
                <a href="" id="think" style="color:purple;font-weight:600;font-size:1.4em;">Think Inc.</a>     				
     			</div>
     		</div>
     	</div>
     </div>
     
    
	</body>
</html>