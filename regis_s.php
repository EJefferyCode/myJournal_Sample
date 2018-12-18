<?php

if(isset($_POST['reg'])){
$mysqli = new mysqli('localhost', 'id8189702_emilyjournalpro', 'butter41', 'id8189702_myjournal');
	
$username = $mysqli->real_escape_string($_POST['username']);
$password = $mysqli->real_escape_string($_POST['password']);
$cpassword = $mysqli->real_escape_string($_POST['cpassword']);
$email     = $mysqli->real_escape_string($_POST['email']);
$ageGroup = $mysqli->real_escape_string($_POST['ageGroup']);
$reminder = $mysqli->real_escape_string($_POST['reminder']);
$verify = $mysqli->real_escape_string($_POST['verify']);
$admin = $mysqli->real_escape_string($_POST['admin']);
$banned = $mysqli->real_escape_string($_POST['banned']);
$close = $mysqli->real_escape_string($_POST['close']);
    
$Q1 = $mysqli->query("SELECT * FROM user WHERE BINARY username = '$username'");
$Q2 = $mysqli->query("SELECT * FROM user WHERE BINARY email = '$email'");
	
	
	
	 if(empty($username) || empty($password) || empty($cpassword) || empty($email) || empty($ageGroup) || empty($reminder) || empty($verify)) {
        echo "<div class='container'>
               <div class='row'>
               <div class='col-lg-12'>
                <div class='thumbnail text-center'>Please Enter All Fields</div>
               </div>
               </div>
             </div>";
    }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
         echo "<div class='container'>
               <div class='row'>
               <div class='col-lg-12'>
                <div class='thumbnail text-center'>Please Enter A Valid Email</div>
               </div>
               </div>
             </div>";
    }elseif($Q1->num_rows != 0) {
         echo "<div class='container'>
               <div class='row'>
               <div class='col-lg-12'>
                <div class='thumbnail text-center'>Username already in use</div>
               </div>
               </div>
             </div>";
    }elseif($Q2->num_rows != 0) {
        echo "<div class='container'>
               <div class='row'>
               <div class='col-lg-12'>
                <div class='thumbnail text-center'>Email already in use</div>
               </div>
               </div>
             </div>";
    }elseif($cpassword != $password) {
        echo "<div class='container'>
               <div class='row'>
               <div class='col-lg-12'>
                <div class='thumbnail text-center'>Passwords do not match</div>
               </div>
               </div>
             </div>";
    }elseif(strlen($password) < 7) {
        echo "<div class='container'>
               <div class='row'>
               <div class='col-lg-12'>
                <div class='thumbnail text-center'>Password must be at least 7 characters</div>
               </div>
               </div>
             </div>";
    }elseif($verify != "HUMAN BEING") {
        echo "<div class='container'>
               <div class='row'>
               <div class='col-lg-12'>
                <div class='thumbnail text-center'>Type in the word you see above</div>
               </div>
               </div>
             </div>";
    }else{
		$password = md5($password);
		 $INSERT = $mysqli->query("INSERT INTO user(username,password,email,ageGroup,reminder,admin,banned,close) VALUES('$username', '$password', '$email', '$ageGroup', '$reminder', '$admin', '$banned', '$close')");
		 
		  if($INSERT != TRUE) {
            echo "<div class='container'>
               <div class='row'>
               <div class='col-lg-12'>
                <div class='thumbnail text-center'>Oops something went wrong.</div>
               </div>
               </div>
             </div>"; 
        }else{
            header('Location:home.php?user=' .$username);
        }
		 
		 
	 }
	
}









































?>