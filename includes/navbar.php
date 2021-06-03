
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../CMS">CMS</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-left top-nav">
                    
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Genre <b class="caret"></b></a>
                         
                        <ul class="dropdown-menu">
                        <?php
                        $query = "SELECT * FROM categories";
                        $select_all_cat = mysqli_query($connection, $query);
                       
                        
                        while($row = mysqli_fetch_assoc($select_all_cat)){
                            $cat_title = $row['cat_title'];
                            $cat_id = $row['cat_id'];


                            echo "<li > <a href='category.php?category={$cat_id}'>{$cat_title}</a> </li>";
                            echo "<li class='divider'></li>";
                        }                    
                        ?>
                        
                        
                        </ul>
                    </li>
                    <li class="$category_class">
                        <a href="contact.php">Contact Us</a>
                    </li>
                    <?php if(!isLoggedIn()){ ?>
                        <li class="category_class">
                            <a href="login.php">Login</a>
                        </li>
                    <?php } else if(isLoggedIn()){?>
                        <li class="category_class">
                            <a href="includes/logout.php">LogOut</a>
                        </li>
                    <?php } ?>
                </ul>
                <ul class="nav navbar-right navbar-nav">
                        

                    <?php 
                        if(isset($_SESSION['role'])){
                            if($_SESSION['role'] === 'admin'){
                                echo "<li><a href='admin'>Admin</a></li>";
                            }
                            if(isset($_GET['p_id'])){
                                $post_id = escape($_GET['p_id']);
                                if($_SESSION['role'] === 'admin'){
                                    echo "<li><a href='admin/posts.php?source=edit_post&p_id={$post_id}'> Edit Post</a></li>";

                                }
                            }
                        }
                    ?>
                    
                    
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>