<?php
/* @var $categoryData Category */
?>

<form action="" method="post">
    <fieldset>
        <legend>Update Category Data</legend>
        <label for="idTxtCatName">Category name</label>
        <input id="idTxtCatName" name="txtCatName" type="text" autofocus="" placeholder="Category Name" required="" value="<?php echo $categoryData->getName(); ?>">
        <br>
        <input type="submit" name="btnUpdate" value="Update Data" class="button button-primary">
    </fieldset>
</form>