
<!-- <a id="addPostBtn" class="btn btn-block btn-primary" href="posts.php?source=add_post"> + Add a New Post <span id="plusSpan"> + </span></a> -->
<h1 class="page-header">
    Comments
    <small>Author</small>
</h1>
<label for="sort_status">Sort by Status</label>
    <select name="sort_status" id="sort_status">
        <option><a href="comments.php?sort='pending'c"></a>pending</option>
        <option>approved</option>
        <option>denied</option>
    </select>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In Response to</th>
            <th>Date</th>
            <th>Approve</th>
            <th>Deny</th>            
            <th>Delete?</th>
            
        </tr>
    </thead>
    <tbody>
    <?php
        $query = 'SELECT * FROM comments WHERE comment_status = "pending"';
        global $connection;
        $query_all_comments = mysqli_query($connection, $query);
        if(!$query_all_comments){
        die("query failed" . mysqli_error($connection));
        };
        
        while($list_all_comments = mysqli_fetch_assoc($query_all_comments )){
            $comment_id = $list_all_comments['comment_id'];
            $comment_post_id = $list_all_comments['comment_post_id'];
            $comment_author = $list_all_comments['comment_author'];
            $comment_email = $list_all_comments['comment_email'];
            $comment_content = $list_all_comments['comment_content'];
            $comment_status = $list_all_comments['comment_status'];
            $comment_date = $list_all_comments['comment_date'];

            echo "<tr id='row{$comment_id}' >";
            echo "<td> {$comment_id} </td>";
            echo "<td>{$comment_author}</td>";
            echo "<td>{$comment_content}</td>";
            echo "<td>{$comment_email} </td> ";            
            echo "<td>{$comment_status}</td>";
            // associate post name with post id 
            $query = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
            $select_post_id_query = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($select_post_id_query)){
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                echo "<td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>";
            }            
            echo "<td>{$comment_date}</td>";
            echo "<td><a href='comments.php?approve={$comment_id}'>Approve</a></td>";
            echo "<td><a href='comments.php?deny={$comment_id}'>Deny</a></td>";    
            echo "<td class='deleteTR edittable delete_btn' ><a class='delbtn' href='comments.php?delete={$comment_id}'>Delete</a></td>";
            echo "</tr>";
        }

        
    ?>
    
    <?php 
    // delete comment
    if(isset($_GET['delete'])){
        $ID = $_GET['delete'];
        $del_query = "DELETE FROM comments Where comment_id = $ID ";
        $del_res = mysqli_query($connection, $del_query);
        if(!$del_res){
            die('delete failed' . mysqli_error($connection));
        } else {
            header('Location: comments.php');
        }
    }

    //approve comment
    if(isset($_GET['approve'])){
        $ID = $_GET['approve'];
        $approve_query = "UPDATE comments SET comment_status='Approved' WHERE comment_id = $ID ";
        $approve_res = mysqli_query($connection, $approve_query);
        if(!$approve_res){
            die('approve failed' . mysqli_error($connection));
        } else {
            header('Location: comments.php');
        }
    }

    // Deny comment
    if(isset($_GET['deny'])){
        $ID = $_GET['deny'];
        $deny_query = "UPDATE comments SET comment_status='Denied' WHERE comment_id = $ID ";
        $deny_res = mysqli_query($connection, $deny_query);
        if(!$deny_res){
            die('deny failed' . mysqli_error($connection));
        } else {
            header('Location: comments.php');
        }
    }
    
    ?>

    </tbody>
</table>
