<?php if(isset($_GET['u_id'])){
    $the_user_id = $_GET['u_id'];

}
$query = "SELECT * FROM users WHERE user_id = $the_user_id ";
        global $connection;
        $query_user_by_id = mysqli_query($connection, $query);
        if(!$query_user_by_id){
        die("query failed" . mysqli_error($connection));
        };
        
        while( $edit_user_id = mysqli_fetch_assoc($query_user_by_id )){
           $user_id = $edit_user_id['user_id'];
           $username = $edit_user_id['username'];
           $user_firstname = $edit_user_id['user_firstname'];
           $user_lastname = $edit_user_id['user_lastname'];
           $user_email = $edit_user_id['user_email'];
           $user_image = $edit_user_id['user_image'];
           $user_role = $edit_user_id['user_role'];
        }

    if(isset($_POST['update_user'])){
        $username = $_POST['username'];
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_email = $_POST['user_email'];
        $user_image = $_FILES['user_image']['name'];
        $user_image_temp = $_FILES['user_image']['tmp_name'];

        move_uploaded_file($user_image_temp, "../$user_image");

        if(empty($user_image)){
            $query = "SELECT * FROM users WHERE user_id=$the_user_id ";
            $select_image = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($select_image)){
                $user_image = $row['user_image'];
            }
        }

        $query = " UPDATE users SET ";
        $query .= "username = '{$username}', ";
        $query .= "user_firstname = '{$user_firstname}', ";
        $query .= "user_lastname = '{$user_lastname}', ";
        $query .= "user_email = '{$user_email}', ";
        $query .= "user_image = '{$user_image}' ";
        $query .= "WHERE user_id = {$the_user_id} ";

        $update_user = mysqli_query($connection, $query);
        confirm($update_user);
        header("Location: users.php");
    }
?>

<h1 class="page-header">
    Edit
   <small><?php echo $username ?></small>
</h1>
<form method="post" action="#" enctype="multipart/form-data">
     <div class="form-group">
        <label for="user_firstname">First Name</label>
        <input type="text" name="user_firstname" id="user_firstname" class="form-control" value="<?php echo $user_firstname ?>">
    </div>
    <div class="form-group">
        <label for="user_lastname">Last Name</label>
        <input type="text" name="user_lastname" id="user_lastname" class="form-control" value="<?php echo $user_lastname ?>">
    </div>
    <div class="form-group">
        <img width="100px" src="../<?php echo $user_image ?>" alt="Current Avatar"><br>
        <label for="user_image">Avatar</label>
        <input type="file" name="user_image" id="user_image" class="form-control">
    </div>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" class="form-control" value="<?php echo $username ?>">
    </div>
    <div class="form-group">
        <label for="user_email">E-Mail</label>
        <input type="email" name="user_email" id="user_email" class="form-control" value="<?php echo $user_email ?>">
    </div>
    <input class="btn btn-lg btn-primary" type="submit" name="update_user" value="edit User">
</form>