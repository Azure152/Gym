<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registrarse | Make Your Body</title>
        <link rel="stylesheet" href="<?php echo SERVER_URL ?>/public/css/normalize.css">
        <link rel="stylesheet" href="<?php echo SERVER_URL ?>/public/css/general.css">
        <link rel="stylesheet" href="<?php echo SERVER_URL ?>/public/css/main.css">
        <script src="<?php echo SERVER_URL ?>/public/js/ajax.js" defer></script>
    </head>
    </head>
    <body id='body'>
        <main>
            <div class="page-content page-session">
                <form typeAction='register_user' action="" method="post" class="formAjax form-session" autocomplete="off">
                    <div class="title">
                        <h2>Registrarse</h2>
                    </div>
                    <div class="content">
                        <label>
                            <fieldset class="field-input-container">
                                <legend><span>Nombre</span></legend>
                                <input type="text" name="name" id="name" placeholder="Nombre completo">
                            </fieldset>
                        </label>
                        <label>
                            <fieldset class="field-input-container">
                                <legend><span>E-mail</span></legend>
                                <input type="email" name="email" id="email" placeholder="Correo electronico">
                            </fieldset>
                        </label>
                        <label>
                            <fieldset class="field-input-container">
                                <legend><span>Nro. Celular</span></legend>
                                <input type="text" name="phone_number" id="phone_number" placeholder="Numero de celular">
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
                        <button type="submit" class="btn btn-safe">Registrarse</button>
                        <a href="<?php echo SERVER_URL ?>/login" type="submit" class="btn btn-safe link">Iniciar Sesion</a>
                    </div>
                    <!-- <p class="link">¿Aun no tienes cuenta?, <a href="#">¡crea una!</p> -->
                </form>
            </div>
        </main>
    </body>
</html>
