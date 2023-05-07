<?php
    if ( !isset( $_GET['cocktail_id'] ) || trim( $_GET['cocktail_id'] ) == '' ) {
        // Track ID is missing.
        echo "Invalid URL";
        exit();
    }
    
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
    
    // Track Information:
    $cocktail_id = $_GET['cocktail_id'];
    
    $sql = "SELECT * 
                    FROM cocktails 
                    WHERE cocktail_id = $cocktail_id;";
    
    $results = $mysqli->query($sql);
    if (!$results) {
        echo $mysqli->error;
        $mysqli->close();
        exit();
    }
    
    $row_cocktail = $results->fetch_assoc();
    
    // Close DB Connection
    $mysqli->close();

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
            #form {
                padding: 50px;
            }
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
            
            <div id="form">
                <form action="edit_confirmation.php" method="POST">

                    <input type="hidden" name="cocktail_id" value="<?php echo $row_cocktail['cocktail_id']; ?>">

                    <div class="form-group row">
                        <label for="name-id" class="col-sm-3 col-form-label text-sm-right">
                            Cocktail: <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="cocktail-id" name="cocktail" value="<?php echo $row_cocktail['cocktail']; ?>">
                        </div>
                    </div> <!-- .form-group -->

                    <div class="form-group row">
                        <label for="media-type-id" class="col-sm-3 col-form-label text-sm-right">
                            Rating:
                        </label>
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