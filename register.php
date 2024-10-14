<?php   

require "dbconnection.php"; 

if(isset($_POST['submit'])){ 
 
    $name=$_POST['name']; 
    $email=$_POST['email']; 
    $phone=$_POST['phone']; 
    $password=$_POST['password']; 
    $cpassword=$_POST['cpassword']; 
    $image=$_FILES['image']['name']; 
    $image_size=$_FILES['image']['size']; 
    $image_tmp_name=$_FILES['image']['tmp_name']; 
    $image_folder='admin/upload/'.$image; 


    $stmt = $con->prepare("SELECT * FROM users  WHERE email=:email AND password=:pass");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':pass', $pass);
    $stmt->execute();

    if($stmt->rowCount()>0){
        $message[]="user already exists";
    }
    else{
        if($password !=$cpassword){ 
            $message[]="confirm password not matched!";
        }elseif($image_size> 2000000){
            $message[]="image size is too large!";
        }else{
            $pass=password_hash($password,PASSWORD_DEFAULT);
            $stmt = $con->prepare("INSERT INTO users (name,email,password,image,phone) VALUES(:name,:email,:pass,:image,:phone)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':pass', $pass);
            $stmt->bindParam(':image', $image);
            $stmt->bindParam(':phone', $phone);
            $stmt->execute();

            if($stmt->rowCount()>0){
                move_uploaded_file($image_tmp_name,$image_folder);
                $message[]="registered successfully!";
                header("location: login.php");
            }else{
                $message[]="registration failed";
            }
        }
    }

}
?> 


<!DOCTYPE html>
<html>
<head>
<title> register</title>
<link rel="stylesheet" href="register.css">
</head>
<body>

<div class="container">
    <h2>Registration now</h2>
    <?php 
    if(isset($message)){
        foreach($message as  $message){
            echo '<div class="message">'. $message.'</div>';
        }
    }
    ?>
    <form action="register.php" method="post" enctype="multipart/form-data">

        <div class="input-group">

            <label for="username">Username</label>
            <input type="text"   name="name" required>
        </div>

        <div class="input-group">
            <label for="email">Email</label>
            <input type="email"  name="email" required>
        </div>

        <div class="input-group">
            <label for="password">Password</label>
            <input type="password" name="password" required>
        </div>

        <div class="input-group">
            <label for="password">confirm Password</label>
            <input type="password"  name="cpassword" required>
        </div>

        <div class="input-group">
            <label for="phone">Phone Number</label>
            <input type="tel" id="phone" name="phone" required>
        </div>

        <div class="input-group">
            <label for="file">image</label>
            <input type="file" name="image" accept="image/jpg, image/jpeg, image/png">
        </div>

        <button type="submit" name="submit"  value="register now" class="btn">Register</button>
    </form>
    <p>already have an account? <a href="login.php">login now</a>.</p>
</div>

</body>
</html>