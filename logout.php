<?php require ('zdb.php');?>
<?php require ('zauthen.php');?>
<?php require ('z_sess_okay.php');?>

<?php
session_start();
session_destroy();
?>


<!DOCTYPE html>
<html>
 <head>
    <meta charset="utf-8">
     <meta name="viewport" content="width=device-width,initial-scale=1">
     <title>myJournal</title>
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
    <body>
        <div class="jumbotron text-center" style='background-color:purple;border-color:purple;'>
          <h2 style="font-size:1em;color:gold;font-weight:600;">Thanks For Stopping By!</h2>
            <a href="index.php" style="color:gold;font-weight:600;">Click Here To Login</a>
             
        </div>
    
    </body>
</html>