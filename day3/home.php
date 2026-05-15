<?php

$products = [

    [
        "id"=>1,
        "name"=>"iPhone 15",
        "brand"=>"Apple",
        "category"=>["Electronics","5G","Flagship"],
        "price"=>80000,
        "stock"=>10,
        "rating"=>4.8
    ],

    [
        "id"=>2,
        "name"=>"Galaxy S24",
        "brand"=>"Samsung",
        "category"=>["Electronics","Android","5G"],
        "price"=>70000,
        "stock"=>5,
        "rating"=>4.6
    ],

    [
        "id"=>3,
        "name"=>"OnePlus 12",
        "brand"=>"OnePlus",
        "category"=>["Electronics","Mobile","Gaming"],
        "price"=>60000,
        "stock"=>2,
        "rating"=>4.4
    ],

    [
        "id"=>4,
        "name"=>"MacBook Air",
        "brand"=>"Apple",
        "category"=>["Laptop","M2","Premium"],
        "price"=>120000,
        "stock"=>0,
        "rating"=>4.9
    ],

    [
        "id"=>5,
        "name"=>"Boat Headphones",
        "brand"=>"Boat",
        "category"=>["Audio","Wireless","Music"],
        "price"=>3000,
        "stock"=>15,
        "rating"=>4.1
    ],

    [
        "id"=>6,
        "name"=>"Sony Camera",
        "brand"=>"Sony",
        "category"=>["Photography","4K","DSLR"],
        "price"=>90000,
        "stock"=>1,
        "rating"=>4.7
    ]

];

$search = "Apple";

$products = array_filter($products,function($p) use ($search){

    return $p["brand"] == $search;

});

usort($products,function($a,$b){

    return $a["price"] <=> $b["price"];

});

$totalProducts = count($products);

$inStock = 0;

$totalPrice = 0;

$ratings = [];

$totalStock = 0;

$categories = [];

foreach($products as $p){

    if($p["stock"] > 0){
        $inStock++;
    }

    $totalPrice += $p["price"];

    $ratings[] = $p["rating"];

    $totalStock += $p["stock"];

    $categories[$p["category"][0]][] = $p;
}

$avgPrice = $totalPrice / $totalProducts;

$highestRated = max($ratings);

$minPrice = min(array_column($products,"price"));

$maxPrice = max(array_column($products,"price"));

$avgRating = array_sum($ratings) / count($ratings);

?>

<!DOCTYPE html>
<html>
<head>

    <title>Dynamic Product Listing</title>

    <style>

        body{
            font-family: Arial;
            background: #f2f2f2;
            padding: 20px;
        }

        h1{
            text-align: center;
            color: darkblue;
        }

        .cards{
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .card{
            flex: 1;
            background: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }

        table{
            width: 100%;
            border-collapse: collapse;
            background: white;
            margin-bottom: 30px;
        }

        th{
            background: darkblue;
            color: white;
            padding: 10px;
        }

        td{
            padding: 10px;
            text-align: center;
        }

        tr:nth-child(even){
            background: #f9f9f9;
        }

        .highlight{
            background: #d9f1ff !important;
        }

        .green{
            background: green;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .yellow{
            background: orange;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .red{
            background: red;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .footer{
            background: lightblue;
            font-weight: bold;
        }

    </style>

</head>

<body>

<h1>Dynamic Product Listing Page</h1>

<div class="cards">

    <div class="card">

        <h2>Total Products</h2>

        <h1><?php echo $totalProducts; ?></h1>

    </div>

    <div class="card">

        <h2>In Stock</h2>

        <h1><?php echo $inStock; ?></h1>

    </div>

    <div class="card">

        <h2>Average Price</h2>

        <h1>₹<?php echo number_format($avgPrice); ?></h1>

    </div>

    <div class="card">

        <h2>Highest Rated</h2>

        <h1><?php echo $highestRated; ?> ⭐</h1>

    </div>

</div>

<?php foreach($categories as $category => $items){ ?>

<h2><?php echo $category; ?></h2>

<table border="1">

<tr>

    <th>ID</th>
    <th>Name</th>
    <th>Brand</th>
    <th>Category</th>
    <th>Price</th>
    <th>Stock</th>
    <th>Status</th>
    <th>Rating</th>

</tr>

<?php foreach($items as $p){

    $class = "";

    if($p["rating"] >= 4.5){
        $class = "highlight";
    }

?>

<tr class="<?php echo $class; ?>">

    <td><?php echo $p["id"]; ?></td>

    <td><?php echo $p["name"]; ?></td>

    <td><?php echo $p["brand"]; ?></td>

    <td><?php echo implode(" | ",$p["category"]); ?></td>

    <td>₹<?php echo number_format($p["price"]); ?></td>

    <td><?php echo $p["stock"]; ?></td>

    <td>

        <?php

        if($p["stock"] > 5){

            echo "<span class='green'>In Stock</span>";
        }
        elseif($p["stock"] > 0){

            echo "<span class='yellow'>Low Stock</span>";
        }
        else{

            echo "<span class='red'>Out of Stock</span>";
        }

        ?>

    </td>

    <td>

        <?php

        $fullStars = floor($p["rating"]);

        echo str_repeat("★",$fullStars);

        ?>

        (<?php echo $p["rating"]; ?>)

    </td>

</tr>

<?php } ?>

<tr class="footer">

    <td colspan="5">Summary</td>

    <td><?php echo $totalStock; ?></td>

    <td>Min: ₹<?php echo number_format($minPrice); ?></td>

    <td>

        Max: ₹<?php echo number_format($maxPrice); ?>

        <br>

        Avg Rating: <?php echo number_format($avgRating,1); ?>

    </td>

</tr>

</table>

<?php } ?>

</body>
</html>