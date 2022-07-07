<?php
// Looking for .env at the root directory

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__),".env");
$dotenv->load();

// The format required by PDO
//$dbh = new PDO('mysql:host=' . $_ENV['DATABASE_HOST'] . ';dbname=' . $_ENV['DATABASE_NAME'], $_ENV['DATABASE_USER'], $_ENV['DATABASE_PASSWORD']);
try {
    $conn = new PDO('mysql:host=' . $_ENV['DATABASE_HOST'] . ';dbname=' . $_ENV['DATABASE_NAME'], $_ENV['DATABASE_USER'], $_ENV['DATABASE_PASSWORD']);
    $dbname = $_ENV['DATABASE_NAME'];
    $dbhost = $_ENV['DATABASE_HOST'];
    //uncomment echo to check if connection was established
   // echo "Connected to $dbname at $dbhost successfully.";


    //Commented out example of sql query//

//    $sqlResult = $conn->query("select name,price from product");
//    print_r($sqlResult);
//    while ($row = $sqlResult->fetch()) {
//        print "<p>Name: {$row[0]} {$row[1]}</p>";
//    }

} catch (PDOException $pe) {
    die("Could not connect to the database $dbname :" . $pe->getMessage());
}

// Retrieve env variable example
//$userName = $_ENV['DATABASE_USER'];
//echo $userName;

