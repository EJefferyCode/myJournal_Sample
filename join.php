<?php require('zdb.php');?>
<?php include('zauthen.php');?>
<?php include('z_sess_index.php');?>
<?php include('regis_s.php');?>
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
     				<h1>myJournal</h1>
     				<h5>create your free account</h5>
     				<a href="index.php">go back</a>
     			</div>
     		</div>
     	</div>
     </div>
     
     <div class="container-fluid" style="margin-bottom:25%;">
     	<div class="row">
     	<div class="col-lg-12">
     		<div class="jumbotron text-center header bg-5">
     			<form method="POST">
     				<div class="form-group">
     					<input type="text" name="username" placeholder="choose a username" class="form-control" maxlength="100" required>
     				</div>

     				<div class="form-group">
     				  <input type="password" name="password" placeholder="password: min 6 characters" class="form-control" maxlength="100" required>
					</div>
    			    <div class="form-group">
     				  <input type="password" name="cpassword" placeholder="confirm password" class="form-control" maxlength="100" required>
					</div>
  			        <div class="form-group">
  			        	<input type="email" name="email" placeholder="enter a valid email" class="form-control" required>
  			        </div>
   			        <div class="form-group">
   			        <h5>Age Group</h5>
   			        	<select class="form-control" name="ageGroup">
   			        		<option value="13-17">13-17</option>
   			        		<option value="18-24">18-24</option>
   			        	    <option value="25-29">25-29</option>
   			        	    <option value="30 and over">30 and over</option>
   			        	</select>
   			        </div>
   			         <div class="form-group">
                      <h4>Answer This Question In Order To Reset Your Password If You Ever Forget It</h4>
                        <h5 style="color:red;">What Is The Name Of The First Street You've Ever Lived On?</h5>
                        <input type="text" class="form-control" name="reminder" maxlength="100" placeholder="Answer" required>
                    </div>
                    
                    <div class="form-group">
                        <h5>Enter The Word You See Below</h5>
                        <div class="thumbnail text-center" style="border-color:white;">
                    <img src="zimgs/HUMAN.jpg">
                    </div>
                     <input type="text" name="verify" class="form-control" required>
                        <br>
                        by using Questioner you agree to our <a href="" style="color:red;font-weight:600;">terms</a>
                    </div>
    			     <input type="hidden" name="admin" value="N">
                    <input type="hidden" name="banned" value="N">
                    <input type="hidden" name="close" value="O">
                    <button type="submit" name="reg" class="btn btn-info">Join</button>
     			</form>
     		</div>
			</div>
     	</div>
     </div>
     
     
     
     
     
     
     
     
     
     
     
     
	</body>
</html>