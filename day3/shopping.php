
<?php

session_start();

$products = [

    [
        "id"=>1,
        "name"=>"iPhone 15",
        "price"=>80000,
        "category"=>["Electronics","Mobile","5G"],
        "stock"=>5
    ],

    [
        "id"=>2,
        "name"=>"Samsung TV",
        "price"=>45000,
        "category"=>["Electronics","TV","Smart"],
        "stock"=>3
    ],

    [
        "id"=>3,
        "name"=>"Laptop",
        "price"=>60000,
        "category"=>["Electronics","Computer","Gaming"],
        "stock"=>4
    ],

    [
        "id"=>4,
        "name"=>"Headphones",
        "price"=>3000,
        "category"=>["Audio","Music","Wireless"],
        "stock"=>10
    ],

    [
        "id"=>5,
        "name"=>"Keyboard",
        "price"=>1500,
        "category"=>["Computer","Accessories","RGB"],
        "stock"=>7
    ]

];

if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = [];
}

if(isset($_POST['add_to_cart'])){

    $id = $_POST['id'];

    foreach($products as $product){

        if($product['id'] == $id){

            $found = false;

            foreach($_SESSION['cart'] as &$item){

                if($item['id'] == $id){
                    $item['quantity']++;
                    $found = true;
                }
            }

            if(!$found){

                $_SESSION['cart'][] = [
                    'id'=>$product['id'],
                    'name'=>$product['name'],
                    'price'=>$product['price'],
                    'quantity'=>1,
                    'category'=>implode(" | ",$product['category'])
                ];
            }
        }
    }
}

$subtotal = 0;

foreach($_SESSION['cart'] as &$item){

    $item['subtotal'] = $item['price'] * $item['quantity'];

    $subtotal += $item['subtotal'];
}

if($subtotal > 1000){

    $_SESSION['cart'] = array_map(function($item){

        $item['price'] = $item['price'] - ($item['price'] * 0.10);

        $item['subtotal'] = $item['price'] * $item['quantity'];

        return $item;

    }, $_SESSION['cart']);

    $subtotal = array_sum(array_column($_SESSION['cart'],'subtotal'));
}

$gst = $subtotal * 0.18;

if($subtotal > 499){
    $delivery = 0;
}
else{
    $delivery = 50;
}

$grandTotal = $subtotal + $gst + $delivery;

?>

<!DOCTYPE html>
<html>
<head>

    <title>Shopping Cart</title>

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

        button{
            background: green;
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
        }

        .bill{
            width: 350px;
            background: white;
            padding: 20px;
            border-radius: 10px;
        }

    </style>

</head>

<body>

<h1>PHP Shopping Cart System</h1>

<h2>Product Catalogue</h2>

<table border="1">

<tr>

    <th>ID</th>
    <th>Name</th>
    <th>Price</th>
    <th>Category</th>
    <th>Stock</th>
    <th>Action</th>

</tr>

<?php foreach($products as $p){ ?>

<tr>

    <td><?php echo $p['id']; ?></td>

    <td><?php echo $p['name']; ?></td>

    <td>₹<?php echo number_format($p['price']); ?></td>

    <td><?php echo implode(" | ",$p['category']); ?></td>

    <td><?php echo $p['stock']; ?></td>

    <td>

        <form method="POST">

            <input type="hidden" name="id" value="<?php echo $p['id']; ?>">

            <button type="submit" name="add_to_cart">Add To Cart</button>

        </form>

    </td>

</tr>

<?php } ?>

</table>

<h2>Cart Summary</h2>

<table border="1">

<tr>

    <th>Product</th>
    <th>Category</th>
    <th>Price</th>
    <th>Quantity</th>
    <th>Subtotal</th>

</tr>

<?php foreach($_SESSION['cart'] as $item){ ?>

<tr>

    <td><?php echo $item['name']; ?></td>

    <td><?php echo $item['category']; ?></td>

    <td>₹<?php echo number_format($item['price'],2); ?></td>

    <td><?php echo $item['quantity']; ?></td>

    <td>₹<?php echo number_format($item['subtotal'],2); ?></td>

</tr>

<?php } ?>

</table>

<div class="bill">

    <h2>Bill Breakdown</h2>

    <p><b>Subtotal:</b> ₹<?php echo number_format($subtotal,2); ?></p>

    <p><b>GST (18%):</b> ₹<?php echo number_format($gst,2); ?></p>

    <p><b>Delivery:</b> ₹<?php echo number_format($delivery,2); ?></p>

    <hr>

    <p><b>Grand Total:</b> ₹<?php echo number_format($grandTotal,2); ?></p>

</div>

</body>
</html>
```

