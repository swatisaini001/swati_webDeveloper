<!DOCTYPE html>
<html>
<head>
</head>
<body>

<h2>Add Products</h2>

<p style="color: red;"><?php echo validation_errors(); ?></p>
<p style="color: red;"><?php echo $this->session->flashdata('error'); ?></p>

<?php echo form_open_multipart(base_url().'add-product'); ?>

<h5>Title</h5>
<input type="text" name="title" value="<?php echo set_value('title'); ?>"/>

<h5>Slug</h5>
<input type="text" name="slug" value="<?php echo set_value('slug'); ?>"/>

<h5>Description</h5>
<input type="text" name="description" value=""/>

<h5>Image</h5>
<input type="file" name="product_image" value=""/>

<div><input type="submit" value="Add" /></div>

</form>
</body>
</html>
