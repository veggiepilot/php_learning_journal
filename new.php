<?php
    // Declaring the variable $message as an empty string. 
    $message = '';

    //Determing the form method. If it is "POST" the condition will be triggered. 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        include('inc/connection.php');

            //Sanitizing input data from the user submitted form.
            $title               = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING));
            $date                = trim(filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING));
            $timeSpent           = trim(filter_input(INPUT_POST, 'timeSpent', FILTER_SANITIZE_STRING));
            $whatILearned        = trim(filter_input(INPUT_POST, 'whatILearned', FILTER_SANITIZE_STRING));
            $resourcesToRemember = trim(filter_input(INPUT_POST, 'resourcesToRemember', FILTER_SANITIZE_STRING));

            //Making sure all the data in the form field is entered
            if (!empty($title) && !empty($date) && !empty($timeSpent) && !empty($whatILearned) && !empty($resourcesToRemember)) {

                // If conditions are met, input data is entered into the database.
                try{
                    
                    $sql = "INSERT INTO entries ('title', 'date', 'time_spent', 'learned', 'resources') 
                            VALUES ('$title', '$date', '$timeSpent', '$whatILearned', '$resourcesToRemember')";

                    $stmt = $db->prepare($sql);
                    $stmt->execute();

                

                } catch (Exception $e) {

                    echo "Error: ". $e->getMessage();

                }

                header('Location: index.php?success');

            }  else {

                //Setting message if one of the fields is left blank.
                $message = "<div class='alert alert-danger' role='alert'> Please make sure all the fields are entered! </div>";
            }

    } 

    include('inc/header.php');

?>
        <section>
            <div class="container">
                <div class="new-entry">

               <!-- Printing message to say if there is field missing  -->
                <?php echo $message; ?>
 
                    <h2>New Entry</h2>

                    <form method='POST' action='new.php'>
                        <label for="title"> Title</label>
                        <input id="title" type="text" name="title"><br>
                        <label for="date">Date</label>
                        <input id="date" type="date" name="date"><br>
                        <label for="time-spent"> Time Spent</label>
                        <input id="time-spent" type="text" name="timeSpent"><br>
                        <label for="what-i-learned">What I Learned</label>
                        <textarea id="what-i-learned" rows="5" name="whatILearned"></textarea>
                        <label for="resources-to-remember">Resources to Remember</label>
                        <textarea id="resources-to-remember" rows="5" name="resourcesToRemember"></textarea>
                        
                        <input type="submit" value="Publish Entry" class="button" name="submit">
                        <a href="#" class="button button-secondary">Cancel</a>
                    </form>

                </div>
            </div>
        </section>

<?php
include('inc/footer.php');
?>