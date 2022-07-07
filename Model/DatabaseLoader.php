<?php
declare(strict_types=1);
// Looking for .env at the root directory
class DatabaseLoader
{
    private string $dbhost;
    private string $dbname;
    private string $dbuser;
    private string $dbpass;

    public function __construct(){
        $dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__), ".env");
        $dotenv->load();
        $this->dbhost = $_ENV['DATABASE_HOST'];
        $this->dbname = $_ENV['DATABASE_NAME'];
        $this->dbuser = $_ENV['DATABASE_USER'];
        $this->dbpass = $_ENV['DATABASE_PASSWORD'];
        $this->getConnection();
    }

    public function getConnection():void{
        // The format required by PDO
//$dbh = new PDO('mysql:host=' . $_ENV['DATABASE_HOST'] . ';dbname=' . $_ENV['DATABASE_NAME'], $_ENV['DATABASE_USER'], $_ENV['DATABASE_PASSWORD']);
        try
        {
            $conn = new PDO('mysql:host=' . $this->dbhost . ';dbname=' . $this->dbname, $this->dbuser, $this->dbpass);

            //uncomment echo to check if connection was established
//             echo "Connected to $this->dbname at $this->dbhost successfully.";


            //Commented out example of sql query//

//    $sqlResult = $conn->query("select name,price from product");
//    print_r($sqlResult);
//    while ($row = $sqlResult->fetch()) {
//        print "<p>Name: {$row[0]} {$row[1]}</p>";
//    }

        }

        catch
        (PDOException $pe) {
            die("Could not connect to the database $this->dbname :" . $pe->getMessage());
        }
    }


// Retrieve env variable example
//$userName = $_ENV['DATABASE_USER'];
//echo $userName;
}
