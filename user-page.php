<?php require ('zdb.php');?>
<?php require ('zauthen.php');?>
<?php require ('z_sess_okay.php');?>
<?php date_default_timezone_set("America/New_York");?>
<?php
$user = $_GET['user'];
$now = date('m-d-Y h:i:s A');
$jid = "journal" . $username . $now;

if($user == ''){
	exit('<h1>Oops. <a href="index.php" style="text-decoration:none;color:purple;">Go Back</a></h1>');
}

if($resultt->num_rows === 0){
	exit('<h1>User does not exist. <a href="index.php">Leave</a></h1>');
}
$sqlj = "SELECT * FROM discussions WHERE fromPerson = '$user'";
$resultj = mysqli_query($dataBase,$sqlj) or die(mysqli_query($dataBase));
$rowj = mysqli_query($resultj);

$sql = "SELECT * FROM user WHERE username = '$user'";
$result = mysqli_query($dataBase,$sql) or die(mysqli_query($dataBase));
$row = mysqli_fetch_array($result);
$image = $row['image'];
$email = $row['email'];
$ageGroup = $row['ageGroup'];
$password = $row['password'];
if(empty($image)){
	$image = 'einstein.jpg';
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
     			<div class="jumbotron text-center header bg-6">
     				<h1>myJournal</h1>
     				<div class="thumbnail text-center dash">
     					<a href="home.php?user=<?php echo $username;?>" style="color:red;font-weight:600;">Home</a> |
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
     			<div class="jumbotron text-center bg-11">
     			 <div class="container-fluid">
     	<div class="row">
     		<div class="col-lg-12">
     		    <h4 style="color:black;"><?php echo $user;?></h4>
     		    <?php
				if($user != $username){
				?>
    		    
    		    <form method="POST">
    		    	
    		    	<button type="submit" name="report" class="btn btn-danger" style="padding:2px;border-radius:0px;" disabled>block this user</button>
    		    </form>
    		    <br>
    		    <?php
				}
				?>
     			<div class="jumbotron text-center bg-13">
     				<img src="zimgs/<?php echo $image;?>" class="img-rounded">
     			</div>
     		</div>
     	</div>
     </div>
     			</div>
     		</div>
     	</div>
     </div>
     
     
     
   
     
      <div class="container-fluid">
     	<div class="row">
     		<div class="col-lg-12">
     			<div class="jumbotron text-center bg-17">
     			<?php echo "post history for $user";?>
     			
     			<?php
					 if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        $no_of_records_per_page = 10;
        $offset = ($page-1) * $no_of_records_per_page;

        $dataBase=mysqli_connect("localhost","root","root","myJournal");
        // Check connection
        if (mysqli_connect_errno()){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            die();
        }

        $total_pages_sql = "SELECT COUNT(*) FROM journals WHERE username = '$user' ORDER BY id DESC";
        $result = mysqli_query($dataBase,$total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);
                  
        $journ = "SELECT * FROM journals WHERE username = '$user' ORDER BY id DESC LIMIT $offset, $no_of_records_per_page";
        $resultjourn = mysqli_query($dataBase,$journ);
        while($rowjourn = $resultjourn->fetch_assoc()) {
                     $journal = $rowjourn['journal'];
                       $person = $rowjourn['username'];
					   $time     = $rowjourn['time'];
					   $category = $rowjourn['category'];
					   $jid      = $rowjourn['jid'];
                        echo "
						  <h5>Posted by <a href='user-page.php?user=$person' style='color:black;'>$person</a></h5>
						  <b>featured in <i><a href='cat.php?cid=$category' style='color:blue;'>$category</a></i></b><br>
						  <a href='full.php?jid=$jid' style='color:green;font-weight:600;'>Comment or View Replies</a><br>
						<a href='pub_j.php?jid=$jid' class='cLinks'>$journal</a><br> <i style='color:blue;'>$time</i><hr style='border-color:#fafe79;'>
						";
                   }
                mysqli_close($dataBase);
                
					
			    ?>
			    <div class="thumbnail text-center bg-17">
              <ul class="pagination" style="list-style-type:none;margin:0;padding:0;overflow:hidden;">
        <li style="float:left;"><a href="?user=<?php echo $user;?>&page=1" style="display:block;padding:10px;color:black;border-color:white;">First</a></li>
       
        <li class="<?php if($page <= 1){ echo 'disabled'; } ?>" style="float:left;">
            <a href="<?php if($page <= 1){ echo '#'; } else { echo "?user=$user&page=".($page - 1); } ?>"  style="display:block;padding:10px;color:black;border-color:white;">Prev</a>
        </li>
       
        <li class="<?php if($page >= $total_pages){ echo 'disabled'; } ?>" style="float:left;">
            <a href="<?php if($page >= $total_pages){ echo '#'; } else { echo "?user=$user&page=".($page + 1); } ?>"  style="display:block;padding:10px;color:black;border-color:white;">Next</a>
        </li>
       
        <li style="float:left;"><a href="?user=<?php echo $user;?>&page=<?php echo $total_pages; ?>"  style="display:block; padding:10px;color:black;border-color:white;">Last</a></li>
    </ul>
             </div>
     			</div>
     		</div>
     	</div>
     </div>
     
     
      <div class="container-fluid">
     	<div class="row">
     		<div class="col-lg-12">
     			<div class="jumbotron text-center bg-17">
     			<?php
					if($resultj->num_rows === 0){
						echo "
						comment history<br>
						no comments yet";
					}else{
		 if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        $no_of_records_per_page = 10;
        $offset = ($page-1) * $no_of_records_per_page;

         $dataBase=mysqli_connect("localhost","id8189702_emilyjournalpro","butter41","id8189702_myjournal");
        // Check connection
        if (mysqli_connect_errno()){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            die();
        }

        $total_pages_sql = "SELECT COUNT(*) FROM journals WHERE fromPerson = '$user' ORDER BY id DESC";
        $result = mysqli_query($dataBase,$total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);
                  
        $journ = "SELECT * FROM discussions WHERE fromPerson = '$user' ORDER BY id DESC LIMIT $offset, $no_of_records_per_page";
        $resultjourn = mysqli_query($dataBase,$journ);
        while($rowjourn = $resultjourn->fetch_assoc()) {
                   $discuss = $rowjourn['discuss'];
			       $did     = $rowjourn['did'];
			       $jid     = $rowjourn['jid'];
			       $time    = $rowjourn['time'];
			       $toPerson = $rowjourn['toPerson'];
			
			       echo "<h5>You responded to <a href='user-page.php?user=$toPerson' style='color:purple;'>$toPerson</a>'s journal:
				   <br><a href='pub_j.php?jid=$jid' style='color:purple;font-size:1.3em;'>$discuss</a> <br><br> on $time</h5>
				   <a href='delete_change.php?did=$did' style='color:purple;'>Delete This Reply</a>
				   ";
                   }
                mysqli_close($dataBase);
					}
					?>
					<br><br><br>	
					 <div class="thumbnail text-center bg-17">
              <ul class="pagination" style="list-style-type:none;margin:0;padding:0;overflow:hidden;">
        <li style="float:left;"><a href="?user=<?php echo $user;?>&page=1" style="display:block;padding:10px;color:black;border-color:white;">First</a></li>
       
        <li class="<?php if($page <= 1){ echo 'disabled'; } ?>" style="float:left;">
            <a href="<?php if($page <= 1){ echo '#'; } else { echo "?user=$user&page=".($page - 1); } ?>"  style="display:block;padding:10px;color:black;border-color:white;">Prev</a>
        </li>
       
        <li class="<?php if($page >= $total_pages){ echo 'disabled'; } ?>" style="float:left;">
            <a href="<?php if($page >= $total_pages){ echo '#'; } else { echo "?user=$user&page=".($page + 1); } ?>"  style="display:block;padding:10px;color:black;border-color:white;">Next</a>
        </li>
       
        <li style="float:left;"><a href="?user=<?php echo $user;?>&page=<?php echo $total_pages; ?>"  style="display:block; padding:10px;color:black;border-color:white;">Last</a></li>
    </ul>
             </div>
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
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
    
    
    
    
    
    
	</body>
</html>