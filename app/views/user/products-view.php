<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Products | Make Your Body</title>
		<link rel="stylesheet" href="<?php echo SERVER_URL ?>/public/css/normalize.css">
        <link rel="stylesheet" href="<?php echo SERVER_URL ?>/public/css/general.css">
        <link rel="stylesheet" href="<?php echo SERVER_URL ?>/public/css/main.css">
        <link rel="icon" href="<?php echo SERVER_URL ?>/public/img/ST.png">
        <!-- Links Font-Awesome -->
        <link rel="stylesheet" href="<?php echo SERVER_URL ?>/public/assets/font-awesome/css/all.css">
        <!-- Scripts -->
        <script src="<?php echo SERVER_URL ?>/public/js/loadscreen.js"></script>
        <script src="<?php echo SERVER_URL ?>/public/js/ajax.js" defer></script>
	</head>
	<body id="body">
		<main id="main">
			<?php include_once PUBLIC_ROOT . '/layouts/nav-lateral.php' ?>
			<div class="page-content page-products">
				<form class="filter-bar">
					<label class="search-input-container">
						<fieldset class="field-input-container">
							<input type="search" name="search" id="" placeholder="Nombre del producto a buscar">
						</fieldset>
					</label>
					<label for="filter" class="select-filter-container">
						<fieldset class="field-input-container">
							<select name="filter" id="filter">
								<option value="">Nombre (A-Z)</option>
								<option value="">Nombre (Z-A) </option>
							</select>
						</fieldset>
					</label>
					<div class="buttons-container">
						<button type="submit" class="btn btn-safe">Buscar</button>
						<button type="reset" class="btn btn-warning">Resetear</button>
					</div>
				</form>
				<!-- <button class="product-container" productId="1">
					<img src="<?php echo SERVER_URL ?>/public/img/IMG.jpeg" alt="">
					<span class="product_name">Nombre Producto</span>
				</button>
				<button class="product-container">
					<img src="<?php echo SERVER_URL ?>/public/img/IMG.jpeg" alt="">
					<span class="product_name">pepito</span>
				</button> -->

				<?php
				foreach($data as $product):
				?>
					<button class="product-container" productId="<?php echo encryption( $product['id']) ?>">
						<img src="<?php echo SERVER_URL ?>/public/img/products/<?php echo $product['img'] ?>" alt="">
						<span class="product_name"><?php echo $product['name'] ?></span>
					</button>
				<?php
				endforeach;
				?>

			</div>
		</main>
	</body>
</html>
