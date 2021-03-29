<!DOCTYPE html>
<html>
<head>
</head>
<body>

<h2>View Product</h2>

<p><b>Title :</b>
<?php echo $product['title']; ?>
</p>
<p><b>Slug :</b>
<?php echo $product['slug']; ?>
</p>
<p><b>Description :</b>
<?php echo $product['description']; ?>
</p>

<?php if($product['image'] != ''){  ?>
	<p><b>Image :</b></p>
	<img src="<?php echo base_url().'uploads/'.$product['image']; ?>" width='150' height="150">
<?php } ?>

</body>
</html>
