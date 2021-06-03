
<?php include "includes/header.php" ?>
<?php include "includes/navbar.php" ?>
    <!-- Page Content -->   
    <div class="container">        
        <div class="row">
            <h1 class="page-header">
                All Posts
                <small>Secondary Text</small>
            </h1>
            
            <!-- Blog Entries Column -->
            <div class="col-sm-12 col-md-8">
                <?php
                    $all_posts_query = "SELECT * FROM posts WHERE post_status = 'approved' ";
                    $total_posts = mysqli_query($connection, $all_posts_query);
                    if(!$total_posts){
                        die('error' . mysqli_error($connection));
                    }
                    $count = mysqli_num_rows($total_posts);

                    if($count < 1){
                        echo "<h1 class='text-center' >No Posts Available!</h1>";
                    } else {

                        $page_count = ceil($count/10);
                        if(isset($_GET['page'])){
                            $page = $_GET['page'];
                            $minLimit = 10 * ($page - 1);                        
                        } else {
                            $page = 1;
                            $minLimit = 0;
                        }           
                        $query = "SELECT * FROM posts LIMIT $minLimit, 10 ";
                        $select_all_posts = mysqli_query($connection, $query);
                        while($row = mysqli_fetch_assoc($select_all_posts)){
                            $post_id = $row['post_id'];
                            $post_title = $row['post_title'];
                            $post_author = $row['post_author'];
                            $post_date = $row['post_date'];
                            $post_image = $row['post_image'];
                            $post_content = substr($row['post_content'],0, 100) . " ..." ;
                            $post_status = $row['post_status'];
                            
                            ?>

                        <!-- First Blog Post -->
                                <h2>
                                    <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                                </h2>
                                <p class="lead">
                                    by <a href="author_posts.php?author=<?php echo $post_author ?>&p_id=<?php echo $post_id ?>"><?php echo $post_author ?></a>
                                </p>
                                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                                <hr>

                                <a href="post.php?p_id=<?php echo $post_id ?>">
                                <img height="200" width="auto" src="<?php echo $post_image ?>" alt="Post main Image">
                                </a>

                                <hr>
                                <p><?php echo $post_content ?></p>
                                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                                <hr>       
                            <?php 
                        }
                    } ?>
                </div>
            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>
        </div>
        <!-- /.row -->
        <hr>        
        <ul class="pager">
            <?php for($y = 1; $y <= $page_count; $y++ ){
                if($page == $y){
                    echo "<li><a class='selected' href='index.php?page={$y}'> {$y}  </a></li>";
                } else {
                    echo "<li><a href='index.php?page={$y}'> {$y}  </a></li>";
                }
            } ?>
        </ul>
        <!-- Footer -->
        <?php include "includes/footer.php"; ?>
