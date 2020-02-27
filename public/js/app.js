class App {
	constructor() {
		this.downButton = document.querySelector("#downbutton");
		this.synopsis = document.querySelector("#synopsis");
		this.newCommentButton = document.querySelector("#newcommentbutton");
		this.newCommentInput = document.querySelector("#postcomments div");
		this.newImageButton = document.querySelector("#newimagebutton");
		this.newImageInput = document.querySelector("#newpost div");
		this.editImageButton = document.querySelector("#editimagebutton");
		this.editImageInput = document.querySelector("#editpost div");

		this.tinyInit();
		if(this.downButton !== null) { this.scrollCorrection(); }
		if(this.newCommentButton !== null) { this.displayFileInput(this.newCommentButton, this.newCommentInput); }
		if(this.newImageButton !== null) { this.displayFileInput(this.newImageButton, this.newImageInput); }
		if(this.editImageButton !== null) { this.displayFileInput(this.editImageButton, this.editImageInput); }
	}

	tinyInit() {
		// Initialisation de l'éditeur de texte
        tinymce.init({
	        force_br_newlines: true,
	        force_p_newlines: false,
	        forced_root_block: '',
	        content_css: ['https://fonts.googleapis.com/css?family=Indie+Flower&display=swap',
	            'https://fonts.googleapis.com/css?family=Courier+Prime&display=swap',
	            'public/css/style.css'],
	        selector: '#post',
	        height: 350,
	        statusbar: false,
	        toolbar: 'undo redo | copy cut paste | fontselect | fontsizeselect | bold italic underline strikethrough | forecolor backcolor | alignleft aligncenter alignright alignjustify | outdent indent | superscript subscript',
	        menubar: '',
	        font_formats: "Arial=arial,helvetica,sans-serif;" + "Arial Black=arial black,avant garde;" + "Comic Sans MS=comic sans ms,sans-serif;" + "Courier Prime=Courier Prime, courier new, courier;" + "Georgia=georgia,palatino;" +  "Helvetica=helvetica;" + "Impact=impact,chicago;" + "Indie Flower=Indie Flower, cursive;" + "Symbol=symbol;" + "Tahoma=tahoma,arial,helvetica,sans-serif;" + "Terminal=terminal,monaco;" + "Times New Roman=times new roman,times;" + "Trebuchet MS=trebuchet ms,geneva;" + "Verdana=verdana,geneva;"
	        });
		}

	scrollCorrection() {
		// Correction du scroll du bouton "Découvrir le livre" de la page d'accueil
		this.downButton.addEventListener("click", function(e) {
			e.preventDefault();
			window.scrollTo(0, this.synopsis.offsetTop - 120);
		}.bind(this));
	}

	displayFileInput(button, input) {
		// Affichage de l'input "file" au clic sur "Modifier l'image"
		button.addEventListener("click", function(e) {
			e.preventDefault();
			input.classList.toggle("invisible");
			input.animate([
					{transform: "translateY(-5%)", opacity: 0},
					{transform: "translateY(0)", opacity: 1}
				], {
					duration : 150,
					iterations : 1,
			});
		});
	}
}

let app = new App;