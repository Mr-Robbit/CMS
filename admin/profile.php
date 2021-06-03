<?php include "includes/admin_header.php"?>
<?php 
    if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];

        $query = "SELECT * FROM users WHERE username = '{$username}' ";
        $select_user_profile = mysqli_query($connection, $query);
        confirm($select_user_profile);

        while($row = mysqli_fetch_assoc($select_user_profile)) {
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_password = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            
        }

    }

    if(isset($_POST['update_user'])){
        $username = escape($_POST['username']);
        $user_firstname = escape($_POST['user_firstname']);
        $user_lastname = escape($_POST['user_lastname']);
        $user_email = escape($_POST['user_email']);
        $user_image = escape($_FILES['user_image']['name']);
        $user_image_temp = escape($_FILES['user_image']['tmp_name']);

        move_uploaded_file($user_image_temp, "../$user_image");

        if(empty($user_image)){
            $query = "SELECT * FROM users WHERE username = '{$username}' ";
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
        $query .= "WHERE username = '{$username}' ";

        $update_user = mysqli_query($connection, $query);
        confirm($update_user);
        header("Location: users.php");
    }
?>

    <div id="wrapper">

    <?php include "includes/admin_navbar.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">  
                    <h1 class="page-header">
                        Welcome to Admin
                        <small>Author</small>
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
                        <input class="btn btn-lg btn-primary" type="submit" name="update_user" value="Update">
                    </form>

                                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

   <?php include "includes/admin_footer.php" ?>
   