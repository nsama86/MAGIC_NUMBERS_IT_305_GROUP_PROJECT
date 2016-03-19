<?php require_once('./inc/header.php'); ?>


		<section id="content">
			<!-- Page Heading -->
			<section class="section page-heading animate-onscroll">
				<h1>Donate Online</h1>
			</section>
			<!-- Page Heading -->

            <!-- Section -->
			<section class="section full-width-bg gray-bg animate-onscroll">
				<div class="row">
					<div class="col-lg-9 col-md-9 col-sm-8">
					<div>
							<h3 class="no-margin-top" style="text-align:left">Donate Money</h3>
							<p>Each year Kent Food Bank distributes approximately 6,000 lbs of food. We are
								a non-profit organization that run on volunteer support with funding from
								grants, individual doners, and some money from the city of Kent. Every contribution
								makes a difference. Please help keep us going by donating directly to the Kent Food Bank via papal.</p>
								<div style="text-align:center;">
								<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
								<input name="cmd" type="hidden" value="_s-xclick">
								<input name="hosted_button_id" type="hidden" value="HPNP9YXHUXN4G">
								<input alt="PayPal - The safer, easier way to pay online!" name="submit" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif"
								type="image"> <img alt="" border="0" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif"
								width="1">
							</form>
								</div>
						</div>
						<div>
							<br>
							<br>
							<h3 class="no-margin-top" style="text-align:left">
								Help by Donating online.
								<span class="pull-right"><a href="sponsorship.php" style="text-align:right" class="button donate">Sponsor Us</a></span>
							</h3>
							<p>We are excited this year to provide you with a number of different options
								to support the Kent Food Bank. Each option gives you the opportunity to be
								able directly make a difference for needy families in our community.</p>Learn more about the <a href="sponsorshipbreakfast.php">annual sponsorship breakfast.</a>
							<p class="text-center"><strong>Your generosity is greatly appreciated!</strong>
							</p>
							<p class="text-center"><strong>THANK YOU!!!</strong></p>
						</div>
					</div>
					 <!-- Sidebar -->
					<?php require_once('./inc/sidebar.php'); ?>
					<!-- /Sidebar -->
				</div>

			</section>
			<!-- /Section -->
		</section>
<?php require_once('./inc/footer.php');
