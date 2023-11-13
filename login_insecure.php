<?php
session_start();
require_once('db_connection.php');
if(isset($_SESSION['user'])){
    header('location: index.php');
}
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the user input
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    // Construct the query (without escaping)
    $query = "SELECT * FROM users WHERE email = 'emauil@gsg.com' AND password = '" . sha1($password) . "'";

    // Execute the query
    $result = $conn->query($query);
    
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        echo "Login successful!";
        $_SESSION['user'] = [
            "name"=>$row['name'],
            "uuid"=>crypt($row['email'],sha1($row['id'].$row['name'].$row['email']))
        ];
        header('location: index.php');
        
    } else {
        echo "Invalid credentials.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Homepage Film</title>
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"> -->
<link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
<?php include "_nav.php";?>
<div class="container">
<h1 class="text-center my-4">Login Insecure</h1>

<div class="row">
<div class="col-md-6 mx-auto mb-4">
<form action="<?php echo($_SERVER["SCRIPT_NAME"]); ?>" method="POST" class="">
<label for="">Email</label>
<input type="text" name="email" class="form-control mb-2" placeholder="Insert Email">
<label for="">Password</label>
<input type="password" name="password" class="form-control mb-2" placeholder="Insert Password">
<button type="submit" class="btn btn-primary">Login</button>
</form>
<div id="msgerr" class="hide">
<br>
<?php if(isset($error)){
    echo $error; 
}
?>
</div>
</div>
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