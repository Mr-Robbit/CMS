<?php include "includes/admin_header.php"?>


    <div id="wrapper">

    <?php include "includes/admin_navbar.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">                    
                        <?php
                            if(isset($_GET['source'])){
                                $source = $_GET['source'];
                            } else {
                                $source = '';
                            }
                            switch ($source) {
                                case 'add_post.php';
                                    include "includes/add_post.php";
                                    break;

                                // case 'posts.php';
                                //     include "includes/view_all_posts.php";
                                //     break;
                                

                                case 'edit_post.php';
                                    include "includes/edit_post.php";
                                    break;

                                // case 'delete_post.php';
                                //     include "includes/delete_post.php";
                                //     break;
                                    
                                default:
                                    include "includes/view_all_posts.php";  
                                    break;
                            }
                            
                        
                        ?>

                                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

   <?php include "includes/admin_footer.php" ?>
   