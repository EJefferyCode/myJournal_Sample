<?php require ('zdb.php');?>
<?php require ('zauthen.php');?>
<?php require ('z_sess_okay.php');?>
<?php date_default_timezone_set("America/New_York");?>
<?php

$sql = "SELECT * FROM user WHERE username = '$username'";
$result = mysqli_query($dataBase,$sql) or die(mysqli_query($dataBase));
$row = mysqli_fetch_array($result);
$image = $row['image'];
$email = $row['email'];
$ageGroup = $row['ageGroup'];
$password = $row['password'];
if(empty($image)){
	$image = 'einstein.jpg';
}


if(isset($_POST['saveImage'])) {
    $selectImage = $_POST['selectImage'];
    
    $mysql = "UPDATE user SET image = '$selectImage' WHERE username = '$username'";
    mysqli_query($dataBase,$mysql) or die($dataBase);
    
    $mysqlQ = "UPDATE discussions SET image = '$selectImage' WHERE fromPerson = '$username'";
    mysqli_query($dataBase,$mysqlQ) or die($dataBase);
    
    $mysqlC = "UPDATE journals SET profileimg = '$selectImage' WHERE username = '$username'";
    mysqli_query($dataBase,$mysqlC) or die($dataBase);
	
	echo "<div class='container'>
               <div class='row'>
               <div class='col-lg-12'>
                <div class='thumbnail text-center' style='font-size:2em;color:red;'>Image Updated. Click <a href='settings.php?user=$username'>here</a> to refresh.</div>
               </div>
               </div>
             </div>";
}

if(isset($_POST['removeImage'])) {
    $selectImage = $_POST['selectImage'];
    
    $mysql = "UPDATE user SET image = '' WHERE username = '$username'";
    mysqli_query($dataBase,$mysql) or die($dataBase);
    
    $mysqlQ = "UPDATE discussions SET image = '' WHERE fromPerson = '$username'";
    mysqli_query($dataBase,$mysqlQ) or die($dataBase);
    
    $mysqlC = "UPDATE journals SET profileimg = '' WHERE username = '$username'";
    mysqli_query($dataBase,$mysqlC) or die($dataBase);
	
	echo "<div class='container'>
               <div class='row'>
               <div class='col-lg-12'>
                <div class='thumbnail text-center' style='color:red;font-weight:600;font-size:2em;'>Image Removed. Click <a href='settings.php?user=$username'>here</a> to refresh.</div>
               </div>
               </div>
             </div>";
}

if(isset($_POST['emailChange'])) {
    $email = $_REQUEST['email'];
    
    $emailChange = "UPDATE user SET email = '$email' WHERE username = '$username'";
    mysqli_query($dataBase,$emailChange) or die(mysqli_error($dataBase));
     echo "<div class='container'>
               <div class='row'>
               <div class='col-lg-12'>
                <div class='thumbnail text-center' style='color:red;font-weight:600;font-size:2em;'>Email Updated. Click <a href='settings.php?user=$username'>here</a> to refresh.</div>
               </div>
               </div>
             </div>";
}

if(isset($_POST['passChange'])) {
    $password = $_SESSION['password'];
    
    $curPassword = $_REQUEST['curPassword'];
    $nPassword   = $_REQUEST['nPassword'];
    $cPassword   = $_REQUEST['cPassword'];
    
    if(empty($curPassword) || empty($nPassword) || empty($cPassword)) {
        echo "<div class='container'>
               <div class='row'>
               <div class='col-lg-12'>
                <div class='thumbnail text-center' style='color:red;font-size:2em;'>Please enter all fields.</div>
               </div>
               </div>
             </div>";
    }elseif($curPassword != $password){
        echo "<div class='container'>
               <div class='row'>
               <div class='col-lg-12'>
                <div class='thumbnail text-center' style='font-size:2em;color:red;'>Current Password is incorrect. Try again?</div>
               </div>
               </div>
             </div>";
        
    }elseif(strlen($nPassword) < 7) {
        echo "<div class='container'>
               <div class='row'>
               <div class='col-lg-12'>
                <div class='thumbnail text-center' style='font-size:2em;color:red;'>Password must be at least 7 characters.</div>
               </div>
               </div>
             </div>";
    }elseif($nPassword != $cPassword){
        echo "<div class='container'>
               <div class='row'>
               <div class='col-lg-12'>
                <div class='thumbnail text-center' style='font-size:2em;color:red;'>New Password doesn't match confirmed password. Retype carefully.</div>
               </div>
               </div>
             </div>";
    }else{
        $nPassword = md5($nPassword);
        $UPDATE = "UPDATE user SET password = '$nPassword' WHERE username = '$username'";
        mysqli_query($dataBase,$UPDATE) or die(mysqli_error($dataBase));
        echo "<div class='container'>
               <div class='row'>
               <div class='col-lg-12'>
                <div class='thumbnail text-center' style='font-size:2em;color:red;'>Password updated. Click <a href='settings.php?user=$username'>here</a> to refresh</div>
               </div>
               </div>
             </div>";
    }
}


if(isset($_POST['ageChange'])) {
    $ageGroup = $_POST['ageGroup'];
    
    $mysql = "UPDATE user SET ageGroup = '$ageGroup' WHERE username = '$username'";
    mysqli_query($dataBase,$mysql) or die($dataBase);
    echo "<div class='container'>
               <div class='row'>
               <div class='col-lg-12'>
                <div class='thumbnail text-center' style='color:red;font-size:1.2em;'>Age Group Updated. Click <a href='settings.php?user=$username'>here</a> to refresh.</div>
               </div>
               </div>
             </div>";
}



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
     			<div class="jumbotron text-center header bg-6 set">
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
  
     
     
     <div class="container-fluid">
     	<div class="row">
     		<div class="col-lg-12">
     			<div class="jumbotron text-center header bg-7 set">
     				<h1>Account Settings</h1>
     				<hr>
     				<h5>Change Your Photo</h5>
     				<div class="jumbotron text-center bg-20 dov">
     				<img src="zimgs/<?php echo $image;?>" class="img-rounded">
     			    </div>
     			    
     			    <form method="POST">
    			    	  <div class="form-group text-center">
                     <label>Choose An Icon From Below:</label>
                   <select class="form-control " name="selectImage" required>
                     <!---images here--->
                                            <option value="america.jpg">America</option>
                                            <option value="baby.jpg">Baby</option>
                                            <option value="babycat.jpg">Baby Cat</option> 
                                             <option value="braces.jpg">Braces</option> 
                                            <option value="canada.jpg">Canada</option> 
                                            <option value="cartooncops.jpg">Cartoon Cops</option> 
                                             <option value="coffee.jpg">Coffee</option>
                                             <option value="confused.gif">Confused</option>
                                             <option value="confused2.jpg">Confused2</option>
                                             <option value="cookies.jpg">Cookies</option>
                                             <option value="dannydevito.jpg">Danny Devito</option>
                                             <option value="dexter.jpg">Dexter</option>
                                             
                                             <option value="einstein.jpg">Einstein</option>
                                             <option value="flag.jpg">LGBT Flag</option>
                                             <option value="flowers.jpg">Flowers</option>
                                             <option value="frenchdog.jpg">French Dog</option>
                                             <option value="obama.jpg">Obama</option>
                                             <option value="oops.jpg">Oops</option>
                                             <option value="picasso.jpg">Picasso</option>
                                             <option value="pumpkin.jpg">Pumpkin</option>
                                             <option value="raindbow.jpg">Rainbow</option>
                                             <option value="satin.png">Satin</option>
                                             <option value="sweater.jpg">Sweater</option>
                                             <option value="trump.jpg">Trump</option>
                                             <option value="uglyfeet.jpg">Feet</option>
                                             <option value="witch.jpg">Witch</option>
                                             <option value="xzibit.jpg">Xzibit</option>
                                             <option value="yoshi.png">Yoshi</option>
                     </select>
                 </div>
                 <button class="btn btn-success save" name="saveImage" type="submit" style="width:80%;">Save</button>
    			    </form>
    			    <br>
    			    <form method="POST">
                  <button class="btn btn-danger save" name="removeImage" type="submit" style="width:80%;">Remove</button>
                 </form>
     			</div>
     		</div>
     	</div>
     </div>
     
      <div class="container-fluid">
     	<div class="row">
     		<div class="col-lg-12">
     			<div class="jumbotron text-center header bg-10 set">
                    <h5>Change Your Email</h5>
                    <form method="POST">
                    <div class="form-group">
                     <input type="email" class="form-control " name="email" value="<?php echo $email;?>" required>
                     </div>
                 <button type="submit" name="emailChange" class="btn btn-warning save" style="width:80%;">Change</button>
                 </form>
     			</div>
     		</div>
     	</div>
     </div>
  
      <div class="container-fluid">
     	<div class="row">
     		<div class="col-lg-12">
     			<div class="jumbotron text-center header bg-7 set">
                   <h5>Change Your Password</h5>
                    <form method="POST">
                 <div class="form-group">
                     <input type="password" class="form-control " name="curPassword" placeholder="enter current password" required>
                     </div>
                 <div class="form-group">
                     <input type="password" class="form-control " name="nPassword" placeholder="enter new password" required>
                     </div>    
                     
                 <div class="form-group">
                     <input type="password" class="form-control " placeholder="confirm new password" name="cPassword" required>
                     </div>
                 <button type="submit" name="passChange" class="btn btn-success save" style="width:80%;">Change</button>
                 </form>
     			</div>
     		</div>
     	</div>
     </div>
     
     <div class="container-fluid">
     	<div class="row">
     		<div class="col-lg-12">
     			<div class="jumbotron text-center header bg-10 set">
                    <h5>Change Your Age Group</h5>
                    <form method="POST">
                     <div class="form-group text-center">
                         <label>Current Age Group:</label>
                      <input type="text" name="currentAge" value="<?php echo $ageGroup; ?>" class="form-control " disabled>
                     </div>
                     
                    <div class="form-group text-center">
                        <label >Update Age Group:</label>
                      <select class="form-control " name="ageGroup" required>
                        <option value="13-17">13 - 17</option>
                        <option value="18-24">18 - 24</option>
                          <option value="25-29">25 - 29</option>
                          <option value="30 and over">30 and over</option>
                        
                        </select>
                     </div>
                     
                     
                 <button type="submit" name="ageChange" class="btn btn-warning save" style="width:80%;">Change</button>
                 </form>
     			</div>
     		</div>
     	</div>
     </div>
     
     
     
     
     
     
     
     
     
     
      <div class="container-fluid">
     	<div class="row">
     		<div class="col-lg-12">
     			<div class="jumbotron text-center bg-10 set">
     			    <a href="#">myJournal &copy; <?php echo date('Y');?></a> |
     				<a href="contact.php?user=<?php echo $username;?>">contact us</a> |
     				<a href="settings.php?user=<?php echo $username;?>">account settings</a>
     			</div>
     		</div>
     	</div>
     </div>
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
    
    
    
    
      <div class="container-fluid">
     	<div class="row">
     		<div class="col-lg-12">
     			<div class="jumbotron text-center bg-1 set">
                <a href="" id="think">Think Inc.</a>     				
     			</div>
     		</div>
     	</div>
     </div>
     
    
	</body>
</html>