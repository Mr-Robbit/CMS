<?php 
    if(isset($_POST['edit_password'])){        
        $password = escape($_POST['current_password']);
        $newPw = escape($_POST['new_password']);
        $confirmPw = escape($_POST['new_password_confirm']);
        $password = mysqli_real_escape_string($connection, $password);
        $the_user_id = escape($_GET['p_id']);
        $query = "SELECT * FROM users WHERE user_id = $the_user_id "; 
        $res = mysqli_query($connection, $query);
        confirm($res);
        while($row = mysqli_fetch_assoc($res)){
            $dbPw = $row['user_password'];
        }
        if (password_verify('$password', $dbPw)) {
            $message = "right for once";
            if($newPw === $confirmPw) {
                $options = ['cost' => 12,];
                $confirmPw = mysqli_real_escape_string($connection, $confirmPw);
                $password = $newPw;
                $password = password_hash('$password', PASSWORD_BCRYPT, $options );
                $query = "UPDATE users SET user_password = '{$password}' WHERE user_id = $the_user_id ";
                $newPwQuery = mysqli_query($connection, $query);
                confirm($newPwQuery);
                header("Location: users.php?source=edit_user&u_id='{$the_user_id}'");
            } else {
                $message = "Passwords don't match!";
            }
        } else {
            $message = "Incorrect Password!";
        }       
    }
?>

<h1 class="page-header">
    
    <?php  if(!empty($message)){ echo $message; } else { echo "Change Password";} ?>
</h1>
<form action="#" method="POST">
    <div class="form-group">
        <label for="current_password">Current Password</label>
        <input autocomplete="off" type="password" name="current_password" id="current_password" class="form-control">
    </div>
    <div class="form-group">
        <label for="new_password">New Password</label>
        <input type="password" name="new_password" id="new_password" class="form-control">
    </div>
    <div class="form-group">
        <label for="new_password_confirm">Confirm Password</label>
        <input type="password" name="new_password_confirm" id="new_password_confirm" class="form-control">
    </div>
    <div class="form-group">
        <button class="btn btn-success" name="edit_password">Change Password</button>
    </div>
</form>