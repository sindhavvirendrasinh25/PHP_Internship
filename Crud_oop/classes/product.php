<?php

class Product
{
    private $conn;
    private $table = "products";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create($name,$sku,$price,$description)
    {
        $sql = "INSERT INTO $this->table
                (name,sku,price,description)
                VALUES
                ('$name','$sku','$price','$description')";

        return mysqli_query($this->conn,$sql);
    }

    public function read()
    {
        return mysqli_query(
            $this->conn,
            "SELECT * FROM $this->table ORDER BY id DESC"
        );
    }

    public function getSingle($id)
    {
        $result = mysqli_query(
            $this->conn,
            "SELECT * FROM $this->table WHERE id='$id'"
        );

        return mysqli_fetch_assoc($result);
    }

    public function update($id,$name,$sku,$price,$description)
    {
        $sql = "UPDATE $this->table
                SET
                name='$name',
                sku='$sku',
                price='$price',
                description='$description'
                WHERE id='$id'";

        return mysqli_query($this->conn,$sql);
    }

    public function delete($id)
    {
        return mysqli_query(
            $this->conn,
            "DELETE FROM $this->table WHERE id='$id'"
        );
    }
}
?>