<?php 
if(isset($_GET['p_id'])){
    $p_id = $_GET['p_id'];

}
$query = 'SELECT * FROM posts Where post_id = $p_id ';
        global $connection;
        $query_post_by_id = mysqli_query($connection, $query);
        if(!$query_post_by_id){
        die("query failed" . mysqli_error($connection));
        };
        
        while( $edit_post_id = mysqli_fetch_assoc($query_post_by_id )){
            $post_id = $edit_post_id['post_id'];
            $post_author = $edit_post_id['post_author'];
            $post_title = $edit_post_id['post_title'];
            $post_category_id = $edit_post_id['post_category_id'];
            $post_status = $edit_post_id['post_status'];
            $post_image = $edit_post_id['post_image'];
            $post_tags = $edit_post_id['post_tag'];
            $post_comment_count = $edit_post_id['post_comment_count'];
            $post_date = $edit_post_id['post_date'];
        }


?>



<h1 class="page-header">
    Edit Post
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