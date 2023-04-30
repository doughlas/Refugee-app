<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];


if(isset($_POST['submit'])){

   $Name = mysqli_real_escape_string($conn, $_POST['Name_txt']);
   $Gender = mysqli_real_escape_string($conn, $_POST['Gender_txt']);
   $Birthday = mysqli_real_escape_string($conn, $_POST['Birthday_txt']);
   $maritualStatus = mysqli_real_escape_string($conn, $_POST['maritualStatus_txt']);
   $Age = mysqli_real_escape_string($conn, $_POST['Age_txt']);
   $Email_txt = mysqli_real_escape_string($conn, $_POST['Email_txt']);
   $phone = mysqli_real_escape_string($conn, $_POST['phone_txt']);
   //
   $Weight = mysqli_real_escape_string($conn, $_POST['Weight_txt']);
   $Height = mysqli_real_escape_string($conn, $_POST['Height_txt']);
   $bloodgroup = mysqli_real_escape_string($conn, $_POST['bloodgroup_txt']);
   $disability = mysqli_real_escape_string($conn, $_POST['disability_txt']);
   $Medcomplication = mysqli_real_escape_string($conn, $_POST['Medcomplication_txt']);
   //
   $educationlevel = mysqli_real_escape_string($conn, $_POST['educationlevel_txt']);
   $country = mysqli_real_escape_string($conn, $_POST['country_txt']);
   $reason = mysqli_real_escape_string($conn, $_POST['reason_txt']);
   $Relative = mysqli_real_escape_string($conn, $_POST['Relative_txt']);
   //

   mysqli_query($conn, "UPDATE `personal_info` SET `Name`='$Name',`Maritual_Status`='$maritualStatus',`Gender`='$Gender',`Date_Of_Birth`='$Birthday',`Phone_Number`='$phone',`Age`='$Age' WHERE `Personal_Id`='$user_id'") or die('query failed');
   
   mysqli_query($conn, "UPDATE `health_records` SET `Disability_status`='$disability',`Health_Condition`='$Medcomplication',`Weight`='$Weight',`Height`='$Height',`Blood_Group`='$bloodgroup' WHERE `Personal_Id`='$user_id'") or die('query failed');
   
   mysqli_query($conn, "UPDATE `other_info` SET `Education_level`='$educationlevel',`Relatives`='$Relative',`Reason`='$reason',`Country`='$country' WHERE `Personal_Id`='$user_id'") or die('query failed');

   $message[] = 'registered successfully!';
   header('location:index.php');

}

?>
