<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iDiscuss-Coding Forums</title>
    <style>
        .container {
            min-height: 90vh;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

</head>

<body>
    <?php include 'partials/_dbconnect.php';?>
    <?php include 'partials/_navbar.php';?>
    <?php include 'partials/_loginModal.php';?>
    <?php include 'partials/_signupModal.php';?>

    <div class="container my-2">
        <h1 class="py-2">Search results for <em>"
                <?php echo $_GET['search'] ?>"
            </em></h1>
        <?php
        $noresults=true;
$query=$_GET["search"];
      $sql="SELECT * FROM `threads` WHERE match (thread_title,thread_title) against ('$query')";
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_assoc($result)){
    $results=false;
    $title=$row['thread_title'];
    $desc=$row['thread_desc'];
    $thread_id=$row['thread_id'];
    $url="thread.php?threadid=" . $thread_id;
    echo '<div class="result">
    <h3><a href="'. $url .'" class="text-dark">'. $title .'</a></h3>
    <p>'. $desc .'</p>
</div>
</div>';
    

}
if ($noresults){
    echo '<div class="jumbotron jumbotron-fluid">
            <div class="container">
                <p class="display-5">No Results Found</p>
                <p class="lead"> Suggestions: <ul>
                        <li>Make sure that all words are spelled correctly.</li>
                        <li>Try different keywords.</li>
                        <li>Try more general keywords. </li></ul>
                </p>
            </div>
         </div>';
}       

      ?>

        <?php include 'partials/_footer.php';?>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
            </script>
</body>

</html>