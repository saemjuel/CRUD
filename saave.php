 <?php
include 'daatabase.php';
if(count($_POST)>0){
	if($_POST['type']==1){

		$product=$_POST['product'];
		$price=$_POST['price'];
		$purchase=$_POST['purchase'];
		$manufacturing=$_POST['manufacturing'];
        $expiry=$_POST['expiry'];
        $quantity=$_POST['quantity'];
		$sql = "INSERT INTO `drugs`( `Product Name`, `Product Price`,`Purchase Date`,
        `Manufacturing Date`, `Expiry Date`, `Product Quantity`) 
		VALUES ('$product','$price','$purchase','$manufacturing',$expiry, $quantity)";
		if (mysqli_query($conn, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}
if(count($_POST)>0){
	if($_POST['type']==2){
        $id=$_POST['id'];
		$product=$_POST['product'];
		$price=$_POST['price'];
		$purchase=$_POST['purchase'];
		$manufacturing=$_POST['manufacturing'];
		$expiry=$_POST['expiry'];
        $quantity=$_POST['quantity'];
		// echo "product" . $product;
		$sql = "UPDATE `drugs` SET `Product Name`='$product',`Product Price`='$price',`Purchase Date`='$purchase',`Manufacturing Date`='$manufacturing',
        `Expiry Date`='$expiry', `Product Quantity`='$quantity' WHERE id='$id'";
		if (mysqli_query($conn, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}
if(count($_POST)>0){
	if($_POST['type']==3){
		$id=$_POST['id'];
		$sql = "DELETE FROM `drugs` WHERE id='$id' ";
		if (mysqli_query($conn, $sql)) {
			echo $id;
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}
if(count($_POST)>0){
	if($_POST['type']==4){
		$id=$_POST['id'];
		$sql = "DELETE FROM drugs WHERE id in ($id)";
		if (mysqli_query($conn, $sql)) {
			echo $id;
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}

?>