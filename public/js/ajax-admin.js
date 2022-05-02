if (document.querySelector('.btn-new-product') != null) {
	const btn_new_product = document.querySelector('.btn-new-product');
	btn_new_product.addEventListener('click', ()=>{
		Modal.newProduct();
	});
}
