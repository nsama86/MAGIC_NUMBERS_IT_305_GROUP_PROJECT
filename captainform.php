<!-- Add header to page -->
<?php require_once("./inc/header.php"); ?>
<section id="content">

	<!-- Page Heading -->
	<section class="section page-heading animate-onscroll">
		<h1>Kent Food Bank Table Contact Form</h1>
	</section>
	<!-- Page Heading -->

	<!-- Section -->
	<section class="section full-width-bg gray-bg animate-onscroll">
        <div class="row">
            <div class="col-md-9 col-sm-8">

<?php

if(isset($_POST['submit']))
{
    $GuestOneemail = $_POST['email'];
    $GuestOnename = $_POST['name'];
    $GuestOnephone = $_POST['phone'];
    $isValid = true;

    // Validate e-mail
    if(!filter_var($GuestOneemail, FILTER_VALIDATE_EMAIL))
    {
        // invalid emailaddress
        echo '<p class="error">Invalid e-mail address entered - please enter a valid e-mail address.</p>';
        $isValid = false;
    }

    // Validate name
    if(empty($GuestOnename) || !ctype_alpha(str_replace(' ', '', $GuestOnename)))
    {
        echo '<p class="error">Please enter an all alphabetical name.</p>';
        $isValid = false;
    }

	//First let's process our phone number
	//eliminate every char except 0-9
	$justNumsGuestOne = preg_replace("/[^0-9]/", '', $GuestOnephone);
	//eliminate leading 1 if its there
	if (strlen($justNumsGuestOne) == 11) $justNumsGuestOne = preg_replace("/^1/", '',$justNumsGuestOne);

	// Validate phone $justNums
	if (!(strlen($justNumsGuestOne) == 10))
	{
		echo '<p class="error">Please enter a valid 10 digit phone number.</p>';
		$isValid = false;
	}

}

// IF everything is good in the form, let's process and email
if($isValid)
{
	// Enter the applicant into the database
	$sql = "INSERT INTO captainform(app_date, name, email, phone, availability, why, app_type, work_type, crime, lift) VALUES(".
		"now()," . //Inserts current date
		"'" . mysqli_real_escape_string($connection, $name) . "'," .
		"'" . mysqli_real_escape_string($connection, $email) . "'," .
		mysqli_real_escape_string($connection, $justNums) . "," .
		"'" . mysqli_real_escape_string($connection, $_POST['availablity']) . "'," .
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
    $emailmessage .= "Phone: " . $_POST['phone'] . "\n\n";


	 //Set headers and send email
    $headers = "From: " . $_POST['email'] . "\r\n" . "Reply-To: " . $_POST['email'] . "\r\n" . "X-Mailer: PHP/" . phpversion();
    @mail("kpraxel@mail.greenriver.edu", "Message from KFB Site", $emailmessage, $headers);

	 // Display a thank you message if the form was submitted successfully
    echo "<p>Thank you for your message, <strong>" . $name . "</strong>.
	 		We will get back to you as soon as possible at <strong>" . $email . "</strong>.  Have a great day!</p>";

// If we didn't have a valid form submission, then display the form
} else { ?>

	          <p>Please enter the form completely<br>You can also reach us by phone at: <strong>(253) 520-3550</strong></p>
				 <p>Fields marked <span class="error">*</span> are mandatory.</p>
				 <hr>
				 <h3>Table Captain</h3>

				 <!-- Start form -->
	          <form role="form" method="post">
	              <div class="inline-inputs">
						  <!-- TABLE CAPTAIN -->
	                  <div class="col-md-4 col-sm-12">
	                      <label>Name<span class="error">*</span></label>
	                      <input type="text" class="form-control" name="name" placeholder="Full Name" value="<?php if(isset($_POST['name'])) {echo $_POST['name'];} ?>" required>
	                  </div>
	                 <div class="col-md-4 col-sm-12">
	                      <label>Email Address<span class="error">*</span></label>
	                      <input type="email" class="form-control" name="email" placeholder="xxxxx@xxxxx.com"  value="<?php if(isset($_POST['email'])) {echo $_POST['email'];} ?>" required>
	                  </div>
	                  <div class="col-md-4 col-sm-12">
	                      <label>Phone Number</label>
	                      <input type="text" class="form-control" name="phone" placeholder="xxx-xxx-xxxx" value="<?php if(isset($_POST['phone'])) {echo $_POST['phone'];} ?>" >
					  </div>

					  <!-- START OF GUESTS -->
					  <div class="col-lg-12">

						<h3>Guests</h3>
					  </div>
					  		<div class="guest">
								<div class="col-sm-1"><p class="guest-number">1</p></div>
								<div class="col-md-4 col-sm-12">
		                      <label>Name<span class="error">*</span></label>
		                      <input type="text" class="form-control" name="GuestOnename" placeholder="Full Name" required>
		                  </div>
		                 <div class="col-md-4 col-sm-12">
		                      <label>Email Address<span class="error">*</span></label>
		                      <input type="email" class="form-control" name="GuestOneemail" placeholder="xxxxx@xxxxx.com" required>
		                  </div>
		                  <div class="col-md-3 col-sm-12">
		                      <label>Phone Number</label>
		                      <input type="text" class="form-control" name="GuestOnephone" placeholder="xxx-xxx-xxxx">
								 </div>

								 <div class="col-sm-1"></div>
								 <div class="col-md-4 col-sm-12">
									 <label>Address</label>
									 <input type="text" class="form-control" name="guestaddress" placeholder="xxx-xxx-xxxx">
								 </div>

								 <div class="col-md-4 col-sm-12">
									 <label>City</label>
									 <input type="text" class="form-control" name="guestcity" placeholder="xxx-xxx-xxxx">
								 </div>

								 <div class="col-md-3 col-sm-12">
									 <label>Zip</label>
									 <input type="text" class="form-control" name="guestzip" placeholder="xxx-xxx-xxxx">
								 </div>

							</div>

							 <!-- ADD ANOTHER GUEST BUTTON -->
							 <button id="add-guest">Add Another Guest</button>

							 <!-- SUBMIT BUTTON -->
	                  <div class="form-group col-lg-12 text-center">
	                      <input type="hidden" name="save" value="contact">
	                      <button type="submit" class="btn btn-default" name="submit">Submit</button>
	                  </div>
	              </div>
	          </form>
<!-- End else to display form -->
<?php } ?>
			</div>

<!-- Add sidebar to page -->
<?php require_once('./inc/sidebar.php'); ?>

		</div>
	​</section>
	<!-- /Section -->
</section>

<!-- JQUERY TO ADD MORE GUESTS -->
<script type="text/javascript">
$(document).ready(function() {
	 $("#add-guest").click(function() {

		 var rownum = parseInt($('p.guest-number:last').text());

		 if(rownum == 7)
		 {
			 // Max guests reached
			 alert("The max number of guests is 7.");
		 }
		 else {
		 	$('.guest:last').clone(true).insertAfter('.guest:last');
			var newrow = rownum + 1;
			$('p.guest-number:last').text(newrow);
		 }


		return false;
	 });
});
</script>

<!-- Add footer to page -->
<?php require_once("./inc/footer.php"); ?>
