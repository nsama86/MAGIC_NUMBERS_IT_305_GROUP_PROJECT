<!-- Add header to page -->
<?php require_once("./inc/header.php"); ?>
<section id="content">

	<!-- Page Heading -->
	<section class="section page-heading animate-onscroll">
		<h1>Contact Us</h1>
	</section>
	<!-- Page Heading -->

	<!-- Section -->
	<section class="section full-width-bg gray-bg animate-onscroll">
        <div class="row">
            <div class="col-md-9 col-sm-8">

<?php
if(isset($_POST['submit']))
{
    $email = $_POST['email'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];
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

    // Check if message is blank
    if(!strlen(trim($message)))
    {
        echo '<p class="error">Please enter a message.</p>';
        $isValid = false;
    }
}

if($isValid)
{
    // Build e-mail content
    $emailmessage = "A new message has been sent from the Kent Food Bank website with the information below.\n\n";
    $emailmessage .= "Name: " . $_POST['name'] . "\n";
    $emailmessage .= "Email: " . $_POST['email'] . "\n";
    $emailmessage .= "Phone: " . $_POST['phone'] . "\n\n";
    $emailmessage .= "Message: " . $_POST['message'] . "\n";

	 //Set headers and send email
    $headers = "From: " . $_POST['email'] . "\r\n" . "Reply-To: " . $_POST['email'] . "\r\n" . "X-Mailer: PHP/" . phpversion();
    @mail("TOstrander@greenriver.edu", "Message from KFB Site", $emailmessage, $headers);

	 // Display a thank you message if the form was submitted successfully
    echo "<p>Thank you for your message, <strong>" . $name . "</strong>.
	 		We will get back to you as soon as possible at <strong>" . $email . "</strong>.  Have a great day!</p>";

// If we didn't have a valid form submission, then display the form
} else { ?>

	         <h3>We want to hear from you</h3>

	          <hr>
	          <p>Do you have a question? We here at the Kent Food Bank are very interested in hearing from you.<br>You can also reach us by phone at: <strong>(253) 520-3550</strong></p>
				 <p>Fields marked <span class="error">*</span> are mandatory.</p>
				 <hr>

				 <!-- Start form -->
	          <form role="form" method="post">
	              <div class="inline-inputs">
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

	                  <div class="col-sm-12">
	                      <label>Your questions/comments<span class="error">*</span></label>
	                      <textarea class="form-control" rows="10" name="message" placeholder="Enter your questions or comments here." required><?php if(isset($_POST['message'])) {echo $_POST['message'];} ?></textarea>
	                  </div>
	                  <div class="form-group col-lg-12 text-center">
	                      <input type="hidden" name="save" value="contact">
	                      <button type="submit" class="btn btn-default" name="submit">Send message</button>
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

	<!-- Add footer to page -->
	<?php require_once("./inc/footer.php"); ?>
