/*
* <== ==========================================================
* Funciones
* ========================================================== ==>
*/

/* ================= producto modal ================= */

function productModal(modalvalue, modalName) {
    const body = document.getElementById('body');
    modal = document.createElement('div');
    modal.classList.add('modal-back')
    modal.innerHTML = `
        <div class="modal modal-product">
            <div class="title bgc_redV radiusE-bottom">
                <h2>${modalName}</h2>
                <button type="button" class="button closeModal" onclick="closeModal()"><i class="fa-solid fa-xmark fa-lg"></i></button>
            </div>
            <div class="modal-content">
                <div class="basic">
                    <div class="img-product">
                        <img src="../img/IMG.jpeg">
                    </div>
                    <div class="text">
                        <p><b>Nombre:</b> <span>CORVUS JPEG</span></p>
                        <p><b>Precio: </b> <span>105000 COP</span></p>
                        <p><b>Punto de venta: </b> <span>Zona de vestimentas</span></p>
                        <p><b>Unidades Restantes: </b> <span>120</span></p>
                    </div>
                </div>
                <div class="extra">
                    <p><b>Descripcion:</b> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
            </div>
        </div>
    `
    body.insertBefore(modal, body.firstChild);
}
/* ================= contraseña modal ================= */

function modalPassword() {
    const body = document.getElementById('body');
    modal = document.createElement('div');
    modal.classList.add('modal-back')
    modal.innerHTML = `
        <div class="modal modal-password">
            <div class="title bgc_red radiusE-bottom">
                <h2>Cambiar contraseña</h2>
                <button type="button" class="button closeModal" onclick="closeModal()"><i class="fa-solid fa-xmark fa-lg"></i></button>
            </div>
            <div class="modal-content">
                <form action="javascript:void(0)" method="POST" autocomplete="off" class="form-modal">
                    <div class="label_input-container OneInp">
                        <label for="">Contraseña actual: </label>
                        <input type="password" name="current_password" id="current_password" placeholder="Contraseña actual">
                    </div>
                    <div class="label_input-container OneInp">
                        <label for="">Contraseña Nueva: </label>
                        <input type="password" name="new_password" id="new_password" placeholder="Contraseña nueva">
                    </div>
                    <div class="buttons-container">
                        <button type="button" class="button bgc_redV ext_out" onclick="alertModal('password_incosistente')">Confirmar</button>
                    </div>
                </form>
            </div>
        </div>
    `;
    for (var index = 0; index < document.querySelectorAll('.product-container.button').length; index++) {
        const element = document.querySelectorAll('.product-container')[index];
        element.disabled = true;
    };
    body.insertBefore(modal, body.firstChild);
}

/* ================= confirmacion modal ================= */

function alertModal(message) {
    const body = document.getElementById('body');
    modal = document.createElement('div');
    modal.classList.add('modal-back')
    modal.classList.add('alert')
    modal.innerHTML = `
        <div class="modal modal-alert">
            <div class="title bgc_red radiusE-bottom">
                <h2>ALERTA</h2>
                <button type="button" class="button closeModal" onclick="closeModal()"><i class="fa-solid fa-xmark fa-lg"></i></button>
            </div>
            <div class="modal-content">
                <p class="message"></p>
            </div>
        </div>
    `;

    if (message == 'correo_existente') {
        modal.querySelector('.message').innerHTML = 'El correo ingresado ya se encuentra en la base de datos. intente con otro';
    } else if (message == 'password_incosistente') {
        modal.querySelector('.message').innerHTML = 'Las Contraseñas no coinciden';
    }
    for (var index = 0; index < document.querySelectorAll('.button_modal').length; index++) {
        const element = document.querySelectorAll('.button_modal')[index];
        element.disabled = true;
    };
    body.insertBefore(modal, body.firstChild);
}

/* ================= confirmacion modal ================= */

function confirmModal(type) {
    if (type == 'delete_profile') {
        const body = document.getElementById('body');
        modal = document.createElement('div');
        modal.classList.add('modal-back')
        modal.innerHTML = `
            <div class="modal modal-delete">
                <div class="title bgc_red radiusE-bottom">
                    <h2>Eliminar Cuenta</h2>
                    <button type="button" class="button closeModal" onclick="closeModal()"><i class="fa-solid fa-xmark fa-lg"></i></button>
                </div>
                <div class="modal-content">
                    <form action="javascript:void(0)" method="POST" autocomplete="off" class="form-modal">
                        <div>
                            <p>¿Esta seguro de que desea eliminar esta cuenta?. Al hacerlo todos lo datos de la cuenta seran eliminados por lo que ya no podrá acceder por medio de ella.</p>
                        </div>
                        <div class="buttons-container">
                            <button type="submit" name="delete_profile" value="1" class="button bgc_redV ext_out">Confirmar</button>
                        </div>
                    </form>
                </div>
            </div>
        `;
        for (var index = 0; index < document.querySelectorAll('.product-container.button').length; index++) {
            const element = document.querySelectorAll('.product-container')[index];
            element.disabled = true;
        };
        body.insertBefore(modal, body.firstChild);

        document.querySelector('.form-modal').addEventListener('submit', (e)=>{
            // form_data = new FormData(e.currentTarget);
            if (e.submitter.name == 'delete_profile') {
                console.log('Se debe Eliminar el usuario: ' + e.submitter.value);
            }
        })
    } else if (type == 'close_session') {
        const body = document.getElementById('body');
        modal = document.createElement('div');
        modal.classList.add('modal-back')
        modal.innerHTML = `
            <div class="modal modal-delete">
                <div class="title bgc_red radiusE-bottom">
                    <h2>Cerrar Sesion</h2>
                    <button type="button" class="button closeModal" onclick="closeModal()"><i class="fa-solid fa-xmark fa-lg"></i></button>
                </div>
                <div class="modal-content">
                    <form action="javascript:void(0)" method="POST" autocomplete="off" class="form-modal">
                        <div>
                            <p>¿Esta seguro de que desea dar por terminada la sesion con esta cuenta?.</p>
                        </div>
                        <div class="buttons-container">
                            <button type="submit" name="close_session" value="true" class="button bgc_redV ext_out">Confirmar</button>
                        </div>
                    </form>
                </div>
            </div>
        `;
        for (var index = 0; index < document.querySelectorAll('.product-container.button').length; index++) {
            const element = document.querySelectorAll('.product-container')[index];
            element.disabled = true;
        };
        body.insertBefore(modal, body.firstChild);
        document.querySelector('.form-modal').addEventListener('submit', (e)=>{
            // form_data = new FormData(e.currentTarget);
            if (e.submitter.name == 'delete_profile') {
                console.log('Se debe Eliminar el usuario: ' + e.submitter.value);
            }
        })
    }
}

/* ================= registrarse modal ================= */

function registerModal() {

}


/* ================= Cerrar modal ================= */
function closeModal() {
    document.querySelector('.modal').querySelector('.closeModal').disabled = true;
    document.querySelector('.modal').classList.add('remove');
    setTimeout(()=>{
        document.querySelector('.modal').remove();
        document.querySelector('.modal-back').remove();
        for (var index = 0; index < document.querySelectorAll('.product-container.button').length; index++) {
            const element = document.querySelectorAll('.product-container')[index];
            element.disabled = false;
        }
    }, 1000);
}

/*
* <== ==========================================================
* EventListeners
* ========================================================== ==>
*/

for (let index = 0; index < document.querySelectorAll('.product-container').length; index++) {
    const element = document.querySelectorAll('.product-container')[index];
    element.addEventListener('click',()=>{
        productModal(element.value, element.getAttribute('product'));
    })
}
