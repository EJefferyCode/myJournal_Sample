<?php
$output = NULL;
$output2 = NULL;

if(isset($_POST['findUser'])) {
    $email = $_POST['email'];
    
    if(empty($email)){
        $output = "<p>Enter a valid email address.</p>";
    }else{
        $connect = new mysqli('localhost', 'id8189702_emilyjournalpro', 'butter41', 'id8189702_myjournal');
        $email = $connect->real_escape_string($email);
         
        $Q = $connect->query("SELECT email FROM user WHERE email = '$email'");
        
        if($Q->num_rows === 0) {
            $output = "<p style='color:red;'>Sorry, you didn't use that email. Try again, maybe?</p>";
    }else{
         $sql = "SELECT * FROM user WHERE email = '$email'";
            $result = $connect->query($sql);
            
            while($row = $result->fetch_assoc()) {
                $username =  $row['username'];
                $output = "<p style='color:red;'>Your username is $username</p> <br> <a href='index.php'>login</a>";
            
 }
}
    }
        
    }


if(isset($_POST['resetPassword'])) {
    $reminder = $_POST['reminder'];
    $username  = $_POST['username'];
    
    if(empty($username) || empty($reminder)) {
        $output2 = "<p style='color:red;'>Please fill in all fields.</p>";
    }else {
       $connect = new mysqli('localhost', 'id8189702_emilyjournalpro', 'butter41', 'id8189702_myjournal');
        
        $reminder = $connect->real_escape_string($reminder);
        $username = $connect->real_escape_string($username);
        
        $Q = $connect->query("SELECT id FROM user WHERE reminder = '$reminder' AND BINARY username = '$username'");
        
        if($Q->num_rows === 0) {
            $output2 = "<p style='color:red;'>That combination isn't in our records. Watch for those typos.</p>";
        }else {
            $sql = "SELECT * FROM user WHERE reminder = '$reminder' AND BINARY username = '$username'";
            $result = $connect->query($sql);
            
            while($row = $result->fetch_assoc()) {
                $answer = $row['reminder'];
                $username = $row['username'];
                $tempPass = 'HomeRun41';
                $tempPass = md5($tempPass);
                
                $update = "UPDATE user SET password = '$tempPass' WHERE username = '$username'";
                mysqli_query($connect,$update) or die(mysqli_error($connect));
                
                $output2 = "<p style='color:red;'>Your temporary password is HomeRun41 Login to your account and change it immediately.</p>";
            }
        }
    }
    
    
    
    
    
}



?>