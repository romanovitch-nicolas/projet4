class App {
	constructor() {
		this.header = document.querySelector("header");
		this.menu = document.querySelector("nav");
		this.dropmenu = document.querySelector(".dropmenu");
		this.submenu = document.querySelector(".submenu");
		this.icon = document.querySelector("#burger");
		this.downButton = document.querySelector("#downbutton");
		this.synopsis = document.querySelector("#synopsis");
		this.newCommentButton = document.querySelector("#newcommentbutton");
		this.newCommentInput = document.querySelector("#postcomments div");
		this.newImageButton = document.querySelector("#newimagebutton");
		this.newImageInput = document.querySelector("#newpost div");
		this.editImageButton = document.querySelector("#editimagebutton");
		this.editImageInput = document.querySelector("#editpost div");

		this.tinyInit();
		this.headerColor(this.header);
		this.initMenu(this.menu);
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

	headerColor(header) {
		// Menu en blanc si la page n'est pas tout en haut
		let scroll;
		if (window.scrollY == 0) {
			scroll = false;
		}
		else {
			scroll = true;
			header.style.backgroundColor = "#FFF";
		}

		window.onscroll = function(e) {
			if(scroll == false) {
				scroll = true;
				/*header.animate([
					{backgroundColor: "transparent"},
					{backgroundColor: "#FFF"}
				], {
					duration : 250,
					iterations : 1,
					fill : "forwards"
				});*/
				header.style.animation = "0.25s forwards header-color";
			}
			if (window.scrollY == 0) {
				scroll = false;
				/*header.animate([
					{backgroundColor: "#FFF"},
					{backgroundColor: "transparent"}
				], {
					duration : 250,
					iterations : 1,
					fill : "forwards"
				});*/
				header.style.animation = "0.25s forwards reverse header-color";
			}
		}
	}

	initMenu(menu) {
		// Menu affiché/caché au resize de la page
		if (window.matchMedia("(max-width: 1024px)").matches) {
			menu.classList.add("invisible");
		};

		window.addEventListener("resize", function() {
			if (window.matchMedia("(max-width: 1024px)").matches) {
				menu.classList.add("invisible");
			} else {
				menu.classList.remove("invisible");
			}
		});

		// Affichage du menu burger
		this.icon.addEventListener("click", function() {
			menu.classList.toggle("invisible");
		});

		// Affichage du menu admin
		if(this.dropmenu !== null) {
			this.dropmenu.addEventListener("mouseover", function() {
				this.submenu.classList.remove("invisible");
			}.bind(this));

			this.dropmenu.addEventListener("mouseleave", function() {
				this.submenu.classList.add("invisible");
			}.bind(this));

			this.dropmenu.addEventListener("click", function() {
				this.submenu.classList.toggle("invisible");
			}.bind(this));
		}
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