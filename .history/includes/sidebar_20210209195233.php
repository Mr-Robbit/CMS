
<div class="col-md-4">


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





    <!-- Blog Categories Well -->
    <div class="well">



        <h4>Main Genre</h4>
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