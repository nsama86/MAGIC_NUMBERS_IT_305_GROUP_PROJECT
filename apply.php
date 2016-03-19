<!-- Add header to the page -->
<?php require_once('./inc/header.php'); ?>

<section id="content">

	<!-- Page Heading -->
	<section class="section page-heading animate-onscroll">
		<h1>Apply</h1>
	</section>
	<!-- Page Heading -->

	<!-- GRAY Section -->
	<section class="section full-width-bg gray-bg">
		<div class="row">

			<div class="col-md-9 col-sm-8">

<?php
if(isset($_POST['submit']))
{
	$email = $_POST['email'];
	$name = $_POST['name'];
	$phone = $_POST['phone'];
	$apptype = $_POST['apptype'];
	$worktype = $_POST['worktype'];
	$availablity = $_POST['availablity'];
	$message = $_POST['message'];
	$crime = $_POST['crime'];
	$lift = $_POST['lift'];

	$isValid = true;

	// Validate e-mail
	if(!filter_var($email, FILTER_VALIDATE_EMAIL))
	{
	  // invalid emailaddress
	  echo '<p class="error">Invalid e-mail address entered - please enter a valid e-mail address.</p>';
	  $isValid = false;
	}

	// Validate name
	if(empty($name) || !ctype_alpha(str_replace(' ', '', $name)))
	{
	  echo '<p class="error">Please enter an all alphabetical name.</p>';
	  $isValid = false;
	}

	//First let's process our phone number
	//eliminate every char except 0-9
	$justNums = preg_replace("/[^0-9]/", '', $phone);
	//eliminate leading 1 if its there
	if (strlen($justNums) == 11) $justNums = preg_replace("/^1/", '',$justNums);

	// Validate phone $justNums
	if (!(strlen($justNums) == 10))
	{
		echo '<p class="error">Please enter a valid 10 digit phone number.</p>';
		$isValid = false;
	}

	// Array for our application types
	$apptypes = array("individual", "group", "organization", "school", "court-ordered");

	//radio button checked
	if(!in_array($_POST['apptype'], $apptypes))
	{
		echo '<p class="error">Application Type is required.</p>';
		$isValid = false;
	}

	if($_POST['apptype'] == "court-ordered")
	{
		// Array for crime question type
		$crimes = array("yes", "no");

		//radio button checked
		if(!in_array($_POST['crime'], $crimes))
		{
		 echo '<p class="error">Committed a Crime Question is required.</p>';
		 $isValid = false;
		}
		if($_POST['crime'] == 'yes'){
			echo '<p class="error">We are sorry. You do not qualify to complete your community service at the Kent Food Bank. Please call 211 to find other community service agencies.';
			$isValid = false;
		}

		// Array for lift question type
		$lifts = array("yes", "no");

		//radio button checked
		if(!in_array($_POST['lift'], $lifts))
		{
		 echo '<p class="error">Lift Capacity Question is required.</p>';
		 $isValid = false;
		}
	}

	// Array for our work types
	$worktypes = array("clothing", "office", "food", "driver");

	//Validate each work type
	if(isset($_POST['worktype']))
	{
	foreach($_POST['worktype'] as $worktype)
	{
		if(!in_array($worktype, $worktypes))
		{
			echo '<p class="error">Invalid work type entered.</p>';
			$isValid = false;
		}
	}
	}
	else
	{
	echo '<p class="error">Please select at least one work preference.</p>';
	$isValid = false;
	}

	// Array for our availability types
	$availabilities = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Weekends");

	//Validate each availability type
	if(isset($_POST['availability']))
	{
	foreach($_POST['availability'] as $availability)
	{
		if(!in_array($availability, $availabilities))
		{
			echo '<p class="error">Invalid availability type entered.</p>';
			$isValid = false;
		}
	}
	}
	else
	{
	echo '<p class="error">Please select at least one day for availability.</p>';
	$isValid = false;
	}

		// Check if message is blank
	if(!strlen(trim($message)))
	{
	echo '<p class="error">Please enter why you are interested in volunteering.</p>';
	$isValid = false;
	}

}

// IF everything is good in the form, let's process and email
if($isValid)
{
	// Enter the applicant into the database
	$sql = "INSERT INTO volunteer(app_date, name, email, phone, availability, why, app_type, work_type, crime, lift) VALUES(".
		"now()," . //Inserts current date
		"'" . mysqli_real_escape_string($connection, $name) . "'," .
		"'" . mysqli_real_escape_string($connection, $email) . "'," .
		mysqli_real_escape_string($connection, $justNums) . "," .
		"'" . mysqli_real_escape_string($connection, implode(", ", $_POST['availability'])) . "'," .
		"'" . mysqli_real_escape_string($connection, $_POST['message']) . "'," .
		"'" . mysqli_real_escape_string($connection, $apptype) . "'," .
		"'" . mysqli_real_escape_string($connection, implode(", ", $_POST['worktype'])) . "'," .
		"'" . mysqli_real_escape_string($connection, $crime) . "'," .
		"'" . mysqli_real_escape_string($connection, $lift) . "')";

	//Send the query to the database
	$result = @mysqli_query($connection, $sql);
	if(!$result)
	{
		echo "<p class='error'>There was a problem with the database!</p>";
	}

	// Build e-mail content
	$emailmessage = "A new message has been sent from the Kent Food Bank website with the information below.\n\n";
	$emailmessage .= "Name: " . $_POST['name'] . "\n";
	$emailmessage .= "Email: " . $_POST['email'] . "\n";
	$emailmessage .= "Phone: " . $_POST['phone'] . "\n";
	$emailmessage .= "Application Type: " . $_POST['apptype'] . "\n";
	$emailmessage .= "Criminal History " . $_POST['crime'] . "\n";
	$emailmessage .= "Lift Requirement met " . $_POST['lift'] . "\n";
	$emailmessage .= "Work Preference: " . implode(", ", $_POST['worktype']) . "\n";
	$emailmessage .= "Availablity: " . implode(", ", $_POST['availability']) . "\n";
	$emailmessage .= "Message: " . $_POST['message'] . "\n";

	$user = "$email";
	$usersubject = "Thank You!";
	$userheaders = "From: kentfoodbank@gmail.com\n";
	$usermessage = "

	Thank you for your interest in volunteering with the Kent Food Bank, our agency has volunteer positions
	to accommodate many different schedules, physical abilities and interests.\n\n

	Volunteers are a vital part of our ability toprovide the basic needs of our community. Thanks to people
	like you, we are able to spend 99 cents of every dollar donated on direct client services. Last year,
	volunteers donated more than 20,000 hours to support Kent Food Bank. Without our caring and dedicated
	volunteers we cannot achieve our mission to end hunger.\n\n

	Once again, thank you for your interest.  A staff member will be in contact with you to set up orientation.\n\n

	Jeniece Choate, Executive Director\n\n

	Kent Food Bank and Emergency Services";
	mail($user,$usersubject,$usermessage,$userheaders);

	//Set headers and send email
	$headers = "From: " . $_POST['email'] . "\r\n" . "Reply-To: " . $_POST['email'] . "\r\n" . "X-Mailer: PHP/" . phpversion();
	@mail("TOstrander@greenriver.edu", "Message from KFB Site", $emailmessage, $headers);

	//Display thank you message
	echo "<p>Thank you for your message, <strong>" . $name . "</strong>.
			We will get back to you as soon as possible at
			<strong>" .  $email . "</strong>.  Have a great day!</p>";

//If we didn't have a valid form submission, ELSE will display form
} else {
?>


				<div class="animate-onscroll">
					<h3 class="no-margin-top">Become a volunteer</h3>
					<p>Here at the Kent Food Bank, we are always in need of people that want to donate their time and volunteer.
						If you are interested in helping please fill out the application below!  Thank you!</p>
					<p>Fields marked <span class="error">*</span> are mandatory.</p>
				</div>

				<form role="form" method="post">

					<div class="row animate-onscroll">

						<div class="col-md-7 col-sm-12">

							<h5>Contact Details</h5>

							<div class="col-sm-12">
								<label>Name<span class="error">*</span></label>
								<input type="text" name="name" placeholder="Full Name" value="<?php if(isset($_POST['name'])) {echo $_POST['name'];} ?>" required>
							</div>

							<div class="col-sm-12">
								<label>Email address<span class="error">*</span></label>
								<input type="email" name="email" placeholder="xxxxx@xxxxx.xxx" value="<?php if(isset($_POST['email'])) {echo $_POST['email'];} ?>" required>
							</div>

							<div class="col-sm-12">
								<label>Phone number<span class="error">*</span></label>
								<input type="text" name="phone" placeholder="xxx-xxx-xxxx" value="<?php if(isset($_POST['phone'])) {echo $_POST['phone'];} ?>" required>
							</div>

							<div class="col-sm-12">
							<label>Your Availability<span class="error">*</span></label><br>

							<input type="checkbox" id="mon-chbx" name="availability[]" value="Monday"
								   <?php if (isset($_POST['availability']) && in_array("Monday", $_POST['availability'])) echo ' checked="checked"';?>>
							<label for="mon-chbx">M</label>
							<input type="checkbox" id="tues-chbx" name="availability[]" value="Tuesday"
									<?php if (isset($_POST['availability']) && in_array("Tuesday", $_POST['availability'])) echo ' checked="checked"';?> >
							<label for="tues-chbx">T</label>
							<input type="checkbox" id="wed-chbx" name="availability[]" value="Wednesday"
									<?php if (isset($_POST['availability']) && in_array("Wednesday", $_POST['availability'])) echo ' checked="checked"';?> >
							<label for="wed-chbx">W</label>
							<input type="checkbox" id="thurs-chbx" name="availability[]" value="Thursday"
									<?php if (isset($_POST['availability']) && in_array("Thursday", $_POST['availability'])) echo ' checked="checked"';?> >
							<label for="thurs-chbx">Th</label>
							<input type="checkbox" id="fri-chbx" name="availability[]" value="Friday"
								   <?php if (isset($_POST['availability']) && in_array("Friday", $_POST['availability'])) echo ' checked="checked"';?>>
							<label for="fri-chbx">F</label>
							<input type="checkbox" id="weekends-chbx" name="availability[]" value="Weekends"
								   <?php if (isset($_POST['availability']) && in_array("Weekends", $_POST['availability'])) echo ' checked="checked"';?>>
							<label for="weekends-chbx">Weekends</label><br><br>
						</div>

							<div class="col-sm-12">
								<label>Why are you interested in volunteering at the Kent Food Bank?<span class="error">*</span></label>
								<textarea rows="10" name="message" placeholder="Why do you want to donate your time to the Kent Food Bank?" required><?php if(isset($_POST['message'])) {echo $_POST['message'];} ?></textarea>
							</div>

						</div>

						<div class="col-md-5 col-sm-12">

							<h5>Application type<span class="error">*</span></h5>

							<input type="radio" id="individual" name="apptype" value="individual"
								   <?php if (isset($_POST['apptype']) && $_POST['apptype'] == "individual") echo ' checked="checked"';?>>
							<label for="individual">Individual</label><br>
							<input type="radio" id="group" name="apptype" value="group"
									<?php if (isset($_POST['apptype']) && $_POST['apptype'] == "group") echo ' checked="checked"';?>>
							<label for="group">Group</label><br>
							<input type="radio" id="organization" name="apptype" value="organization"
									<?php if (isset($_POST['apptype']) && $_POST['apptype'] == "organization") echo ' checked="checked"';?>>
							<label for="organization">Organization</label><br>
							<input type="radio" id="school" name="apptype" value="school"
									<?php if (isset($_POST['apptype']) && $_POST['apptype'] == "school") echo ' checked="checked"';?>>
							<label for="school">School</label><br>
							<input type="radio" id="court-ordered" name="apptype" value="court-ordered"
									<?php if (isset($_POST['apptype']) && $_POST['apptype'] == "court-ordered") echo ' checked="checked"';?>>
							<label for="court-ordered">Court Ordered Community Service</label><br>

							<!-- Additional questions if court ordered is selected -->
							<div id="extra-questions" class="hidden">
								<Strong>I have committed theft, fraud, assault, or a crime against children.<span class="error">*</span></Strong><br>
								<input type="radio" id="y" name="crime" value="yes"
									<?php if (isset($_POST['crime']) && $_POST['crime'] == "yes") echo ' checked="checked"';?> >
								<label for="y">Yes</label>
								<input type="radio" id="n" name="crime" value="no"
									<?php if (isset($_POST['crime']) && $_POST['crime'] == "no") echo ' checked="checked"';?> >
								<label for="n">No</label><br>

								<Strong>I am able to lift 40 pounds.<span class="error">*</span></Strong><br>
								<input type="radio" id="yes" name="lift" value="yes"
									<?php if (isset($_POST['lift']) && $_POST['lift'] == "yes") echo ' checked="checked"';?> >
								<label for="yes">Yes</label>
								<input type="radio" id="no" name="lift" value="no"
									<?php if (isset($_POST['lift']) && $_POST['lift'] == "no") echo ' checked="checked"';?> >
								<label for="no">No</label>
							</div>

							<h5>Volunteer Opportunities<span class="error">*</span></h5>

							<input type="checkbox" id="clothing-chbx" name="worktype[]" value="clothing"
								   <?php if (isset($_POST['worktype']) && in_array("clothing", $_POST['worktype'])) echo ' checked="checked"';?>>
							<label for="clothing-chbx">I would like to work in the Clothing Bank. Volunteers receive, sort and organize donated clothing and assisting clients in their shopping</label><br>
							<input type="checkbox" id="office-chbx" name="worktype[]" value="office"
									<?php if (isset($_POST['worktype']) && in_array("office", $_POST['worktype'])) echo ' checked="checked"';?> >
							<label for="office-chbx">I would like to work in Office. Volunteers register clients by computer check in through a one on one client interview process and verify information. Assist with resource referral and other needs.</label><br>
							<input type="checkbox" id="food-chbx" name="worktype[]" value="food"
									<?php if (isset($_POST['worktype']) && in_array("food", $_POST['worktype'])) echo ' checked="checked"';?> >
							<label for="food-chbx">I would like to work in Food Bank. Volunteers receive, unload, sort and organize donate items from the community.  Assist clients one on one with their food line selections. </label><br>
							<input type="checkbox" id="driver-chbx" name="worktype[]" value="driver"
									<?php if (isset($_POST['worktype']) && in_array("driver", $_POST['worktype'])) echo ' checked="checked"';?> >
							<label for="driver-chbx">I would like to volunteer as a Driver. If selected, you will be asked to deliver food to assisted living facilities.</label><br>
						</div>

						<!-- Submit button -->
						<div class="form-group col-lg-12 text-center">
	                  <input type="hidden" name="save" value="contact">
	                  <button type="submit" class="btn btn-default" name="submit">Submit</button>
            		</div>

					</div>

				</form>

				<!-- End the else statement that displays the form -->
				<?php } ?>
			</div>

			<!-- Add Sidebar -->
			<?php require_once('./inc/sidebar.php'); ?>

		</div>

	</section>
	<!-- /Section -->
</section>

<!-- Display extra questions if court ordered is checked -->
<script type="text/javascript">
var apptype = "<?php echo $_POST['apptype']; ?>";
if(apptype == "court-ordered")
{
	$("#extra-questions").removeClass("hidden");
}
$("input[name='apptype']").change(function() {
	if($(this).val() == 'court-ordered') {
		$("#extra-questions").removeClass("hidden");
	} else {
		$("#extra-questions").addClass("hidden");
	}
});
</script>

<!-- Add footer to page -->
<?php require_once('./inc/footer.php');
