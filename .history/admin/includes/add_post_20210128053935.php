<?php 
if(isset($_POST['create_post'])){
    $post_title = $_POST['title'];
    $post_author = $_POST['post_author'];
    $post_category_id = $_POST['post_category_id'];
    $post_status = $_POST['post_status'];

    $target_dir = "images/";
    $post_image = $target_dir . basename($_FILES["image"]["name"]);
    $post_image_temp = $_FILES['image']['tmp_name'];

    $post_tags = $_POST['post_tag'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');
    $post_comment_count = 4;

        move_uploaded_file($post_image_temp, "../$post_image");
        global $connection;
        $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tag, post_comment_count, post_status) ";
        $query .= " VALUES ('{$post_category_id}', '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_comment_count}', '{$post_status}' ) ";
        $create_post_result = mysqli_query($connection, $query);
        confirm($create_post_result);
        header("Location: posts.php?source=posts.php");
}


?>
<h1 class="page-header">
    Create a post!
    <small>< post_author></small>
</h1>
<form method="post" action="#" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" name="title" id="title" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_category">Post Category</label>
        <input type="text" name="post_category_id" id="post_category" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_author">Post author</label>
        <input type="text" name="post_author" id="post_author" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" name="post_status" id="post_status" class="form-control">
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
        <label for="post_content">Post Content</label>
        <textarea name="post_content" id="post_content" class="form-control" cols="30" rows="10"></textarea>
    </div>
    <input class="btn btn-lg btn-primary" type="submit" name="create_post">
</form>