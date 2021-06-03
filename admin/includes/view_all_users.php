
<!-- <a id="addPostBtn" class="btn btn-block btn-primary" href="posts.php?source=add_post"> + Add a New Post <span id="plusSpan"> + </span></a> -->
<h1 class="page-header">
    Users
    <small>Author</small>
</h1>
<form action="users.php" method="GET">
<label for="sort_status">Sort by Status</label>
    <select name="sort_status" id="sort_status">
        <option value="subscriber">members</option>
        <option value="admin">admins</option>
        <option value="suspended">in the dog house</option>
    </select>
    <input type="submit" name="sort" class="btn btn-success" value="Go!">
    <a class="btn btn-primary" href="users.php">Show all!</a>
</form>
<a id="addPostBtn" class="btn btn-block btn-primary" href="users.php?source=add_user"> + Add a New User <span id="plusSpan"> + </span></a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Promote to Admin</th>
            <th>Demote to Sub</th>
            <th>Delete</th>

            
           
            
        </tr>
    </thead>
    <tbody>
    <?php 
        if(isset($_GET['sort_status'])){
            $sort_by_status = escape($_GET['sort_status']);
            $query = "SELECT * FROM users WHERE user_role = '{$sort_by_status}' ";
            global $connection;
            $query_all_users = mysqli_query($connection, $query);
            if(!$query_all_users){
                die("query failed" . mysqli_error($connection));
            };    
        } else {
            $query = 'SELECT * FROM users';
            global $connection;
            $query_all_users = mysqli_query($connection, $query);
            if(!$query_all_users){
            die("query failed" . mysqli_error($connection));
            };
        }
        
       
        while($list_all_users = mysqli_fetch_assoc($query_all_users)){
            $user_id = $list_all_users['user_id'];
            $username = $list_all_users['username'];
            $user_password = $list_all_users['user_password'];
            $user_firstname = $list_all_users['user_firstname'];
            $user_lastname = $list_all_users['user_lastname'];
            $user_email = $list_all_users['user_email'];
            $user_image = $list_all_users['user_image'];
            $user_role = $list_all_users['user_role'];
          

            echo "<tr id='row{$user_id}' >";
            echo "<td><a href='users.php?source=edit_user&u_id={$user_id}'> {$user_id} </a></td>";
            echo "<td>{$username}</td>";
            echo "<td>{$user_firstname}</td>";
            echo "<td>{$user_lastname} </td> ";            
            echo "<td>{$user_email}</td>";
            echo "<td>{$user_role}</td>";
            // associate post name with post id 
                     
           
            echo "<td><a href='users.php?promote_to_admin={$user_id}'>Promote</a></td>";
            echo "<td><a href='users.php?demote_to_sub={$user_id}'>Demote</a></td>";    
            echo "<td class='deleteTR edittable delete_btn' ><a class='delbtn' href='users.php?delete={$user_id}'>Delete</a></td>";
            echo "</tr>";
        }

        
    ?>
    
    <?php 
    // delete user
    if(isset($_GET['delete'])){
        if(isset($_SESSION)){
            if($_SESSION['role'] == 'admin'){

                $ID = mysqli_real_escape_string($connection, $_GET['delete']);
                $del_query = "DELETE FROM users Where user_id = $ID ";
                $del_user = mysqli_query($connection, $del_query);
                if(!$del_user){
                    die('delete failed' . mysqli_error($connection));
                } else {
                    header('Location: users.php');
                }
            }
        }
    }

    //approve comment
    if(isset($_GET['promote_to_admin'])){
        $ID = escape($_GET['promote_to_admin']);
        $approve_query = "UPDATE users SET user_role='admin' WHERE user_id = $ID ";
        $approve_promote = mysqli_query($connection, $approve_query);
        if(!$approve_promote){
            die('promotion failed' . mysqli_error($connection));
        } else {
            header('Location: users.php');
        }
    }

    // Deny comment
    if(isset($_GET['demote_to_sub'])){
        $ID = escape($_GET['demote_to_sub']);
        $deny_query = "UPDATE users SET user_role='subscriber' WHERE user_id = $ID ";
        $deny_res = mysqli_query($connection, $deny_query);
        if(!$deny_res){
            die('deny failed' . mysqli_error($connection));
        } else {
            header('Location: users.php');
        }
    }
    
    ?>

    </tbody>
</table>
