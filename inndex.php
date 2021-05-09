<?php
include 'daatabase.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> Drug Store Inventory </title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!--	<link rel="stylesheet" href="css/style.css"> -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="ajjax.js"></script>
</head>
<body>
    <div class="container">
	<p id="success"></p>
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2 style= "padding-left: 170px" >  Drug Store Inventory </h2>
					</div>
					<div style="float: right; padding-left: 170px" class="col-sm-7">
						<a href="#addProduct" class="btn btn-success" data-toggle="modal"><i class="material-icons"></i> <span>Add New Drug </span></a>
						<a href="JavaScript:void(0);" class="btn btn-danger" id="delete_multiple"><i class="material-icons"></i> <span>Delete</span></a>						
					</div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
						<th>
							<span class="custom-checkbox">
								<input type="checkbox" id="selectAll">
								<label for="selectAll"></label>
							</span>
						</th>
						<!-- <th>SL NO</th> -->
                        <th>Product Name</th>
                        <th>Product Price (₦)</th>
						<th>Purchase Date</th>
                        <th>Manufacturing Date</th>
                        <th>Expiry Date</th>
                        <th>Prouct Quantity</th>
                    </tr>
                </thead>
				<tbody>
				
				<?php
				$result = mysqli_query($conn,"SELECT * FROM drugs");
					$i=1;
					while($row = mysqli_fetch_array($result)) {
				?>
				<tr id="<?php echo $row["ID"]; ?>">
				<td>
							<span class="custom-checkbox">
								<input type="checkbox" class="user_checkbox" data-user-id="<?php echo $row["ID"]; ?>">
								<label for="checkbox2"></label>
							</span>
						</td>
 					<td><?php echo $row["Product Name"]; ?></td>
					<td><?php echo $row["Product Price"]; ?></td>
					<td><?php echo $row["Purchase Date"]; ?></td>
					<td><?php echo $row["Manufacturing Date"]; ?></td>
                    <td><?php echo $row["Expiry Date"]; ?></td>
                    <td><?php echo $row["Product Quantity"]; ?></td>
					<td>
						<a href="#editProduct" class="edit" data-toggle="modal">
							<i class="material-icons update" data-toggle="tooltip" 
							data-id="<?php echo $row["ID"]; ?>"
							data-product="<?php echo $row["Product Name"]; ?>"
							data-price="<?php echo $row["Product Price"]; ?>"
							data-purchase="<?php echo $row["Purchase Date"]; ?>"
							data-manufacturing="<?php echo $row["Manufacturing Date"]; ?>"
                            data-expiry="<?php echo $row["Expiry Date"]; ?>"
                            data-quantity= "<?php echo $row["Product Quantity"]; ?>"
							title="Edit"></i>
						</a>
						<a href="#deleteProduct" class="delete" data-id="<?php echo $row["ID"]; ?>" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" 
						 title="Delete"></i></a>
                    </td>
				</tr>
				<?php
				$i++;
				}
				?>
				</tbody>
			</table>
			
        </div>
    </div>
	<!-- Add Modal HTML -->
	<div id="addProduct" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="user_form">
					<div class="modal-header">						
						<h4  class="modal-title">Add New Drug </h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>Product Name</label>
							<input type="product" id="product" name="product" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Product Price</label>
							<input type="price" id="price" name="price" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Purchase Date</label>
							<input type="purchase" id="purchase" name="purchase" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Manufacturing Date</label>
							<input type="manufacturing" id="manufacturing" name="manufacturing" class="form-control" required>
						</div>
                        <div class="form-group">
							<label>Expiry Date</label>
							<input type="expiry" id="expiry" name="expiry" class="form-control" required>
						</div>
                        <div class="form-group">
							<label>Product Quantity</label>
							<input type="quantity" id="quantity" name="quantity" class="form-control" required>
						</div>					
					</div>
					<div class="modal-footer">
					    <!-- <input type="hidden" id="id_u" name="type"> -->
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-success" id="btn-add">Add</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Edit Modal HTML -->
	<div id="editProduct" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="update_form">
					<div class="modal-header">						
						<h4 class="modal-title">Edit Product List</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<!-- <input type="hidden" id="id_u" name="id" class="form-control" required>					 -->
						<div class="form-group">
							<label>Product Name</label>
							<input type="product" id="product_u" name="product" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Product Price</label>
							<input type="price" id="price_u" name="price" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Purchase Date</label>
							<input type="purchase" id="purchase_u" name="purchase" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Manufacturing Date</label>
							<input type="manufacturing" id="manufacturing_u" name="manufacturing" class="form-control" required>
						</div>		
                        <div class="form-group">
							<label>Expiry Date</label>
							<input type="expiry" id="expiry_u" name="expiry" class="form-control" required>
						</div>		
                        <div class="form-group">
							<label>Product Quantity</label>
							<input type="quantity" id="quantity_u" name="quantity" class="form-control" required>
						</div>					
					</div>
					<div class="modal-footer">
						<input type="hidden" id="id_u" name="type">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-info" id="update">Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Delete Modal HTML -->
	<div id="deleteProduct" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
						
					<div class="modal-header">						
						<h4 class="modal-title">Delete Product</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="id_d" name="id" class="form-control">					
						<p>Are you sure you want to delete these Records?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-danger" id="delete">Delete</button>
					</div>
				</form>
			</div>
		</div>
	</div>

</body>
</html>    