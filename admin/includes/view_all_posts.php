
<?php 

    if(isset($_POST['selectIds'])) {
        $selectIds = $_POST['selectIds'];
        foreach($selectIds as $postValueId ) {
            $bulk_options = $_POST['bulk_options'];

            switch ($bulk_options) {
                case 'approved':
                    $query = " UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}";
                    $update_to_approved = mysqli_query($connection, $query);
                    confirm($update_to_approved);
                    break;
                case 'pending':
                    $query = " UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}";
                    $update_to_pending = mysqli_query($connection, $query);
                    confirm($update_to_pending);
                    break;
                case 'delete':
                    $del_query = "DELETE FROM posts Where post_id = {$postValueId}";
                    $del_res = mysqli_query($connection, $del_query);
                    confirm($del_res);
                    break;
                case 'clone':
                    $query = "SELECT * FROM posts WHERE post_id = {$postValueId}";
                    $post_query = mysqli_query($connection, $query);
                    confirm($post_query);
                    while($row = mysqli_fetch_assoc($post_query)){
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_category_id = $row['post_category_id'];
                        $post_status = $row['post_status'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
                        $post_tags = $row['post_tag'];
                    }
                    $query = "INSERT INTO posts(post_category_id,  post_title, post_author, post_date, post_image, post_content, post_tag, post_status) ";
                    $query .= " VALUES ({$post_category_id}, '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}' ) ";
                    $clone_query = mysqli_query($connection, $query);
                    confirm($clone_query);
                    break;
            }
        }
    }
?>
<a id="addPostBtn" class="btn btn-block btn-primary" href="posts.php?source=add_post"> + Add a New Post <span id="plusSpan"> + </span></a>

<form action="" method="POST" name="bulk_options">
    <table class="table table-bordered">
        <div id="bulkOptionsContainer" class="col-xs-4">
            <select class="form-control" name="bulk_options" id="">
                <option value="">Post Options</option>
                <option value="approved">Approve</option>
                <option value="pending">Submit for review</option>
                <option value="clone">Clone</option>
                <option value="delete">Delete</option>
            </select>
        </div>
        <div class="col-xs-8">
            <input type="submit" id="quickEditPost" class="btn btn-success btn-block" value="Apply">
        </div>

        <thead>
            <tr>
                <th><input type="checkbox" id="selectAllBoxes"></th>

                <th>Author</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Date</th>
                
                <th>Edit?</th>
                
            </tr>
        </thead>
        <tbody>
        <?php
            // $query = 'SELECT * FROM posts ORDER BY post_id DESC ';
            $query = "SELECT posts.post_id, posts.post_author, posts.post_title, posts.post_category_id, posts.post_status, posts.post_image, "; 
            $query .= "posts.post_tag, posts.post_comment_count, posts.post_date, posts.post_view_count, categories.cat_id, categories.cat_title ";
            $query .= "FROM posts ";
            $query .= "LEFT JOIN categories ON posts.post_category_id = categories.cat_id ORDER BY posts.post_id";
            global $connection;
            $query_all_posts = mysqli_query($connection, $query);
            if(!$query_all_posts){
            die("query failed" . mysqli_error($connection));
            };
            
            while( $list_all_posts = mysqli_fetch_assoc($query_all_posts )){
                $post_id = $list_all_posts['post_id'];
                $post_author = $list_all_posts['post_author'];
                $post_title = $list_all_posts['post_title'];
                $post_category_id = $list_all_posts['post_category_id'];
                $post_status = $list_all_posts['post_status'];
                $post_image = $list_all_posts['post_image'];
                $post_tags = $list_all_posts['post_tag'];
                $post_comment_count = $list_all_posts['post_comment_count'];
                $post_date = $list_all_posts['post_date'];
                $cat_title = $list_all_posts['cat_title'];
                $cat_id = $list_all_posts['cat_id'];

                echo "<tr id='row{$post_id}' >";
                echo "<td><input type='checkbox' id='{$post_id}' value='{$post_id}' name='selectIds[]' class='checkBoxes'>";
                echo " <label id='post_check' for='{$post_id}'><div>{$post_id}</div></label> </td>";
                echo "<td>{$post_author}</td>";
                echo "<td ><a href='../post.php?p_id={$post_id}'><h4 class='text-center'>{$post_title}</h4</a></td>";
              
                echo "<td>{$cat_title} </td> ";

                
                echo "<td>{$post_status}</td>";
                echo "<td width='90'> <img height='50' src='../{$post_image}'></td>";
                echo "<td>{$post_tags}</td>";
                $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
                $send_comment_query = mysqli_query($connection, $query);

                
                $count_comments = mysqli_num_rows($send_comment_query);

                echo "<td><a href='post_comments.php?id=$post_id'>{$count_comments}</a></td>";
                echo "<td>{$post_date}</td>";
                
                echo "<td class='editTR edittable'>";
                    echo "<a  href='posts.php?source=edit_post&p_id={$post_id}'>";
                        echo "<div class='previewImage'></div>";
                        echo "<h2 class='previewTitle'>Edit</h2>";
                    echo "</a>";
                echo "</td>";

                
                
                
                echo "</tr>";
            }

            
        
        // if(isset($_GET['delete'])){
        //     $ID = escape($_GET['delete']);
        //     $del_query = "DELETE FROM posts Where post_id = $ID ";
        //     $del_res = mysqli_query($connection, $del_query);
        //     if(!$del_res){
        //         die('delete failed' . mysqli_error($connection));
        //     } else {
        //         header('Location: posts.php?source=posts.php');
        //     }
        // }
        
        ?>

        </tbody>
    </table>
</form>