<?php require ('zdb.php');?>
<?php require ('zauthen.php');?>
<?php require ('z_sess_okay.php');?>
<?php date_default_timezone_set("America/New_York");?>
<?php
$user = $_GET['user'];
if(empty($user)){
	exit('<h1>Oops. <a href="new.php?user='.$username.'">Leave</a></h1>');
}
$now = date('m-d-Y h:i:s A');
$jid = "journal" . $username . $now;

$sql = "SELECT * FROM user WHERE username = '$username'";
$result = mysqli_query($dataBase,$sql) or die(mysqli_query($dataBase));
$row = mysqli_query($result);
$image = $row['image'];
if(empty($image)){
	$image = 'einstein.png';
}


$sqld = "SELECT * FROM discussions WHERE toPerson = '$username'";
$resultd = mysqli_query($dataBase,$sqld) or die(mysqli_query($dataBase));
$rowd = mysqli_query($resultd);

$toPerson = $rowd['toPerson'];
$fromPerson = $rowd['fromPerson'];
$discuss    = $rowd['discuss'];
$did        = $rowd['did'];
$jid        = $rowd['jid'];
$time       = $rowd['time'];
$image      = $rowd['image'];

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
     				<h1><a href='home.php?user=<?php echo $username;?>' style="color:white;text-decoration:none;">myJournal</a></h1>
     				<h3>Welcome <?php echo $username;?></h3>
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
     			<div class="jumbotron text-left header bg-7 set">
     				<?php
					if($resultd->num_rows === 0){
						echo "no notifications yet!";
					}elseif($fromPerson === $username){
						echo "no notifications yet!";
					}else{
						#select all and while
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

        $total_pages_sql = "SELECT COUNT(*) FROM discussions WHERE toPerson = '$username' ORDER BY id DESC";
        $result = mysqli_query($dataBase,$total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);
                  
        $journ = "SELECT * FROM discussions WHERE toPerson = '$username' ORDER BY id DESC LIMIT $offset, $no_of_records_per_page";
        $resultjourn = mysqli_query($dataBase,$journ);
        while($rowjourn = $resultjourn->fetch_assoc()) {
			         $fromPerson = $rowjourn['fromPerson'];
			         $discuss = $rowjourn['discuss'];
			         $did     = $rowjourn['did'];
			         $jid     = $rowjourn['jid'];
			         $time    = $rowjourn['time'];
                     echo "
					       <ul style='list-style-type:none;'>
						     <li><a href='user-page.php?user=$fromPerson' style='font-size:1.3em;color:purple;'>$fromPerson</a><br> responded to your journal: <br><a href='pub_j.php?jid=$jid' style='color:purple;font-weight:600;'>$discuss</a> on <b>$time</b></li>
						   </ul>
					 ";
                   }
                mysqli_close($dataBase);
					}
                
					?>
    			
					
     				
     			</div>
     		</div>
     	</div>
     	<div class="thumbnail text-left bg-8 set">
              <ul class="pagination" style="list-style-type:none;margin:0;padding:0;overflow:hidden;">
        <li style="float:left;"><a href="?user=<?php echo $username;?>&page=1" style="display:block;padding:10px;color:black;border-color:white;">First</a></li>
       
        <li class="<?php if($page <= 1){ echo 'disabled'; } ?>" style="float:left;">
            <a href="<?php if($page <= 1){ echo '#'; } else { echo "?user=$username&page=".($page - 1); } ?>"  style="display:block;padding:10px;color:black;border-color:white;">Prev</a>
        </li>
       
        <li class="<?php if($page >= $total_pages){ echo 'disabled'; } ?>" style="float:left;">
            <a href="<?php if($page >= $total_pages){ echo '#'; } else { echo "?user=$username&page=".($page + 1); } ?>"  style="display:block;padding:10px;color:black;border-color:white;">Next</a>
        </li>
       
        <li style="float:left;"><a href="?user=<?php echo $username;?>&page=<?php echo $total_pages; ?>"  style="display:block; padding:10px;color:black;border-color:white;">Last</a></li>
    </ul>
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