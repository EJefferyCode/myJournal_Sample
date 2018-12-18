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
	$image = 'einstein.png';
}

if(isset($_POST['create'])){
	$mysqli = new mysqli('localhost', 'id8189702_emilyjournalpro', 'Dasies195', 'id8189702_myjournal'); 
	
	$username = $mysqli->real_escape_string($_POST['username']);
	$jid = $mysqli->real_escape_string($_POST['jid']);
	$time = $mysqli->real_escape_string($_POST['time']);
	$profileimg = $mysqli->real_escape_string($_POST['profileimg']);
	$journal = $mysqli->real_escape_string($_POST['journal']);
	$category    = $mysqli->real_escape_string($_POST['category']);

	if(empty($journal)){
		  echo "<div class='container'>
               <div class='row'>
               <div class='col-lg-12'>
                <div class='thumbnail text-center'>Please fill out all fields.</div>
               </div>
               </div>
             </div>"; 
	}else{
		$INSERT = $mysqli->query("INSERT INTO journals(username,jid,time,profileimg,journal,category) VALUES('$username', '$jid', '$time', '$profileimg', '$journal', '$category')");
		
		        if($INSERT != TRUE) {
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
    
             <div class="container-fluid">
     	<div class="row">
     		<div class="col-lg-12">
     			<div class="jumbotron text-center header bg-1">
     				<h1 style=""><k style='color:black;'>Demonstration Version</k> myJournal&copy;<?php echo date('Y');?></h1>
     			</div>
     		</div>
     	</div>
     </div>
    
<!--
    <h1>home</h1>
    <a href="logout.php">logout</a>
-->
     <div class="container-fluid">
     	<div class="row">
     		<div class="col-lg-12">
     			<div class="jumbotron text-center header bg-6">
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
     			<div class="jumbotron text-center header bg-7 set">
     				<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#new">
     					Create New Post
     				</button>
     				<div class="modal fade" id="new" role="dialog">
     					<div class="modal-dialog">
     						<div class="modal-content">
     							<div class="modal-header">
     								<button type="button" class="close" data-dismiss="modal">&times;</button>
     							</div>
     							<div class="modal-body">
     								<h3>Submit A New Journal Post</h3>
     								<form method="POST">
     								<input type="hidden" name="username" value="<?php echo $username;?>">
     								<input type="hidden" name="jid" value="<?php echo $jid;?>">
     								<input type="hidden" name="time" value="<?php echo $now;?>">
     								<input type="hidden" name="profileimg" value="<?php echo $image;?>">
     							          <div class="form-group">
     							          <h5 style="color:red;">Choose A Category</h5>
     							          	<select name="category" class="form-control" required>
     							          		<?php
												 $sqlc = "SELECT * FROM cats LIMIT 10";
												$resultc = $dataBase->query($sqlc);
												while($rowc = $resultc->fetch_assoc()){
													$cat = $rowc['cat'];
													echo "<option value='$cat'>$cat</option>";
												}
												?>
     							          	</select>
     							          </div>
     							   
     							   
     									<div class="form-group">
     										<textarea class="form-control" name="journal" placeholder="500 characters or less..." maxlength="500" rows="5" required></textarea>
     									</div>
     									<button class="btn btn-success" name="create" type="submit" style="width:80%;">Create</button>
     								</form>
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
     			<div class="jumbotron text-center bg-8 set">
     				<h1>What Others Are Posting</h1>
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

        $total_pages_sql = "SELECT COUNT(*) FROM journals ORDER BY id DESC";
        $result = mysqli_query($dataBase,$total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);
                  
        $journ = "SELECT * FROM journals ORDER BY id DESC LIMIT $offset, $no_of_records_per_page";
        $resultjourn = mysqli_query($dataBase,$journ);
        while($rowjourn = $resultjourn->fetch_assoc()) {
                     $journal = $rowjourn['journal'];
                       $person = $rowjourn['username'];
					   $time     = $rowjourn['time'];
					   $category = $rowjourn['category'];
					   $jid      = $rowjourn['jid'];
                        echo "
						  <h5>Posted by <a href='user-page.php?user=$person' style='color:black;'>$person</a></h5>
						  <b>featured in <i><a href='cat.php?cid=$category' style='color:purple;'>$category</a></i></b><br>
						  <a href='full.php?jid=$jid' style='color:black;font-weight:600;'>Comment or View Replies</a><br>
						<a href='pub_j.php?jid=$jid' class='cLinks'>$journal</a><br> <i style='color:blue;'>$time</i><hr style='border-color:#1ffdcb;'>
						";
                   }
                mysqli_close($dataBase);
                
					?>
    			
    			<div class="thumbnail text-center bg-8">
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
     			<div class="jumbotron text-center bg-9">
     				<h1>Check This Out</h1>
     			</div>
     		</div>
     	</div>
     </div>
     
      <div class="container-fluid">
     	<div class="row">
     		<div class="col-lg-12">
     			<div class="jumbotron text-center bg-10">
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
     			<div class="jumbotron text-center bg-1 opac">
                <a href="" id="think">Think Inc.</a>     				
     			</div>
     		</div>
     	</div>
     </div>
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
    
    
    
    
    
    
	</body>
</html>