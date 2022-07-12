<?php


$user=rand(1,100);
$str=password_hash($user,PASSWORD_DEFAULT);
$rand=substr($str,10,6);


$exist="false";
if($_SERVER['REQUEST_METHOD']=='POST'){
    include "_dbconnect.php";
    $username=$_POST['username'];

    $pass=$_POST['password'];
    $cpass=$_POST['cpassword'];
    $userid=$rand;
    $existsql="SELECT * FROM `cruduser` where `username`='$username'";
    $resexist=mysqli_query($conn,$existsql);
    $num=mysqli_num_rows($resexist);
    
    if($num>0){
        header("location: /crud/index.php/?exist=true");
        exit;
    }
    else{
        if($pass!=$cpass){
            header("location: /crud/index.php/?pass=notmatch");
            exit; 
        }
        else if($pass==""){
            header("location: /crud/index.php/?pass=notmatch");
            exit;
        }
        else{
            $hash=password_hash($pass,PASSWORD_DEFAULT);
            $username=str_replace("<","&lt;",$username);
            $username=str_replace(">","&gt;",$username);
            $sql="INSERT INTO `cruduser` (`userid`,`username`, `password`, `dt`) VALUES ('$userid','$username', '$hash', current_timestamp())";
            $result=mysqli_query($conn,$sql);
            if($result){
                header("location: /crud/index.php/?signup=true");

            }
        }
    }
}