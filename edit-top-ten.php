<?php
if (!isset($_COOKIE['first_name']))
{
	// Need the functions:
	require('./inc/login_functions.inc.php');
	redirect_user();
}

require_once('./inc/header.php'); ?>

<?php
    //Handle Top Ten form
    $submitted = isset($_POST['submit']);
    if($submitted)
    {
        // Make sure every field has something in it
        $blankField = false;
        for($i = 1; $i <= 10; $i++)
        {
            if($_POST[$i] == "")
            {
                $blankField = true;
            }
        }

        // If everything looks good, submit to the databasen
        if(!$blankField)
        {
            for($i = 1; $i <= 10; $i++)
            {
                $sql = "UPDATE top_ten
                        SET item = '" . mysqli_real_escape_string($connection, $_POST[$i]) .
                        "' WHERE rank=$i";
                //Send the query to the database
                $result = @mysqli_query($connection, $sql);
                if(!$result)
                {
                    echo "<p class='error'>There was a problem with the database!</p>";
                }
            }
        }
    }
?>

<section id="content">
    <section class="section page-heading animate-onscroll">
        <button class="logout"><a href="./logout.php">Log Out</a></button>
		  <h1>Edit Top Ten List</h1>
    </section>
    <!-- Section -->
    <section class="section full-width-bg gray-bg animate-onscroll">
		 <button class="admin"><a href="admin.php">Back to Admin</a></button>

        <div class="row">
			  	<div class="col-md-3 col-xs-0"></div>
            <div class="col-md-6 col-xs-12 text-center">
                <h3>Edit Top Ten List</h3>
                <p>Edit any or all of the fields below, then click save.</p>
                <p><button id="restore-top-ten">Restore Defaults</button></p>
                <?php
                if($submitted)
                {
                    if($blankField)
                    {
                        echo '<p class="error">Please enter a needed item for each field.</p>';
                    }
                    else
                    {
                        echo '<p class="success">List successfully updated!</p>';
                    }
                }
                ?>
                <form action="" method="post">
                <?php // Loop to display top ten items from the database

                    //Define the select query
                    $sql = "SELECT * FROM top_ten ORDER BY rank";

                    //Send the query to the database
                    $result = @mysqli_query($connection, $sql);

                    $i = 1;
                    //Process the rows
                    while($row = mysqli_fetch_assoc($result))
                    {
                        echo "<input type='text' id='$i' name='$i' value='";

                        if(isset($_POST['submit']))
                        {
                            echo $_POST[$i];
                        }
                        else
                        {
                            echo $row['item'];
                        }

                        echo "'>";
                        $i++;
                    }

                ?>
                <input type="submit" value="Save Top Ten" name="submit">
                </form>
            </div>
				<div class="col-md-3 col-xs-0"></div>
        </div>
    </section>
</section>

<script>
    $(document).ready(function() {
        $('#restore-top-ten').click(function(){
            $('#1').val("Soup – condensed and ready to eat");
            $('#2').val("Canned vegetables");
            $('#3').val("Canned tomato products");
            $('#4').val("Canned fruit");
            $('#5').val("Canned proteins – SPAM, tuna, chicken");
            $('#6').val("Ready to eat meals – chili, Chef Boyardee");
            $('#7').val("Canned or bagged beans");
            $('#8').val("Toiletries");
            $('#9').val("Diapers and Formula");
            $('#10').val("Office supplies - paper, pens, garbage bags");
        });
    });
</script>

<?php require_once('./inc/footer.php'); ?>
