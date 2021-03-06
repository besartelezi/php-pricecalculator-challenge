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
            $customersArray[] = new Customer($row[0], $row[1], $row[2], $row[3]);
        }

        if (isset($_POST['submit'])) {
            $productFetch = $this->databaseLoader->getConnection()->query("SELECT * FROM product where id =" . $POST['products']);
            $productDetails = $productFetch->fetch();
            $customerFetch = $this->databaseLoader->getConnection()->query("SELECT * FROM customer where id =" . $POST['customers']);
            $customerDetails = $customerFetch->fetch();

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


            //get highest variable discount from customer group
            $sqlGetMaxVariableDiscount = $this->databaseLoader->getConnection()->query("select MAX(variable_discount) from customer_group
            where id = (select parent_id from customer_group where id =(select group_id from customer where  id =" . $customerDetails['id'] . "))
            or id=(select group_id from customer where  id =" . $customerDetails['id'] . ") 
            or id = (select parent_id from customer_group where id = (select parent_id from customer_group where id =(select group_id from customer where  id =" . $customerDetails['id'] . ")));");
            $fetchMaxVariableDiscount = $sqlGetMaxVariableDiscount->fetch();
            $maxVariableDiscount = $fetchMaxVariableDiscount[0];


            //get the sum of all fixed discounts from customer group
            $sqlGetSumFixedDiscounts = $this->databaseLoader->getConnection()->query("select sum(ifnull(fixed_discount,0)) from customer_group
            where id = (select parent_id from customer_group where id =(select group_id from customer where  id =" . $customerDetails['id'] . "))
            or id=(select group_id from customer where  id =" . $customerDetails['id'] . ") 
            or id = (select parent_id from customer_group where id = (select parent_id from customer_group where id =(select group_id from customer where  id =" . $customerDetails['id'] . ")));");
            $fetchSumFixedDiscounts = $sqlGetSumFixedDiscounts->fetch();
            $sumFixedDiscountsCustomerGroup = $fetchSumFixedDiscounts[0];

            //get the flat value of highest variable discount according to price of product
            $productPriceWithoutDiscount = $productDetails['price'] / 100;
            $variableDiscountCustomerGroupValue = number_format($productPriceWithoutDiscount / 100 * $maxVariableDiscount, 2);

            //checking what discounts are used and which ones aren't
            //this will be needed in the view
            $customerGroupFixedDiscountCheck = false;
            $customerGroupVariableDiscountCheck = false;
            $customerFixedDiscountCheck = true;
            $customerVariableDiscountCheck = false;

            //check if customer has fixed discount
            $customerFixedDiscount = $customerDetails['fixed_discount'];
            if ($customerFixedDiscount === null) {
                $customerFixedDiscount = 0;
                $customerFixedDiscountCheck = false;
            }


            $customerVariableDiscount = $customerDetails['variable_discount'];
            $priceWithDiscount = $productPriceWithoutDiscount;
            $priceWithDiscount -= $customerFixedDiscount;

            //decide if sum of fixed discounts or highest variable discount gives best value for customer
            if ($variableDiscountCustomerGroupValue < $sumFixedDiscountsCustomerGroup) {
                $discountCustomerGroup = $sumFixedDiscountsCustomerGroup;
                $priceWithDiscount -= $discountCustomerGroup;
                $customerGroupFixedDiscountCheck = true;
            } elseif ($variableDiscountCustomerGroupValue > $sumFixedDiscountsCustomerGroup) {
                $discountCustomerGroup = $variableDiscountCustomerGroupValue;
            }
                //decide if customer group variable or customer variable discount is the best value for the customer
                if ($customerVariableDiscount === null) {
                    $customerVariableDiscount = 0;
                    $finalVariableDiscount = $discountCustomerGroup;
                    $priceWithDiscount -= $finalVariableDiscount;
                    $customerGroupVariableDiscountCheck = true;
                }else if ($maxVariableDiscount > $customerVariableDiscount) {
                    $finalVariableDiscount = $discountCustomerGroup;
                    $priceWithDiscount -= $finalVariableDiscount;
                    $customerGroupVariableDiscountCheck = true;
                } else {
                    $finalVariableDiscount = $customerVariableDiscount;
                    $priceWithDiscount -= number_format(($productPriceWithoutDiscount / 100 * $finalVariableDiscount), 2);
                    $customerVariableDiscountCheck = true;
                }
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
