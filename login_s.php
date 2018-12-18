<?php
if(isset($_POST['go'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if(empty($password) || empty($username)) {
         echo "<div class='container'>
               <div class='row'>
               <div class='col-lg-12'>
                <div class='thumbnail text-center'>Please fill in all fields</div>
               </div>
               </div>
             </div>"; 
    }else {
        $CONNECT = new mysqli('localhost', 'id8189702_emilyjournalpro', 'butter41', 'id8189702_myjournal');
        
        $username = $CONNECT->real_escape_string($username);
        $password = $CONNECT->real_escape_string($password);
        
        $Q = $CONNECT->query("SELECT id FROM user WHERE BINARY username = '$username' AND password = md5('$password')");
        
        if($Q->num_rows === 0) {
            echo "<div class='container'>
               <div class='row'>
               <div class='col-lg-12'>
                <div class='thumbnail text-center'>Invalid username or password. Try again.</div>
               </div>
               </div>
             </div>"; 
        }else{
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            header("Location:home.php?user=" .$username);
        }
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
    }
}


?>