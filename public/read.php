<?php

require "../config.php";
require "../common.php";

if (isset($_POST['submit'])) {
    if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();
    try {


        $connection = new PDO($dsn, $username, $password, $options);
        $sql = "SELECT *  FROM clients;";
        $statement = $connection->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>

<?php include "templates/header.php"; ?>
<?php if (isset($_POST['submit'])) {
    if ($result && $statement->rowCount() > 0) { ?>
    <h2>Results</h2>

    <table>
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Age</th>
            <th>Phone</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($result as $row) { ?>
            <tr>
                <td><?php echo escape($row["id"]); ?></td>
                <td><?php echo escape($row["name"]); ?></td>
                <td><?php echo escape($row["age"]); ?></td>
                <td><?php echo escape($row["phone"]); ?> </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
<?php } else { ?>
    > No results found
<?php }
} ?>
    <h2>Find user based on location</h2>

    <form method="post">
        <label for="location">Location</label>
        <input type="text" id="location" name="location">
        <input type="submit" name="submit" value="View Results">
        <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">

    </form>

    <a href="index.php">Back to home</a>
<?php include "templates/footer.php"; ?>