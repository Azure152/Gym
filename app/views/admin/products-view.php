<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Productos</title>
		<link rel="stylesheet" href="<?php echo SERVER_URL ?>/public/css/normalize.css">
        <link rel="stylesheet" href="<?php echo SERVER_URL ?>/public/css/general.css">
        <link rel="stylesheet" href="<?php echo SERVER_URL ?>/public/css/main.css">
        <link rel="icon" href="<?php echo SERVER_URL ?>/public/img/ST.png">
        <!-- Links Font-Awesome -->
        <link rel="stylesheet" href="<?php echo SERVER_URL ?>/public/assets/font-awesome/css/all.css">
        <!-- Scripts -->
        <script src="<?php echo SERVER_URL ?>/public/js/loadscreen.js"></script>
        <script src="<?php echo SERVER_URL ?>/public/js/preview_img.js" defer></script>
        <script src="<?php echo SERVER_URL ?>/public/js/ajax.js" defer></script>
        <script src="<?php echo SERVER_URL ?>/public/js/ajax-admin.js" defer></script>
	</head>
	<body id="body">
		<main id="main">
			<?php include_once PUBLIC_ROOT . '/layouts/nav-lateral-admin.php' ?>
			<div class="page-content page-products page-products-admin">
				<div class="filter-bar-container">
					<!-- Barra de busqueda y filtro para los productos -->
					<form class="filter-bar">
						<label class="search-input-container">
							<fieldset class="field-input-container">
								<input type="search" name="search" id="" placeholder="Nombre del producto a buscar" value="<?php if (isset($_GET['search'])) { echo $_GET['search']; } ?>">
							</fieldset>
						</label>
						<label for="filter" class="select-filter-container">
							<fieldset class="field-input-container">
								<select name="filter" id="filter">
									<option value="ASC">Nombre (A-Z)</option>
									<option value="DESC" <?php if (isset($_GET['filter']) && $_GET['filter'] == 'DESC') { echo 'selected'; } ?> >Nombre (Z-A) </option>
								</select>
							</fieldset>
						</label>
						<div class="buttons-container">
							<button type="submit" class="btn btn-safe">Buscar</button>
							<button type="reset" class="btn btn-warning">Resetear</button>
						</div>
					</form>
					<!-- Opciones de productos -->
					<div class="forms-products-admin">
						<button type="button" class="btn btn-safe btn-new-product">Crear producto <i class="fa-solid fa-plus-circle"></i> </button>
					</div>
				</div>			
				
				<!-- Contenedores de los productos -->
				<!-- <a href="<?php echo SERVER_URL ?>/products/edit/1" class="product-container" productId="1">
					<img src="<?php echo SERVER_URL ?>/public/img/IMG.jpeg" alt="">
					<span class="product_name">Nombre Producto</span>
				</a>
				<a href="<?php echo SERVER_URL ?>/products/edit/2" class="product-container">
					<img src="<?php echo SERVER_URL ?>/public/img/IMG.jpeg" alt="">
					<span class="product_name">pepito</span>
				</a> -->
				<?php foreach($data as $product): ?>
					<a href="<?php echo SERVER_URL ?>/products/edit/<?php echo encryption($product['id']) ?>" class="product-container">
						<img src="<?php echo SERVER_URL ?>/public/img/products/<?php echo $product['img'] ?>" alt="">
						<span class="product_name"><?php echo $product['name'] ?></span>
					</a>
				<?php endforeach; ?>
			</div>
		</main>
	</body>
</html>