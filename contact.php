<?php

if($_SERVER['REQUEST_METHOD']=='POST'){
    include "assets/_dbconnect.php";
    $email=$_POST['email'];
    $name=$_POST['name'];
    $concern=$_POST['concern'];
    $name=str_replace("<","&lt;",$name);
    $name=str_replace(">","&gt;",$name);
    $concern=str_replace("<","&lt;",$concern);
    $concern=str_replace(">","&gt;",$concern);

    $sql="INSERT INTO `contact` (`name`, `email`, `concern`, `dt`) VALUES ('$name', '$email', '$concern', current_timestamp());";
    $result=mysqli_query($conn,$sql);
    if ($result)
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Message sent successfully.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  else{
    echo 'Failed to send message.';
  }
}
?>
<?php
include "assets/_navDynamic.php";
?>
<div class="container px-5" style="min-height: 80vh;">
    <h1 class="my-3 text-center">Contact Me</h1>
<form action="/crud/contact.php" method="POST" >
  <div class="form-group my-4">
    <label for="email">Enter your email address</label>
    <input type="email" class="form-control " id="email" name="email" aria-describedby="emailHelp" placeholder="name@example.com" maxlength="60" required>
  </div>
  <div class="form-group my-4">
    <label for="name">Enter your Name</label>
    <input type="text" class="form-control " id="name" name="name" aria-describedby="nameHelp" maxlength="60" required>
  </div>
  <div class="form-group my-4">
    <label for="concern">Your concern</label>
    <textarea class="form-control " id="concern" rows="3" name="concern"></textarea>
  </div>

  <button type="submit" class="btn btn-primary mb-3">Submit</button>
</form>
</div>

</body>
<?php
include "assets/_footer.php";
?>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>