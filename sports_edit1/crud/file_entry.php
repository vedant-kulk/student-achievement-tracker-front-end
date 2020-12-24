<?php
require 'db.php';
session_start();
if(!isset($_SESSION["login"]) || $_SESSION["login"] !== true){
    header("location: ../../Home_page.php");
    exit;
}
$id = isset($_SESSION['ID']) ? $_SESSION['ID'] : '';
$message = '';
$uid = uniqid("SP-");
$filename='';

if (isset ($_POST['Type'])  && isset($_POST['Description']) && isset($_POST['Venue']) && isset($_POST['Achievements'])  && isset($_POST['DOB']) ) {
  $type = $_POST['Type'];
  $descp = $_POST['Description'];
  $venue = $_POST['Venue'];
  $achieve = $_POST['Achievements'];
  $rawdate = $_POST['DOB'];
  $dob = date('Y-m-d',strtotime($rawdate));
  $sql = 'INSERT INTO sports(UID,ID,Sports_Name,Description,Venue,Achievements,Date_Sports) VALUES(:uid,:id,:type,:descp,:venue,:achieve,:dob)';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':uid' => $uid,':id' => $id,':type' => $type,':descp' => $descp,':venue' => $venue,':achieve' => $achieve,':dob' => $dob])) {
    $message = 'data inserted successfully';
  }
  
}
else{
    $message = 'data insertion Unsuccessful';
  }
 



?>

<html lang="en">
  <head>
    <title>Create</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  </head>
  <body class="bg-info">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/projects/Auth_page1.php">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Achievements</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="">Add Data</a>
      </li>
      
    </ul>
  </div>
  
</nav>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Add Certificate</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
     
       <form  action="../../file/filesLogic.php?uid=<?php echo $uid?>&type=Sports&flag_file=1" method="post" enctype="multipart/form-data" > 
                  <input type="file" name="myfile" id="file" >
                   <button style="margin:5%;" type="submit" name="save" class="btn btn-info">Submit</button>
                </form> 
             
             
      </form>
    </div>
  </div>
</div>

<?php require 'footer.php'; ?>