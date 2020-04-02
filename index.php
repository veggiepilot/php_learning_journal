<?php
include('inc/header.php');
include('inc/functions.php');

//Calling the function that will show 4 entries sorted by date in descenting order. 
$items = get_html_item();

?>

        <section>
            <div class="container">
                <div class="entry-list">
                    <?php
                    // Alert message for when a record has been edited and created respectively.
                     if (isset($_GET['success']) && $_GET['success'] == 'edit') {
                        echo "<div class='alert alert-success' role='alert'>Your entry has been edited successfully!</div>";
                    } elseif (isset($_GET['success'])) {
                        echo "<div class='alert alert-success' role='alert'>Your entry has been recorded successfully!</div>";
                    }
                    foreach ($items as $item) { echo $item; }
                    ?>
                </div>
            </div>
        </section>

<?php
include('inc/footer.php');
?>