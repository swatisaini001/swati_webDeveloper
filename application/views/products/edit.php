<!DOCTYPE html>
<html>
<head>
</head>
<body>

<h2>Update Product</h2>

<p style="color: red;"><?php echo validation_errors(); ?></p>
<?php echo form_open_multipart(base_url().'update-product/'.$product['id'] ); ?>

<h5>Title</h5>
<input type="text" name="title" value="<?php echo $product['title']; ?>"/>

<h5>Slug</h5>
<input type="text" name="slug" value="<?php echo $product['slug']; ?>"/>

<h5>Description</h5>
<input type="text" name="description" value="<?php echo $product['description']; ?>"/>

<h5>Image</h5>
<input type="file" name="product_image" value=""/>

<?php if($product['image'] != ''){  ?>
	<img src="<?php echo base_url().'uploads/'.$product['image']; ?>" width='150' height="150">
<?php } ?>
<input type="hidden" name="old_image" value='<?php echo $product['image']; ?>'>


<div><input type="submit" value="Update" /></div>

</form>
</body>
</html>
