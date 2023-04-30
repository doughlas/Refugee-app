<?php

include 'config.php';

if(isset($_POST['submit'])){

   $id=rand();
    

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));

   $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $message[] = 'user already exist!';
   }else{
      mysqli_query($conn, "INSERT INTO `user_form`(Personal_Id,name, email, password) VALUES('$id','$name', '$email', '$pass')") or die('query failed');
      
      mysqli_query($conn, "INSERT INTO `personal_info`(`Personal_Id`, `Name`, `Maritual_Status`, `Gender`, `Date_Of_Birth`, `Phone_Number`, `Age`) VALUES ('$id','','','','','','')") or die('query failed');
      
      mysqli_query($conn, "INSERT INTO `other_info`(`Personal_Id`, `Education_level`, `Relatives`, `Reason`, `Country`) VALUES ('$id','','','','')") or die('query failed');
      
      mysqli_query($conn, "INSERT INTO `health_records`(`Personal_Id`, `Disability_status`, `Health_Condition`, `Weight`, `Height`, `Blood_Group`) VALUES ('$id','','','','','')") or die('query failed');
      
      
      $message[] = 'registered successfully!';
      header('location:login.php');
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

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
      <h3>register now</h3>


      <div class="input-box">
         <i class='bx bxs-envelope-open'></i>
        <input type="text" name="name" required placeholder="enter username" class="box"/>
      </div>

      <div class="input-box">
         <i class='bx bxs-envelope-open'></i>
         <input type="email" name="email" required placeholder="enter email" class="box"/>
      </div>
      
      <div class="input-box">
         <i class='bx bxs-envelope-open'></i>
         <input type="password" name="password" required placeholder="enter password" class="box"/>
      </div>

      <div class="input-box">
         <i class='bx bxs-envelope-open'></i>
         <input type="password" name="cpassword" required placeholder="confirm password" class="box">
      </div>
      
      <div class="button">
         <i class='bx bxs-envelope-open'></i>
         <input type="submit" name="submit" class="btn" value="register now">
      </div>
      <br/><br/>
      <p>already have an account? <a href="login.php">login now</a></p>
   </form>

   </div>
   </div>

   
</div>

</body>
</html>