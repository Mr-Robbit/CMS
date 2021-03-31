<?php include "db.php"; ?>
<?php session_start(); ?>
<?php 
if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['user_password'];
    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);
    
    $query = "SELECT * FROM users WHERE username = '{$username}' OR user_email = '{$username}' ";
    $login_query = mysqli_query($connection, $query);
    if(!$login_query){
        die("login Failed" . mysqli_error($connection));
    }
    while($row = mysqli_fetch_assoc($login_query)){
        $db_id = $row['user_id'];
        $db_username = $row['username'];
        $db_password = $row['user_password'];
        $db_firstname = $row['user_firstname'];
        $db_lastname = $row['user_lastname'];
        $db_email = $row['user_email'];
        $db_role = $row['user_role'];
    }

    if( $username === $db_username || $username === $db_email){
        if($db_password === $password){
            $_SESSION['username'] = $db_username;
            $_SESSION['user_firstname'] = $db_firstname;
            $_SESSION['user_email'] = $db_email;
            $_SESSION['role'] = $db_role;
            $_SESSION['user_id'] = $db_id;

            header('Location: ../admin');
        } else {
            header('Location: ../index.php');
        }
     
    } else{
        header('Location: ../index.php');
    } 

    
   
    
    




}

?>