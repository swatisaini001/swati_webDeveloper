<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap.min.css">

<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>

<h2>Products list</h2>
<a href='add-product'>Add Product</a>

<p style="color: green;" class='msg'><?php echo $this->session->flashdata('success'); ?></p>
<p style="color: red;" class='msg'><?php echo $this->session->flashdata('error'); ?></p>

<table id="example" class="table table-striped table-bordered" style="width:100%">
   <thead>
  <tr>
    <th>Name</th>
    <th>Slug</th>
    <th>Action</th>
  </tr>
</thead>
<tbody>
  <?php if(isset($products) && !empty($products)){ 
  		foreach ($products as $product) { 		
  	?>  
	  <tr>
	    <td><?php echo ($product->title != '')? $product->title : '--'; ?></td>
	    <td><?php echo ($product->slug != '')? $product->slug : '--'; ?></td>
	    <td><a href='view-product/<?php echo $product->id; ?>'>View</a> &nbsp; <a href='update-product/<?php echo $product->id; ?>'>Edit</a> &nbsp; <a href='delete-product/<?php echo $product->id; ?>' onclick="return confirm('Are you sure you want to delete?');">Delete</a></td>
	  </tr>
	<?php } }else{ ?>
    <tr colspan='4'> No records found!</tr>
  <?php } ?>  
  </tbody>
  </table>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#example').DataTable();    
} );

</script>

</body>
</html>
