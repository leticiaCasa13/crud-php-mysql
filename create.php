<?php
require "../config.php";
require "../common.php";

$success = null;

if (isset($_POST["submit"])) {
    if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();

    try {
        $connection = new PDO($dsn, $user, $pass, $options);
        
        $sql = "INSERT INTO users (firstname, lastname, email, age, location, date) VALUES (:firstname, :lastname, :email, :age, :location, :date)";
        
        $statement = $connection->prepare($sql);
        $statement->bindValue(':firstname', $_POST['firstname']);
        $statement->bindValue(':lastname', $_POST['lastname']);
        $statement->bindValue(':email', $_POST['email']);
        $statement->bindValue(':age', $_POST['age']);
        $statement->bindValue(':location', $_POST['location']);
        $statement->bindValue(':date', $_POST['date']);
        
        $statement->execute();
        
        $success = "User successfully added.";
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>

<?php require "templates/header.php"; ?>
<h2>Add User</h2>

<?php if ($success) echo $success; ?>

<form method="post">
    <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
    <label for="firstname">First Name</label>
    <input type="text" name="firstname" id="firstname" required>
    <label for="lastname">Last Name</label>
    <input type="text" name="lastname" id="lastname" required>
    <label for="email">Email</label>
    <input type="email" name="email" id="email" required>
    <label for="age">Age</label>
    <input type="number" name="age" id="age" required>
    <label for="location">Location</label>
    <input type="text" name="location" id="location" required>
    <label for="date">Date</label>
    <input type="date" name="date" id="date" required>
    <input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>
