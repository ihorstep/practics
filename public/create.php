<?php
    if (isset($_POST['submit'])) {
        require "../config.php";

        $new_user = array(
            "name" => $_POST['firstname'],
            "age"     => $_POST['email'],
            "phone"       => $_POST['age']
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

        } catch(PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    }
?>

<?php include "templates/header.php"; ?>
<h2>Add a user</h2>

<form method="post">
    <label for="firstname">First Name</label>
    <input type="text" name="firstname" id="firstname">
    <label for="lastname">Last Name</label>
    <input type="text" name="lastname" id="lastname">
    <label for="email">Email Address</label>
    <input type="text" name="email" id="email">
    <label for="age">Age</label>
    <input type="text" name="age" id="age">
    <label for="location">Location</label>
    <input type="text" name="location" id="location">
    <input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>

<?php include "templates/footer.php"; ?>
