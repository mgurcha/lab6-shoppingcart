<?php
    include 'functions.php';
    include 'database.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <title>Products Page</title>
    </head>
    <body>
    <div class='container'>
        <div class='text-center'>
            
            <!-- Bootstrap Navagation Bar -->
            <nav class='navbar navbar-default - navbar-fixed-top'>
                <div class='container-fluid'>
                    <div class='navbar-header'>
                        <a class='navbar-brand' href='#'>Shopping Land</a>
                    </div>
                    <ul class='nav navbar-nav'>
                        <li><a href='index.php'>Home</a></li>
                        <li><a href='scart.php'>
                        <span class='glyphicon glyphicon-shopping-cart' aria-hidden='true'>
                        </span> Cart: <?php displayCartCount(); ?> </a></li>
                    </ul>
                </div>
            </nav>
            <br /> <br /> <br />
            
            <!-- Search Form -->
            <form enctype="text/plain">
                <div class="form-group">
                    <label for="pName">Product Name</label>
                    <input type="text" class="form-control" name="query" id="pName" placeholder="Name">
                    Category:  
                    <select name="category">
                        <?php echo getCategoriesHTML(); ?>
                    </select>
                    <br/>
                    Price: <br/> 
                    From: <input type="text" name="price-from" />
                    To: <input type="text" name="price-to" />
                    <br/>
                    Order Results by: 
                    <input type="radio" name="ordering" value="product"> Product 
                    <input type="radio" name="ordering" value="price"> Price
                    <br/>
                    <input name="show-images" type="checkbox"> Display images
                    <br/>

                </div>
                <input type="submit" name="search-submitted" value="Submit" class="btn btn-default">
                <br /><br />
            </form>
            
            <!-- Display Search Results -->
            <?php
                session_start();
                
                if(!isset($_SESSION['cart'])){
                    $_SESSION['cart'] = array();
                    // echo "Array created!!";
                }
                
                if(isset($_POST['itemName'])){
                    //Creating an array to hold an item's properties
                    $newItem = array();
                    $newItem['name'] = $_POST['itemName'];
                    $newItem['id'] = $_POST['itemId'];
                    $newItem['price'] = $_POST['itemPrice'];
                    $newItem['image'] = $_POST['itemImage'];
                    
                    //array_push($_SESSION['cart'], $newItem);
                    foreach($_SESSION['cart'] as &$item){
                        if($newItem['id'] == $item['id']){
                            $item['quantity'] += 1;
                            $found = true;
                        }
                    }
                
                    if($found != true){
                        $newItem['quantity'] = 1;
                        array_push($_SESSION['cart'], $newItem);
                    }
                }
                
                $query = '';
                $category = '';
                $priceFrom = '';
                $priceTo = '';
                $ordering = '';
                $showImages = false;
                
                if (isset($_GET["query"]) && !empty($_GET["query"])) {
                    $query = $_GET["query"]; 
                }
                if (isset($_GET["category"]) && !empty($_GET["category"])) {
                    $category = $_GET["category"]; 
                }
            
                if (isset($_GET["price-from"]) && !empty($_GET["price-from"])) {
                    $priceFrom =  $_GET["price-from"]; 
                }
                
                if (isset($_GET["price-to"]) && !empty($_GET["price-to"])) {
                    $priceTo = $_GET["price-to"];
                }
                if (isset($_GET["ordering"]) && !empty($_GET["ordering"])) {
                    $ordering = $_GET["ordering"];
                }
                if (isset($_GET["show-images"]) && !empty($_GET["show-images"])) {
                    $showImages = true;
                }
                
                
                if(isset($_GET['query']))
                {
                    //include 'wmapi.php';
                    //$items = getProducts($_GET['query']);
                    //print_r($items);
                    // $items = getMatchingItems($_GET['query']);
                    
                
                    
                
                    // echo "query: $query <br/>"; 
                    // echo "category: $category <br/>"; 
                    // echo "priceFrom: $priceFrom <br/>"; 
                    // echo "priceTo: $priceTo <br/>"; 
                    // echo "ordering: $ordering <br/>"; 
                    // echo "showImages: $showImages <br/>"; 
                }
                
                if(isset($_GET['search-submitted'])){
                    $items = getMatchingItems($query, $category, $priceFrom, $priceTo, $ordering, $showImages);
                }
                
            ?>
            
            <?php 
                
                displayResults();
                //insertItemsIntoDB($items);
            
            
            ?>
            
        </div>
    </div>
    </body>
</html>