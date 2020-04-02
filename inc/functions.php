<?php

//Function that returns an array opf data for a specific request from the database.
function detail() {

    include('connection.php');

    //Sanitizing input data before sending to database.
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    //Statement to choose the appropriate data to get from the database.
    switch($id) {

        case 1:
            $offsetCondition = " OFFSET 1";         
        break; 

        case 2:
            $offsetCondition = " OFFSET 2";
        break;

        case 3:
            $offsetCondition = " OFFSET 3"; 
        break;

        default:
            $offsetCondition = "";

    }

     // If conditions are met, the database is queried.
    try 
    {
        $sql = "SELECT * FROM entries ORDER BY date DESC LIMIT 1" . "$offsetCondition";
        $stmt = $db->prepare($sql);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            return $row;

        }
    } catch (Exception $e) {

        echo "Error: ". $e->getMessage();

    }

}

//Function to get the latest 4 entries from the date sorted by date in descending order. Will show only 4 HTML items. 
function get_html_item() {

    include('connection.php');

    $html = [];
    $id   = 0;

    $sql =("SELECT * FROM entries ORDER BY date DESC LIMIT 4");

    $stmt = $db->prepare($sql);
    $stmt->execute();

    foreach ($rows = $stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
        
        $html[] =  "<article>
         <h2><a href='detail.php?id=".$id++."'>$row[title]</a></h2>
        <time datetime='2020-03-29'>". date('F d, Y', strtotime($row['date'])). "</time>
        </article>";

    }

    return $html;

}
