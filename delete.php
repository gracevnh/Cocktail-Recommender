<?php
    if ( !isset($_GET['cocktail_id']) || trim($_GET['cocktail_id']) == '' ) {
		// Missing track_id;
		$error = "Invalid URL.";
	} else {
		// Valid URL w/ track_id.

		$host = "303.itpwebdev.com";
		$user = "ghutapea_db_user";
		$pass = "uscitp2023";
		$db = "ghutapea_cocktails";

		// Establish MySQL Connection.
		$mysqli = new mysqli($host, $user, $pass, $db);

		// Check for any Connection Errors.
		if ( $mysqli->connect_errno ) {
			echo $mysqli->connect_error;
			exit();
		}

		$sql = "DELETE FROM cocktails
						WHERE cocktail_id = " . $_GET['cocktail_id'] . ";";


		// echo "<hr>$sql<hr>";

		$results = $mysqli->query($sql);

		if (!$results) {
			echo $mysqli->error;
			$mysqli->close();
			exit();
		}

		$mysqli->close();

		// $row = $results->fetch_assoc();

	}

?>

<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="home.css">
        <title>Pour a Drink</title>

        <style>
            img {
                width: 500px;
                height: auto;
            }
            #deleted {
                padding: 50px;
            }
        </style>
    </head>

    <body>
        <div id="container">
            <div id="header">
                <h1 class="text-center p-2">Pour a Drink</h1>
            </div>
            
            <div id="deleted" class="row mt-4">
                <div class="col-12">

                    <?php if( isset($error) && trim($error) != '' ): ?>

                        <div class="text-danger">
                            <!-- Show Error Messages Here. -->
                            <?php echo $error; ?>
                        </div>

                    <?php else: ?>

                        <div class="text-success"><span class="font-italic"><?php echo $_GET['cocktail']; ?></span> was successfully deleted.</div>
                        <a href="recs_view.php" class="btn btn-primary mt-2">Back</a>

                    <?php endif; ?>

                </div> <!-- .col -->
            </div> <!-- .row -->
        </div>
        
    </body>

</html>