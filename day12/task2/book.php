<?php

class Book
{
    private $title;

    private $author;

    private $isbn;

    private $status;



    // CONSTRUCTOR

    public function __construct(
        $title,
        $author,
        $isbn,
        $status = "Available"
    )
    {
        $this->title = $title;

        $this->author = $author;

        $this->isbn = $isbn;

        $this->status = $status;
    }



    // GETTERS

    public function getTitle()
    {
        return $this->title;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getIsbn()
    {
        return $this->isbn;
    }

    public function getStatus()
    {
        return $this->status;
    }



    // BORROW BOOK

    public function borrowBook()
    {
        if($this->status == "Available")
        {
            $this->status = "Borrowed";

            return true;
        }

        return false;
    }



    // RETURN BOOK

    public function returnBook()
    {
        if($this->status == "Borrowed")
        {
            $this->status = "Available";

            return true;
        }

        return false;
    }



    // CHECK STATUS

    public function isAvailable()
    {
        return $this->status == "Available";
    }
}

?>