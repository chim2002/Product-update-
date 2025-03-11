<?php
$conn = new mysqli("localhost", "root", "", "db");
if($conn->connect_error){
    die("Connection failed". $conn->connect_error);
}

$sql = "SELECT * FROM product";
$result = $conn->query($sql);
?>

<html>
<head>
    <title>Product List</title>
</head>
<body>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['P_ID'] ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['price']) ?></td>
                <td><?= htmlspecialchars($row['qty']) ?></td>
                <td><a href="updateProduct.php?P_ID=<?= $row['P_ID'] ?>">Edit</a></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
