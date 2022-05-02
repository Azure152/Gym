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
			document.querySelector('#body').prepend(modal_back);
			modal_back.querySelector('.modal').querySelector('.btn-modal-confirm').focus();
			modal_back.querySelector('.modal').querySelector('.btn-modal-confirm').addEventListener('click', ()=>{
				this.modalClose();
				res(true);
			})
		});
	}
	/* <=== ======== Cerrar modal ======== ===> */
	static confirm(data_modal = {title: 'Alert', content : 'Confirm content default', btn_confirm: 'Confirmar', btn_cancel: 'Cancelar'}) {
		data_modal = (data_modal['title'] != undefined) ? data_modal['title'] : '¿Estas seguro?';
		data_modal = (data_modal['content'] != undefined) ? data_modal['content'] : 'Confirm default content';
		data_modal = (data_modal['btn_confirm'] != undefined) ? data_modal['btn_confirm'] : 'Confimrar';
		data_modal = (data_modal['btn_cancel'] != undefined) ? data_modal['btn_cancel'] : 'Cancelar';

		return new Promise((res, rej)=>{
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
			document.querySelector('#body').prepend(modal_back);
			modal_back.querySelector('.modal').querySelector('.btn-modal-confirm').focus();
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
	/* <=== ======== Cerrar modal ======== ===> */
	static changePassword() {
		return new Promise((res, rej)=>{
			const modal_back = document.createElement('div');
			modal_back.classList.add('modal-background');
			modal_back.innerHTML = `
				<div class="modal passwordModal">
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
						<button type='button' class="btn btn-safe btn-modal-confirm">Confirmar cambio</button>
						<button type='button' class="btn btn-safe btn-modal-cancel">Cancelar</button>
					</div>
				</div>
			`;
			document.querySelector('#body').prepend(modal_back);
			modal_back.querySelector('.modal').querySelector('.btn-modal-cancel').focus();
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
	/* <=== ======== Modal - Producto ======== ===> */
	static product(data_modal = { img: '/gym2/public/img/IMG2.jpeg', title: 'Nombre del producto', price: '0', sell_point: 'n/a', amount: '0', description: 'N/A' }) {
		data_modal['img'] = (data_modal['img'] != undefined) ? data_modal['img'] : '/gym2/public/img/IMG2.jpeg' ;
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
								<p><b>Precio: </b><span>${data_modal['price']}</span></p>
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
	/* <=== ======== Cerrar modal ======== ===> */
	static modalClose() {
		const modal_back = document.querySelector('.modal-background');
		modal_back.querySelector('.modal').classList.add('remove');
		setTimeout(()=>{
			modal_back.removeChild(modal_back.querySelector('.modal'));
			document.querySelector('#body').removeChild(document.querySelector('.modal-background'));
		}, 1000);
	}
}


/* <=== ========================================================================
	Seccion de la declaracion para el ajax
======================================================================== ==?> */

if (document.querySelector('.btn-change-password') != null) {
	const btn_cange_pass = document.querySelector('.btn-change-password');
	btn_cange_pass.addEventListener('click', ()=>{
		Modal.changePassword();
	});
}

if (document.querySelector('.product-container') != null) {
	document.querySelectorAll('.product-container').forEach((product) => {
		product.addEventListener('click', ()=>{
			let product_name = product.querySelector('.product_name').innerHTML;
			Modal.product( {
				title: product_name
			} );
		})
	});
}
