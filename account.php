<?php
require "header.php";

session_start();

$id = $_SESSION['id'];


$sql = 'SELECT * FROM users WHERE id=:id';
$stmt = $newpdo->prepare($sql);
$stmt->execute([':id'=>$id]);


    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
    $firstname = $_SESSION['firstname'];
    $lastname = $_SESSION['lastname'];



?>


<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!--Bootstrap -->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">
    <div class="d-flex flex-wrap col-4 mx-auto my-5 px-5 field2">
        <div>
            <h2>Update</h2>
            <h6>Please update your details.</h6>
        </div>
        <form action="auth.php" method="post">
            <div class="form-row pt-4">
                <div class="form-group col-md-6">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?php echo $username?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $email ?>"required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="firstname">Firstname</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Firstname" value="<?php echo $firstname ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="lastname">Lastname</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Lastname" value="<?php echo $lastname ?>" required>
                </div>
            </div>

            <button type="info" name="update" class="btn btn-1" value="auth.php?id=<?= $row['id'] ?>">Update</button>
            <a onclick="return confirm('Are you sure you want to delete those item')" href="auth.php?id=<?= $row['id'] ?>" class="btn btn-danger" name="delete">Delete</a>
            <button type="submit" name="register" class="btn btn-1">Register</button>
            <button type="reset" name="reset" class= "btn btn-1">Reset</button>
            <br/>Click here to <a href='login.php'>Log in</a>
        </form>
    </div>
</div>




<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>