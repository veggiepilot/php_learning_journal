<?php
include('inc/header.php');

//Each html item is assigned an ID number. This is verifying if the ID is set. If it is, we call the detail function.
if (isset($_GET['id'])) {
    include('inc/functions.php');
    $detail = detail();

}

//If the edit button has been clicked, the condition will be executed. 
if (isset($_POST['edit'])) {
    include('inc/connection.php');

    //Sanitizing input data before sending to database.
    $title               = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING));
    $date                = trim(filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING));
    $timeSpent           = trim(filter_input(INPUT_POST, 'timeSpent', FILTER_SANITIZE_STRING));
    $whatILearned        = trim(filter_input(INPUT_POST, 'whatILearned', FILTER_SANITIZE_STRING));
    $resourcesToRemember = trim(filter_input(INPUT_POST, 'ResourcesToRemember', FILTER_SANITIZE_STRING));

    // If conditions are met, input data is entered into the database.
    try{
        
        $sql = "UPDATE entries 
                SET 
                title       = '$title', 
                date        = '$date', 
                time_spent  = '$timeSpent', 
                learned     = '$whatILearned', 
                resources   = '$resourcesToRemember'  
                WHERE id    = '$detail[id]'";


       $stmt = $db->prepare($sql);
       $stmt->execute();
  

    } catch (Exception $e) {

        echo "Error: ". $e->getMessage();

    }
    // Redirecting to the home page once the entry has been edited.
    header("Location: index.php?success=edit");

}

?>
        <section>
            <div class="container">
                <div class="edit-entry">
                    <h2>Edit Entry</h2>
                    <form method="POST" action="">
                        <label for="title"> Title</label>
                        <input id="title" type="text" name="title" value="<?php echo $detail['title']; ?>"><br>
                        <label for="date">Date</label>
                        <input id="date" type="date" name="date" value="<?php echo $detail['date']; ?>"><br>
                        <label for="time-spent"> Time Spent</label>
                        <input id="time-spent" type="text" name="timeSpent" value="<?php echo $detail['time_spent']; ?>"><br>
                        <label for="what-i-learned">What I Learned</label>
                        <textarea id="what-i-learned" rows="5" name="whatILearned"><?php echo $detail['learned']; ?></textarea>
                        <label for="resources-to-remember">Resources to Remember</label>
                        <textarea id="resources-to-remember" rows="5" name="ResourcesToRemember" ><?php echo $detail['resources'];?></textarea>
                        <input type="submit" value="Edit Entry" class="button" name="edit">
                        <a href="index.php" class="button button-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </section>
<?php
include('inc/footer.php');