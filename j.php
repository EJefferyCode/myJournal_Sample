<?php require ('zdb.php');?>
<?php require ('zauthen.php');?>
<?php require ('z_sess_okay.php');?>
<?php date_default_timezone_set("America/New_York");?>
<?php

$now = date('m-d-Y h:i:s A');
$jid = "journal" . $username . $now;

$sql = "SELECT * FROM user WHERE username = '$username'";
$result = mysqli_query($dataBase,$sql) or die(mysqli_query($dataBase));
$row = mysqli_fetch_array($result);
$image = $row['image'];
if(empty($image)){
	$image = 'einstein.jpg';
}

$sqlj = "SELECT * FROM journals WHERE username = '$username'";
$resultj = mysqli_query($dataBase,$sqlj) or die(mysqli_query($dataBase));
$rowj = mysqli_fetch_array($resultj);

#select * from friends
#select * from journals

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
     				<div class="thumbnail text-center dash">
     					<a href="home.php?user=<?php echo $username;?>" style="color:red;font-weight:600;">Home</a> |
     					<a href="new.php?user=<?php echo $username;?>">Notifications</a> |
     					<a href="logout.php" style="color:red;font-weight:600;">Logout</a>
     				</div>
     				<h3>Welcome <?php echo $username;?></h3>
     				  
      <div class="container-fluid">
     	<div class="row">
     		<div class="col-lg-12">
     			<div class="jumbotron text-center bg-13">
     				<img src="zimgs/<?php echo $image;?>" class="img-rounded">
     				<br><br>
     				<a href="settings.php?user=<?php echo $username;?>" style="color:white;font-size:1.2em;">Change Image</a>
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
     			<div class="jumbotron text-center bg-12 set">
     			<h3>Your Journals</h3>
     				<?php
					
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

        $total_pages_sql = "SELECT COUNT(*) FROM journals WHERE username = '$username' ORDER BY id DESC";
        $result = mysqli_query($dataBase,$total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);
                  
        $sqlv = "SELECT * FROM journals WHERE username = '$username' ORDER BY id DESC LIMIT $offset, $no_of_records_per_page";
        $res_datav = mysqli_query($dataBase,$sqlv);
        while($rowv = $res_datav->fetch_assoc()) {
                      $jid = $rowv['jid'];
			          $time = $rowv['time'];
			          $journal = $rowv['journal'];
			          $category = $rowv['category'];
			
			          echo "
					  <div class='thumbnail text-left'>
					  <a href='pub_j.php?jid=$jid' style='color:black;'><i>$journal</i></a>
					  <br>
					 <i>asked in</i> <a href='cat.php?cid=$category' style='color:blue;font-weight:600;'>$category</a>
					  <br>
					  <b>$time</b>
					  <br>
					  <a href='delete_change.php?remove=$jid' style='color:red;font-weight:600;'>Remove This Post</a>
					  </div>
					  ";
                   }
                mysqli_close($dataBase);
                
					?>
    			<div class="thumbnail text-left">
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
     		</div>
     	</div>
     </div>

     
     <div class="container-fluid">
     	<div class="row">
     		<div class="col-lg-12">
     			<div class="jumbotron text-center bg-10 set">
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