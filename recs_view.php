<?php
    $host = "303.itpwebdev.com";
	$user = "ghutapea_db_user";
	$pass = "uscitp2023";
	$db = "ghutapea_cocktails"; 

    $mysqli = new mysqli($host, $user, $pass, $db);
	if ( $mysqli->connect_errno ) {
		echo $mysqli->connect_error;
		exit();
	}

    $mysqli->set_charset('utf8');

    // Retrieve results 
    // $sql = "SELECT cocktail_id, cocktail, rating, flavor
    //             FROM cocktails
    //             WHERE 1 = 1;";

    $sql = "SELECT cocktails.cocktail_id, cocktails.cocktail, MAX(cocktails.rating) AS max_rating, flavor.flavor, alcohol.alcohol, beverage
    FROM cocktails
    JOIN flavor ON cocktails.flavor_id = flavor.flavor_id
    JOIN alcohol ON cocktails.alcohol_id = alcohol.alcohol_id
    WHERE 1 = 1
    GROUP BY cocktails.cocktail_id
    ORDER BY max_rating DESC;";

    $results = $mysqli->query($sql);

    if ( !$results ) {
        echo $mysqli->error;
        $mysqli->close();
        exit();
    }

    // Close MySQL Connection
    $mysqli->close();

?>

<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="Get personalized cocktail recommendations based on your taste preferences, occasion, and ingredients on hand. Our recommendation engine will suggest the perfect cocktail for you, whether you're in the mood for a classic or something more adventurous.">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="home.css">
        <title>Pour a Drink</title>

        <style>
            table {
                 margin-left: auto;
                margin-right: auto;
            }
            thead {
                border-bottom: 1px solid #7C3030;
                margin-left: auto;
                margin-right: auto;
            }
            td {
                border-top: 1px solid #7C3030;
                border-bottom: 1px solid #7C3030;
                margin-left: auto;
                margin-right: auto;
            }
            table thead,
            table tbody {
                text-align: center;
            }
            #navbar {
                background-image: url('img/recs_view.jpg');
            }
        </style>
    </head>

    <body>
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
        <div class="container">
            <div class="row">
                <h1 class="col-12 mt-4">Best Cocktails</h1>
            </div> <!-- .row -->
        </div> <!-- .container -->
        <div class="container">
            <div class="row">
                <div class="col-12">

                    Showing <?php echo $results->num_rows; ?> result(s) from highest to lowest rating.

                </div> <!-- .col -->
                <div class="col-12">
                    <table class="table table-hover table-responsive mt-4">
                        <thead>
                            <tr>
                                <th>Cocktail</th>
                                <th>Rating</th>
                                <th>Flavor</th>
                                <th>Alcohol</th>
                                <th>Beverage</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php while ( $row = $results->fetch_assoc() ) : ?>
                                <tr>
                                    <td><?php echo $row['cocktail']; ?></td>
                                    <td><?php echo $row['max_rating']; ?></td>
                                    <td><?php echo $row['flavor']; ?></td>
                                    <td><?php echo $row['alcohol']; ?></td>
                                    <td><?php echo $row['beverage']; ?></td>
                                    <td>
                                        <a href="delete.php?cocktail_id=<?php echo $row['cocktail_id']; ?>&cocktail=<?php echo $row['cocktail']; ?>" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this cocktail?');">
                                            Delete
                                        </a>
                                    </td>
                                    <td>
                                        <a href="edit.php?cocktail_id=<?php echo $row['cocktail_id']; ?>" class="btn btn-outline-warning">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>

                        </tbody>
                    </table>
                </div> <!-- .col -->
            </div> <!-- .row -->
        </div> <!-- .container -->
        
    </body>

</html>