<?php

if (isset($_POST['submit'])) {
    if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();

    require "../config.php";
    require "../common.php";

    $new_user = array(
        "name" => $_POST['name'],
        "age" => $_POST['age'],
        "phone" => $_POST['phone']
    );

    try {
        $connection = new PDO($dsn, $username, $password, $options);
        $sql = sprintf(
            "INSERT INTO %s (%s) values (%s)",
            "clients",
            implode(", ", array_keys($new_user)),
            ":" . implode(", :", array_keys($new_user))
        );
        $statement = $connection->prepare($sql);
        $statement->execute($new_user);

    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>

<?php include "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) { ?>
    <?php echo escape($_POST['name']); ?> successfully added.
<?php } ?>

<h2>Add a user</h2>

<form method="post">
    <label for="name">Last Name</label>
    <input type="text" name="name" id="name">
    <label for="age">Age</label>
    <input type="text" name="age" id="age">
    <label for="phone">Phone</label>
    <input type="text" name="phone" id="phone">
    <input type="submit" name="submit" value="Submit">
    <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
</form>

<a href="index.php">Back to home</a>


<?php include "templates/footer.php"; ?>
