<?php

//Each html item is assigned an ID number. This is verifying if the ID is set. 
if (isset($_GET['id'])) {
    include('inc/connection.php');

    //Sanitizing input data before sending to database.
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    // If conditions are met, the database is queried.
    try {

        $sql = "DELETE FROM entries WHERE id = ? ";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();

    } catch (Exception $e) {

        echo "Error: " . $e->getMessage();

    }

    // Redirecting to the home page once the entry has been deleted.
    header("Location: index.php");
}

