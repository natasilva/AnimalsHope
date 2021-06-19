/* Animação com o Scroll */
const debounce = function(func, wait, immediate) {
  let timeout;
  return function(...args) {
    const context = this;
    const later = function() {
      timeout = null;
      if(!immediate) func.apply(context, args);
    };
    const callNow = immediate && !timeout;
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
    if(callNow) func.apply(context, args);
  };
};

const target = document.querySelectorAll('[data-anime]');
const animationClass = 'animate';

function animarScroll() {
    const windowTop = window.pageYOffset + (window.innerHeight * 0.75);
    target.forEach(function(element) {
        if(windowTop > element.offsetTop) {
            element.classList.add(animationClass)
        } else {
            element.classList.remove(animationClass)
        }
    }) 
}

animarScroll();

if(target.length) {
  window.addEventListener('scroll', debounce(function() {
    animarScroll();
  }, 200));
}


/* Animação cards - sobre o site */
var modelo    = document.getElementById("myModal")
var img1     = document.getElementById("myImg1")
var img2     = document.getElementById("myImg2")
var img3     = document.getElementById("myImg3")
var img4     = document.getElementById("myImg4")
var modalImg = document.getElementById("img01")
var span     = document.getElementsByClassName("fechar")[0]

$(".imgs-sobre").click(function() {
  corpo.style.overflow = "hidden"
})

$(img1).click(function() {
  modelo.style.display = "block"
  modalImg.src = this.src
  nav.style.display = "none"
});
$(img2).click(function() {
  modelo.style.display = "block"
  modalImg.src = this.src
  nav.style.display = "none"
});
$(img3).click(function() {
  modelo.style.display = "block"
  modalImg.src = this.src
  nav.style.display = "none"
});
$(img4).click(function() {
  modelo.style.display = "block"
  modalImg.src = this.src
  nav.style.display = "none"
});

$(span).click(function() {
  modelo.style.display = "none"
  nav.style.display = "inherit"
  corpo.style.overflow = "auto"
});
$(".modelo-conteudo").click(function() {
    nav.style.display = "inherit"
    modelo.style.display = "none"
    corpo.style.overflow = "auto"
});


$("img").css("-webkit-user-drag", "none");


/* Voltar ao Topo */
$(document).ready(function () {
    $("body").scroll(function() {
        if($(this).scrollTop() == 0){
            $(".voltar-ao-topo").css("display", "none");
        } else {
            $(".voltar-ao-topo").css("display", "initial");
        }
    });
    $(".voltar-ao-topo").click(function() {
        $("html, body").animate({scrollTop: 0}, 800);
    });
});