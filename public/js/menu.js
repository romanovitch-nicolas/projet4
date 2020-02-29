class Menu {
	constructor() {
		this.header = document.querySelector("header");
		this.menu = document.querySelector("nav");
		this.dropmenu = document.querySelector(".dropmenu");
		this.submenu = document.querySelector(".submenu");
		this.icon = document.querySelector("#burger");

		this.headerColor(this.header);
		this.initMenu(this.menu);
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
				header.style.animation = "0.25s forwards header-color";
			}
			if (window.scrollY == 0) {
				scroll = false;
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
}

let menu = new Menu;