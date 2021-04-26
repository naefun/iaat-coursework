// stores the number of images
var imageAmount;
// the index of the current image being shown
var currentImageIndex = 0;

// initialises the carrousel and hides all images except the first image
function carrouselController(){
    var container = document.getElementsByClassName("carrousel-container")[0];
    var carrouselImages = container.querySelectorAll("img");

    imageAmount = container.querySelectorAll("img.carrousel-image").length;
    
    if(imageAmount > 0){
        carrouselImages[0].classList.toggle("image-hide");
        carrouselImages[0].classList.toggle("image-show");
    }
}


function changeImage(direction){
    //get the carrousel container
    var container = document.getElementsByClassName("carrousel-container")[0];
    //get an array of all carrousel images
    var carrouselImages = container.querySelectorAll("img");
    //hide the current image
    carrouselImages[currentImageIndex].classList.toggle("image-show");
    carrouselImages[currentImageIndex].classList.toggle("image-hide");
    //move right or left if there is another image to move to in that direction
    if((direction == 1 && currentImageIndex + direction < imageAmount) || (direction == -1 && currentImageIndex + direction >= 0)){
        currentImageIndex += direction;
    }else if(direction == 1 && currentImageIndex + direction >= imageAmount){
        //move to the beginning if there are no more images to the right
        currentImageIndex = 0;
    }else if(direction == -1 && currentImageIndex + direction < 0){
        //move to the end if there are no more images to the left
        currentImageIndex = imageAmount-1;
    }
    //show the required image
    carrouselImages[currentImageIndex].classList.toggle("image-show");
    carrouselImages[currentImageIndex].classList.toggle("image-hide");
}

if(document.getElementsByClassName("carrousel-container").length != 0){

    // hide carrousel buttons if there is only one image / add event listeners to the buttons if there is more than one image
    if(document.getElementsByClassName("carrousel-image").length <= 1){
        var buttons = document.getElementsByClassName("carrousel-button");
        [].forEach.call(buttons, function (button) {
            button.classList.toggle("image-hide");
        });
    }else{
        document.getElementById("move-left").addEventListener("click", function () {
            changeImage(-1);
        });
        document.getElementById("move-right").addEventListener("click", function () {
            changeImage(1);
        });
    }
        // show the first image
        carrouselController();
}