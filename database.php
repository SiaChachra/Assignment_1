<?php
class Database
{
    private $connection;

    // Constructor
    function __construct()
    {
        $this->connect_db();
    }

    // Database Connection
    public function connect_db()
    {
        $this->connection = mysqli_connect('172.31.22.43', 'Sia200547582', 'GECtJ9cwE1', 'Sia200547582');
        if (mysqli_connect_error()) {
            die("Database Connection Failed" . mysqli_connect_error() . mysqli_connect_error());
        }
    }

    // Create an order
    public function create($name, $email, $address, $size, $toppings, $payment_method, $special_instructions)
    {
        $sql = "INSERT INTO pizzaHeaven (name, email, address, pizzasize, toppings, paymentmethod, specialinstructions) 
                VALUES ('$name', '$email', '$address', '$size', '$toppings', '$payment_method', '$special_instructions')";
        $res = mysqli_query($this->connection, $sql);
        if ($res) {
            return true;
        } else {
            return false;
        }
    }

    // Get the latest order from database
    public function getLatestOrder()
    {
        $sqlStatement = "SELECT * FROM pizzaHeaven ORDER BY order_id DESC LIMIT 1";
        $res = $this->connection->query($sqlStatement);

        if ($res->num_rows > 0) {
            return $res->fetch_assoc();
        }

        return null;
    }

    // Read from database
    public function read($name = null)
    {
        $sql = "SELECT * FROM pizzaHeaven";
        if ($name) {
            $sql .= " WHERE name='$name'";
        }
        $res = mysqli_query($this->connection, $sql);
        return $res;
    }
    public function sanitize($var)
    {
        $return = mysqli_real_escape_string($this->connection, $var);
        return $return;
    }
}
$database = new Database();
