<?php

    if ( !isset($_POST['cocktail']) || trim($_POST['cocktail']) == '' ) {
    // One or more of the required fields is empty.
    $error = "Please fill out all required fields.";
    } else {
        $host = "303.itpwebdev.com";
        $user = "ghutapea_db_user";
        $pass = "uscitp2023";
        $db = "ghutapea_cocktails"; 
        
        // DB Connection.
        $mysqli = new mysqli($host, $user, $pass, $db);
        if ( $mysqli->connect_errno ) {
            echo $mysqli->connect_error;
            exit();
        }
        
        $mysqli->set_charset('utf8');

        $cocktail = $_POST['cocktail'];

        if ( isset($_POST['rating']) && trim($_POST['rating']) != '' ) {
			$rating = $_POST['rating'];
		} else {
			$rating = "null";
		}

        $sql = "UPDATE cocktails
						SET
							cocktail = '$cocktail',
							rating = $rating
						WHERE cocktail_id = " . $_POST['cocktail_id'] . ";";

		$results = $mysqli->query($sql);

		if (!$results) {
			echo $mysqli->error;
			$mysqli->close();
			exit();
		}

        $mysqli->close();
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
            #navbar {
                background-image: none;
                background-repeat: no-repeat;
                background-size: none;
                height: 0px; 
                border-bottom: 0px solid #7C3030;
            }
            #confirm {
                padding: 50px;
                padding-left: 100px;
            }
            #navbar li a {
                color: #7C3030;
            }
        </style>
    </head>

    <body>
        <div id="container">
            <div id="header">
                <h1 class="text-center p-2">Pour a Drink</h1>
            </div>

            <div id="navbar">
                <ul id="nav" class="list-unstyled list-inline text-center p-2">
                    <li class="list-inline-item">
                        <a id="active-nav" href="home.php">Home</a>
                    </li>
                    <li class="list-inline-item">
                        <a id="active-nav" href="materials.php">Materials</a>
                    </li>
                    <li class="list-inline-item">
                        <a id="active-nav" href="recs_view.php">Recommendations</a>
                    </li>
                    <li class="list-inline-item">
                        <a id="active-nav" href="recs_add.php">Add Your Own</a>
                    </li>
                    <li class="list-inline-item">
                        <a id="active-nav" href="non_alcoholic.php">Non-alcoholic</a>
                    </li>
                </ul>
            </div>

            <div class="col-12">

				<?php if ( isset($error) && trim($error) != '' ) : ?>

					<div class="text-danger">
						<?php echo $error; ?>
					</div>

				<?php else: ?>

					<div id="confirm" class="text-success">
						<span class="font-italic"><?php echo $cocktail; ?></span> was successfully edited.
                        <br>
                        <a href="recs_view.php" class="btn btn-primary mt-2">Back</a>
                    </div>

				<?php endif; ?>

			</div> <!-- .col -->


        </div>
        
    </body>

</html>