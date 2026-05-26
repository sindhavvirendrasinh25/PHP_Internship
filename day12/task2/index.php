<?php

require_once "Book.php";

session_start();


// RESET OLD SESSION IF BROKEN

if(isset($_SESSION['books']))
{
    if(!is_array($_SESSION['books']))
    {
        unset($_SESSION['books']);
    }
}


// CREATE BOOK OBJECTS

if(!isset($_SESSION['books']))
{
    $_SESSION['books'] = [

        serialize(
            new Book(
                "Clean Code",
                "Robert C. Martin",
                "9780132350884"
            )
        ),

        serialize(
            new Book(
                "Atomic Habits",
                "James Clear",
                "9780735211292"
            )
        ),

        serialize(
            new Book(
                "Rich Dad Poor Dad",
                "Robert Kiyosaki",
                "9781612680194"
            )
        ),

        serialize(
            new Book(
                "Design Patterns",
                "Erich Gamma",
                "9780201633610"
            )
        ),

        serialize(
            new Book(
                "The Pragmatic Programmer",
                "Andrew Hunt",
                "9780201616224"
            )
        )

    ];
}


// MESSAGE

$message = "";


// ACTION

if(isset($_POST['action']) &&
   isset($_POST['book_index']))
{
    $index = $_POST['book_index'];


    // CONVERT STRING TO OBJECT

    $book = unserialize(
        $_SESSION['books'][$index]
    );


    // BORROW

    if($_POST['action'] == "borrow")
    {
        if($book->borrowBook())
        {
            $message = "Book Borrowed Successfully";
        }
        else
        {
            $message = "Book Already Borrowed";
        }
    }


    // RETURN

    if($_POST['action'] == "return")
    {
        if($book->returnBook())
        {
            $message = "Book Returned Successfully";
        }
        else
        {
            $message = "Book Already Available";
        }
    }


    // SAVE OBJECT AGAIN

    $_SESSION['books'][$index] = serialize($book);
}

?>

<!DOCTYPE html>
<html>
<head>

    <title>Library Management System</title>

    <style>

    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
    }

    body{
        font-family:Arial, Helvetica, sans-serif;
        background:linear-gradient(135deg,#dfe9f3,#ffffff);
        padding:40px;
    }

    .container{
        max-width:1100px;
        margin:auto;
        background:white;
        padding:30px;
        border-radius:20px;
        box-shadow:0 10px 30px rgba(0,0,0,0.15);
    }

    h1{
        text-align:center;
        margin-bottom:25px;
        font-size:42px;
        color:#2d3436;
        letter-spacing:1px;
    }

    .message{
        background:#dff9fb;
        color:#130f40;
        padding:15px;
        border-left:6px solid #22a6b3;
        border-radius:8px;
        margin-bottom:20px;
        font-weight:bold;
    }

    table{
        width:100%;
        border-collapse:collapse;
        overflow:hidden;
        border-radius:15px;
    }

    th{
        background:linear-gradient(45deg,#6a11cb,#2575fc);
        color:white;
        padding:16px;
        font-size:17px;
        text-transform:uppercase;
    }

    td{
        padding:14px;
        text-align:center;
        border-bottom:1px solid #ddd;
        font-size:15px;
    }

    tr:nth-child(even){
        background:#f8f9fa;
    }

    tr:hover{
        background:#ffeaa7;
        transition:0.3s;
    }

    .available{
        color:#00b894;
        font-weight:bold;
        font-size:16px;
    }

    .borrowed{
        color:#d63031;
        font-weight:bold;
        font-size:16px;
    }

    button{
        padding:10px 18px;
        border:none;
        border-radius:8px;
        color:white;
        cursor:pointer;
        font-size:14px;
        transition:0.3s;
    }

    button:hover{
        transform:scale(1.05);
    }

    .borrow-btn{
        background:linear-gradient(45deg,#0984e3,#6c5ce7);
    }

    .return-btn{
        background:linear-gradient(45deg,#00b894,#55efc4);
    }

    .reset{
        display:inline-block;
        margin-top:25px;
        background:linear-gradient(45deg,#d63031,#ff7675);
        color:white;
        padding:12px 20px;
        text-decoration:none;
        border-radius:8px;
        font-weight:bold;
        transition:0.3s;
    }

    .reset:hover{
        transform:scale(1.05);
    }

</style>

</head>
<body>

<div class="container">

<h1>Library Management System</h1>

<?php

if($message != "")
{
    echo "<div class='message'>$message</div>";
}

?>

<table>

<tr>

    <th>#</th>
    <th>Title</th>
    <th>Author</th>
    <th>ISBN</th>
    <th>Status</th>
    <th>Action</th>

</tr>

<?php

foreach($_SESSION['books'] as $index => $bookData)
{

    // STRING TO OBJECT

    $book = unserialize($bookData);

?>

<tr>

    <td>
        <?php echo $index + 1; ?>
    </td>

    <td>
        <?php echo $book->getTitle(); ?>
    </td>

    <td>
        <?php echo $book->getAuthor(); ?>
    </td>

    <td>
        <?php echo $book->getIsbn(); ?>
    </td>

    <td class="<?php
        echo $book->isAvailable()
        ? "available"
        : "borrowed";
    ?>">

        <?php echo $book->getStatus(); ?>

    </td>

    <td>

        <form method="POST">

            <input type="hidden"
                   name="book_index"
                   value="<?php echo $index; ?>">

            <?php

            if($book->isAvailable())
            {
            ?>

                <input type="hidden"
                       name="action"
                       value="borrow">

                <button class="borrow-btn"
                        type="submit">
                    Borrow
                </button>

            <?php
            }
            else
            {
            ?>

                <input type="hidden"
                       name="action"
                       value="return">

                <button class="return-btn"
                        type="submit">
                    Return
                </button>

            <?php
            }
            ?>

        </form>

    </td>

</tr>

<?php
}
?>

</table>

<a class="reset"
   href="reset.php">
   Reset Library
</a>

</div>

</body>
</html>