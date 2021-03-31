



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