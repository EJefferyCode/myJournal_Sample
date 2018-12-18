<?php require ('zdb.php');?>
<?php require ('zauthen.php');?>
<?php require ('z_sess_okay.php');?>
<?php date_default_timezone_set("America/New_York");?>
<?php
$cid = $_GET['cid'];
$now = date('m-d-Y h:i:s A');
$jid = "journal" . $username . $now;

$sql = "SELECT * FROM user WHERE username = '$username'";
$result = mysqli_query($dataBase,$sql) or die(mysqli_query($dataBase));
$row = mysqli_fetch_array($result);
$image = $row['image'];
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
     				  
     		
     			</div>
     		</div>
     	</div>
     </div>
     <div class="container-fluid">
     	<div class="row">
     		<div class="col-lg-12">
     			<div class="jumbotron text-center bg-11 set">
     				<button type="button" class="btn btn-warning" data-toggle="collapse" data-target="#cats">
     					Browse Journals By Category
     				</button>
     				<div id="cats" class="collapse text-left" style="margin-top:25px;">
     					   <?php
                 $cats = "SELECT * FROM cats LIMIT 10";
                $result = $dataBase->query($cats);
                   while($row = $result->fetch_assoc()){
                       $cat = $row['cat'];
                      
                        echo "<a href='cat.php?cid=$cat' class='cLinks'>$cat</a><br>";
                   }
                 
      ?>
     					
     				</div>
     			</div>
     		</div>
     	</div>
     </div>
     
     <div class="container-fluid">
     	<div class="row">
     		<div class="col-lg-12">
     			<div class="jumbotron text-center bg-12 set">
     			<h3><?php echo $cid;?></h3>
     			</div>
     		</div>
     	</div>
     </div>

    
     <div class="container-fluid">
     	<div class="row">
     		<div class="col-lg-12">
     			<div class="jumbotron text-center bg-10 set">
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

        $total_pages_sql = "SELECT COUNT(*) FROM journals WHERE category = '$cid' ORDER BY id DESC";
        $result = mysqli_query($dataBase,$total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);
                  
        $journ = "SELECT * FROM journals WHERE category = '$cid' ORDER BY id DESC LIMIT $offset, $no_of_records_per_page";
        $resultjourn = mysqli_query($dataBase,$journ);
        while($rowjourn = $resultjourn->fetch_assoc()) {
			

                     $journal = $rowjourn['journal'];
                       $person = $rowjourn['username'];
					   $time     = $rowjourn['time'];
					   $category = $rowjourn['category'];
					   $jid      = $rowjourn['jid'];
                        echo "
						  <h5>Posted by <a href='user-page.php?user=$person'>$person</a></h5>
						 
						  <a href='full.php?jid=$jid'>Comment or View Replies</a><br>
						<a href='pub_j.php?jid=$jid' class='cLinks'>$journal</a><br> <i style='color:blue;'>$time</i><hr style='border-color:#1ffdcb;'>
						";
                   }
                mysqli_close($dataBase);
                
					?>
    			
    			<div class="thumbnail text-center bg-8">
              <ul class="pagination" style="list-style-type:none;margin:0;padding:0;overflow:hidden;">
        <li style="float:left;"><a href="?cid=<?php echo $cid;?>&page=1" style="display:block;padding:10px;color:black;border-color:white;">First</a></li>
       
        <li class="<?php if($page <= 1){ echo 'disabled'; } ?>" style="float:left;">
            <a href="<?php if($page <= 1){ echo '#'; } else { echo "?cid=$cid&page=".($page - 1); } ?>"  style="display:block;padding:10px;color:black;border-color:white;">Prev</a>
        </li>
       
        <li class="<?php if($page >= $total_pages){ echo 'disabled'; } ?>" style="float:left;">
            <a href="<?php if($page >= $total_pages){ echo '#'; } else { echo "?cid=$cid&page=".($page + 1); } ?>"  style="display:block;padding:10px;color:black;border-color:white;">Next</a>
        </li>
       
        <li style="float:left;"><a href="?cid=<?php echo $cid;?>&page=<?php echo $total_pages; ?>"  style="display:block; padding:10px;color:black;border-color:white;">Last</a></li>
    </ul>
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