var sliderPhoto = {

    slide: document.getElementsByClassName("slide"),
    imageNum: 0,
    flecheDroite: document.getElementsByClassName("w3-right"),   // fleche droite
    flecheGauche: document.getElementsByClassName("w3-left"),    // fleche Gauche
    dots: document.getElementsByClassName("bulle"),

    start: function(n) {
        this.imageNum = n;
        this.slide[this.imageNum].style.display = "block";
        this.dots[this.imageNum].className = "bulle hover-white actif";
    },

    next: function() {
        // Si le numero du slide > au numero de la dernière image alors on revient à la première image
        if (this.imageNum < this.slide.length) {
            this.imageNum++;
            this.slide[this.imageNum - 1].style.display = "none";
            this.dots[this.imageNum - 1].className = "bulle hover-white inactif";

        } 
        if (this.imageNum === this.slide.length) {
            this.imageNum = 0;
        }
        this.slide[this.imageNum].style.display = "block";
        this.dots[this.imageNum].className = "bulle hover-white actif";
        clearInterval();

    },

    previous: function() {

        if (this.imageNum >= 0){
            this.imageNum--;
            this.slide[this.imageNum + 1].style.display = "none";
            this.dots[this.imageNum + 1].className = "bulle hover-white inactif";
        }
        // Si le numero du slide > au numero de la dernière image alors on revient à la première image
        if (this.imageNum < 0) {
            this.imageNum = this.slide.length-1;
            this.slide[0].style.display = "none";
            this.dots[0].className = "bulle hover-white inactif";
        } 

        // Enfin on
        this.slide[this.imageNum].style.display = "block";
        this.dots[this.imageNum].className = "bulle hover-white actif";
        console.log(this.imageNum);
    },

    current: function(n){
        this.slide[this.imageNum].style.display = "none";
        this.dots[this.imageNum].className = "bulle hover-white inactif";
        this.start(n)
    }
}
sliderPhoto.start(0);
var timer = setInterval(sliderPhoto.next.bind(sliderPhoto), 5000);