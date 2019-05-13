<?php
session_start();

//initializing variables
$username = "";
$email = "";
$errors = array();
$passwordErr = "";

//connect to the database
include 'header.php';


//REGISTER USER
if(isset($_POST['register'])) {

    //receive all input values from the form
    $username = $_POST['username'];
    $password = hash('sha256', $_POST['password']);
    $expassword = hash('sha256', $_POST['expassword']);
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];

    //form validation: ensure that the form is correctly filled...
    //by adding (array_push()) corresponding error unto $errors array
    if (empty($username) || empty($email) || empty($firstname) || empty($lastname) || empty($password) || empty($expassword)) {
        header('Location:register.php?there is an error in a field');
    }

    else if ($password !== $expassword) {
            header('Location:register.php?The two passwords do not match');
            array_push($errors);
        }
        //first check the database to make sure
        //a user does not already exist with the same username and/or email


        //finally, register user if there are no errors in the form
    else if (count($errors) == 0) {

        // encrypt the password1.php before saving in the database
        $sql = "INSERT INTO users (username, email, firstname, lastname, password)
        VALUES (:username, :email, :firstname, :lastname, :password)";
        $stmt = $newpdo->prepare($sql);

        //$stmt->bindParam(':id', $id);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':password', $password);


        $stmt->execute();
        echo "New records created successfully";
        header('Location:index.php');
        }
    }




else if(isset($_POST['login'])) {
    if(empty($_POST['username']) || empty($_POST['password'])){
        $message = '<label>All fields are required</label>';
        $_SESSION['error'] = $message;
        header('location: login.php?error');
    }
    else{
        $sql = 'SELECT * FROM users WHERE username=:username AND password=:password';
        $stmt = $newpdo->prepare($sql);
        $exe = ['username'=> $_POST['username'], 'password'=> hash('sha256',$_POST['password'])];
        $stmt->execute($exe);
        $count = $stmt->rowCount();
        $row = $stmt->fetch();

        $_SESSION['id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['firstname'] = $row['firstname'];
        $_SESSION['lastname'] = $row['lastname'];
        $_SESSION['password'] = $row['password'];

        if($count > 0){
            //$_SESSION['username'] = $_POST['username'];
            header('location: home.php');
        }
        else{
            $message = '<label>Wrong data</label>';
            $_SESSION['wrongData'] = $message;
            header('location: login.php?wrong');
        }
    }
}

else if(isset($_POST['update'])){


    if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['firstname']) && isset($_POST['lastname'])){

        $id = $_SESSION['id'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $firstname = $_POST['firstname'];
        $lastname= $_POST['lastname'];

        $sql = "UPDATE users SET username=?, email=?, firstname=?, lastname=? WHERE id=?";
        $newpdo->prepare($sql)->execute([$username, $email, $firstname, $lastname, $id]);


        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $_SESSION['firstname'] = $firstname;
        $_SESSION['lastname'] = $lastname;


            $message = 'data inserted successfully';
            header("Location:home.php");
        }
}

else if(isset($_POST['delete'])){
    $id = $_GET['id'];
    $sql = 'DELETE FROM users WHERE id=:id';
    $statement = $newpdo->prepare($sql);

    if ($statement->execute([':id' => $id])) {
        header("Location:register.php");
    }
}
else {
    session_destroy();
    header('location: login.php');
}




?>