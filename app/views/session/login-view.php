<?php 
session_start();
if (isset($_SESSION['hola']) || !empty($_SESSION)):
    self::redirect('/products');
endif;
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ingresar | Make Your Body</title>
        <link rel="stylesheet" href="<?php echo SERVER_URL ?>/public/css/normalize.css">
        <link rel="stylesheet" href="<?php echo SERVER_URL ?>/public/css/general.css">
        <link rel="stylesheet" href="<?php echo SERVER_URL ?>/public/css/main.css">
        <script src="<?php echo SERVER_URL ?>/public/js/ajax.js" defer></script>
    </head>
    </head>
    <body id="body">
        <main id="main">
            <div class="page-content page-session">
                <form typeAction="login_user" action="" method="post" class="formAjax form-session">
                    <div class="title">
                        <h2>Iniciar sesion</h2>
                    </div>
                    <div class="content">
                        <label>
                            <fieldset class="field-input-container">
                                <legend><span>E-mail</span></legend>
                                <input type="email" name="email" id="email" placeholder="Correo electronico">
                            </fieldset>
                        </label>
                        <label>
                            <fieldset class="field-input-container">
                                <legend> <span>Contraseña</span></legend>
                                <input type="password" name="password" id="password" placeholder="Contraseña">
                            </fieldset>
                        </label>
                    </div>
                    <div class="buttons-container">
                        <button type="submit" class="btn btn-safe">Iniciar Sesion</button>
                        <a href="<?php echo SERVER_URL ?>/register" type="submit" class="btn btn-safe link">Registrarse</a>
                    </div>
                    <!-- <p class="link">¿Aun no tienes cuenta?, <a href="#">¡crea una!</p> -->
                </form>
            </div>
        </main>
    </body>
</html>