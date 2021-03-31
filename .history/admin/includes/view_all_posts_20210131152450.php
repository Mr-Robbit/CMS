
<a id="addPostBtn" class="btn btn-block btn-primary" href="posts.php?source=add_post.php"> + Add a New Post <span id="plusSpan"> + </span></a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
            <th>Edit?</th>
            <th>Delete?</th>
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
        $post_tags = $list_all_posts['post_tag'];
        $post_id = $post_tags['post_id'];
        echo "<tr id='row{$post_id}' >";
            echo "<td> {$list_all_posts['post_id']} </td>";
            echo "<td>{$list_all_posts['post_author']}</td>";
            echo "<td>{$list_all_posts['post_title']}</td>";
            echo "<td>{$list_all_posts['post_category_id']} </td> ";
            echo "<td>{$list_all_posts['post_status']}</td>";
            echo "<td width='90'> <img height='50' src='../{$list_all_posts['post_image']}'></td>";
            echo "<td>{$post_tags}</td>";
            echo "<td>{$list_all_posts['post_comment_count']}</td>";
            echo "<td>{$list_all_posts['post_date']}</td>";
            ?>
            <td class='editTR edittable'>
                <a class="cPreview" href="posts.php?source=edit_post">
                    <div class="previewImage"></div>
                    <h2 class="previewTitle">Edit</h2>
                </a>
            </td>

            <?php
            
            echo "<td class='deleteTR edittable delete_btn' ><a href='posts.php?delete={$list_all_posts['post_id']}'>Delete</a></td>";
            echo "</tr>";
        }

        
    ?>

    </tbody>
</table>

<?php

    if(isset($_GET['delete'])){
        $post_id = $_GET['delete'];
        $del_query = "DELETE FROM posts WHERE post_id = {$post_id} ";
        $del_query = mysqli_query($connection, $del_query);
    }
    
?>