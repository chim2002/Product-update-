<?php
$conn = new mysqli("localhost", "root", "", "db");
if($conn->connect_error){
    die("Connection failed". $conn->connect_error);
}
?>

<?php
$PID = $_GET['P_ID'] ?? '';
$product = null;

if($PID){
    $sql = "SELECT * FROM product WHERE P_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $PID);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];

    $sql = "UPDATE product SET name = ?, price = ?, qty = ? WHERE P_ID = ? ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sdii', $name, $price, $qty, $PID);

    if($stmt->execute()){
        echo "<script> alert('Updated Successfully!');window.location.href='products.php';</script>";
    }
    else{
        echo "Error: " . $stmt->error;
    }
}

?>

<html>
    <head>
      <title>Products Update</title>
    </head>
    <body>
        <?php if($product): ?>
        <form method="post">

            <label for="name">Product Name</label><br>
            <input type="text" placeholder="Product Name" name="name" value="<?=htmlspecialchars($product['name'])?>"><br>

            <label for="price">Price</label><br>
            <input type="text" placeholder="Price" name="price" value="<?=htmlspecialchars($product['price'])?>"><br>

            <label for="qty">Quantity</label><br>
            <input type="text" placeholder="Quantity" name="qty" value="<?=htmlspecialchars($product['qty'])?>"><br><br>

            <input type="submit" value="Update">

        </form>
        <?php else: ?>
            <p> Product not found </p>
        <?php endif; ?>   
    </body>
</html> 
