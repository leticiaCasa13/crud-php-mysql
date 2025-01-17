<?php
require "../config.php";
require "../common.php";

$success = null;

if (isset($_POST["submit"])) {
    if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();

    try {
        $connection = new PDO($dsn, $user, $pass, $options);
        
        $id = $_POST["submit"];
        $sql = "DELETE FROM users WHERE id = :id";

        $statement = $connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();

        $success = "User successfully deleted";
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

try {
    $connection = new PDO($dsn, $user, $pass, $options);

    $sql = "SELECT * FROM users";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();
} catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}
?>

<?php require "templates/header.php"; ?>
<h2>Delete Users</h2>

<?php if ($success) echo $success; ?>

<form method="post">
    <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email Address</th>
                <th>Age</th>
                <th>Location</th>
                <th>Date</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($result as $row) : ?>
            <tr>
                <td><?php echo escape($row["id"]); ?></td>
                <td><?php echo escape($row["firstname"]); ?></td>
                <td><?php echo escape($row["lastname"]); ?></td>
               
