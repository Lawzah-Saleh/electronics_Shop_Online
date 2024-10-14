<?php
include "header.php";
require "dbconnection.php";

if (isset($_POST['add_to_cart'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = 1;

    $select_cart = $con->prepare("SELECT * FROM `cart` WHERE name = :product_name");
    $select_cart->bindParam(':product_name', $product_name);
    $select_cart->execute();

    if ($select_cart->rowCount() > 0) {
        $message[] = 'product already added to cart';
    } else {
        $insert_product = $con->prepare("INSERT INTO `cart`(name, price, image, quantity) VALUES(:product_name, :product_price, :product_image, :product_quantity)");
        $insert_product->bindParam(':product_name', $product_name);
        $insert_product->bindParam(':product_price', $product_price);
        $insert_product->bindParam(':product_image', $product_image);
        $insert_product->bindParam(':product_quantity', $product_quantity);
        $insert_product->execute();
        $message[] = 'product added to cart successfully';
    }
}?>
   <link rel="stylesheet" href="css/style.css">

    <section class="home-slider owl-carousel">

      <div class="slider-item" style="background-image: url(images/galaxyTabS6.jpg);" data-stellar-background-ratio="0.5">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center">

            <div class="col-md-7 col-sm-12 text-center ftco-animate">
            	<h1 class="mb-3 mt-5 bread">Our Products</h1>
	            <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>products</span></p>
            </div>

          </div>
        </div>
      </div>
    </section>

	<section class="ftco-section">
    	<div class="container">
    		<div class="row justify-content-center mb-5 pb-3">
          		<div class="col-md-7 heading-section ftco-animate text-center">
          			<span class="subheading">Discover</span>
			  		<br>
            		<h2 class="mb-4">  Best Protuct Sellers</h2>
            		<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
          		</div>
				  
        	</div>
        	<div class="row">
			<?php
						$stm = $con->query("SELECT * FROM `products`");
						if ($stm->rowCount() > 0) {
						while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
    			   ?>
			<form action="" method="post">
			<div class="box">	
        	<div class="col-md-3">
        		<div class="menu-entry">
				<img class="img"  style="background-image" src="admin/upload/<?php echo $row['image'] ?>" width="250">
				<div class="text text-center pt-4">
				<h3 style= "color:black"><?php echo $row['name'];  ?></h3>
				<p style= "color:black"><?php echo $row['description'];  ?></p>
				<p style= "color:black"><span><?php echo $row['price']."$";  ?></span></p>
				<input type="hidden" name="product_name" value="<?php echo $row['name']; ?>">
                <input type="hidden" name="product_price" value="<?php echo $row['price']; ?>">
                <input type="hidden" name="product_image" value="<?php echo $row['image']; ?>">
                <input type="submit" class="btn btn-primary btn-outline-primary" value="add to cart" name="add_to_cart">
    					</div>
    				</div>
        	</div>
			</div>
			</form> 
			<?php
				}
				}
			?>
        </div> 
	
        </div> 
		
	</section>	
    
	<section class="ftco-menu">
    	<div class="container">
    		<div class="row justify-content-center mb-5">
          <div class="col-md-7 heading-section text-center ftco-animate">
          	<span class="subheading">Discover</span>
            <h2 class="mb-4">Our Products</h2>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
          </div>
        </div>
    		<div class="row d-md-flex">
	    		<div class="col-lg-12 ftco-animate p-md-5">
		    		<div class="row">
		          <div class="col-md-12 nav-link-wrap mb-5">
		            <div class="nav ftco-animate nav-pills justify-content-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
		              <a class="nav-link active" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1" role="tab" aria-controls="v-pills-1" aria-selected="true">Laptops</a>

		              <a class="nav-link" id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2" role="tab" aria-controls="v-pills-2" aria-selected="false">Phones</a>

		              <a class="nav-link" id="v-pills-3-tab" data-toggle="pill" href="#v-pills-3" role="tab" aria-controls="v-pills-3" aria-selected="false">other</a>
		            </div>
		          </div>
		          <div class="col-md-12 d-flex align-items-center">
		            
		            <div class="tab-content ftco-animate" id="v-pills-tabContent">

		              <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-1-tab">
		              	<div class="row">
		              		<div class="col-md-4 text-center">
		              			<div class="menu-wrap">
		              				<a href="#" class="menu-img img mb-4" style="background-image: url(images/lap1.jpg);"></a>
		              				<div class="text">
		              					<h3><a href="#">Laptop</a></h3>
		              					<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.</p>
		              					<p class="price"><span>$2.90</span></p>
		              					<p><a href="#" class="btn btn-primary btn-outline-primary">Add to cart</a></p>
		              				</div>
		              			</div>
								<?php
                                        // $sql="select * from products" ;
                                        // $stm = $con->prepare($sql);
                                        // $stm->execute();

                                        // if($stm->rowCount())
                                        // {
                                        //     foreach ($stm->fetchAll() as $row) {
                                        //         $id = $row['id'];
                                        //         $name = $row['name'];
                                        //         $description = $row['description'];
                                        //         $image = $row['image'];
                                        //         $price = $row['price'];
                                        //         $cat_id = $row['cat_id'];
                                        //     } }
                                            ?>
		              		</div>
		              		<div class="col-md-4 text-center">
		              			<div class="menu-wrap">
		              				<a href="#" class="menu-img img mb-4" style="background-image: url(images/lap2.jpg);"></a>
		              				<div class="text">
		              					<h3><a href="#"><?php echo $name ?></a></h3>
		              					<p><?php echo $description ?></p>
		              					<p class="price"><span><?php echo $price ?></span></p>
		              					<p><a href="#" class="btn btn-primary btn-outline-primary">Add to cart</a></p>
		              				</div>
		              			</div>
		              		</div>
		              		<div class="col-md-4 text-center">
		              			<div class="menu-wrap">
		              				<a href="#" class="menu-img img mb-4" style="background-image: url(images/lap3.jpg);"></a>
		              				<div class="text">
		              					<h3><a href="#">Laptop</a></h3>
		              					<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.</p>
		              					<p class="price"><span>$2.90</span></p>
		              					<p><a href="#" class="btn btn-primary btn-outline-primary">Add to cart</a></p>
		              				</div>
		              			</div>
		              		</div>
		              	</div>
		              </div>

		              <div class="tab-pane fade" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-2-tab">
		                <div class="row">
		              		<div class="col-md-4 text-center">
		              			<div class="menu-wrap">
		              				<a href="#" class="menu-img img mb-4" style="background-image: url(images/phone1.png);"></a>
		              				<div class="text">
		              					<h3><a href="#">IPhone</a></h3>
		              					<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.</p>
		              					<p class="price"><span>$2.90</span></p>
		              					<p><a href="#" class="btn btn-primary btn-outline-primary">Add to cart</a></p>
		              				</div>
		              			</div>
		              		</div>
		              		<div class="col-md-4 text-center">
		              			<div class="menu-wrap">
		              				<a href="#" class="menu-img img mb-4" style="background-image: url(images/phone2.png);"></a>
		              				<div class="text">
		              					<h3><a href="#">Hwawe</a></h3>
		              					<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.</p>
		              					<p class="price"><span>$2.90</span></p>
		              					<p><a href="#" class="btn btn-primary btn-outline-primary">Add to cart</a></p>
		              				</div>
		              			</div>
		              		</div>
		              		<div class="col-md-4 text-center">
		              			<div class="menu-wrap">
		              				<a href="#" class="menu-img img mb-4" style="background-image: url(images/phone3.jpg);"></a>
		              				<div class="text">
		              					<h3><a href="#">vivo</a></h3>
		              					<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.</p>
		              					<p class="price"><span>$2.90</span></p>
		              					<p><a href="#" class="btn btn-primary btn-outline-primary">Add to cart</a></p>
		              				</div>
		              			</div>
		              		</div>
		              	</div>
		              </div>

		              <div class="tab-pane fade" id="v-pills-3" role="tabpanel" aria-labelledby="v-pills-3-tab">
		                <div class="row">
		              		<div class="col-md-4 text-center">
		              			<div class="menu-wrap">
		              				<a href="#" class="menu-img img mb-4" style="background-image: url(images/screen1.jpg);"></a>
		              				<div class="text">
		              					<h3><a href="#">FHD Screen</a></h3>
		              					<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.</p>
		              					<p class="price"><span>$2.90</span></p>
		              					<p><a href="#" class="btn btn-primary btn-outline-primary">Add to cart</a></p>
		              				</div>
		              			</div>
		              		</div>
		              		<div class="col-md-4 text-center">
		              			<div class="menu-wrap">
		              				<a href="#" class="menu-img img mb-4" style="background-image: url(images/watch1.png);"></a>
		              				<div class="text">
		              					<h3><a href="#">Watch</a></h3>
		              					<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.</p>
		              					<p class="price"><span>$2.90</span></p>
		              					<p><a href="#" class="btn btn-primary btn-outline-primary">Add to cart</a></p>
		              				</div>
		              			</div>
		              		</div>
		              		<div class="col-md-4 text-center">
		              			<div class="menu-wrap">
		              				<a href="#" class="menu-img img mb-4" style="background-image: url(images/screen2.png);"></a>
		              				<div class="text">
		              					<h3><a href="#">FHD Screen</a></h3>
		              					<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.</p>
		              					<p class="price"><span>$2.90</span></p>
		              					<p><a href="#" class="btn btn-primary btn-outline-primary">Add to cart</a></p>
		              				</div>
		              			</div>
		              		</div>
		              	</div>
		              </div>
		            </div>
		          </div>
		        </div>
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