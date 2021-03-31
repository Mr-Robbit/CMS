
<div class=" col-sm-12 col-md-4">


    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <div class="row">
            <form action="search.php" method="post">
            <div class="input-group">
                <input type="text" name="search" class="form-control">
                <span class="input-group-btn">
                    <button name="submit" class="btn btn-default" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                </button>
                </span>
            </div>
            </form>
        </div>
        <!-- /.input-group -->
    </div>
    
    <div class="well">
        <h4>Login</h4>
            <form action="includes/login.php" method="post">
            <div class="form-group">
               
                <input type="text" name="username" placeholder="Username or Email" class="form-control">
                
            </div>
            <div class="input-group">
               
                <input type="password" name="user_password" id="user_password" class="form-control" placeholder="password">
                <span class="input-group-btn">
                    <button class="btn btn-primary" name="login" type="submit">Login</button>
                </span>
            </div>
            </form>
        
        <!-- /.input-group -->
    </div>





    <!-- Blog Categories Well -->
    <div class="well">



        <h4>Genre</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                <?php
                    $query = "SELECT * FROM categories";
                    $select_cat_sidebar = mysqli_query($connection, $query);
                    
                    while($row = mysqli_fetch_assoc($select_cat_sidebar)){
                        $cat_title = $row['cat_title'];
                        $cat_id = $row['cat_id'];
                        echo "<li><a href='category.php?category={$cat_id}'>{$cat_title}</a></li>";
                    }                   
                ?>              
                </ul>
            </div>
        </div>
        <!-- /.row -->
        <?php include "widget.php" ?>
    </div>
</div>
<!-- Side Widget Well -->