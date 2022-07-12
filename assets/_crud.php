<?php
session_start();
// if method == post then take the data from the input.values and run sql to insert values in database/table;

// echo $_SERVER['REQUEST_METHOD'];
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include "_dbconnect.php";

  //If method== Post with ID snoEdit, as mentioned in 'hidden input tag in modal', then form will be edited else inserted!
  if (isset($_POST["snoEdit"])) {
    // echo "yes";
    $slno = $_POST["snoEdit"];
    $title = $_POST["editTitle"];
    $desc = $_POST["editDesc"];
    $title=str_replace("<","&lt;",$title);
    $title=str_replace(">","&gt;",$title);
    $desc=str_replace("<","&lt;",$desc);
    $desc=str_replace(">","&gt;",$desc);
    $useridnote=$_SESSION['id'];

    $sql = "UPDATE `note` SET `Title` ='$title' , `Description` = '$desc' WHERE `note`.`SL` = $slno";
    $result = mysqli_query($conn, $sql);
    header("location: /crud/index.php/?update=true&userid=".$useridnote);
    
  } 
  
  else {
    $title = $_POST["title"];
    $notes = $_POST["note"];
    $useridnote=$_SESSION['id'];
    $title=str_replace("<","&lt;",$title);
    $title=str_replace(">","&gt;",$title);
    $notes=str_replace("<","&lt;",$notes);
    $notes=str_replace(">","&gt;",$notes);

    $sql = "INSERT INTO `note` ( `userid`, `Title`, `Description`, `timestamp`) VALUES ('$useridnote','$title', '$notes', current_timestamp());";
    $result = mysqli_query($conn, $sql);
    $sql = "SELECT * FROM note where `userid`='$useridnote'";
    $result = mysqli_query($conn, $sql);
    header("location: /crud/index.php/?success=true&userid=".$useridnote);
    
  }
}
//! after inserting data to mysql database select everything and run sql(also can be done after delete sql)

?>