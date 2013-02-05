var curSlide = 0;

var x = 0;
var isSlide = true;
var isOnMouse = false;
var slider = null;
var childs = null;
var items  = 0;
var show_dir = 0; // direction 0 - right, 1 - left

function turnOnOffSlideShow() {
	var switcher = document.getElementById("slideSwitcher");
	if (isSlide) {
		isSlide = false;
	} else {
		isSlide = true;
	}
	console.log('slider: '+isSlide);
}

function slideShow() {
    if(slider == null){
        slider = document.getElementById('slider');      
        if(slider.getChildren == undefined){
            childs = slider.childNodes;            
        }else {
            childs = slider.getChildren();
        }
        items  = childs.length;        
    }
    if(items != 1){
        if (!isOnMouse && isSlide) {
            if(show_dir == 0) { // move right
                if (x < items && isSlide) {
                   x++;
                   slideToPos(x);

                } else {
                    changeShowDirection();
                }
            } else { // move left
                if (x > 1 && isSlide) {
                    x--;
                    slideToPos(x);
                   
                } else {
                    changeShowDirection();
                }
            }
            window.setTimeout("slideShow()", 5000);
        }
    }
}

function changeShowDirection(){
    if(show_dir == 1){
        show_dir = 0;
    } else {
        show_dir = 1;
    }   
}

function slideIn(slidePos) {
	isOnMouse = true;

    slideToPos(slidePos);	
}

function slideOut(slidePos) {

	slideToPos(curSlide);
	isOnMouse = false;
	if (isSlide) {
		slideShow();
	}
}

function clickSlide(slidePos) {
    curSlide = slidePos;
    turnOnOffSlideShow();

	slideToPos(slidePos);
	slideShow();
}

function slideToPos(slidePos) {
    console.log(slidePos);
 	var slideObject = document.getElementById('slider');

	curSlide = slidePos;
	slideObject.className = "pos"+slidePos;
}