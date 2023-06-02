<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iDiscuss-Coding Forums</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

</head>

<body>
    <?php include 'partials/_dbconnect.php';?>
    <?php include 'partials/_navbar.php';?>
    <?php 
    $id=$_GET['catid'];
    $sql="SELECT * FROM `idiscuss` WHERE Category_id=$id";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
        $catname=$row['category_name'];
        $catdesc=$row['category_desc'];

    }
    ?>
    <?php
    $showAlert=false;
    $method= $_SERVER['REQUEST_METHOD'];
    if($method=='POST'){
        $th_title = $_POST['title'];
        $th_desc = $_POST['desc'];

        $th_title = str_replace("<", "&lt;", $th_title);
        $th_title = str_replace(">", "&gt;", $th_title); 

        $th_desc = str_replace("<", "&lt;", $th_desc);
        $th_desc = str_replace(">", "&gt;", $th_desc); 
$sno=$_POST['sno'];
$sql="INSERT INTO `threads` ( `thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title','$th_desc', '$id', '$sno', current_timestamp())";
    $result=mysqli_query($conn,$sql);
    $showAlert=true;
    if($showAlert)
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Your thread has been added!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div> ';
    };
   
    ?>

    <div class="container  my-4">
        <div class="jumbotron">
            <h3 class="display-4">Welcome to <?php echo $catname;?> Forums</h3>
            <p class="lead"><?php echo $catdesc;?></p>
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
            <a class="btn btn-primary btn-lg" href="https://docs.python.org/3/" target="_blank" role="button">Learn
                more</a>

        </div>
    </div>
    <hr></br>

    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){

        echo'  <div class="container">
              <h1>Start a Discussion</h1>
              <form action="'. $_SERVER['REQUEST_URI'] .'" method="post">
                  <div class=" form-group mb-3">
                  <label for="title" class="form-label">Problem Title</label>
                  <input type="text" class="form-control" id="title" name="title" placeholder="title">
                  <small id="title" class="form-text text-muted">Keep your title as short as possible</small>
              </div>
              <input type="hidden" name="sno" value="'. $_SESSION["sno"]. '">
              <div class="form-group mb-3">
                  <label for="desc" class="form-label">Elloborate your title</label>
                  <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
          </form>
      </div>';
    }
    else{
        echo '
        <div class="container">
        <p class="lead">You are not logged in. Please logged in to able to start a conversation.</p>
         
        </div> ';
    }
            ?>

    <div class="container">
        <h2>Browse Questions</h2>
        <?php
        $id=$_GET['catid'];
        $sql="SELECT * FROM `threads` WHERE thread_cat_id=$id;";
        $result=mysqli_query($conn,$sql);
        $noresult=true;
        while($row=mysqli_fetch_assoc($result)){
            $noresult=false;
            $id=$row['thread_id'];
            $threadtime=$row['timestamp'];
            $threadtitle=$row['thread_title'];
            $threaddesc=$row['thread_desc'];
            $thread_user_id=$row['thread_user_id'];
            $sql2="SELECT user_email FROM users WHERE sno='$thread_user_id'";
            $result2=mysqli_query($conn,$sql2);
            $row2=mysqli_fetch_assoc($result2);
            



        echo '<div class="d-flex mt-2 mb-3">
        <div class="flex-shrink-0">
        <img src="https://img.freepik.com/premium-vector/avatar-profile-icon-vector-illustration_276184-165.jpg"
        width="65px" alt="...">
        </div>
        <div class="flex-grow-1 ms-3">
        <p class="font-weight-bold my-0">Asked by ' . $row2['user_email'] .' at ' . $threadtime .'</p>
        <h5 ><a class="text-dark" href="thread.php?threadid=' . $id. '">' . $threadtitle . '</a></h5>
        '. $threaddesc .'
        </div>
        </div>';
      }
      if($noresult){
        echo '<div class="jumbotron jumbotron-fluid">
        <div class="container">
          <h1 class="display-6">No Result found</h1>
          <p class="lead" >Be the first person to ask the question.</p>
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