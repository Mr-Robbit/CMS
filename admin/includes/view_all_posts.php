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
                    $del_query = "DELETE FROM posts Where post_id = $postValueId ";
                    $del_res = mysqli_query($connection, $del_query);
                    confirm($del_res);
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
                <option value="approved">Approved</option>
                <option value="pending">Pending</option>
                <option value="delete">Delete</option>
            </select>
        </div>
        <div class="col-xs-8">
            <input type="submit" id="quickEditPost" class="btn btn-primary btn-block" value="Apply">
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
            $query = 'SELECT * FROM posts';
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

                echo "<tr id='row{$post_id}' >";
                echo "<td><input type='checkbox' id='{$post_id}' value='{$post_id}' name='selectIds[]' class='checkBoxes'>";
                echo " <label id='post_check' for='{$post_id}'><div>{$post_id}</div></label> </td>";
                echo "<td>{$post_author}</td>";
                echo "<td ><a href='../post.php?p_id={$post_id}'><h4 class='text-center'>{$post_title}</h4</a></td>";
                
                $query = "SELECT * FROM categories WHERE cat_id = $post_category_id ";
                $select_categories_id = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($select_categories_id)){
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                }
                
                echo "<td>{$cat_title} </td> ";

                
                echo "<td>{$post_status}</td>";
                echo "<td width='90'> <img height='50' src='../{$post_image}'></td>";
                echo "<td>{$post_tags}</td>";
                echo "<td>{$post_comment_count}</td>";
                echo "<td>{$post_date}</td>";
                
                echo "<td class='editTR edittable'>";
                    echo "<a  href='posts.php?source=edit_post&p_id={$post_id}'>";
                        echo "<div class='previewImage'></div>";
                        echo "<h2 class='previewTitle'>Edit</h2>";
                    echo "</a>";
                echo "</td>";

                
                
                
                echo "</tr>";
            }

            
        
        if(isset($_GET['delete'])){
            $ID = $_GET['delete'];
            $del_query = "DELETE FROM posts Where post_id = $ID ";
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
</form>