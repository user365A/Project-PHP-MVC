const header=document.querySelector("header")
window.addEventListener("scroll",function(){
    x=window.pageYOffset
    if(x>0){
        header.classList.add("sticky")
    }
    else{
        header.classList.remove("sticky")
    }
})

const imgPostion = document.querySelectorAll(".aspect-ratio-169 img");
const imgContianer = document.querySelector(".aspect-ratio-169");
const dotItem = document.querySelectorAll(".dot");
let imgNumber = imgPostion.length;
let index = 0;
imgPostion.forEach(function (image, index) {
    image.style.left = index * 100 + "%";
    dotItem[index].addEventListener("click", function () {
        slider(index);
    })
})
function imgSlide() {
    index++;
    if (index >= imgNumber) {
        index = 0;
    }
    slider(index);
}
function slider(index) {
    imgContianer.style.left = "-" + index * 100 + "%";
    const dotActive = document.querySelector('.active');
    dotActive.classList.remove("active");
    dotItem[index].classList.add("active");
}
setInterval(imgSlide, 3000);