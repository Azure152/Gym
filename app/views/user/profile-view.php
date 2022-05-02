<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Products | Make Your Body</title>
		<!-- Links de los estilos -->
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
			<?php include_once PUBLIC_ROOT . '/layouts/nav-lateral.php' ?>
			<div class="page-content page-profile">
				<form typeAction="update_user" action="javascript:void(0)" method="post" class="formAjax" enctype="multipart/form-data">
					<div class="user-img-container">
						<label>
							<fieldset class="field-input-container" class="img_preview_container">
								<legend><span>Imagen de perfil</span></legend>
								<img src="<?php echo SERVER_URL ?>/public/img/users/<?php echo $data['img'] ?>" alt="" class="img_preview">
								<input type="file" name="img_user" id="img_user" class="input_file_img">
							</fieldset>
						</label>
					</div>
					<div class="content">
						<label>
							<fieldset class="field-input-container">
								<legend><span>Nombre completo</span></legend>
								<input type="text" name="name" id="name" placeholder="Nombre completo" value="<?php echo $data['name'] ?>">
							</fieldset>
						</label>
						<label>
							<fieldset class="field-input-container">
								<legend><span>Correo electronico</span></legend>
								<input type="text" name="email" id="email" placeholder="Correo electronico" value="<?php echo $data['email'] ?>">
							</fieldset>
						</label>
						<label>
							<fieldset class="field-input-container">
								<legend><span>Numero de telefono</span></legend>
								<input type="text" name="phone_number" id="phone_number" placeholder="" value="<?php echo $data['phone_number'] ?>">
							</fieldset>
						</label>
					</div>
					<div class="buttons-container">
						<button type="submit" class="btn btn-safe">Guardar cambios</button>
						<button type="button" class="btn btn-safe btn-change-password">Cambiar contraseña</button>
						<button type="reset" class="btn btn-warning">Resetear campos</button>
						<a href="<?php echo SERVER_URL ?>/user/delete/<?php echo encryption($_SESSION['user']['id']) ?>" type="submit" class="btn btn-warning">Eliminar usuario</a>
					</div>
				</form>
			</div>
		</main>
	</body>
</html>
