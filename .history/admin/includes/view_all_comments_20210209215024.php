
<a id="addPostBtn" class="btn btn-block btn-primary" href="posts.php?source=add_post"> + Add a New Post <span id="plusSpan"> + </span></a>
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
        $query = 'SELECT * FROM comments';
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
            echo "<td>{$comment_post_id} </td>";
            echo "<td>{$comment_date}</td>";
            echo "<td></td>";
            echo "<td></td>";
            
            
            // echo "<td class='editTR edittable'>";
            //     echo "<a class='cPreview' href='posts.php?source=edit_post&p_id={$post_id}'>";
            //         echo "<div class='previewImage'></div>";
            //         echo "<h2 class='previewTitle'>Edit</h2>";
            //     echo "</a>";
            // echo "</td>";

            
            
            echo "<td class='deleteTR edittable delete_btn' ><a class='delbtn' href='posts.php?delete={$post_id}'>Delete</a></td>";
            echo "</tr>";
        }

        
    ?>
    <?php 
    if(isset($_GET['delete'])){
        $ID = $_GET['delete'];
        $del_query = "DELETE FROM comments Where comment_id = $ID ";
        $del_res = mysqli_query($connection, $del_query);
        if(!$del_res){
            die('delete failed' . mysqli_error($connection));
        } else {
            header('Location: posts.php?source=posts.php');
        }
    }
    
    ?>

    </tbody>
</table>
