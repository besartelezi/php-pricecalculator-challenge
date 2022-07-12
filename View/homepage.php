<?php require 'includes/header.php' ?>
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
                foreach ($productsArray as $product) {
                    $productName = ucfirst($product->getProductName());
                    $productID = $product->getProductID();
                    echo "<option value=" . $productID . ">" . $productName . "</option>";
                }
                ?>
            </select>

            <label for="customers">Choose a customer:</label>

            <select name="customers" id="customers">
                <?php
                foreach ($customersArray as $customer) {
                    $customerID = $customer->getCustomerID();
                    $firstName = ucfirst($customer->getFirstName());
                    $lastName = ucfirst($customer->getLastName());
                    $fullName = $firstName . " " . $lastName;
                    echo "<option value=" . $customerID . "> " . $fullName . " </option>";
                }
                ?>
            </select>
            <button type="submit" class="btn btn-primary" name="submit">Send</button>
        </form>

        <?php
        if (isset($POST['submit'])) {
            echo "Choses customer: " . $customerDetails['firstname'] . " " . $customerDetails['lastname'] . "<br>";
            echo "Product name: " . $productDetails['name'] . "<br>";
            echo "Price: €" . $productPriceWithoutDiscount . "<br>";


            //to check if group id is correct and if we can get correct info out of database
            echo "value of the customer group variable discount according to product price: ";
            echo $variableDiscountCustomerGroupValue . "<br>";
            echo "value of sum of fixed discounts customer group: ";
            echo $sumFixedDiscountsCustomerGroup . "<br>";
            echo "most valuable discount customer group: ";
            echo $discountCustomerGroup . "<br>";
            echo "add customer fixed discount to total discount of customer group: <br> ";
            echo "Fixed discount customer group total: ";
            echo $sumFixedDiscountsCustomerGroup . "<br>";
            echo "fixed discount customer: ";
            echo $customerFixedDiscount . "<br>";
            echo "variable discount customer: ";
            echo $customerVariableDiscount . "<br>";
            echo 'The final price is: ';
            if ($priceWithDiscount <= 0) {
                echo '<img src ="./resources/images/its-free-real-sate.gif">';
            } else {
                echo $priceWithDiscount;
            }

            echo '<table class="table table-sm">';
            echo '<thead>
        <tr>
        <th scope="col">Discount Types</th>
        <th scope="col">Discount Values</th>
        </tr>
        </thead>
        <tbody>
        <tr>';
            //Checking if the customerFixedDiscount was used or not and give it the proper colour background
            if ($customerFixedDiscountCheck) {
                echo '<td class="table-success">Customer fixed discount</td>
        <td class="table-success">' . $customerFixedDiscount . '</td></tr>';
            }
            else {
                echo '<td class="table-danger">Customer fixed discount</td>
        <td class="table-danger">' . $customerFixedDiscount . '</td></tr>';
            }

            //Checking if the $customerVariableDiscountCheck was used or not and give it the proper colour background
            if ($customerVariableDiscountCheck) {
                echo '<td class="table-success">Customer variable discount</td>
        <td class="table-success">' . $customerVariableDiscount . '</td></tr>';
            }
            else {
                echo '<td class="table-danger">Customer variable discount</td>
        <td class="table-danger">' . $customerVariableDiscount . '</td></tr>';
            }

            //Checking if the $customerGroupFixedDiscountCheck was used or not and give it the proper colour background
            if ($customerGroupFixedDiscountCheck) {
                echo '<td class="table-success">Total of customer group fixed discount</td>
        <td class="table-success">' . $sumFixedDiscountsCustomerGroup . '</td></tr>';
            }
            else {
                echo '<td class="table-danger">Total of customer group fixed discount</td>
        <td class="table-danger">' . $sumFixedDiscountsCustomerGroup . '</td></tr>';
            }

            //Checking if the $customerGroupFixedDiscountCheck was used or not and give it the proper colour background
            if ($customerGroupVariableDiscountCheck) {
                echo '<td class="table-success">Highest customer group variable discount in €</td>
        <td class="table-success">' . $variableDiscountCustomerGroupValue . '</td></tr>';
            }
            else {
                echo '<td class="table-danger">Highest customer group variable discount in €</td>
        <td class="table-danger">' . $variableDiscountCustomerGroupValue . '</td></tr>';
            }
            echo '<td class="text-center" colspan="2" style="font-weight: bold; font-size: 35px">Total Price: '  . $priceWithDiscount . "€" .'</td></tr></tbody></table>';

                



        //<tr class="table-success">...</tr>
        //<tr class="table-danger">...</tr>

//        echo "<br>";
//        echo "is Customer group fixed discount used: ";
//        echo $customerGroupFixedDiscountCheck . '<br>';
//        echo "is Customer group variable discount used: ";
//        echo $customerGroupVariableDiscountCheck . '<br>';
//        echo "is Customer fixed discount used: ";
//        echo $customerFixedDiscountCheck . '<br>';
//        echo "is Customer variable discount used: ";
//        echo $customerVariableDiscountCheck . '<br>';
    }

        ?>

    </section>
<?php require 'includes/footer.php' ?>