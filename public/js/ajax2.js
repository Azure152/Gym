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
			document.querySelector('#body').prepend(modal_back);
			modal_back.querySelector('.modal').querySelector('.btn-modal-confirm').focus();
			modal_back.querySelector('.modal').querySelector('.btn-modal-confirm').addEventListener('click', ()=>{
				this.modalClose();
				res(true);
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
	Seccion de funcinones
======================================================================== ==?> */

async function formAjax(data_ajax) {
	fetch('http://localhost/gym2/app/libraries/functions.php', {
		method : 'POST',
		body : JSON.stringify(data_ajax)
	})	.then(res => res.text())
		.then( async (res)=>{
			console.log(res);
			if (res['RESULT'] === false){
				Modal.alert({ title : 'Alerta', content : res['MSG'], btn_confirm : 'Aceptar' });
			} else {
				let modal_result = await Modal.alert({ title : 'Exito', content: res['MSG'], btn_confirm : 'Aceptar' });
				if (modal_result === true) {
					if (data_ajax) {

					}
					// window.location.href = `${SERVER_URL}/login`;
				}
			}
		});
} 


/* <=== ========================================================================
	Seccion de la declaracion para el ajax
======================================================================== ==?> */

document.querySelectorAll('.formAjax').forEach((form) => {
	form.addEventListener('submit', (e)=>{
		e.preventDefault();
		let data_ajax;
		const typeAction = form.getAttribute('typeAction');
		// Modal.alert({ title : 'Alerta', content : 'Contenido de la alerta', btn_confirm : 'Confirmar' });
		if ( typeAction === 'register_user' ) {
			data_ajax = {
				typeFetch : 'register_user',
				name : document.querySelector('#name').value,
				email : document.querySelector('#email').value,
				phone_number : document.querySelector('#phone_number').value,
				password : document.querySelector('#password').value
			};
		} else if ( typeAction === 'login_user' ) {
			data_ajax = {
				typeFetch : 'login_user',
				email : document.querySelector('#email').value,
				password : document.querySelector('#password').value,
			}
		}

		formAjax(data_ajax);
		
	})
});