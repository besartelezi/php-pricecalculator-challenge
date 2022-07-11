<?php require 'includes/header.php'?>
<!-- this is the view, try to put only simple if's and loops here.
Anything complex should be calculated in the model -->
<section>
<!--    original code from boilerplate-->
<!--    <h4>Hello --><?php //echo $_ENV['DATABASE_NAME']?><!--,</h4>-->
<!---->
<!--    <p><a href="index.php?page=info">To info page</a></p>-->
<!---->
<!--    <p>Put your content here.</p>-->
<form method="post">
    <label for="products">Choose a product:</label>

    <select name="products" id="products">
        <?php
        foreach ($productsArray as $product){
            $productName = ucfirst($product->getProductName());
            $productID = $product->getProductID();
            echo "<option value=" .$productID . ">" . $productName . "</option>";
        }
        ?>
    </select>

    <label for="customers">Choose a customer:</label>

    <select name="customers" id="customers">
        <?php
        foreach ($customersArray as $customer){
            $customerID = $customer ->getCustomerID();
            $firstName = ucfirst($customer->getFirstName());
            $lastName = ucfirst($customer->getLastName());
            $fullName = $firstName . " " . $lastName;
            echo "<option value=" .$customerID. "> ".$fullName ." </option>";
        }
        ?>
    </select>
    <button type="submit" class="btn btn-primary" name="submit">Send</button>
</form>

    <?php
    if (isset($POST['submit'])){
        echo "Product name: " .$productDetails['name'] ."<br>";
        echo "Price: €" .$productDetails['price']/100 ."<br>";
//        var_dump($customerDetails); //to check if group id is correct and if we can get correct info out of database
//        var_dump($productDetails);
    }
    ?>

<!-- code to get price -->
<!--    $price = number_format($product->getProductPrice() / 100, 2);-->
</section>
<?php require 'includes/footer.php'?>