/* <=== =========================================================================
	Seccion de funciones
========================================================================= ===> */

/* ----------------------------------------------------------------------------------
	Img-preview - Previsualizacion de una imagen en elemento IMG
---------------------------------------------------------------------------------- */

function preview_img(event) {
	const preview_img_container = document.querySelector('.img_preview');
	const img_file = document.querySelector('.input_file_img').files[0];

	if (img_file) {
		preview_img_container.src = URL.createObjectURL(img_file);
	} 
}

/* ----------------------------------------------------------------------------------
	Btn-file - Nombre del archivo en el boton de seleccion de archivo
---------------------------------------------------------------------------------- */

function get_btn_file() {
	if ( document.querySelector('.input_file_img') != null && document.querySelector('.btn-file') != null ) {
		document.querySelectorAll('.btn-file').forEach((btn_file)=>{
			btn_file.onclick = function(e) { e.target.parentElement.querySelector('.input_file_img').click(); };
			btn_file.parentElement.querySelector('.input_file_img').onchange = function(e) {
				console.log('Change');
				if (e.target.files.length > 0) {
					e.target.parentElement.querySelector('.btn-file').innerText = e.target.files[0].name;
				} else {
					e.target.parentElement.querySelector('.btn-file').innerText = 'Seleccionar imagen';
				}
			};
		})
	}
}

/* <=== =========================================================================
	Seccion de eventos
========================================================================= ===> */

if ( document.querySelector('.input_file_img') != null && document.querySelector('.img_preview') != null ) {
	document.querySelector('.input_file_img').onchange = preview_img;
}