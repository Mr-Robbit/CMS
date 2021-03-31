
<?php
function confirm($query){
    global $connection;
    if(!$query){
            die('Query Failed! Please try again ' . mysqli_error($connection));
        } 
}

    function addCats() {
        if(isset($_POST['submit'])){
            $add_cat_title = $_POST['cat_title'];
            global $connection;
            if($add_cat_title == '' || empty($add_cat_title)){
                echo "this field should not be empty! ";
            } else {
                $query = "INSERT INTO categories(cat_title)";
                $query .= " VALUES ('$add_cat_title')";
                $add_cat = mysqli_query($connection, $query);
                if(!$add_cat) {
                    die('Failed to add category' . mysqli_error($connection));
                }
            }
        }
    }
    
?>
<?php


function findAllCat(){
    $query = "SELECT * FROM categories";
    global $connection;
    $select_cat_sidebar = mysqli_query($connection, $query);
    
    while($row = mysqli_fetch_assoc($select_cat_sidebar)){
        $cat_title = $row['cat_title'];
        $cat_id = $row['cat_id']; 
        ?>        
        <tr>
            <td> <?php echo $cat_id ?> </td>
            <td> <?php echo $cat_title ?> </td>
            <td><a href="categories.php?delete=<?php echo $cat_id ?>" class="btn btn-danger">Delete </a><a href="categories.php?edit=<?php echo $cat_id?>&editname=<?php echo $cat_title?>" class="edit_btn btn btn-warning" >Edit</a></td>
        </tr>
    <?php } 
};



function deleteCat(){
    global $connection;
    if(isset($_GET['delete'])){
        $cat_id = $_GET['delete'];
        $query = "DELETE FROM categories ";
        $query .= "WHERE cat_id = $cat_id";
        $delete_cat = mysqli_query($connection, $query);
        if(!$delete_cat){
            die('Failed to delete category' . mysqli_error($connection));
        } else{
            header("Location: categories.php");
        }
    }
}


?>