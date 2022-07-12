<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous" />
  <!-- //! Thankyou Datatable -->
  <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="assets/style.css">

  <title>NoteTaker- Make notes taking easy!</title>

</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#"><img src="https://img.icons8.com/dusk/344/php-logo.png" alt="NoteTaker" height="50px"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <?php
        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
          echo '<a class="nav-link" href="/crud/index.php/?userid=' . $_SESSION['id'] . '">Home <span class="sr-only"></span></a>';
        } else {
          echo '<a class="nav-link" href="/crud/">Home <span class="sr-only"></span></a>';
        }
        ?>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/crud/about.php">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/crud/contact.php">Contact Me</a>
      </li>
    </ul>
    <div class="my-2 my-lg-0">


      <?php
      // session_start();
      // <p class="text-light">Welcome <b>$_SESSION["username"]</b></p>
      if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        echo '<p class="text-light d-inline mx-3">Welcome <img src="https://img.icons8.com/fluency/344/user-male-circle.png" alt="logo" width="50px" class="mr-2"><b>' . $_SESSION["username"] . '</b></p>
  <a href="/crud/assets/_logout.php" class="btn btn-primary" type="button">Logout</a>';
      } else {

        echo '<button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#signup">
  Sign Up
</button>

<!-- Modal -->
<div class="modal fade" id="signup" tabindex="-1" aria-labelledby="signup" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="signup">Sign Up to NoteTaker</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/crud/assets/_handlesignup.php" method="POST">
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" aria-describedby="username" placeholder="Enter username">
            <small id="usernameHelp" class="form-text text-muted">The username is not case sensetive</small>
          </div>

          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
          </div>
          <div class="form-group">
            <label for="cpassword">Confirm Password</label>
            <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password">
          </div>
          <button type="submit" class="btn btn-primary">Sign Up</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- Button trigger modal -->
<button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#login">
  Login
</button>

<!-- Modal -->
<div class="modal fade" id="login" tabindex="-1" aria-labelledby="login" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="login">Login to NoteTaker</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/crud/assets/_handlelogin.php" method="POST">
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" aria-describedby="username" placeholder="Enter username">
            <small id="usernameHelp" class="form-text text-muted">username is case sensitive</small>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
          </div>

          <button type="submit" class="btn btn-primary">Login</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>';
      }
      ?>

    </div>
  </div>
</nav>