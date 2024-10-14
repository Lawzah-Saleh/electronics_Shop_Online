<?php
include "header.php";
include 'dbconnection.php';

if (isset($_POST['update_update_btn'])) {
    $update_value = $_POST['update_quantity'];
    $update_id = $_POST['update_quantity_id'];
    $update_quantity_query = $con->prepare("UPDATE `cart` SET quantity = :update_value WHERE id = :update_id");
    $update_quantity_query->bindParam(':update_value', $update_value);
    $update_quantity_query->bindParam(':update_id', $update_id);
    $update_quantity_query->execute();
    if ($update_quantity_query) {
        header('location:cart.php');
    }
}

if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    $remove_query = $con->prepare("DELETE FROM `cart` WHERE id = :remove_id");
    $remove_query->bindParam(':remove_id', $remove_id);
    $remove_query->execute();
    header('location:cart.php');
}

if (isset($_GET['delete_all'])) {
    $delete_all_query = $con->query("DELETE FROM `cart`");
    header('location:cart.php');
}

?>
?>

    <section class="home-slider owl-carousel">

      <div class="slider-item" style="background-image: url(images/galaxyTabS6.jpg);" data-stellar-background-ratio="0.5">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center">

            <div class="col-md-7 col-sm-12 text-center ftco-animate">
            	<h1 class="mb-3 mt-5 bread">Cart</h1>
	            <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Cart</span></p>
            </div>

          </div>
        </div>
      </div>
    </section>
	<!-- style="background:#17a2b8"  -->
		<section class="ftco-section ftco-cart">
			<div class="container">
				<div class="row">
    			<div class="col-md-12 ftco-animate">
    				<div class="cart-list">
	    				<table class="table">
						    <thead class="thead-primary" >
						      <tr class="text-center">
						        <th>&nbsp;</th>
						        <th>Image</th>
						        <th>Product</th>
						        <th>Quantity</th>
						        <th>Price</th>
						        <th>Total</th>
						      </tr>
						    </thead>
						    <tbody>
							<?php

$select_cart = $con->query("SELECT * FROM `cart`");
$grand_total = 0;
if ($select_cart->rowCount() > 0) {
	while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
		?>
						      <tr class="text-center">
                                <td class="product-remove"><a href="cart.php?remove=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('remove item from cart?')" class="delete-btn"> <i class="fas fa-trash"></i><span style="color:black" class="icon-close"></span></a></td>
                                <td><img src="admin/upload/<?php echo $fetch_cart['image']; ?>" height="100" alt=""></td>
								<td class="product-name" style="color:black"><?php echo $fetch_cart['name']; ?></td>
								<td class="quantity">
								<form action="" method="post">
                                        <input type="hidden" name="update_quantity_id" value="<?php echo $fetch_cart['id']; ?>">
                                        <input  style="width: 80px; height: 30px; font-size: 12px;" type="number" name="update_quantity" min="1" value="<?php echo $fetch_cart['quantity']; ?>">
                                        <input type="submit" value="update" name="update_update_btn">
                                    </form>
									</td>
								<td>$<?php echo number_format($fetch_cart['price']); ?></td>
                                <td>$<?php echo $sub_total = number_format($fetch_cart['price'] * $fetch_cart['quantity']); ?></td>
								<td>

							  <?php
                            // $grand_total += $sub_total;
                        };
                    };
                    ?>
						      </tr><!-- END TR-->

						      
							  <tr class="table-bottom">
                        <td><a href="menu.php" class="option-btn" style="margin-top: 0;">continue shopping</a></td>
                        <td colspan="3">grand total</td>
                        <td>$<?php echo $grand_total += $sub_total; ?></td>
                        <td><a href="cart.php?delete_all" onclick="return confirm('are you sure you want to delete all?');" class="delete-btn"> <i class="fas fa-trash"></i> delete all </a></td>
                    </tr>
						    </tbody>
						  </table>
					  </div>
    			</div>
    		</div>
    		<div class="row justify-content-end">
    			<div class="col col-lg-3 col-md-6 mt-5 cart-wrap ftco-animate">
    				<div class="cart-total mb-3">
    					<h3>Cart Totals</h3>
    					
    				</div>
    				<p class="text-center"><a href="checkout.html" class="btn btn-primary py-3 px-4">Proceed to Checkout</a></p>
					<a href="checkout.php" class="btn <?= ($grand_total > 1) ? '' : 'disabled'; ?>">proceed to checkout</a>

				</div>
    		</div>
			</div>
		</section>

    
	<?php
	 include "footer.php" ;
	  ?>

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/jquery.timepicker.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>

    
  </body>
</html>