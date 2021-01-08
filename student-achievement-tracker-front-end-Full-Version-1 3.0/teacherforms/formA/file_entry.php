<?php
require 'db.php';
session_start();
if(!isset($_SESSION["login_auth"]) || $_SESSION["login_auth"] !== true){
    header("location: ../../Auth_login.php");
    exit;
}
$id = $_SESSION['AID'];

$filename='';

if (isset ($_POST['activity'])  && isset($_POST['title']) && isset($_POST['venue']) && isset($_POST['sponsor'])  && isset($_POST['DO']) && isset($_POST['participant']) && isset($_POST['coordinator']) && isset($_POST['remark']) ) {
  $activity = $_POST['activity'];
  $title = $_POST['title'];
  $venue = $_POST['venue'];
  $sponsor = $_POST['sponsor'];
  $rawdate = $_POST['DO'];
  $currdate=date("Y-m-d");
  $participant=$_POST['participant'];
  $coordinator=$_POST['coordinator'];
  $remark=$_POST['remark'];
  $dob = date('Y-m-d',strtotime($rawdate));
  $uid = uniqid("FA-");
  $sql = 'INSERT INTO formA(UID,ID,Activity,Title,State,Sponsor,Date_time,Participants,Coordinator,Remarks,Currentdate) VALUES(:uid,:id,:activity,:title,:venue,:sponsor,:dob,:participant,:coordinator,:remark,:currdate)';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':uid' => $uid,':id' => $id,':activity' => $activity,':title' => $title,':venue' => $venue,':sponsor' => $sponsor,':dob' => $dob,':participant'=>$participant,':coordinator'=>$coordinator,':remark'=>$remark,':currdate'=>$currdate])) {
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
      <h2>Add Seminars, Symposia, Workshops Data</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
     
       <form  action="../../file/filesLogic.php?uid=<?php echo $uid?>&type=formA&flag_file=2" method="post" enctype="multipart/form-data" > 
                  <input type="file" name="myfile" id="file" >
                   <button style="margin:5%;" type="submit" name="save" class="btn btn-info">Submit</button>
        </form> 
             
      </form>
    </div>
  </div>
</div>

<?php
require 'footer.php';
?>