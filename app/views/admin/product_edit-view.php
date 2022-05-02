<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Producto | <?php echo $data['product']['name'] ?></title>
		<link rel="stylesheet" href="<?php echo SERVER_URL ?>/public/css/normalize.css">
        <link rel="stylesheet" href="<?php echo SERVER_URL ?>/public/css/general.css">
        <link rel="stylesheet" href="<?php echo SERVER_URL ?>/public/css/main.css">
        <link rel="icon" href="<?php echo SERVER_URL ?>/public/img/ST.png">
        <!-- Links Font-Awesome -->
        <link rel="stylesheet" href="<?php echo SERVER_URL ?>/public/assets/font-awesome/css/all.css">
        <!-- Scripts -->
        <script src="<?php echo SERVER_URL ?>/public/js/loadscreen.js"></script>
        <script src="<?php echo SERVER_URL ?>/public/js/ajax.js" defer></script>
        <script src="<?php echo SERVER_URL ?>/public/js/preview_img.js" defer></script>
	</head>
	<body id="body">
		<main id="main">
			<?php include_once PUBLIC_ROOT . '/layouts/nav-lateral-admin.php' ?>
			<div class="page-content page-product-edit">
				<form typeAction="update_product" action="javascript:void(0)" method="post" class="formAjax">
					<div class="product-img-container">
						<label>
							<fieldset class="field-input-container" class="img_preview_container">
								<legend><span>Imagen del producto</span></legend>
								<img src="<?php echo SERVER_URL ?>/public/img/products/<?php echo $data['product']['img'] ?>" alt="" class="img_preview">
								<input type="file" name="img_product" id="img_product" class="input_file_img">
							</fieldset>
						</label>
					</div>
					<div class="content">
						<label>
							<fieldset class="field-input-container">
								<legend>Nombre: </legend>
								<input type="text" name="name" id="name" placeholder="Nombre del producto" value="<?php echo $data['product']['name'] ?>">
							</fieldset>
						</label>
						<label>
							<fieldset class="field-input-container">
								<legend>Precio (COP): </legend>
								<input type="number" name="price" id="price" placeholder="Precio del producto" value="<?php echo $data['product']['price'] ?>">
							</fieldset>
						</label>
						<label>
							<fieldset class="field-input-container">
								<legend>Unidades: </legend>
								<input type="number" name="amount" id="amount" placeholder="Cantidad de unidades" value="<?php echo $data['product']['amount'] ?>">
							</fieldset>
						</label>
						<label for="sell_point">
							<fieldset class="field-input-container">
								<legend>Punto de venta: </legend>
								<select name="sell_point" id="sell_point">
									<!-- <option value="1">Esquina Izquierda</option> -->
									<?php foreach($data['sell_points'] as $sell_point): ?>
										<option value="<?php echo encryption($sell_point['id']) ?>"><?php echo $sell_point['name'] ?></option>
									<?php endforeach; ?>
								</select>
							</fieldset>
						</label>
						<input type="hidden" name="id" value="<?php echo encryption($data['product']['id']) ?>">
					</div>
					<div class="description-container">
						<label>
							<fieldset class="field-input-container">
								<legend>Descripcion</legend>
								<textarea name="description" id="description" cols="30" rows="7" placeholder="Descripcion del producto: Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."><?php echo $data['product']['description'] ?></textarea>
							</fieldset>
						</label>
					</div>
					<div class="buttons-container">
						<button type="submit" class="btn btn-safe">Guardar Cambios</button>
					</div>
				</form>
			</div>
		</main>
	</body>
</html>