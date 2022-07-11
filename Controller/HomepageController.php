<?php
declare(strict_types=1);

class HomepageController
{
    private DatabaseLoader $databaseLoader;

    public function __construct()
    {
        $this->databaseLoader = new DatabaseLoader();
    }

    //render function with both $_GET and $_POST vars available if it would be needed.
    public function render(array $GET, array $POST)
    {
        $sqlProduct = $this->databaseLoader->getConnection()->query("SELECT id,name,price FROM product");
        $productsArray = [];
        while ($row = $sqlProduct->fetch()) {
            $productsArray[] = new product($row[0], $row[1], $row[2]);
        }
        $sqlCustomer = $this->databaseLoader->getConnection()->query("SELECT id, firstname, lastname, group_id FROM customer");
        $customersArray = [];
        while ($row = $sqlCustomer->fetch()) {
            $customersArray[] = new Customer($row[0], $row[1], $row[2],$row[3]);
        }

        if (isset($_POST['submit'])){
            $productFetch = $this->databaseLoader->getConnection()->query("SELECT * FROM product where id =".$POST['products']);
            $productDetails = $productFetch->fetch();
            $customerFetch = $this->databaseLoader->getConnection()->query("SELECT * FROM customer where id =". $POST['customers']);
            $customerDetails= $customerFetch->fetch();

            $sqlFixed = $this->databaseLoader->getConnection()->query("Alter table customer_group modify fixed_discount int;");
            $sqlVariable = $this->databaseLoader->getConnection()->query("Alter table customer_group modify variable_discount int;");

            $sqlCustomerGroup = $this->databaseLoader->getConnection()->query("select id, name, ifnull(parent_id,0), ifnull(fixed_discount,0),  ifnull(variable_discount,0) from customer_group
            where id = (select parent_id from customer_group where id =(select group_id from customer where  id =" . $customerDetails['id'] . "))
            or id=(select group_id from customer where  id =" . $customerDetails['id'] . ") 
            or id = (select parent_id from customer_group where id = (select parent_id from customer_group where id =(select group_id from customer where  id =" . $customerDetails['id'] . ")));");
            $customerGroupArray = [];
            while ($row = $sqlCustomerGroup->fetch()) {
                $customerGroupArray[] = new CustomerGroup($row[0], $row[1], $row[2], $row[3], $row[4]);
            }

            $sqlGetMaxVariableDiscount = $this->databaseLoader->getConnection()->query("select MAX(variable_discount) from customer_group
            where id = (select parent_id from customer_group where id =(select group_id from customer where  id =" . $customerDetails['id'] . "))
            or id=(select group_id from customer where  id =" . $customerDetails['id'] . ") 
            or id = (select parent_id from customer_group where id = (select parent_id from customer_group where id =(select group_id from customer where  id =" . $customerDetails['id'] . ")));");
            $fetchMaxVariableDiscount = $sqlGetMaxVariableDiscount->fetch();
            $maxVariableDiscount = $fetchMaxVariableDiscount[0];
        }

        // you should not echo anything inside your controller - only assign vars here

        // Models will be responsible for getting the data, for example if you want to get some students from a database:
        // $students = StudentHelper::getAllStudents();
        // The line above this one will use a StudentHelper model that you can make and require in this file
        // the getAllStudents is a static method, which means you can call this function without an instance of your StudentHelper
        // If you want to learn more about static methods -> https://www.w3schools.com/Php/php_oop_static_methods.asp

        // then the view will actually display them.

        //load the view
        require 'View/homepage.php';
    }
}
