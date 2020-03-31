<?php
include('inc/header.php');
include('inc/functions.php');
//Calling the detail function.
$detail     = detail();

?>
        <section>
            <div class="container">
                <div class="entry-list single">
                    <article>
                        <h1><?php echo $detail['title']; ?></h1>
                        <time datetime="2016-01-31"><?php echo date("F d, Y", strtotime($detail['date'])); ?></time>
                        <div class="entry">
                            <h3>Time Spent: </h3>
                            <p><?php echo $detail['time_spent']; ?></p>
                        </div>
                        <div class="entry">
                            <h3>What I Learned:</h3>
                            <p><?php echo $detail['learned'];?></p>
                        </div>
                        <div class="entry">
                            <h3>Resources to Remember:</h3>
                            <ul>
                                <li><a href=""></a><?php echo $detail['resources']; ?></li>
                                <li><a href=""></a></li>
                                <li></li>
                                <li><a href=""></a></li>
                            </ul>
                        </div>
                    </article>
                </div>
            </div>
            <div class="edit">
                <p><a href="edit.php?id=<?php echo $_GET['id']; ?>" name="edit">Edit Entry</a></p>
                <form method="POST" action="delete.php?id=<?php echo $detail[id]; ?>">
                    <button type="submit" class="btn btn-danger">Delete Entry</button>
                </form>
                
            </div>
        </section>
<?php
include('inc/footer.php');
?>