<?php
if(isset($_POST['send'])){
	$mysqli = new mysqli('localhost', 'id8189702_emilyjournalpro', 'butter41', 'id8189702_myjournal');
	
	$toPerson = $mysqli->real_escape_string($_POST['toPerson']);
	$fromPerson = $mysqli->real_escape_string($_POST['fromPerson']);
	$did        = $mysqli->real_escape_string($_POST['did']);
	$jid        = $mysqli->real_escape_string($_POST['jid']);
	$image      = $mysqli->real_escape_string($_POST['image']);
	$time       = $mysqli->real_escape_string($_POST['time']);
	$discuss    = $mysqli->real_escape_string($_POST['discuss']);
	
	if(empty($discuss)){
		 echo "<div class='container'>
               <div class='row'>
               <div class='col-lg-12'>
                <div class='thumbnail text-center'>Please fill out all fields.</div>
               </div>
               </div>
             </div>"; 
	}else{
		$INSERTD = $mysqli->query("INSERT INTO discussions(toPerson,fromPerson,discuss,did,jid,image,time) VALUES('$toPerson', '$fromPerson', '$discuss', '$did', '$jid', '$image', '$time')");
		
		
			if($INSERTD != TRUE) {
             echo "<div class='container'>
               <div class='row'>
               <div class='col-lg-12'>
                <div class='thumbnail text-center'>Oops. Something went wrong.</div>
               </div>
               </div>
             </div>"; 
        }else{
            header('Location:pub_j.php?jid=' .$jid);
        }
	}
}

?>
