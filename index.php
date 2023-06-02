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
    <?php include 'partials/_loginModal.php';?>
    <?php include 'partials/_signupModal.php';?>
    <div id="carouselExampleIndicators" class="carousel slide ">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://picsum.photos/id/26/2500/700" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://picsum.photos/id/20/2500/700" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://picsum.photos/id/7/2500/700" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="container ">
        <h3 class="text-center my-2 mb-3" style=> iDiscuss- Browse Categories</h3>
        <div class="row">
            <?php
    $sql="SELECT * FROM `idiscuss`";
    $result=mysqli_query( $conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
        // echo $row['Category_id'];
        // echo $row['category_name'];
        $cat= $row['category_name'];
        $catedesc= $row['category_desc'];
        $id=$row['Category_id'];

        echo '<div class="col-md-4 mb-3">
            <div class="card" style="width: 18rem;">
      <img src="https://picsum.photos/id/1/200/150" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title"><a href="threadlist.php?catid=' . $id. '">' . $cat . '</a></h5>
        <p class="card-text">'. substr($catedesc, 0,90) . '...</p>
        <a href="threadlist.php?catid=' . $id . '" class="btn btn-primary">View threads</a>
              </div>
            </div>
           </div>';
           
        }
        
        ?>
        </div>
        </div>
            <?php include 'partials/_footer.php';?>

            
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
            crossorigin="anonymous"></script>
        </body>

</html>