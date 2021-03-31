
<a id="addPostBtn" class="btn btn-block btn-primary" href="posts.php?source=add_post"> + Add a New Post <span id="plusSpan"> + </span></a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Category</th>
            <th>Status</th>
            <th>Email</th>
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
        $query_all_comment = mysqli_query($connection, $query);
        if(!$query_all_comment){
        die("query failed" . mysqli_error($connection));
        };
        
        while( $list_all_posts = mysqli_fetch_assoc($query_all_posts )){
            $commentid = $list_all_comment['commentid'];
            $commentauthor = $list_all_comment['commentauthor'];
            $commenttitle = $list_all_comment['commenttitle'];
            $commentcategory_id = $list_all_comment['commentcategory_id'];
            $commentstatus = $list_all_comment['commentstatus'];
            $commentimage = $list_all_comment['commentimage'];
            $commenttags = $list_all_comment['commenttag'];
            $commentcomment_count = $list_all_comment['commentcomment_count'];
            $commentdate = $list_all_comment['commentdate'];

            echo "<tr id='row{$post_id}' >";
            echo "<td> {$post_id} </td>";
            echo "<td>{$post_author}</td>";
            echo "<td>{$post_title}</td>";
            
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
                echo "<a class='cPreview' href='posts.php?source=edit_post&p_id={$post_id}'>";
                    echo "<div class='previewImage'></div>";
                    echo "<h2 class='previewTitle'>Edit</h2>";
                echo "</a>";
            echo "</td>";

            
            
            echo "<td class='deleteTR edittable delete_btn' ><a class='delbtn' href='posts.php?delete={$post_id}'>Delete</a></td>";
            echo "</tr>";
        }

        
    ?>
    <?php 
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
