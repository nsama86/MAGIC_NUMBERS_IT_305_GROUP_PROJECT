<?php require_once('./inc/header.php'); ?>
		<section id="content">
			<!-- Page Heading -->
			<section class="section page-heading animate-onscroll">
				<h1>Donate in Person</h1>
			</section>
			<!-- Page Heading -->
            <section class="section full-width-bg gray-bg animate-onscroll">
				<div class="row">
					<div class="col-lg-4 col-md-4 col-sm-12">
						<h3 class="no-margin-top">Top Ten Needed Items</h3>
						<ul class="orange_list">
						<?php // Loop to display top ten items from the database

							//Define the select query
							$sql = "SELECT * FROM top_ten ORDER BY rank";

							//Send the query to the database
							$result = @mysqli_query($connection, $sql);

							//Process the rows
							while($row = mysqli_fetch_assoc($result))
							{
								echo "<li>" . $row['item'] . "</li>";
							}

						?>
						</ul>
						<p><a href="top-ten-items.php" target="_blank">Print List</a></p>
						<br>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-12">
					<h3 class="no-margin-top">Clothing Bank</h3>
					<p>We want to see everyone in our community stay warm during the Winter and have everything else that they need for
					the rest of the year.  When you donate a piece of clothing to our clothing bank, you make a difference.  You can help
					put socks on that young man who has none or a Jacket to the girl who’s alone on the street.  Let your donations become
					blessings to those who are less fortunate and keep those in our community warm and dry.  Please consider donating your
					gently used clothes to the clothing bank today!</p>
					<p>The Kent Food Bank’s clothing bank is open Monday – Wednesday as well as Friday from 9am – 2pm (You can find our full
					list of hours here.) Your generosity is very much appreciated. Thank you.</p>
					</div>

					<!-- Sidebar -->
					<?php require_once('./inc/sidebar.php'); ?>
					<!-- /Sidebar -->
				</div>
			</section>
			<!-- /Section -->
		</section>
<?php require_once('./inc/footer.php');
