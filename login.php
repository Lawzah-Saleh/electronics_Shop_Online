<?php
session_start();


?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <!-- <link rel="stylesheet" href="styles.css"> -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/custom.css">
<link rel="stylesheet" href="css/font-awesome.min.css">

	<?php if(isset($custom)) echo $custom;  ?>

</head>
<body style=" background-image: url('images/about.jpg');">

<?php 
require "dbconnection.php";

if(isset($_POST['login']))
{
$username=$_POST['username'];
$password=$_POST['password'];

if (empty($username) | empty($password)){
  echo "the filed are required ";
}
else {
 $query="select * from users where email=:email and password=:password" ;
 $stm=$con->prepare($query);
 $stm->execute(array("email"=>$username,"password"=>$password));
 if($stm->rowcount()==1){
  $_SESSION['user_info']=$stm->fetch();
  if($_SESSION['user_info']['role_id']==1){

    header("location:Admin/index.php");
  }
  else{
    header("location:index.php");
  }
}
  else {
    echo "<div class='alert alert-danger text-center'> email or password are uncorecct</div>";
  }
 
}
}
?>
    <div class="login-container">
        <h2>Login</h2>
        <form id="login-form"  method="post">
            <div class="input-field">
                <label for="uname">Username</label>
                <input type="text" id="uname" name="username" required>
            </div>
            <div class="input-field">
                <label for="psw">Password</label>
                <input type="password" id="psw" name="password" required>
            </div>
            <button type="submit" class="btn" style="background-color:#4CAF50" name="login" >Login</button>
        </form>
        <p>Don't have an account? <a href="register.php">Create one</a>.</p>
    </div>
</body>
</html>