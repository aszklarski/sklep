<?php

require __DIR__ . '\..\media\shopingCart.php';
$app = new ShopingCart();
 
$products = $app->getProducts();
$categories = $app->getCategory();
?>


<div class="content">
	<div class="left">
		<nav class="navi-shop">
			<ul>
				<?php 
				if(isset($_SESSION['imie'])){
					if($_SESSION['imie']=="admin"){
						
						echo '<li><a href="media/item_add.php">+ dodaj element!</a></li>';
						
					}	
				}				
				echo '<li><a href="media/menu_session_start.php?menu=all">Wszystkie produkty</a></li>';
				if(count($categories) > 0)
				{
					foreach ($categories as $category) 
					{
						$test = $category['kategoria'];
						echo '<li><a  href="media/menu_session_start.php?menu='.$category['kategoria'].'">'. $category['kategoria'] .'</a></li>';
										
						
					}
				}				
				?>
				
			</ul>
		</nav>
	</div>
	<div class="right">
		 <?php	
				if(!isset($_SESSION['shop_menu'])){
					$_SESSION['shop_menu']=NULL;
				}
				
                if(count($products) > 0)
                {
                    foreach ($products as $product) {
						if($_SESSION['shop_menu'] == $product['kategoria']){
							
							echo ' 	<form method="post" class = "product" action="media/add_to_basket.php"> 
										<div>
											<h5>'. $product['nazwa'] .'</h5> 
											<div class="card-body">
												<div class="product_img">
													<img src="media/img/products/' . $product['zdjecie'] . '.jpg" />
												</div>
												<input	type="hidden" name="hidden_id" value="' . $product['id'] . ' "/>
												<input	type="hidden" name="hidden_name" value="' . $product['nazwa'] . '"/>
												<input type="submit" value="Dodaj do koszyka!"/>
												
												<div class="category">
													' . $product['kategoria'] . '
												</div>
											</div>
										</div>
									</form>';
						}
						
						if($_SESSION['shop_menu'] == "all"){
							echo ' 	<form method="post" class = "product" action="media/add_to_basket.php"> 
										<div>
											<h5>'. $product['nazwa'] .'</h5> 
											<div class="card-body">
												<div class="product_img">
													<img src="media/img/products/' . $product['zdjecie'] . '.jpg" />
												</div>
												<input	type="hidden" name="hidden_id" value="' . $product['id'] . ' "/>
												<input	type="hidden" name="hidden_name" value="' . $product['nazwa'] . '"/>
												<input type="submit" value="Dodaj do koszyka!"/>
												
												<div class="category">
													' . $product['kategoria'] . '
												</div>
											</div>
										</div>
									</form>';
						}							
                    }
                }
                ?>
	
	</div>
</div>

