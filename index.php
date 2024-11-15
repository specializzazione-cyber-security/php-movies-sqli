<?php
session_start();
require_once('db_connection.php');

// UNSECURE 

if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
    $sql = "SELECT * FROM movies WHERE title LIKE '%$searchTerm%'";
} else {
    $sql = "SELECT * FROM movies";
}

try {
    $result = mysqli_query($conn, $sql);
} catch (\Throwable $th) {
    //throw $th;
    die("Error: " . mysqli_error($conn));
    $error = "Error: " . mysqli_error($conn);
}

// if (isset($_GET['search'])) {
//     $searchTerm = $_GET['search'];
//     // Prepare the statement
//     $sql = "SELECT * FROM movies WHERE title LIKE ?";
//     $stmt = $conn->prepare($sql);
    
//     // Bind the parameter and execute the statement
//     $searchTerm = '%' . $searchTerm . '%';

//     $stmt->bind_param("s",$searchTerm);
// } else {
//     $sql = "SELECT * FROM movies";
//     $stmt = $conn->prepare($sql);
// }

// try {
//     $stmt->execute();
//     // Get the result
//     $result = $stmt->get_result();
// } catch (\Throwable $th) {
//     //throw $th;
//     //die("Error: " . mysqli_error($conn));
//     $error = "Error: " . mysqli_error($conn);
// }

?>
<!DOCTYPE html>
<html>
<head>
    <title>Homepage Film</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="bootstrap.min.css">
   <style>
        .hide{
            display: none;
        }
    </style>
</head>
<body>
<?php include "_nav.php";?>
    <div class="container">
        <h1 class="text-center my-4">Vulnerable Movie Platform</h1>
        
        <div class="row">
            <div class="col-md-6 mx-auto mb-4">
                <form action="<?php echo($_SERVER["SCRIPT_NAME"]); ?>" method="get" class="d-flex">
                    <input type="text" name="search" class="form-control me-2" placeholder="Cerca film">
                    <button type="submit" class="btn btn-primary">Cerca</button>
                </form>
                <div id="msgerr" class="hide">
                <?= $sql;?>
                <br>
                <?php if(isset($error)){
                    echo $error; 
                }
                ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 offset-md-2">
            <?php if (isset($result) && mysqli_num_rows($result) > 0) {?>
            <table class="table">
                <thead>
                    <tr>
                    <!-- <th scope="col">#</th> -->
                    <th scope="col">Title</th>
                    <th scope="col">Year</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) {?>
                    <tr>
                    <!-- <th scope="row"><?= $row['id'] ?></th> -->
                    <td><?= $row['title'] ?></td>
                    <td><?= $row['year'] ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php } else { ?>
                <h2>Nessun film trovato</h2>
            <?php } ?>
            </div>
            <!-- Aggiungi altre colonne per i film -->
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <script>
        btnerr = document.querySelector('#btnerr')
        btnerr.addEventListener('click',(e)=>{
            msgerr = document.querySelector('#msgerr')
            msgerr.classList.toggle("hide");
        })
    </script>
</body>
</html>
