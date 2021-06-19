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
    const windowTop = window.pageYOffset + (window.innerHeight * 0.9);
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


/* ANIMAÇÕES COM O MOUSE DO INPUT */
var inputSearch = document.querySelector('input.pesquisa')
var spanPlaceHolder = document.querySelector('span#placeholder')
var corpoPagina = document.querySelector('body#corpo')

function animarPlaceHolder() {
    $('.pesquisa').each(function(index, elemento) {
        //console.log(index + ' : ' + elemento.innerHTML);
        if(elemento.value == '') {
            spanPlaceHolder.style.top = "-5px"
            spanPlaceHolder.style.fontSize = "20px"
        } else {
            spanPlaceHolder.style.top = "-20px"
            spanPlaceHolder.style.fontSize = "15px"
            spanPlaceHolder.style.transitionDuration = ".2s"
        }
    });

    spanPlaceHolder.style.top = "8px"
    spanPlaceHolder.style.fontSize = "15px"
    spanPlaceHolder.style.transitionDuration = ".6s"
    inputSearch.style.border = "solid 4px #f48024"
}

function desanimarPlaceHolderSaindoMouse() {
    $('.pesquisa').each(function(index, elemento) {
        if(elemento.value == '') {
            spanPlaceHolder.style.top = "18px"
            spanPlaceHolder.style.fontSize = "20px"
            inputSearch.style.border = "solid 2px #f48024"
            
            $(".pesquisa").mouseenter(function animarPlaceHolderDenovo() {
                spanPlaceHolder.style.top = "8px"
                spanPlaceHolder.style.fontSize = "15px"
                spanPlaceHolder.style.transitionDuration = ".6s"
                inputSearch.style.border = "solid 4px #f48024"
            });
        } else {
            spanPlaceHolder.style.top = "8px"
            spanPlaceHolder.style.fontSize = "15px"
        }
    });
}

function desanimarPlaceHolder() {
    spanPlaceHolder.style.top = "18px"
    spanPlaceHolder.style.fontSize = "20px"
    inputSearch.style.border = "solid 2px #f48024"
}


/* CARREGAMENTO DA PÁGINA */
var corpoPagina = document.querySelector('body#corpo')
var header = document.querySelector('header#cabecalho')
var main = document.querySelector('main#principal')
var footer = document.querySelector('footer.rodapé')
var nav = document.querySelector('nav.nav-main')

window.addEventListener("load", function(event) {
    document.getElementById("loading").style.display = "none"
    header.style.display = "initial"
    main.style.display = "initial"
    footer.style.display = "inherit"
    nav.style.display ="inherit"
    corpoPagina.style.backgroundColor = "#451354"
});

$(window).on("load", function() {
    $("#loading").fadeOut("slow");
});


/* Navegação Principal */
var prevScrollpos = window.pageYOffset
var nav = document.querySelector('nav.nav-main')
window.onscroll = function() {
  var currentScrollPos = window.pageYOffset
  if(prevScrollpos > currentScrollPos) {
    nav.style.top = "0"
  } else {
    nav.style.top = "-100px"
  }
  prevScrollpos = currentScrollPos
}


/* Favoritagem com a estrela */
function trim(entrada, indesejados){
    var i, retorno;
    retorno = entrada;
    var cortePadrao = " \n\t\r";
    if (typeof(indesejados)=='undefined' || indesejados =='') {
        indesejados = cortePadrao;
    } else {
        indesejados += cortePadrao;
    }
 
    //limpando o início
    for (i = 0; i < retorno.length; i++) {
        if (indesejados.indexOf(retorno.charAt(i)) === -1) {
            retorno = retorno.substring(i);
            break;
        }
    }
 
    //limpando o fim
    for (i = (retorno.length - 1); i >= 0; i--) {
        if (indesejados.indexOf(retorno.charAt(i)) === -1) {
            retorno = retorno.substring(0, i + 1);
            break;
        }
    }
    return retorno;
}

function favoritar(id){
    id = trim(id, 'favorite');
    var botaoFavoritar = document.getElementById('favorite'+id)
    var imageFavoritar = document.getElementById('imagem'+id)
    if(botaoFavoritar.checked == true){
        imageFavoritar.src = '../images/star-favoritada.png'
    }else{
        imageFavoritar.src = '../images/star-nao-favoritada.png'
    }
}

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