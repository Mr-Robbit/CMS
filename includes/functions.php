<?php 
    
    function redirect($location){
        header("Location:" . $location);
        exit;
    }

    function ifItIsMethod($method = null){
        if($_SERVER['REQUEST_METHOD'] == strtoupper($method)){
            return true;
        }
        return false;
    }
    
    function isLoggedIn(){
        if(isset($_SESSION['role'])){
            return true;
        }
        return false;
    }

    function checkIfUserLoggedRedirect($redirectLocation = null){
        if(isLoggedIn()){
            redirect($redirectLocation);
        }
    }

    function escape($string){
        global $connection;
        return mysqli_real_escape_string($connection, trim($string));
    }
    
    function confirm($query){
        global $connection;
        if(!$query){
                die('Query Failed! Please try again ' . mysqli_error($connection));
            } 
    }

    function usernameExists($username){
    global $connection;
    $query = "SELECT username FROM users WHERE username = '$username' ";
    $result = mysqli_query($connection, $query);
    
    if(mysqli_num_rows($result) > 0){
        return true;
    } else  {
        return false;
    }
}

function emailExists($email){
    global $connection;
    $query = "SELECT user_email FROM users WHERE user_email = '$email' ";
    $result = mysqli_query($connection, $query);

    if(mysqli_num_rows($result) > 0){
        return true;
    } else {
        return false;
    }
}

function registerUser($username, $email, $password){
    global $connection;    
    $username = mysqli_real_escape_string($connection, $username);
    $email = mysqli_real_escape_string($connection, $email);
    $password = mysqli_real_escape_string($connection, $password);
    $options = [
        'cost' => 12,
    ];
    $password = password_hash('$password', PASSWORD_BCRYPT, $options );
    $query = "INSERT INTO users (username, user_email, user_password, user_role) ";
    $query .= "VALUES('{$username}', '{$email}', '{$password}', 'subscriber' )";
    $register_user_query = mysqli_query($connection, $query);
    confirm($register_user_query);
        
           
} 

function loginUser($username, $password){
    global $connection;
    
    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);
    
    $query = "SELECT * FROM users WHERE username = '{$username}' OR user_email = '{$username}' ";
    $login_query = mysqli_query($connection, $query);
    confirm($login_query);
    while($row = mysqli_fetch_assoc($login_query)){
        $db_id = $row['user_id'];
        $db_username = $row['username'];
        $db_password = $row['user_password'];
        $db_firstname = $row['user_firstname'];
        $db_lastname = $row['user_lastname'];
        $db_email = $row['user_email'];
        $db_role = $row['user_role'];
       
        if (password_verify('$password', $db_password)) {
                $_SESSION['username'] = $db_username;
                $_SESSION['user_firstname'] = $db_firstname;
                $_SESSION['user_email'] = $db_email;
                $_SESSION['role'] = $db_role;
                $_SESSION['user_id'] = $db_id;
    
                redirect("/demo/cms/admin");
            } else {
                return false;
            }
        
    }
    return true;     

}



    function addCats() {
        global $connection;
        if(isset($_POST['submit'])){
            $add_cat_title = escape($_POST['cat_title']);
            if($add_cat_title == '' || empty($add_cat_title)){
                echo "this field should not be empty! ";
            } else {
                $stmt = mysqli_prepare($connection, "INSERT INTO categories(cat_title) VALUES (?) ") ;
                
                mysqli_stmt_bind_param($stmt, 's', $add_cat_title);
                mysqli_stmt_execute($stmt);
                
            } 
            mysqli_stmt_close($stmt);
        }
    }
    
    



function findAllCat(){
    $query = "SELECT * FROM categories";
    global $connection;
    $select_cat_sidebar = mysqli_query($connection, $query);
    
    while($row = mysqli_fetch_assoc($select_cat_sidebar)){
        $cat_title = $row['cat_title'];
        $cat_id = $row['cat_id']; 
        ?>        
        <tr>
            <td> <?php echo $cat_id ?> </td>
            <td> <a href="../category.php?category=<?php echo $cat_id ?>"><?php echo $cat_title ?></a> </td>
            <td><a href="categories.php?delete=<?php echo $cat_id ?>" class="btn btn-danger">Delete </a><a href="categories.php?edit=<?php echo $cat_id?>&editname=<?php echo $cat_title?>" class="edit_btn btn btn-warning" >Edit</a></td>
        </tr>
    <?php } 
};



function deleteCat(){
    global $connection;
    if(isset($_GET['delete'])){
        $cat_id = escape($_GET['delete']);
        $query = "DELETE FROM categories ";
        $query .= "WHERE cat_id = $cat_id";
        $delete_cat = mysqli_query($connection, $query);
        if(!$delete_cat){
            die('Failed to delete category' . mysqli_error($connection));
        } else{
            header("Location: categories.php");
        }
    }
}

function recordCount($table){
    global $connection;
    $query = " SELECT * FROM " . $table;
    $select_all_records = mysqli_query($connection, $query);
    $result = mysqli_num_rows($select_all_records);
    confirm($result);

    return $result;
}

function checkStatus($table, $column, $status){
    global $connection;
    $query = " SELECT * FROM $table WHERE $column = '$status' ";
    $result = mysqli_query($connection, $query);
    return mysqli_num_rows($result);
}

function users_online(){
    if(isset($_GET['onlineusers'])){
        global $connection;
        if(!$connection){
            session_start();
            include("../../includes/db.php");
            $session = session_id();
            $time = time();
            $time_out_in_seconds = 30;
            $time_out = $time - $time_out_in_seconds;
    
            $query = " SELECT * FROM users_online WHERE session = '$session' ";
            $send_query = mysqli_query($connection, $query);
            confirm($send_query);
            $count = mysqli_num_rows($send_query);
            if($count == NULL) {
                mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES ('$session', '$time') ");
    
            } else {
                mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session' ");
            }
            $users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out' ");
            echo $count_user = mysqli_num_rows($users_online_query);
        }
    } // get request
}

function isAdmin($username = " "){
    global $connection;
    $query = "SELECT user_role FROM users WHERE username = '{$username}' ";
    $result = mysqli_query($connection, $query);
    confirm($result);

    $row = mysqli_fetch_array($result);
    if($row['user_role'] === 'admin'){
        return true;
    }  
    return false;
}


users_online();

?>