<?php 
if(isset($_POST['create_user'])){
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $username = $_POST['username'];
    $user_password = $_POST['user_password'];
    $user_email = $_POST['user_email'];
    $user_role = 'suscriber';

    $target_dir = "images/";
    $user_image = $target_dir . basename($_FILES["image"]["name"]);
    $user_image_temp = $_FILES['image']['tmp_name'];

    
    // $member_since = date('d-m-y');
    

        move_uploaded_file($user_image_temp, "../$user_image");
        global $connection;
        $query = "INSERT INTO users(username, user_password, user_firstname, user_lastname, user_email, user_image, user_role) ";
        $query .= " VALUES ('{$username}', '{$user_password}', '{$user_firstname}', '${user_lastname}', '{$user_email}', '{$user_image}', '{$user_role}' ) ";
        $create_user_result = mysqli_query($connection, $query);
        confirm($create_user_result);

        echo "User Created" . " " . "<a href='users.php'>Return</a> ";
        
}


?>
<h1 class="page-header">
    Add a User!
   
</h1>
<form method="post" action="#" enctype="multipart/form-data">
     <div class="form-group">
        <label for="user_firstname">First Name</label>
        <input type="text" name="user_firstname" id="user_firstname" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_lastname">Last Name</label>
        <input type="text" name="user_lastname" id="user_lastname" class="form-control">
    </div>
   
    <!-- <div class="form-group">
      
        <select name="user_role" id="user_role">
            <option value="suscriber">Select Role</option>
            <option value="admin">Admin</option>
            <option value="suscriber">Suscriber</option>
        </select>
    </div> -->
    <div class="form-group">
        <label for="user_image">Avatar</label>
        <input type="file" name="image" id="user_image" class="form-control">
    </div>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_email">E-Mail</label>
        <input type="email" name="user_email" id="user_email" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" name="user_password" id="user_password" class="form-control">
    </div>
    <input class="btn btn-lg btn-primary" type="submit" name="create_user" value="Add User">
</form>