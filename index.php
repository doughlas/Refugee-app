<?php
include 'config.php';

session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:login.php');
};


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home.us</title>

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


<header>

<?php
      $select_user = mysqli_query($conn, "SELECT * FROM `user_form` WHERE Personal_Id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select_user) > 0){
         $fetch_user = mysqli_fetch_assoc($select_user);
        
      }; 
     
   ?>


   <?php
      $UserDetails = mysqli_query($conn, "SELECT * FROM `personal_info` WHERE Personal_Id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($UserDetails) > 0){
         $fetch_Details = mysqli_fetch_assoc($UserDetails);
        
      }; 
     
   ?>



   <?php
      $UserHealth_Records = mysqli_query($conn, "SELECT * FROM `health_records` WHERE Personal_Id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($UserHealth_Records) > 0){
         $fetch_HealthRecords= mysqli_fetch_assoc($UserHealth_Records);
        
      }; 
     
   ?>

   <?php
      $UserAddInfo = mysqli_query($conn, "SELECT * FROM `other_info` WHERE Personal_Id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($UserAddInfo) > 0){
         $fetch_AdditionalInfo = mysqli_fetch_assoc($UserAddInfo);
        
      }; 
     
   ?>


		<nav>
			<ul>
				<li><a href="#">Home</a></li>
				<li><a href="#">About Us</a></li>
				<li><a href="#">Services</a></li>
				<li><a href="#">Contact Us</a></li>
			</ul>
		</nav>
      <div class="right">
         <img src="t3.jpg" />
         <div class="right" style="margin-top: 12px;">
         <div class="dropdown">
            <span><?php echo $fetch_user['name']; ?></span>
            <div class="dropdown-content">
            <p> <p id="showDialog"> Profile</p></p>
            <br/>
            <p><a href="index.php?logout=<?php echo $user_id; ?>" onclick="return confirm('are your sure you want to logout?');">logout</a></p>
          </div>
</div>
      </div>
   </div>
	</header>

	<main>
		<section class="hero">
			<h1>Online Refugees Registration System</h1>
			<p>Here's some text about my website or business.</p>
			<div class="image-grid">
				<div class="image-item">
					<img src="image5.jpg" alt="Placeholder Image">
					<p>


               <h3>What is the Global Appeal?</h3>
               The Global Appeal provides information about UNHCR’s plans for the coming year and the funding it needs to protect, assist and empower a record number of forcibly displaced and stateless people, and to help them find solutions to their situations.


               </p>
				</div>

              <!-- A modal dialog containing a form -->
            <dialog id="favDialog">
            <form action="update.php" method="post">
            
               <h2> Refugee Details</h2>

            <div >
                  <fieldset>
                        <legend  align="left">Personal Info:-</legend>
                        <br/>
                     <label style="margin-left:15px; float:left; text-align: start;  width:40%;">Identity NO.</label>
                     <label  style="float:left;text-align: start; margin-left:15px;width:55%;">Full Name</label>
                     <br/>
                     <input type="text" name="Uid_txt" required class="box" style="float:left; margin-left:15px; width:35%;" value="<?php echo $fetch_Details['Personal_Id']; ?>"/>
                     <input type="text" name="Name_txt" required class="box"  style=" margin-left:15px; width:55%;" value="<?php echo $fetch_Details['Name']; ?>" />
                     <br/><br/>
                     <label style="margin-left:15px; float:left; text-align: start;  width:40%;">Gender</label>
                     <label  style="float:left;text-align: start;width:55%;">Date of Birth</label>
                     <br/>


                     <div class="id_100">
                     <select name="Gender_txt" id="Gender_txt" style="margin-left:15px; float:left; text-align: start;  width:25%;" >
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>

                      </select>
                        
                     </div>

                     <input type="text" name="Birthday_txt" placeholder="D.O.B" style="margin-left:15px; float:left; text-align: start;  width:65%;"  value="<?php echo $fetch_Details['Date_Of_Birth']; ?>" 
                        onfocus="(this.type='date')" onfocusout="(this.type='text')"/>

                        <br/><br/><br/>
                     <label style="margin-left:25px; float:left; text-align: start;width:45%;">Marital Status</label>
                     <label  style="float:left;text-align: start; margin-left:15px;width:40%;">Age</label>
                     <br/>
                     <input type="text" name="maritualStatus_txt" required class="box" value="<?php echo $fetch_Details['Maritual_Status']; ?>" />
                     <input type="text" name="Age_txt" required class="box" value="<?php echo $fetch_Details['Age']; ?>" />
                     <br/><br/>

                     </fieldset>
                     <br/><br/>

                     <fieldset>
                        <legend  align="left">Contacts Info:-</legend>
                        <br/>
                     <label style="margin-left:25px; float:left; text-align: start;width:45%;">E-mail</label>
                     <label  style="float:left;text-align: start; margin-left:15px;width:40%;">Phone Number</label>
                     <br/>
                     <input type="text" name="Email_txt" required class="box" value="<?php echo $fetch_user['email']; ?>" />
                     <input type="text" name="phone_txt" required class="box" value="<?php echo $fetch_Details['Phone_Number']; ?>"/>
                     
                                       
                     <br/><br/>
                   </fieldset>

                   <br/><br/>

               <fieldset style="padding-bottom:10px;">
                  <legend  align="left">Health Info:-</legend>
                  <br/>
               <label style="margin-left:25px; float:left; text-align: start;width:25%;">Weight</label>
               <label  style="float:left;text-align: start; margin-left:15px;width:25%;">Height</label>
               <label  style="float:left;text-align: start; margin-left:15px;width:25%;">Blood Group</label>
               <br/>
               <input type="text" name="Weight_txt"  value="<?php echo $fetch_HealthRecords['Weight']; ?>"  required class="box" style="float:left;text-align: start; margin-left:15px;width:25%;" />
               <input type="text" name="Height_txt" value="<?php echo $fetch_HealthRecords['Height']; ?>" required class="box"  style="float:left;text-align: start; margin-left:15px;width:25%;" />
               <select name="bloodgroup_txt" id="bloodgroup_txt" style="float:left;text-align: start; margin-left:15px;width:25%;">
               <option value="">Select Blood Group</option>
               <option value="A+">A+</option>
               <option value="A-">A-</option>
               <option value="B+">B+</option>
               <option value="B-">B-</option>
               <option value="AB+">AB+</option>
               <option value="AB-">AB-</option>
               <option value="O+">O+</option>
               <option value="O-">O-</option>
               </select>

               <br/><br/>
               <br/>
               <label for="disability" style="margin-left:25px; float:left; text-align: start;width:25%;"> disability?</label>
               <br/>
               <select id="disability" name="disability_txt" style="float:left;text-align: start; margin-left:15px;width:25%;" >
               <option value="yes">Yes</option>
               <option value="no">No</option>

               <textarea id="story" name="Medcomplication_txt"rows="4" cols="33" placeholder="If disabled Or any other Health complication....." style="float:left;text-align: start; margin-left:15px;width:60%;"><?php echo $fetch_HealthRecords['Health_Condition']; ?></textarea>

               </select>
               </fieldset>



               <fieldset style="padding-bottom:10px;">
                  <legend  align="left">Additional Info:-</legend>
                  <br/>
                  <label for="education-level" style="float:left;text-align: center; margin-left:15px;width:30%;">Education Level:</label>
                  <label  style="float:left;text-align: center; margin-left:15px;width:30%;">Country</label>
                  <label  style="float:left;text-align: center; margin-left:15px;width:30%;">Reson(Migration)</label>
                  
                  <br/>
                  <select id="education_level" name="educationlevel_txt"  style="float:left;text-align: start; margin-left:15px;width: 27%;" > 
                     <option value="">--Education Level--</option>
                     <option value="high-school">High School</option>
                     <option value="bachelor">Bachelor's Degree</option>
                     <option value="master">Master's Degree</option>
                     <option value="phd">PhD</option>
                     </select>

         
                     <select id="country" name="country_txt" style="float:left;text-align: start; margin-left:15px;width:30%;" >
                     <option value="">--Country--</option>

              <option value="none">Select a country</option>
               <option value="Algeria">Algeria</option>
               <option value="Angola">Angola</option>
               <option value="Benin">Benin</option>
               <option value="Botswana">Botswana</option>
               <option value="Burkina Faso">Burkina Faso</option>
               <option value="Burundi">Burundi</option>
               <option value="Cameroon">Cameroon</option>
               <option value="Cape Verde">Cape Verde</option>
               <option value="Central African Republic">Central African Republic</option>
               <option value="Chad">Chad</option>
               <option value="Comoros">Comoros</option>
               <option value="Democratic Republic of the Congo">Democratic Republic of the Congo</option>
               <option value="Djibouti">Djibouti</option>
               <option value="Egypt">Egypt</option>
               <option value="Equatorial Guinea">Equatorial Guinea</option>
               <option value="Eritrea">Eritrea</option>
               <option value="Eswatini">Eswatini</option>
               <option value="Ethiopia">Ethiopia</option>
               <option value="Gabon">Gabon</option>
               <option value="Gambia">Gambia</option>
               <option value="Ghana">Ghana</option>
               <option value="Guinea">Guinea</option>
               <option value="Guinea-Bissau">Guinea-Bissau</option>
               <option value="Ivory Coast">Ivory Coast</option>
               <option value="Kenya">Kenya</option>
               <option value="Lesotho">Lesotho</option>
               <option value="Liberia">Liberia</option>
               <option value="Libya">Libya</option>
               <option value="Madagascar">Madagascar</option>
               <option value="Malawi">Malawi</option>
               <option value="Mali">Mali</option>
               <option value="Mauritania">Mauritania</option>
               <option value="Mauritius">Mauritius</option>
               <option value="Morocco">Morocco</option>
               <option value="Mozambique">Mozambique</option>
               <option value="Namibia">Namibia</option>
               <option value="Niger">Niger</option>
               <option value="Nigeria">Nigeria</option>
               <option value="Republic of the Congo">Republic of the Congo</option>
               <option value="Rwanda">Rwanda</option>
               <option value="Sao Tome and Principe">Sao Tome and Principe</option>
               <option value="Senegal">Senegal</option>
               <option value="Seychelles">Seychelles</option>
               <option value="Sierra Leone">Sierra Leone</option>
               <option value="Somalia">Somalia</option>
               <option value="South Africa">South Africa</option>
               <option value="South Sudan">South Sudan</option>
               <option value="Sudan">Sudan</option>
               <option value="Tanzania">Tanzania</option>

                     </select>
                 
                  <select name="reason_txt" id="reasontxt" style="float:left;text-align: start; margin-left:15px;width:27%;" >
                  <option value="">--Reason--</option>
                  <option value="persecution">Persecution</option>
                  <option value="war">War or armed conflict</option>
                  <option value="violence">Violence or threat of violence</option>
                  <option value="discrimination">Discrimination based on race, religion, nationality, or political beliefs</option>
                  <option value="economic">Economic hardship or poverty</option>
                  </select>
                  <br/><br/>
                  <label  style="float:left;text-align: center; margin-left:15px;width:30%;">Relatives/Family</label>
                  <br/>

                  <textarea id="story" name="Relative_txt"rows="7" cols="33" style="float:left;text-align: center; margin-left:15px;width:90%;"><?php echo $fetch_AdditionalInfo['Relatives']; ?></textarea>


                  <br/><br/><br/><br/>
               </fieldset>


            </div>
               <input type="submit"  name="submit" value="Update Details" style="margin-top:8px; background: green; " />
            </form>
            </dialog>
				<div class="image-item">
               <p>
               <h3>Earthquake survivors in Türkiye count the devastating toll</h3>
                  Ahmet Erkan and his family escaped last month’s disaster with their lives, but like many they lost loved ones and their home and now face a long and uncertain road to recovery.

               </p>

					<img src="home4.PNG" alt="Placeholder Image">
					<p style="font-size: 8px;">

               UN High Commissioner for Refugees Filippo Grandi (second from left) meets earthquake survivor Ahmet Erkan and his family at Boynuyoğun Temporary Accommodation Centre (TAC) in Hatay, Türkiye.   © UNHCR/Emrah Gürel
               </p>

				</div>
				<div class="image-item">
            <h3>Subscribe to the UNHCR Newsletter</h3>
					<img src="home3.PNG" alt="Placeholder Image">
					<p>
                  
                  <p style="font-size: 10px;"> Subscribe to the UNHCR newsletter and join a global community that cares for the protection and well-being of refugees, internally displaced and stateless people.

               We’ll keep you up to date on emergencies and campaigns and you’ll be among the first to hear when we need support from our community. We’ll also share impact pieces and stories from the field with you, so you can follow UNHCR activities and explore the work we do around the globe.  

               Enter your details below and click “submit”. We’re looking forward to connecting with you!</p>
            </p>
				</div>
			</div>
		</section>
	</main>

	<footer>
		<p>&copy; 2023 My Website. All Rights Reserved.</p>
	</footer>




</body>
<script >
         const showButton = document.getElementById('showDialog');
         const favDialog = document.getElementById('favDialog');
         const outputBox = document.querySelector('output');
         const selectEl = favDialog.querySelector('select');
         const confirmBtn = favDialog.querySelector('#confirmBtn');
        

         // "Show the dialog" button opens the <dialog> modally
         showButton.addEventListener('click', () => {
            favDialog.showModal();
         });
         // "Favorite animal" input sets the value of the submit button
         selectEl.addEventListener('change', (e) => {
         confirmBtn.value = selectEl.value;
         });
         // "Confirm" button of form triggers "close" on dialog because of [method="dialog"]
         favDialog.addEventListener('close', () => {
         outputBox.value = `ReturnValue: ${favDialog.returnValue}.`;
         });
         document.getElementById('Gender_txt').value = '<?php echo $fetch_Details['Gender']; ?>';
         document.getElementById('bloodgroup_txt').value = '<?php echo $fetch_HealthRecords['Blood_Group']; ?>';
         document.getElementById('disability').value = '<?php echo $fetch_HealthRecords['Disability_status']; ?>';
         document.getElementById('education_level').value = '<?php echo $fetch_AdditionalInfo['Education_level']; ?>';
         document.getElementById('country').value = '<?php echo $fetch_AdditionalInfo['Country']; ?>';
         document.getElementById('reasontxt').value = '<?php echo $fetch_AdditionalInfo['Reason']; ?>';
         
        
      </script>


</html>