<?php
require 'db.php';
session_start();
if(isset($_SESSION["login_auth"]) || $_SESSION["login_auth"] == true || isset($_SESSION["login_admin"]) || $_SESSION["login_admin"] == true){
$id = $_SESSION['AID'];
if (isset ($_POST['name'])  && isset($_POST['title']) && isset($_POST['pub'])   && isset($_POST['DO']) && isset($_POST['copy'])  && isset($_POST['isbn']) ) {
  
  $name = $_POST['name'];
 $title = $_POST['title'];
 $id = $_POST['ID'];
 $pub = $_POST['pub'];
  $currdate=date("Y-m-d");
 $rawdate = $_POST['DO'];
 $copy=$_POST['copy'];
 $link=$_POST['link'];
 
 $isbn=$_POST['isbn'];
 $dob = date('Y-m-d',strtotime($rawdate));
 $uid = uniqid("FK-");
 $sql = 'INSERT INTO formk(UID,ID,Name,Title,Publisher,Date_start,Copy,Link,Isbn) VALUES(:uid,:id,:name,:title,:pub,:dob,:copy,:link,:isbn)';
 $statement = $connection->prepare($sql);
 if ($statement->execute([':uid' => $uid,':id' => $id,':name' => $name,':title' => $title,':pub' => $pub,':dob' => $dob,':copy'=>$copy,':link'=>$link,':isbn'=>$isbn])) {
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
      <h2>
K.   Books / Book Chapter 

</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <!-- <form method="post" action="/projects/teacherforms/FormK/file_entry.php"> -->
      <form method="post" action="create.php">
        <div class="form-group">
          <label for="ID">Reg.ID</label>
          <input type="text" name="ID"  class="form-control">
        </div>
        
        <div class="form-group">
          <label for="name">Name of the Teacher(s)/Author</label>
          <input type="text" name="name" id="name" class="form-control">
        </div>
        <div class="form-group">
          <label for="title">Title of the Reference Books/Monographs</label>
          <input type="text" name="title" id="title" class="form-control">
        </div>
        <div class="form-group">
          <label for="pub">Name and Place of Publisher(s)</label>
          <input type="text" name="pub" id="pub" class="form-control">
        </div>
        
         <div class="form-group">
          <label for="DO">Date of Publication</label>
          <input type="date" name="DO" id="DO" class="form-control">
        </div>
         <div class="form-group">
          <label for="copy">Hard /Soft Copy</label>
          <input type="text" name="copy" id="copy" class="form-control">
        </div>
        
         <div class="form-group">
          <label for="link">Link in case of Soft copy</label>
          <input type="text" name="link" id="link" class="form-control">
        </div>
         <div class="form-group">
          <label for="isbn">Isbn/Issn No.</label>
          <input type="text" name="isbn" id="isbn" class="form-control">
        </div>
    

        <div class="form-group">
          <button type="submit" class="btn btn-info">Upload Document Proof</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php

require 'footer.php';
      }

      else
{
	if($_SESSION['login_flag'] == 2){
        header("location: ../../../index.html");
        exit;
    }

    else if($_SESSION['login_flag'] == 3){
        header("location: ../../../Admin_login.html");
        exit;
    }
}
?>