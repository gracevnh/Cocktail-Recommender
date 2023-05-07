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

    // Query to retrieve flavors from the flavor table
    $flavors_sql = "SELECT * FROM flavor;";
    $results_flavors = $mysqli->query($flavors_sql);
    if (!$results_flavors) {
        echo $mysqli->error;
        exit();
    }

    // Query to retrieve flavors from the alcohol table
    $alcohols_sql = "SELECT * FROM alcohol;";
    $results_alcohols = $mysqli->query($alcohols_sql);
    if (!$results_alcohols) {
        echo $mysqli->error;
        exit();
    }

?>

<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="Share your favorite cocktail recipes with our community and get feedback from other cocktail enthusiasts. Create your own profile, add your own drinks, and discover new variations on classic cocktails. Join us and become part of our cocktail-loving community.">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="home.css">
        <title>Pour a Drink</title>

        <style>
            #navbar {
                background-image: url('img/addyours.jpg');
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

            <div id="content">
                <h2 class="p-2 pl-5">Add Yours</h2>
                <p class="p-2 pl-5 pr-4">Feel free to add your own cocktail mixture!</p>
            </div>

            <div class="container ml-0">

                <form action="recs_add_results.php" method="POST">
        
                    <div class="form-group row">
                        <label for="cocktail-id" class="col-sm-3 col-form-label text-sm-right">Cocktail: <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="cocktail-id" name="cocktail">
                        </div>
                    </div> <!-- .form-group -->
        
                    <div class="form-group row">
                        <label for="rating-id" class="col-sm-3 col-form-label text-sm-right">Rating:</label>
                        <div class="col-sm-9">
                            <select name="rating" id="rating-id" class="form-control">
                                <option value="" selected disabled>-- Select One --</option>
        
                                <!-- Insert options -->
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
        
                            </select>
                        </div>
                    </div> <!-- .form-group -->

                    <div class="form-group row">
                        <label for="flavor" class="col-sm-3 col-form-label text-sm-right">Flavor:</label>
                        <div class="col-sm-9">
                            <select name="flavor" id="flavor" class="form-control">
                                <option value="" selected disabled>-- Select One --</option>

                                <?php 
                                    // loop through the flavors fetched from the database
                                    while ($flavor = $results_flavors->fetch_assoc()) {
                                        // display each flavor as an option in the drop-down menu
                                        echo "<option value=\"" . $flavor['flavor_id'] . "\">" . $flavor['flavor'] . "</option>";
                                    }
                                ?>

                            </select>
                        </div>
                    </div> <!-- .form-group -->

                    <div class="form-group row">
                        <label for="alcohol" class="col-sm-3 col-form-label text-sm-right">Alcohol:</label>
                        <div class="col-sm-9">
                            <select name="alcohol" id="alcohol" class="form-control">
                                <option value="" selected disabled>-- Select One --</option>

                                <?php 
                                    // loop through the flavors fetched from the database
                                    while ($alcohol = $results_alcohols->fetch_assoc()) {
                                        // display each flavor as an option in the drop-down menu
                                        echo "<option value=\"" . $alcohol['alcohol_id'] . "\">" . $alcohol['alcohol'] . "</option>";
                                    }
                                ?>

                            </select>
                        </div>
                    </div> <!-- .form-group -->

                    <div class="form-group row">
                        <label for="beverage-id" class="col-sm-3 col-form-label text-sm-right">Beverage:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="beverage-id" name="beverage">
                        </div>
                    </div> <!-- .form-group -->
        
                    <div class="form-group row">
                        <div class="ml-auto col-sm-9">
                            <span class="text-danger font-italic">* Required</span>
                        </div>
                    </div> <!-- .form-group -->
        
                    <div class="form-group row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-9 mt-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-light">Reset</button>
                        </div>
                    </div> <!-- .form-group -->
        
                </form>

            </div>

        </div>
        
    </body>

</html>