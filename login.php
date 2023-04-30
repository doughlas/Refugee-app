<?php

include 'config.php';
session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $row = mysqli_fetch_assoc($select);
      $_SESSION['user_id'] = $row['Personal_Id'];
      header('location:index.php');
   }else{
      $message[] = 'incorrect password or email!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style.css">

</head>
<body>

<?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
   }
}
?>
   
   <div class="container">
        <div  class="form-box">
        <form action="" method="post">
                <h2>Login</h2>
                <p id="result"></p>                
                <div class="input-box">
                    <i class='bx bxs-envelope-open'></i>
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="input-box">
                    <i class='bx bxs-lock-open'></i>
                    <input type="password" name="password" placeholder="Password" register>
                </div>
                 <div class="button">
                 <input type="submit" name="submit" class="btn" value="login now">
                </div>
                <div class="btnR">
                <p>don't have an account? <a href="register.php">register now</a></p>
                </div>
            </form>
        </div>
   </div>

</div>

</body>
</html>