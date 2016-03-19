<?php require_once('./inc/header.php'); ?>
<section id="content">
    <!-- Section -->
    <section class="section full-width-bg animate-onscroll">
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-8">
                <!-- Main Slider -->
                <div class="flexslider main-flexslider">
                    <ul class="slides">
                        <li id="main_flex_1">
							<div class="slide align-center">
                                <h2 class="great-vibes">Helping us help others</h2>
                            </div>
                        </li>
                        <li id="main_flex_2">
							<div class="slide align-center">
										<h2>Be great, donate!</h2>
							</div>
                        </li>
                        <li id="main_flex_3">
							<div class="slide align-center">
                                <h2>Make a difference in your community today!</h2>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- /Main Slider -->
            </div>
            <?php require_once('./inc/sidebar.php'); ?>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h1 class="no-margin-top">Welcome to the Kent Food Bank <span class="orange">&amp;</span> Emergency Services</h1>
                <h2>We provide assistance to families and individuals living within the boundaries of the Kent School District with food and clothing.
                    Learn how to get help, how you can help, and ways to donate today!
                </h2>
                <br>
                <br>
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
                <br>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="fb-page" data-href="https://www.facebook.com/kentfoodbank" data-tabs="timeline, events, messages"
                    data-width="800" data-height="620" data-small-header="false" data-adapt-container-width="true"
                    data-hide-cover="false" data-show-facepile="false">
                    <div class="fb-xfbml-parse-ignore">
                        <blockquote cite="https://www.facebook.com/kentfoodbank">
                            <a href="https://www.facebook.com/kentfoodbank" target="_blank">
                            Kent Food Bank &amp; Emergency Services
                            </a>
                        </blockquote>
                    </div>
                </div>
            </div>
		</div>
    </section>
</section>
<?php require_once('./inc/footer.php');
