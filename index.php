<?php
// session_start();
include "assets/_dbconnect.php";
$success = 'false';
$login = 'false';
$update = 'undefine';
$logout = 'false';
$pass = 'false';
$exist = false;
$delete = false;

if (isset($_GET['delete'])) {
  $sno = $_GET['delete'];
  // echo $sno;
  $sql = "DELETE FROM `note` WHERE `note`.`SL` = $sno";
  $result = mysqli_query($conn, $sql);
  $delete = true;
}

?>
<?php include "assets/_navDynamic.php";
?>

<?php
//! if $success==true, trigger an alert.
if (isset($_GET['success'])) {
  $success = $_GET['success'];
  $message = " Your note has been added successfully.";
} else if (isset($_GET['signup'])) {
  $success = $_GET['signup'];
  $message = " Your account created successfully. You can login now.";
} else if (isset($_GET['exist'])) {
  $exist = $_GET['exist'];
  if ($exist == "true")
    $warnMsg = " Username already exists! Please try to login.";
  else if ($exist == "false")
    $warnMsg = " Username does not exists! Please try to signup first.";
} else if (isset($_GET['pass'])) {
  $pass = $_GET['pass'];
  $warnMsg = " Password does not match or password field is empty";
  $redMsg = " Wrong password!!";
} else if (isset($_GET['login'])) {
  $success = $_GET['login'];
  $message = " You successfully logged into your CRUD account.";
} else if (isset($_GET['update'])) {
  $success = $_GET['update'];
  $message = " Your note has been updated successfully.";
} else if (isset($_GET['delete'])) {
  $delete = $_GET['delete'];
  $redMsg = " Your note has been deleted successfully.";
} else if (isset($_GET['logout'])) {
  $logout = $_GET['logout'];
  $redMsg = " You logged out from your CRUD account.";
}

if ($success == "true")
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong>' . $message . '
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
if ($exist || $pass == "notmatch")
  echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Error!</strong>' . $warnMsg . '
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
if ($delete || $logout == "true" || $pass == "wrong")
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>' . $redMsg . '</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
?>
<!--//! Save every data in a table form -->
<div class="container my-4">
  <h2>Add a note to NoteTaker</h2>
  <form action="/crud/assets/_crud.php" method="POST">
    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" class="form-control" id="title" name="title" maxlength="60" aria-describedby="titleHelp" required />
    </div>
    <div class="form-group">
      <label for="note">Note</label>
      <textarea class="form-control" id="note" rows="3" name="note" required></textarea>
    </div>
    <?php
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
      echo '<button type="submit" class="btn btn-primary">Submit</button>';
    } else {
      echo '<button type="button" class="btn btn-primary disabled" data-toggle="tooltip" data-placement="top" title="Login to NoteTaker to create note">Submit</button>';
    }
    ?>
  </form>


  <?php

  if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
    // echo $_SESSION['id'];
    $userid = 0;
    if (isset($_GET['userid'])) {
      $userid = $_GET['userid'];
    }

    $sql = "SELECT * FROM note where `userid`='$userid'";

    // this $result variable select all data in database, which is echoed by While loop in line 152

    $result = mysqli_query($conn, $sql);

    echo '<div class="container my-4">
    <table class="table .thead-dark" id="myTable">
      <thead>
        <tr>
          <th scope="col">Sl.</th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>';
    $sl = 0;
    while ($data = (mysqli_fetch_assoc($result))) {
      $sl++;
      //! Creating a dynamic table.
      echo "<tr>
                <th scope='row'>" . $sl . "</th>
                <td>" . $data['Title'] . "</td>
                <td>" . $data['Description'] . "</td>
                <td><button type='button' class='btn btn-primary btn-sm mx-1 edit' id=" . $data["SL"] . " >Edit</button><button type='button'class='" . $data['userid'] . " delete btn btn-primary btn-sm mx-1' id=d" . $data["SL"] . " >Delete</button></td>
              </tr>";
    };

    echo '<!-- Button trigger modal -->

        <!-- Modal -->
        <div class="modal fade" id="editNote" tabindex="-1" aria-labelledby="editNote" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="editNote">Edit Note</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="/CRUD/assets/_crud.php" method="POST">

                  <input type="hidden" name="snoEdit" id="snoEdit">

                  <div class="form-group">
                    <label for="editTitle">Edit Title</label>
                    <input type="text" class="form-control" id="editTitle" name="editTitle" aria-describedby="titleHelp" />
                  </div>
                  <div class="form-group">
                    <label for="editDesc">Edit Note</label>
                    <textarea class="form-control" id="editDesc" rows="3" name="editDesc"></textarea>
                  </div>
                  <button type="submit" class="btn btn-primary">Update Note</button>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
      </tbody>
    </table>
    <hr>
  </div>';
  } else
    echo '<div class="jumbotron jumbotron-fluid my-3">
    <div class="container">
      <h1 class="display-4 font-weight-bolder">You are not logged in.</h1>
      <p class="lead">Kindly <span class="font-weight-bolder text-primary">create an account and login</span> to <b>NoteTaker</b> to access its use.</p>
    </div>
  </div>';
  ?>
</div>
<?php
include "assets/_footer.php";
?>
</body>
<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready(function() {
    $('#myTable').DataTable();
  });
</script>

<script>
  edits = document.getElementsByClassName("edit");
  Array.from(edits).forEach((element) => {
    element.addEventListener("click", (e) => {
      console.log("edit ");
      tr = e.target.parentNode.parentNode;
      title = tr.getElementsByTagName("td")[0].innerText;
      desc = tr.getElementsByTagName("td")[1].innerText;
      console.log(title, desc);
      editTitle.value = title;
      editDesc.value = desc;
      sl = e.target.id;
      snoEdit.value = sl;
      $('#editNote').modal('toggle');

    })
  })
</script>

<script>
  deletes = document.getElementsByClassName("delete");
  Array.from(deletes).forEach((element) => {
    element.addEventListener("click", (e) => {
      sno = e.target.id.substr(1);
      user = e.target.className[0];
      for (i = 1; i < 6; i++) {
        user += e.target.className[i];
      }
      // console.log(sno);

      if (confirm("Are you sure you want to delete this Note ?")) {
        console.log("yes");
        window.location = `/crud/index.php?userid=` + user + `&delete=${sno}`;
      } else {
        alert("Unable to Delete.");
      }
    })
  })
  $(function() {
    $('[data-toggle="tooltip"]').tooltip()
  })
</script>

</body>

</html>