<?php require 'includes/header.php'?>
<!-- this is the view, try to put only simple if's and loops here.
Anything complex should be calculated in the model -->
<section>
    <h4>Hello <?php echo $_ENV['DATABASE_NAME']?>,</h4>

    <p><a href="index.php?page=info">To info page</a></p>

    <p>Put your content here.</p>

    <label for="cars">Choose a car:</label>

    <select name="cars" id="cars">
        <?php


        foreach ($productsArray as $product){
            $name = ucfirst($product->getProductName());
            $price = number_format($product->getProductPrice() / 100, 2);
            echo "<option value=" .$name . ">" . $name . "</option>";
        }


        ?>
    </select>
<!--        . $price . "<br>";-->
</section>
<?php require 'includes/footer.php'?>