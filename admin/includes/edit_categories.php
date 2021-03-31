<?php // Edit categories
    if(isset($_GET['edit'])){
        $update_cat_id = $_GET['edit'];
        $cat_title_single = $_GET['editname'];
        $btn_text = "Update Category";
        $form_id = "edit_cat_form";
        $label_for = "edit_cat_title";
        $input_name = "edit_cat_title";
        $input_id = "edit_cat_title";
        $btn_class = "btn btn-primary";
        $btn_name = "submit_cat";
        $input_value = $cat_title_single;
        if(isset($_POST['submit_cat'])){
            $cat_title = $_POST['edit_cat_title'];
            $update_query = "UPDATE categories SET cat_title = '$cat_title' WHERE cat_id = $update_cat_id";
            $updated_cat = mysqli_query($connection, $update_query);
            if(!$updated_cat){
                die('Failed to update' . mysqli_error($connection));
            } else {
                header('Location: categories.php');
            }
            
        }
    } else {
            $form_id = "add_cat_form";
            $label_for = "cat_title";
            $input_name = "cat_title";
            $input_id = "cat_title";
            $btn_class = "btn btn-success";
            $btn_name = "submit";
            $btn_text = "Add Category";
            $undo_btn = 5;
            $input_value = "";

        } 

?>

<form class="" action="#" method="post" id="<?php echo $form_id; ?> ">
    <div class="form-group">
        <label for="<?php echo $label_for; ?>">Category Title</label>
        <input type="text" class="form-control" name="<?php echo $input_name ?>" id="<?php echo $input_id; ?>" value="<?php echo $input_value?>">
    </div>
    <div class="form-group">
        <input type="submit" class="<?php echo $btn_class; ?>" name="<?php echo $btn_name?>" value=" <?php echo $btn_text; ?> " >

        <?php
        if(isset($_GET['edit'])){
            echo ' <a class="btn btn-warning" id="undo_edit" href="categories.php"> Undo Edit </a> ';
        };
        
        
    ?>
    </div>
</form>