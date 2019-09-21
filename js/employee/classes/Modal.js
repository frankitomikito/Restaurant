class ModalController {

	static showModal() {
		const id = document.getElementById('myModal');
		id.className = 'mymodal showw'
		id.style.display = "flex";
		document.getElementById('myModalContainer').className = 'mymodal-container';
	}

	static closeModal() {
		const cont = document.getElementById('myModalContainer');
		cont.className = 'mymodal-container closed';
		const id = document.getElementById('myModal');
		id.className = 'mymodal closed';
		setTimeout(() => {
			id.style.display = "none";
		}, 600);
	}
}