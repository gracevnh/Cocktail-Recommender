<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="Welcome to our cocktail recommendation website! Discover new cocktail recipes, learn about different ingredients, and find recommendations based on your preferences. Join our community and share your favorite drinks with other cocktail enthusiasts.">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="home.css">
        <title>Pour a Drink</title>

        <style>
            #content {
                margin-top: 20px;
            }
            #navbar {
                background-image: url('img/rosecocktail.jpg');
                background-position: center;
            }
            img {
                width: 100px;
                height: auto;
            }
            table {
                margin: 0 auto;
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
            
        <div class="box mx-auto">
            <div class="row">
                <div class="col-12 mx-auto">
                    <table class="table table-hover table-responsive mt-4 mx-auto">
                      
                        <thead>
                                <tr>
                                    <th>Cocktail</th>
                                    <th>Image</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                        </thead>
                            <tbody>

                            

                            </tbody>
                       
                    </table>
                </div> <!-- .col -->
            </div> <!-- .row -->
        </div> <!-- .container -->
            
        </div>
        
        <script>
            // Call the API and populate the table with the results
            fetch('https://www.thecocktaildb.com/api/json/v1/1/filter.php?a=Non_Alcoholic')
                .then(response => response.json())
                .then(data => {
                    // Get the tbody element from the table
                    const tbody = document.querySelector('table tbody');

                    // Loop through each cocktail in the data
                    data.drinks.forEach(cocktail => {
                        // Create a new row in the table
                        const row = document.createElement('tr');

                        // Create a cell for the cocktail name
                        const nameCell = document.createElement('td');
                        nameCell.textContent = cocktail.strDrink;
                        row.appendChild(nameCell);

                        // Create a cell for the cocktail image
                        const imageCell = document.createElement('td');
                        const image = document.createElement('img');
                        image.src = cocktail.strDrinkThumb;
                        image.alt = cocktail.strDrink;
                        image.width = 100;
                        imageCell.appendChild(image);
                        row.appendChild(imageCell);

                        // Add the row to the table
                        tbody.appendChild(row);
                    });
                });
        </script>


    </body>

</html>