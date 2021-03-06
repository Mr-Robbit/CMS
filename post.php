<?php include "includes/db.php" ?>
<?php include "includes/header.php" ?>



    

<?php include "includes/navbar.php" ?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1>
    
            <!-- Blog Entries Column -->
            <div class="col-sm-6 col-md-8">
                <?php 
                // post show 
                if(isset($_GET['p_id'])){
                    $post_id = $_GET['p_id'];
                }
                    $query = "SELECT * FROM posts WHERE post_id = $post_id ";
                    $select_all_posts = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_assoc($select_all_posts)){
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];

                        ?>

                        <!-- First Blog Post -->
                        <h2>
                            <a href="#"><?php echo $post_title ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="index.php"><?php echo $post_author ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                        <hr>
                        <img height="200" width="auto" src="<?php echo $post_image ?>" alt="">
                        <hr>
                        <p><?php echo $post_content ?></p>
                       

                        <hr>       
                    <?php } ?>
                    <!-- // create comment  -->
                    <?php 
                        if(isset($_POST['create_comment'])){
                            $comment_author = $_POST['comment_author'];
                            $comment_email = $_POST['comment_email'];
                            $comment_content = $_POST['comment_content'];
                            
                            $query = "INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
                            $query .= " VALUES($post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'pending', now()) ";
                            $create_comment_result = mysqli_query($connection, $query);
                            if(!$create_comment_result){
                                die('query error' . mysqli_error($connection));
                            }
                            
                            $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $post_id ";
                            $res = mysqli_query($connection, $query);
                            if(!$res){
                                die('error' . mysqli_error($connection));
                            }

                        }
                    
                    
                    ?>
                    

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>



                    <form role="form" action="" method="POST">
                        <div class="form-group">
                            <label for="Author">Author</label>
                            <input type="text" id="author" class="form-control" name="comment_author">
                        </div>
                    <form role="form">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" class="form-control" name="comment_email">
                        </div>
                        <div class="form-group">
                            <label for="content">Your Comment!</label>
                            <textarea class="form-control" id="content" rows="3" name="comment_content"></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                <?php 
                //view all comments related to post
                    $query = "SELECT * FROM comments WHERE comment_post_id = $post_id ";
                    $query .= "AND comment_status ='approved' ";
                    $query .= "ORDER BY comment_id DESC";
                    $show_comments_query = mysqli_query($connection, $query);
                    while($row = mysqli_fetch_assoc($show_comments_query)){
                        $comment_author = $row['comment_author'];
                        $comment_email = $row['comment_email'];
                        $comment_content = $row['comment_content'];
                        $comment_date = $row['comment_date'];
                        ?>
                        <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"><?php echo $comment_author ?>
                                <small><?php echo $comment_date ?></small>
                            </h4>
                            <?php echo $comment_content ?>
                    </div>
                </div>        
                    <?php } ?>
                
                
         

                <!-- Comment -->
               
                </div> 

    


            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>
        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <?php include "includes/footer.php"; ?>

