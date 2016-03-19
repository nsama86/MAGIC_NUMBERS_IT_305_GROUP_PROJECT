<?php require_once('./inc/header.php'); ?>


		<section id="content">

			<!-- Page Heading -->
			<section class="section page-heading animate-onscroll">
				<h1>Sponsorship</h1>
			</section>
			<!-- Page Heading -->

			<!-- Section -->
			<section class="section full-width-bg gray-bg animate-onscroll">
				<div class="row">
						<div class="col-sm-12">
					<?php
                        if(isset($_POST['submit']))
                        {
                            $email = $_POST['email'];
                            $name = $_POST['name'];
                            $phone = $_POST['phone'];
                            $businessname = $_POST['businessname'];
									 $level = $_POST['level'];
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

							// Sponsor levels
							$sponsorlevels = array("gold", "silver", "bronze");

							//radio button checked - check that the level is in our sponsorlevels array
							//Must be gold / silver / bronze for form to validate
							if(!in_array($_POST['level'], $sponsorlevels))
							{
								 echo '<p class="error">Sponsorship level is required.</p>';
								 $isValid = false;
							}

                        }

						if($isValid)
                        {
									// Enter the applicant into the database
									$sql = "INSERT INTO sponsors(app_date, name, email, business, phone, sponsor_level) VALUES(".
										"now()," . //Inserts current date
										"'" . mysqli_real_escape_string($connection, $name) . "'," .
										"'" . mysqli_real_escape_string($connection, $email) . "'," .
										"'" . mysqli_real_escape_string($connection, $businessname) . "'," .
										"'" . mysqli_real_escape_string($connection, $justNums) . "'," .
										"'" . mysqli_real_escape_string($connection, $level) . "')";

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
                            $emailmessage .= "Business Name: " . $_POST['businessname'] . "\n";
									 $emailmessage .= "Sponsorship Level: " . $_POST['level'] . "\n";

                            $headers = "From: " . $_POST['email'] . "\r\n" . "Reply-To: " . $_POST['email'] . "\r\n" . "X-Mailer: PHP/" . phpversion();

                            @mail("TOstrander@greenriver.edu", "Message from KFB Site", $emailmessage, $headers);
                    ?>
                            <p>Thank you for your message, <strong><?php echo $name; ?></strong>.  We will get back to you as soon as possible at <strong><?php echo $email; ?></strong>.  Have a great day!</p>

                    <?php
                        }
                        else
                        {
					?>


						<h3>MAKE A DIFFERENCE SPONSOR US</h3>

						<p>Your generosity is greatly appreciated. We are very excited to give you several different options for sponsorship of the Kent Food Bank. Each option gives you the opportunity to help the better the lives of
						   your community members. Every dollar you donate helps keep our food bank going.</p> <br><br><h4>Once again Thank you so much!</h4><br>


						<form role="form" method="post">
						<h3 class="no-margin-top">Sponsorship Levels <br><span class="error">You must select one.*</span></h3><br>
						<table class="pricing-tables">
							<tr>
								<td>
									<div class="pricing-table">
										<div class="pricing-header">
											<h4>Bronze</h4>
										</div>
										<div class="pricing-price">
											<span class="currency">$</span>
											<span class="price">1000</span>
											<span class="period">/ yr</span>
											<br><span class="period">or</span>
											<span class="currency">$</span>
											<span class="price">85</span>
											<span class="period">/ mo</span>
										</div>
										<ul class="pricing-features">
											<li>Name recognition on printed materials</li>
											<li>Name recognition in annual report</li>
											<li>Name recognition on our Facebook page</li>
											<li>Verbal recognition day of event</li>
											<li>Table of Honor at event</li>
										</ul>
										<div class="pricing-button">
											<input type="radio" id="1" class="button big" name="level" value="bronze"
												   <?php if (isset($_POST['level']) && $_POST['level'] == "bronze") echo ' checked="checked"';?> required>
											<label for="1">Donate Today</label>
										</div>
									</div>
								</td>
								<td>
									<div class="pricing-table">
										<div class="pricing-header">
											<h4>Silver</h4>
										</div>
										<div class="pricing-price">
											<span class="currency">$</span>
											<span class="price">1500</span>
											<span class="period">/ yr</span>
											<br><span class="period">or</span>
											<span class="currency">$</span>
											<span class="price">125</span>
											<span class="period">/ mo</span>
										</div>
										<ul class="pricing-features">
											<li>Logo and name recognition on printed materials</li>
											<li>Name recognition in annual report</li>
											<li>Logo and name recognition on our Facebook page</li>
											<li>Verbal recognition day of event</li>
											<li>Each Table of Honor guest will receive 3 raffle tickets </li>
										</ul>
										<div class="pricing-button">
											<input type="radio" id="2" class="button big" name="level" value="silver"
												<?php if (isset($_POST['level']) && $_POST['level'] == "silver") echo ' checked="checked"';?> required>
											<label for="2">Donate Today</label>
										</div>
									</div>
								</td>
								<td>
									<div class="pricing-table">
										<div class="pricing-header">
											<h4>Gold</h4>
										</div>
										<div class="pricing-price">
											<span class="currency">$</span>
											<span class="price">3000</span>
											<span class="period">/ yr</span>
											<br><span class="period">or</span>
											<span class="currency">$</span>
											<span class="price">250</span>
											<span class="period">/ mo</span>
										</div>
										<ul class="pricing-features">
											<li>Logo and name recognition on printed materials</li>
											<li>Logo and name recognition in annual report</li>
											<li>Logo and name recognition on our Facebook page</li>
											<li>Verbal recognition day of event</li>
											<li>Each Table of Honor guest will receive 7 raffle tickets </li>
											<li>Certificate of Appreciation</li>
										</ul>
										<div class="pricing-button">
											<input type="radio" id="3" class="button big" name="level" value="gold"
												<?php if (isset($_POST['level']) && $_POST['level'] == "gold") echo ' checked="checked"';?> required>
											<label for="3">Donate Today</label>
										</div>
									</div>
								</td>
							</tr>
						</table>



						<br>
						<br>
						<p><br>Fields marked <span class="error">*</span> are mandatory.</p>


							<div class="inline-inputs">

								<div class="col-md-6 col-sm-12">
									<label>Name<span class="error">*</span> </label>
									<input type="text" name="name" placeholder="Full Name" value="<?php if(isset($_POST['name'])) {echo $_POST['name'];} ?>" required>
								</div>

								<div class="col-md-6 col-sm-12">
									<label>Business Name</label>
									<input type="text" name="businessname" placeholder="Business Name" value="<?php if(isset($_POST['businessname'])) {echo $_POST['businessname'];} ?>" required>
								</div>

								<div class="col-md-6 col-sm-12">
									<label>Email address<span class="error">*</span> </label>
									<input type="email" name="email" placeholder="xxxxx@xxxxx.xxx" value="<?php if(isset($_POST['email'])) {echo $_POST['email'];} ?>" required>
								</div>

								<div class="col-md-6 col-sm-12">
									<label>Phone Number<span class="error">*</span> </label>
									<input type="text" name="phone" placeholder="xxx-xxx-xxxx" value="<?php if(isset($_POST['phone'])) {echo $_POST['phone'];} ?>" required>
								</div>

							</div>

							  <div class="form-group col-lg-12">
                                    <input type="hidden" name="save" value="contact">
                                    <button type="submit" class="btn btn-default" name="submit">Submit</button>
                              </div>

						</form>
						 <?php } ?>
						<p><br><br>Questions? <a href="contact.php">Contact Us!</a><br>EIN #91-0881434</p>

					</div>

				</div>

			</section>
			<!-- /Section -->
		</section>

<!-- Add footer to page -->
<?php require_once("./inc/footer.php"); ?>
