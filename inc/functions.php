<?php

//Function that returns an array of data for a specific request from the database.
function detail() {

    include('connection.php');

    //Sanitizing input data before sending to database.
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

     // If conditions are met, the database is queried.
    try 
    {
        $sql = "SELECT * FROM entries WHERE id = ? ORDER BY date DESC";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            return $row;

        }
    } catch (Exception $e) {

        echo "Error: ". $e->getMessage();

    }

}

//Function to get all the entries from the database sorted by date in descending order.
function get_html_item() {

    include('connection.php');

    $html = [];
    $id   = 0;

    $sql =("SELECT * FROM entries ORDER BY date DESC");

    $stmt = $db->prepare($sql);
    $stmt->execute();

    foreach ($rows = $stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
        
        $html[] =  "<article>
         <h2><a href='detail.php?id=".$row['id']."'>$row[title]</a></h2>
        <time datetime='2020-03-29'>". date('F d, Y', strtotime($row['date'])). "</time>
        </article>";

    }

    return $html;

}
