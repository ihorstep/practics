<?php

require "../config.php";
require "../common.php";

if (isset($_POST['submit'])) {
    if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();

    try {
        $connection = new PDO($dsn, $username, $password, $options);
        $user =[
            "id"        => $_POST['id'],
            "name"  => $_POST['name'],
            "age"       => $_POST['age'],
            "phone"      => $_POST['phone']
        ];

        $sql = "UPDATE users
            SET id = :id,         
              name = :name,
              age = :age,
              phone = :phone,
            WHERE id = :id";

        $statement = $connection->prepare($sql);
        $statement->execute($user);
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

if (isset($_GET['id'])) {
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        $id = $_GET['id'];

        $sql = "SELECT * FROM users WHERE id = :id";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }

} else {
    echo "Something went wrong!";
    exit;
}
?>

<?php require "templates/header.php"; ?>

<h2>Edit a user</h2>

<form method="post">
    <?php foreach ($user as $key => $value) : ?>
        <label for="<?php echo $key; ?>">
            <?php echo ucfirst($key); ?>
        </label>
        <input
            type="text"
            name="<?php echo $key; ?>"
            id="<?php echo $key; ?>"
            value="<?php echo escape($value); ?>">
        <?php echo ($key === 'id' ? 'readonly' : null); ?>>
    <?php endforeach; ?>
    <input type="submit" name="submit" value="Submit">
    <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">

</form>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>
