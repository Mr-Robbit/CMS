
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
                if(isset($_POST['submit'])){
                    $search = escape($_POST['search']);
                    
                    $query = "SELECT * FROM posts WHERE post_title LIKE '%$search%'";
                    $search_query = mysqli_query($connection, $query);
                
                    if(!$search_query){
                        die('search error' . mysqli_error($connection));
                    }
                
                    $count = mysqli_num_rows($search_query);
                
                    if($count== 0){
                        echo "<h1> no result </h1>";
                    }else {

                        while($row = mysqli_fetch_assoc($search_query)){
                            $post_title = $row['post_title'];
                            $post_author = $row['post_author'];
                            $post_date = $row['post_date'];
                            $post_image = $row['post_image'];
                            $post_status = $row['post_status'];
                            $post_content = substr($row['post_content'],0, 100) . " ..." ;
                            if($post_status === "approved"){

                                ?>
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
                                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                                
                                <hr>       
                            <?php }
                        } 
                }
            } ?>
            </div> 

    


            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>
        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <?php include "includes/footer.php"; ?>
