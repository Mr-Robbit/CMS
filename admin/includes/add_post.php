<?php 
if(isset($_POST['create_post'])){
    $post_title = escape($_POST['title']);
    $post_author = escape($_POST['post_author']);
    $post_category_id = escape($_POST['post_category']);
    $post_status = escape($_POST['post_status']);

    $target_dir = "images/";
    $post_image = $target_dir . basename($_FILES["image"]["name"]);
    $post_image_temp = $_FILES['image']['tmp_name'];

    $post_tags = escape($_POST['post_tag']);
    $post_content = escape($_POST['post_content']);
    $post_date = date('d-m-y');
    

        move_uploaded_file($post_image_temp, "../$post_image");
        global $connection;
        $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tag, post_status) ";
        $query .= " VALUES ('{$post_category_id}', '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}' ) ";
        $create_post_result = mysqli_query($connection, $query);
        confirm($create_post_result);
        $postID = mysqli_insert_id($connection);
        echo "<h2 class='bg-success text-center'>Post Created!<br> <a href='../post.php?p_id={$postID}'> View Post </a> <a href='../post.php?source=add_post'> Add another</a> </h2>";
}   


?>
<h1 class="page-header">
    Create a post!
    <small><?php echo $_SESSION['username'] ?></small>
</h1>
<form method="post" action="#" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" name="title" id="title" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_category">Post Category</label>
        <select name="post_category" id="post_category">
            <?php 
                $query = "SELECT * FROM categories";
                $select_cat = mysqli_query($connection, $query);
                confirm($select_cat);

                while($row = mysqli_fetch_assoc($select_cat)){
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];

                        echo "<option value='{$cat_id}'>{$cat_title}</option>";
                }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="post_author">Post author</label>
        <input type="text" name="post_author" id="post_author" class="form-control">
    </div>
    <div class="form-group">
      <label for="post_status">Post Status</label>
      <select class="form-control" name="post_status" id="post_status">
        <option>Select Status</option>
        <option value="approved">Approved</option>
        <option value="pending">Pending</option>
        <option value="draft">Draft</option>
      </select>
    </div>
    
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image" id="post_image" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_tag">Post Tags</label>
        <input type="text" name="post_tag" id="post_tag" class="form-control">
    </div>
    <div class="form-group">
        <label for="body">Post Content</label>
        <textarea name="post_content" id="body" class="form-control" cols="30" rows="10"></textarea>
    </div>
    <input class="btn btn-lg btn-primary" type="submit" name="create_post">
</form>