<?php

//Each html item is assigned an ID number. This is verifying if the ID is set. 
if (isset($_GET['id'])) {
    include('inc/connection.php');

    // If conditions are met, the database is queried.
    try {

        $sql = "DELETE FROM entries WHERE id = ? ";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(1, $_GET['id'], PDO::PARAM_INT);
        $stmt->execute();

    } catch (Exception $e) {

        echo "Error: " . $e->getMessage();

    }

    // Redirecting to the home page once the entry has been deleted.
    header("Location: index.php");
}

