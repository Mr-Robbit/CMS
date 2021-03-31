<?php include "includes/admin_header.php"?>


    <div id="wrapper">

    <?php include "includes/admin_navbar.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            welcome to admin
                            <small>Author</small>
                        </h1>

                        <div class="col-xs-6">
                            <?php addCats();?>
                            <?php include "includes/edit_categories.php" ?>
                        </div>
                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category Title</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php findAllCat ();?>

                                        <?php deleteCat(); ?>
                            
                                </tbody>
                            </table>
                        </div>                        
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
   