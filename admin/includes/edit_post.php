<?php 
if(isset($_GET['p_id'])){
    $the_post_id = escape($_GET['p_id']);

}
$query = "SELECT * FROM posts WHERE post_id=$the_post_id ";
        global $connection;
        $query_post_by_id = mysqli_query($connection, $query);
        if(!$query_post_by_id){
        die("query1 failed" . mysqli_error($connection));
        };
        
        while( $edit_post_id = mysqli_fetch_assoc($query_post_by_id )){
            $post_id = $edit_post_id['post_id'];
            $post_author = $edit_post_id['post_author'];
            $post_title = $edit_post_id['post_title'];
            $post_category_id = $edit_post_id['post_category_id'];
            $post_status = $edit_post_id['post_status'];
            $post_image = $edit_post_id['post_image'];
            $post_tags = $edit_post_id['post_tag'];
            $post_content = $edit_post_id['post_content'];
        }

    if(isset($_POST['update_post'])){
        $post_author = escape($_POST['post_author']);
        $post_title = escape($_POST['title']);
        $post_category_id = escape($_POST['post_category']);
        $post_status = escape($_POST['post_status']);
        $post_image = escape($_FILES['image']['name']);
        $post_image_temp = escape($_FILES['image']['tmp_name']);
        $post_content = escape($_POST['post_content']);
        $post_tags = escape($_POST['post_tag']);

        move_uploaded_file($post_image_temp, "../$post_image");

        if(empty($post_image)){
            $query = "SELECT * FROM posts WHERE post_id=$the_post_id ";
            $select_image = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($select_image)){
                $post_image = $row['post_image'];
            }
        }

        $query = "UPDATE posts SET ";
        $query .= "post_title = '{$post_title}', ";
        $query .= "post_category_id = '{$post_category_id}', ";
        $query .= "post_date = now(), ";
        $query .= "post_author = '{$post_author}', ";
        $query .= "post_status = '{$post_status}', ";
        $query .= "post_tag = '{$post_tags}', ";
        $query .= "post_content = '{$post_content}', ";
        $query .= "post_image = '{$post_image}' ";
        $query .= "WHERE post_id = {$the_post_id} ";

        $update_post = mysqli_query($connection, $query);
        confirm($update_post);

        echo "<h2 class='bg-success text-center'>Post Updated!<br> <a href='../post.php?p_id={$the_post_id}'> View Post </a> </h2>";
    }


?>



<h1 class="page-header">
    Edit Post
    <small> <?php echo $post_title ?></small>
</h1>
<form method="post" action="#" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input value="<?php echo $post_title ?>" type="text" name="title" id="title" class="form-control">
    </div>
    <div class="form-group">
        <select name="post_category" id="post_category">
            <?php 
                $query = "SELECT * FROM categories";
                $select_cat = mysqli_query($connection, $query);
                confirm($select_cat);

                while($row = mysqli_fetch_assoc($select_cat)){
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];

                        
                        if($cat_id == $post_category_id){
                            
                            echo "<option selected value='{$cat_id}'>{$cat_title}</option>";

                        }else {
                            echo "<option value='{$cat_id}'>{$cat_title}</option>";

                        }
                }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="post_author">Post author</label>
        <input value="<?php echo $post_author ?>" type="text" name="post_author" id="post_author" class="form-control">
    </div>
    <div class="form-group">
        <select name="post_status" id="post_status">
                    <option value='<?php echo $post_status ?>'><?php echo $post_status; ?></option>
                    <?php
                        if($post_status == 'pending') {
                            echo "<option value='approved'>approved</option>" ;
                            echo " <option value='draft'>Draft</option>";
                        } else if($post_status == 'approved'){
                            echo "<option value='pending'>pending</option>" ;
                            echo " <option value='draft'>Draft</option>";
                        } else if( $post_status == 'draft'){
                            echo "<option value='approved'>approved</option>" ;
                            echo "<option value='pending'>pending</option>" ;
                        }
                    ?>
                   
        
        </select>
    </div>
    <div class="form-group">
        <img width="100px" src="../<?php echo $post_image ?>" alt="">
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <label for="post_tag">Post Tags</label>
        <input value="<?php echo $post_tags ?>" type="text" name="post_tag" id="post_tag" class="form-control">
    </div>
    <div class="form-group">
        <label for="body">Post Content</label>
        <textarea name="post_content" id="body" class="form-control" cols="30" rows="10"><?php echo $post_content ?></textarea>
    </div>
    <input class="btn btn-lg btn-primary" type="submit" name="update_post">
    <a class="btn btn-lg btn-warning" href='posts.php'> Back </a>
</form>