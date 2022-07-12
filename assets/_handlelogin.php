<?php

if($_SERVER['REQUEST_METHOD']=='POST'){
    include "_dbconnect.php";
    $username=$_POST['username'];
    $pass=$_POST['password'];
    // $id=$_POST['userid'];
    $selectSql="SELECT * FROM `cruduser` where `username`='$username'";
    $result1=mysqli_query($conn,$selectSql);

    if(mysqli_num_rows($result1)==1){
        if($pass==""){
            header("location: /crud/index.php/?pass=wrong");
            exit;
        }

        $row=mysqli_fetch_assoc($result1);
        if($pass==password_verify($pass,$row['password'])){
            session_start();
            $_SESSION['loggedin']=true;
            $_SESSION['username']=$username;
            $_SESSION['id']=$row['userid'];
            header("location: /crud/index.php/?login=true&userid=".$row['userid']);            
        }
        else{
            header("location: /crud/index.php/?pass=wrong");  
        }
    }
    else{
        header("location: /crud/index.php/?exist=false");
    }
}
?>