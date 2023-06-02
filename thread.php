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
   
    <?php 
    $id=$_GET['threadid'];
    $sql="SELECT * FROM `threads` WHERE thread_id=$id";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
        $title=$row['thread_title'];
        $desc=$row['thread_desc'];
        $thread_user_id = $row['thread_user_id'];
        // Query the users table to find out the name of OP
        $sql2 = "SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $posted_by = $row2['user_email'];

    }
    ?>
    <?php
    $showAlert=false;
    $method= $_SERVER['REQUEST_METHOD'];
    if($method=='POST'){
        $comment = $_POST['comment']; 

        $comment = str_replace("<", "&lt;", $comment);
        $comment = str_replace(">", "&gt;", $comment); 



$sno=$_POST['sno'];
$sql="INSERT INTO `comments` ( `comment_content`, `thread_id`, `comment_time`, `comment_by`) VALUES ( '$comment', '$id', current_timestamp(), '$sno')";
    $result=mysqli_query($conn,$sql);
    $showAlert=true;
    if($showAlert)
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Your comment has been added!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div> ';
    };
   
    ?>

    <div class="container  my-4">
        <div class="jumbotron">
            <h3 class="display-4"><?php echo $title;?></h3>
            <p class="lead"><?php echo $desc;?></p>
            <hr class="my-4">
            <p>Forum rules and posting guidelines
            <ul>
                <li>Keep it friendly.</li>
                <li>Be courteous and respectful. Appreciate that others may have an opinion different from yours.</li>
                <li>Stay on topic. ...</li>
                <li>Share your knowledge. ...</li>
                <li>Refrain from demeaning, discriminatory, or harassing behaviour and speech.</li>
            </ul>
            </p>
           <p><em> Posted by: <?php echo $posted_by; ?></em></p>

        </div>
    </div>
    <hr></br>

    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true ){

        echo' <div class="container">
             <h1>Post your comment</h1>
             <form action="' .  $_SERVER['REQUEST_URI'] . '" method="post">
                 
             <div class="form-group mb-3">
                 <label for="desc" class="form-label">Type your comment</label>
                 <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                 <input type="hidden" name="sno" value="'. $_SESSION["sno"] .'">
                 
             </div>
             <button type="submit" class="btn btn-primary">Post comment</button>
         </form>
     </div>';
    }
    else{
        echo '
        <div class="container">
        <p class="lead">You are not logged in. Please logged in to post  comment.</p>
         
        </div> ';
    }
            ?>
    <div class="container">
        <h2>Discussions</h2>
        <?php
        $id=$_GET['threadid'];
        $sql="SELECT * FROM `comments` WHERE thread_id=$id";
        $result=mysqli_query($conn,$sql);
        $noresult=true;
        while($row=mysqli_fetch_assoc($result)){
            $noresult=false;
          $id=$row['comment_id'];
        $content=$row['comment_content'];
        $comment_time=$row['comment_time'];
        $thread_user_id=$row['comment_by'];
        $sql2="SELECT user_email FROM users WHERE sno='$thread_user_id'";
        $result2=mysqli_query($conn,$sql2);
        $row2=mysqli_fetch_assoc($result2);
        

        echo '<div class="d-flex mt-2">
        <div class="flex-shrink-0">
        <img src="https://img.freepik.com/premium-vector/avatar-profile-icon-vector-illustration_276184-165.jpg"
        width="65px" alt="...">
        </div>
        <div class="flex-grow-1 ms-3">
       <p class="fs-5 mb-0">'.$row2['user_email'] .' at ' . $comment_time . '</p>
        '. $content .'
        </div>
        </div>';
      }

      if($noresult){
        echo '<div class="jumbotron jumbotron-fluid">
        <div class="container">
          <h1 class="display-6">No Comments found</h1>
          <p class="lead" >Be the first person to comment</p>
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