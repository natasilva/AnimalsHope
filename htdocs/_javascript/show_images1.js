var check = document.getElementById("show-images");
var images = document.getElementById("pre-images");
var portrait = document.getElementById("portrait");
var input = document.getElementById("input-portrait");
input.value= (portrait.src).substring((portrait.src).indexOf("images/")+7,(portrait.src).length);

function show_images(){
    if(check.checked == true){
        images.classList.remove("pre-images-inactive");
        images.classList.add("pre-images-active");
    }else{
        images.classList.remove("pre-images-active");
        images.classList.add("pre-images-inactive");
    }
}
function close_images(){
    check.checked = false;
    images.classList.remove("pre-images-active");
    images.classList.add("pre-images-inactive");
}
function display_image(icon_id){
    var image = document.getElementById(icon_id);
    var path = image.src;

    portrait.src = path;
    input.value= (portrait.src).substring((portrait.src).indexOf("images/")+7,(portrait.src).length);
}