<?php require('zdb.php');?>
<?php include('zauthen.php');?>
<?php include('z_sess_index.php');?>
<?php include('f_script.php');?>
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
     					 <form method="POST" >
                <h2 style="color:red;">If you can't remember your username:</h2>
                 <div class="form-group">
                    <label for="email">What email did you use?</label>
                      <input type="email" class="form-control" name="email" maxlength="200" required>
                    </div>
                    <button type="submit" class="btn btn-success" name="findUser" style="width:100%;">Submit</button>
                </form>
                 <div class='thumbnail' style='border-color:white;'>
                           <?php echo $output;?>
                            </div>
     				</div>
     				<a href="index.php">go back</a>
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
     				       	<form method="POST" >
                             <h2 style="color:red;">If you can't remember your password:</h2>
                             <label for="password">Please answer the following question:</label>
                               <br> <label>"What was the name of the first street you've ever lived on?"</label>
                                <input type="text" name="reminder" class="form-control" placeholder="answer" required>
                                <br>
                                <input type="text" name="username" class="form-control" placeholder="username" required>
                                <br>
                                <button class="btn btn-success" name="resetPassword" style="width:100%;">Submit</button>
                            </form>
                 
                  <div class='thumbnail' style='border-color:white;'>
                           <?php echo $output2;?>
                            </div>
     				       </div>
     				<a href="index.php">go back</a>
     			</div>
     		</div>
     	</div>
     </div>
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
	</body>
</html>