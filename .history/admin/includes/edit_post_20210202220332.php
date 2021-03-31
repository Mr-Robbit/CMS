<?php 
if(isset($_GET['p_id'])){
    $the_post_id = $_GET['p_id'];

}
$query = "SELECT * FROM posts WHERE post_id=$the_post_id ";
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
            $post_content = $edit_post_id['post_content'];
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
        <label for="post_category">Post Category</label>
        <input value="<?php echo $post_category_id ?>" type="text" name="post_category_id" id="post_category" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_author">Post author</label>
        <input value="<?php echo $post_author ?>" type="text" name="post_author" id="post_author" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input value="<?php echo $post_status ?>" type="text" name="post_status" id="post_status" class="form-control">
    </div>
    <div class="form-group">
        <img width="100px" src="../<?php echo $post_image ?>" alt="">
    </div>
    <div class="form-group">
        <label for="post_tag">Post Tags</label>
        <input value="<?php echo $post_tags ?>" type="text" name="post_tag" id="post_tag" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea name="post_content" id="post_content" class="form-control" cols="30" rows="10"><?php echo $post_content ?></textarea>
    </div>
    <input class="btn btn-lg btn-primary" type="submit" name="create_post">
</form>