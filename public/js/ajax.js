/* <=== ========================================================================
	Seccion de variables
======================================================================== ==?> */

const SERVER_URL = 'http://localhost/gym2';

/* <=== ========================================================================
	Seccion de clases
======================================================================== ==?> */

class Modal {
	/* <=== ======== Modal de alerta ======== ===> */
	static alert(data_modal = { title : 'Alert', content : 'Alert content default', btn_confirm: 'Aceptar' }) {
		return new Promise((res, rej)=>{
			const modal_back = document.createElement('div');
			modal_back.classList.add('modal-background');
			modal_back.innerHTML = `
				<div class="modal alertModal">
					<p class='title'>${data_modal['title']}</p>
					<p class='content'>${data_modal['content']}</p>
					<div class="buttons-container">
						<button type='button' class="btn btn-safe btn-modal-confirm">${data_modal['btn_confirm']}</button>
					</div>
				</div>
			`;
			document.querySelector('#body').appendChild(modal_back);
			modal_back.querySelector('.modal').querySelector('.btn-modal-confirm').focus();
			modal_back.querySelector('.modal').querySelector('.btn-modal-confirm').addEventListener('click', ()=>{
				this.modalClose();
				res(true);
			})
		});
	}
	/* <=== ======== modal de confirmacion ======== ===> */
	static confirm(data_modal = {title: 'Confirm modal', content : 'Confirm content default', btn_confirm: 'Confirmar', btn_cancel: 'Cancelar'}) {

		return new Promise((res, rej)=>{
			if (data_modal === undefined) {
				let data_modal = {};
			}
			data_modal['title'] = (data_modal['title'] != undefined) ? data_modal['title'] : '¿Estas seguro?';
			data_modal['content'] = (data_modal['content'] != undefined) ? data_modal['content'] : 'Confirm default content';
			data_modal['btn_confirm'] = (data_modal['btn_confirm'] != undefined) ? data_modal['btn_confirm'] : 'Confimrar';
			data_modal['btn_cancel'] = (data_modal['btn_cancel'] != undefined) ? data_modal['btn_cancel'] : 'Cancelar';
			const modal_back = document.createElement('div');
			modal_back.classList.add('modal-background');
			modal_back.innerHTML = `
				<div class="modal confirmModal">
					<p class='title'>${data_modal['title']}</p>
					<p class='content'>${data_modal['content']}</p>
					<div class="buttons-container">
						<button type='button' class="btn btn-safe btn-modal-confirm">${data_modal['btn_confirm']}</button>
						<butto type="button" class="btn btn-warning btn-modal-cancel">${data_modal['btn_cancel']}</butto>
					</div>
				</div>
			`;
			document.querySelector('#body').appendChild(modal_back);
			modal_back.querySelector('.modal').querySelector('.btn-modal-cancel').click();
			modal_back.querySelector('.modal').querySelector('.btn-modal-confirm').addEventListener('click', ()=>{
				this.modalClose();
				res(true);
			})
			modal_back.querySelector('.modal').querySelector('.btn-modal-cancel').addEventListener('click', ()=>{
				this.modalClose();
				res(false);
			})
		});

	}
	/* <=== ======== Modal cambiar contraseña ======== ===> */
	static changePassword() {
		return new Promise((res, rej)=>{
			const modal_back = document.createElement('div');
			modal_back.classList.add('modal-background');
			modal_back.innerHTML = `
				<form typeAction="change_password_user" action="javascript:void(0)" class="modal passwordModal formAjax" method="post">
					<p class='title'>Cambiar Contraseña</p>
					<div class="content">
						<label>
							<fieldset class="field-input-container">
								<legend>Contraseña antigua</legend>
								<input type="password" name="old_password" placeholder="Contraseña actual">
							</fieldset>
						</label>
						<label>
							<fieldset class="field-input-container">
								<legend>Contraseña nueva</legend>
								<input type="password" name="new_password" placeholder="Contraseña nueva">
							</fieldset>
						</label>
					</div>
					<div class="buttons-container">
						<button type='submit' class="btn btn-safe">Confirmar cambio</button>
						<button type='button' class="btn btn-safe btn-modal-cancel">Cancelar</button>
					</div>
				</form>
			`;
			document.querySelector('#body').appendChild(modal_back);
			search_formAjax();

			modal_back.querySelector('.modal').querySelector('.btn-modal-cancel').focus();
			modal_back.querySelector('.modal').querySelector('.btn-modal-cancel').addEventListener('click', ()=>{
				this.modalClose();
				res(false);
			})
		});
	}
	/* <=== ======== Modal - Producto ======== ===> */
	static product(data_modal = { img: '/gym2/public/img/IMG2.jpeg', title: 'Nombre del producto', price: '0', sell_point: 'n/a', amount: '0', description: 'N/A' }) {
		data_modal['img'] = (data_modal['img'] != undefined) ? '/gym2/public/img/products/' + data_modal['img'] : '/gym2/public/img/IMG2.jpeg' ;
		data_modal['title'] = (data_modal['title'] != undefined) ? data_modal['title'] : 'Nombre del producto' ;
		data_modal['price'] = (data_modal['price'] != undefined) ? data_modal['price'] : '0' ;
		data_modal['sell_point'] = (data_modal['sell_point'] != undefined) ? data_modal['sell_point'] : 'N/A' ;
		data_modal['amount'] = (data_modal['amount'] != undefined) ? data_modal['amount'] : '0' ;
		data_modal['description'] = (data_modal['description'] != undefined) ? data_modal['description'] : 'N/A' ;

		return new Promise((res, rej)=>{
			const modal_back = document.createElement('div');
			modal_back.classList.add('modal-background');
			modal_back.innerHTML = `
				<div class="modal productModal">
					<p class="title">${data_modal['title']}</p>
					<div class="content">
						<div class="basic">
							<div class="product_img">
								<img src="${data_modal['img']}" alt="hola">
							</div>
							<div class="text">
								<p><b>Precio: </b><span>${data_modal['price']} COP</span></p>
								<p><b>Punto de venta: </b> <span>${data_modal['sell_point']}</span></p>
								<p><b>Unidades: </b> <span>${data_modal['amount']} Restantes</span></p>
							</div>
						</div>
						<div class="extra">
							<p><b>Descripcion:</b> ${data_modal['description']}</p>
						</div>
					</div>
					<div class="buttons-container">
						<button type="button" class="btn btn-safe btn-modal-cancel">Cerrar</button>
					</div>
				</div>
			`;
			document.querySelector('#body').appendChild(modal_back);
			modal_back.querySelector('.modal').querySelector('.btn-modal-cancel').focus();
			modal_back.querySelector('.modal').querySelector('.btn-modal-cancel').addEventListener('click', ()=>{
				this.modalClose();
				res(false);
			})
		});
	}
	/* <=== ======== Metodo - nuevo producto ======== ===> */
	static newProduct() {
		return new Promise( async (res, rej)=>{
			let sell_points = await getSellPoints();
			// console.log(sell_points);
			let sell_points_html = '';

			for (var i = 0; i < sell_points.length; i++) {
				sell_points_html += `<option value="${sell_points[i]['id']}">${sell_points[i]['name']}</option>`
			}

			// console.log(sell_points_html);

			const modal_back = document.createElement('div');
			modal_back.classList.add('modal-background');
			modal_back.innerHTML = `
				<form typeAction="create_product" action="javascript:void(0)" class="modal productModal newProduct formAjax" method="post">
					<p class='title'>Crear Producto</p>
					<div class="content">
						<label>
							<fieldset class="field-input-container">
								<legend><span>Nombre</span></legend>
								<input type="text" name="name" placeholder="Nombre del producto">
							</fieldset>
						</label>
						<label>
							<fieldset class="field-input-container">
								<legend><span>Cantidad</span></legend>
								<input type="number" name="amount" placeholder="Cantidad disponible">
							</fieldset>
						</label>
						<label>
							<fieldset class="field-input-container">
								<legend><span>Precio (unidad)</span></legend>
								<input type="number" name="price" placeholder="Precio por unidad">
							</fieldset>
						</label>

						<label>
							<fieldset class="field-input-container">
								<legend><span>Puntos de venta</span></legend>
								<select name="sell_point" id="sell_point">
									<option value=""> --- </option>
									${sell_points_html}
								</select>
							</fieldset>
						</label>

						<label class="label-input-container" for="input_file_img">
							<button type="button" class="btn btn-safe btn-file bgc-red">Seleccionar Imagen</button>
							<input type="file" name="input_file_img" id="input_file_img" class="input_file_img" placeholder="Precio por unidad">
						</label>
					</div>
					<div class="buttons-container">
						<button type='submit' class="btn btn-safe">Crear producto</button>
						<button type='button' class="btn btn-safe btn-modal-cancel">Cancelar</button>
					</div>
				</form>
			`;
			document.querySelector('#body').appendChild(modal_back);
			get_btn_file();
			search_formAjax();

			modal_back.querySelector('.modal').querySelector('.btn-modal-cancel').focus();
			modal_back.querySelector('.modal').querySelector('.btn-modal-cancel').addEventListener('click', ()=>{
				this.modalClose();
				res(false);
			})
		});
	}
	/* <=== ======== Cerrar modal ======== ===> */
	static modalClose() {
		const modal_back = document.querySelector('.modal-background:last-child');
		modal_back.querySelector('.modal').classList.add('remove');
		setTimeout(()=>{
			modal_back.removeChild(modal_back.querySelector('.modal'));
			document.querySelector('#body').removeChild(modal_back);
		}, 1000);
	}
}

/* <=== ========================================================================
	Seccion de funciones
======================================================================== ==?> */

/* <=== ======== Funcion - redireccionar ======== ===> */
function url_redirect(url) {
	return window.location.href = SERVER_URL + url;
}

/* <=== ======== Funcion - Buscar formularios ajax ======== ===> */
function search_formAjax() {
	document.querySelectorAll('.formAjax').forEach((form) => {
		form.addEventListener('submit', sendFormAjax);
	});
}

/* <=== ======== Funcion - Buscar datos de formularios Ajax ======== ===> */
async function sendFormAjax(event) {
	event.preventDefault();

	let form_data = new FormData(this);
	let typeForm = event.target.getAttribute('typeAction');
	let headers = new Headers();
	var data = {};

	form_data.set('type', typeForm);

	let config = {
		method : 'POST',
		headers : headers,
		mode : 'cors',
		cache : 'no-cache',
		body : form_data
	};

	await fetch(SERVER_URL+'/app/libraries/functions.php', config)
		.then( response => response.json() )
		.then( async (response) => {
			await console.log(response);
			if (response['RESULT'] === false) {
				alert_title = 'Error';
			} else {
				alert_title = 'Exito';
			}

			if (response['RESULT'] === true) {
				if (form_data.get('type') === 'create_product') {
					// Si se crea un producto
					location.reload();
				} else if (form_data.get('type') === 'login_user') {
					// redireccion de pagina segun el role
					if (response['ROLE'] == 1 || response['ROLE'] == '1') {
						url_redirect('/admin/products');
					} else if (response['ROLE'] == 2) {
						url_redirect('/products');
					}
				} else if (form_data.get('type') === 'create_product') {
					location.reload();
				} else if (form_data.get('type') === 'update_product') {
					location.reload();
				} else {
					
				}
			}

			let result_modal = await Modal.alert({
				title : alert_title,
				content : response['MSG'],
				btn_confirm : 'Aceptar'
			})
			// Definir la accion del modal segun el tipo de formulario
			if (response['RESULT'] === true && result_modal === true) {
				if (form_data.get('type') === 'register_user') {
					url_redirect('/login');
				} else if (form_data.get('type') === 'login_user') {
					if (response['ROLE'] == 1 || response['ROLE'] == '1') {
						url_redirect('/admin/products');
					} else if (response['ROLE'] == 2) {
						url_redirect('/products');
					}
				} else if (form_data.get('type') === 'update_user') {
					location.reload();
				} else if (form_data.get('type') === 'change_password_user') {
					location.reload();
				} else if (form_data.get('type') === 'create_product') {
					location.reload();
				}
			}
		} );
}

/* <=== ======== Funcion - buscar producto ======== ===> */

async function getProduct(event, id) {
	// console.log( {event: event, id: id} );
	let data = {id: id, type: 'get_product_user'};
	let headers = new Headers();

	let config = {
		method : 'POST',
		headers : headers,
		mode : 'cors',
		cache : 'no-cache',
		body : JSON.stringify(data)
	};

	await fetch(SERVER_URL+'/app/libraries/functions.php', config)
		.then( response => response.json() )
		.then( response => {
			// console.log(response);
			let product = response[0];
			if (response.length > 0) {
				Modal.product( {
					img: product['img'],
					title: product['name'],
					price: product['price'],
					sell_point: product['sell_point'],
					amount: product['amount'],
					description: product['description']
				} );
			}
		} )
}

/* <=== ======== Funcion - Obtener puntos de ventas ======== ===> */

async function getSellPoints() {
	let data = {type: 'get_sell_point'};
	let headers = new Headers();

	let config = {
		method : 'POST',
		headers : headers,
		mode : 'cors',
		cache : 'no-cache',
		body : JSON.stringify(data)
	};

	let sell_points;

	await fetch(SERVER_URL+'/app/libraries/functions.php', config)
		.then( response => response.json() )
		.then( response => { sell_points = response } )

	return sell_points;
}

/* <=== ======== Funcion - Aplicar para entrenador ======== ===> */

async function applyToCoachs() {
	let data = { type:'apply_coachs' };
	let headers = new Headers();

	let config = {
		method : 'POST',
		headers : headers,
		mode : 'cors',
		cache : 'no-cache',
		body : JSON.stringify(data)
	};

	await fetch(SERVER_URL+'/app/libraries/functions.php', config)
		.then( response => response.json() )
		.then( response => {
			// console.log(response);
			if (response['RESULT'] === true ) {
				Modal.alert( { title:'Solicitud exitosa', content:response['MSG'] } );
			}
		} )
}


/* <=== ========================================================================
	Seccion de la declaracion para el ajax
======================================================================== ==?> */

// buscando formularios que ocupen ajax
search_formAjax();

// Buscando la existencias del boton para cambiar contraseña
if (document.querySelector('.btn-change-password') != null) {
	const btn_cange_pass = document.querySelector('.btn-change-password');
	btn_cange_pass.addEventListener('click', ()=>{
		Modal.changePassword();
	});
}

// Buscando la existencias del boton solicitud para entrenador
if (document.querySelector('.btn-apply-coachs') != null) {
	const btn_apply_coachs = document.querySelector('.btn-apply-coachs');
	btn_apply_coachs.onclick = async function(e) {
		let modal_response = await Modal.confirm( { title: 'Solicitar ser entrenador', content: '¿Quiere hacer una solicitud para ser un entrenador del gimnasio?'} );
		if ( modal_response == true ) {
			applyToCoachs();
		}
	}
}

// Buscando por la existencia de contenedores de productos
if (document.querySelector('.product-container') != null) {
	document.querySelectorAll('.product-container').forEach((product) => {
		product.addEventListener('click', (event)=>{
			let product_id = product.getAttribute('productId');
			getProduct(event, product_id);
			// Modal.product( {
			// 	title: product_name
			// } );
		})
	});
}
