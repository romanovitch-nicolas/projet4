class App {
	constructor() {
		this.header = document.querySelector("header");
		this.downButton = document.querySelector("#downbutton");
		this.synopsis = document.querySelector("#synopsis");
		this.editImageButton = document.querySelector("#editimagebutton");
		this.editImageInput = document.querySelector("#editimageinput");

		this.headerColor(this.header);
		if(this.downButton !== null) { this.scrollCorrection(); }
		if(this.editImageButton !== null) { this.displayFileInput(); }
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
				header.animate([
					{backgroundColor: "transparent"},
					{backgroundColor: "#FFF"}
				], {
					duration : 250,
					iterations : 1,
					fill : "forwards"
				});
			}
			if (window.scrollY == 0) {
				scroll = false;
				header.animate([
					{backgroundColor: "#FFF"},
					{backgroundColor: "transparent"}
				], {
					duration : 250,
					iterations : 1,
					fill : "forwards"
				});
			}
		}
	}

	scrollCorrection() {
		// Correction du scroll du bouton "Découvrir le livre" de la page d'accueil
		this.downButton.addEventListener("click", function(e) {
			e.preventDefault();
			window.scrollTo(0, this.synopsis.offsetTop - 120);
		}.bind(this));
	}

	displayFileInput() {
		// Affichage de l'input "file" au clic sur "Modifier l'image"
		this.editImageButton.addEventListener("click", function(e) {
			e.preventDefault();
			this.editImageInput.classList.toggle("invisible");
			this.editImageInput.animate([
					{transform: "translateY(-15%)", opacity: 0},
					{transform: "translateY(0)", opacity: 1}
				], {
					duration : 150,
					iterations : 1,
			});
		}.bind(this));
	}
}

let menu = new App;