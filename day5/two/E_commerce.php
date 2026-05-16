<?php

session_start();

include 'config.php';

// Create cart session
if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = [];
}

// Add to cart
if(isset($_GET['cart'])){

    $id = $_GET['cart'];

    $_SESSION['cart'][] = $id;

}

// Fetch products
$sql = "SELECT * FROM product";
$result = mysqli_query($conn, $sql);

// Cart count
$cart_count = count($_SESSION['cart']);

?>

<!DOCTYPE html>
<html>
<head>
    <title>E-Commerce Website</title>

    <style>

        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body{
            font-family: Arial;
            background: #f4f4f4;
        }

        .navbar{
            background: #222;
            color: white;
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h2{
            color: white;
        }

        .cart{
            background: orange;
            padding: 10px 15px;
            border-radius: 5px;
            font-weight: bold;
        }

        h1{
            text-align: center;
            margin: 30px 0;
        }

        .container{
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            padding-bottom: 40px;
        }

        .card{
            width: 260px;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            transition: 0.3s;
        }

        .card:hover{
            transform: translateY(-5px);
        }

        .card img{
            width: 100%;
            height: 220px;
            object-fit: cover;
        }

        .card-body{
            padding: 15px;
        }

        .card h2{
            margin-bottom: 10px;
            color: #333;
        }

        .price{
            color: green;
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .desc{
            color: #666;
            margin-bottom: 15px;
        }

        .btn{
            display: inline-block;
            padding: 10px 15px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .btn:hover{
            background: #0056b3;
        }

    </style>

</head>

<body>

<div class="navbar">

    <h2>My Shop</h2>

    <div class="cart">
        Cart: <?php echo $cart_count; ?>
    </div>

</div>

<h1>Our Products</h1>

<div class="container">

<?php

if(mysqli_num_rows($result) > 0){

    while($row = mysqli_fetch_assoc($result)){

?>

    <div class="card">

        <img src="<?php echo $row['product_image']; ?>" alt="Product Image">

        <div class="card-body">

            <h2>
                <?php echo $row['product_name']; ?>
            </h2>

            <div class="price">
                ₹<?php echo $row['product_price']; ?>
            </div>

            <div class="desc">
                <?php echo $row['product_discription']; ?>
            </div>

            <a href="?cart=<?php echo $row['product_id']; ?>" class="btn">
                Add to Cart
            </a>

        </div>

    </div>

<?php

    }

}else{

    echo "No Products Found";
}

?>

</div>

</body>
</html>