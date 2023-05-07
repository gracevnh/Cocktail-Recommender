<?php

    if ( !isset($_POST['cocktail']) || trim($_POST['cocktail']) == '' ) {
        $error = "Please fill out all required fields.";
    } else {
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

        $cocktail = $mysqli->real_escape_string($_POST['cocktail']);
        $rating = isset($_POST['rating']) && trim($_POST['rating']) != '' ? $mysqli->real_escape_string($_POST['rating']) : 'NULL';
        
        $flavor_id = isset($_POST['flavor']) && trim($_POST['flavor']) != '' ? $mysqli->real_escape_string($_POST['flavor']) : 'NULL';
        $alcohol_id = isset($_POST['alcohol']) && trim($_POST['alcohol']) != '' ? $mysqli->real_escape_string($_POST['alcohol']) : 'NULL';
        
        $beverage = isset($_POST['beverage']) && trim($_POST['beverage']) != '' ? "'" . $mysqli->real_escape_string($_POST['beverage']) . "'" : 'NULL';
    
        $sql = "INSERT INTO cocktails (cocktail, rating, flavor_id, alcohol_id, beverage)
                    VALUES ('$cocktail', $rating, $flavor_id, $alcohol_id, $beverage);";

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
            #navbar {
                background-image: none;
                background-repeat: no-repeat;
                background-size: none;
                height: 0px; 
                border-bottom: 0px solid #7C3030;
            }
        </style>
    </head>

    <body>
        <div id="header">
                <h1 class="text-center p-2">Pour a Drink</h1>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <h1 class="col-12 mt-4">Add a Cocktail</h1>
            </div> <!-- .row -->
        </div> <!-- .container -->
        <div class="container">
            <div class="row mt-4">
                <div class="col-12">

                    <?php if ( isset($error) && trim($error) != '' ) : ?>

                        <div class="text-danger">
                            <!-- Show Error Messages Here. -->
                            <?php echo $error; ?>
                        </div>

                    <?php else : ?>

                        <div class="text-success">
                            <span class="font-italic"><?php echo $cocktail; ?></span> was successfully added.
                            <br>
                            <a href="recs_add.php" class="btn btn-primary mt-2">Back</a>
                        </div>

                    <?php endif; ?>

                </div> <!-- .col -->
            </div> <!-- .row -->
        </div> <!-- .container -->
        
    </body>

</html>