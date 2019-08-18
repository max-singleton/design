var timerId, delay = 5000;

function currentSlides(slideIndex){
	showSlides(slideIndex);
}
function showSlides(slideIndex){
    var dotsT = $(".slide__switcher-button");
    if(slideIndex> dotsT.length){
        slideIndex = 1;
    }
    if(slideIndex<1){
        slideIndex = dotsT.length;
    }
    dotsT.removeClass("button-active");
    dotsT[slideIndex-1].classList.add("button-active");
    [".slide__text",".slider__image"].forEach(function(item){
        var slidesT = $(item);
        slidesT.removeClass("slide-active");
		slidesT[slideIndex-1].classList.add("slide-active");
	});
	if(timerId != null)
	{
		clearTimeout(timerId);
		timerId = null;
	}
	timerId = setTimeout(function() {
		slideIndex++;
		if(slideIndex>3){
			slideIndex = 1;
		}

		showSlides(slideIndex);
	}, delay);
}
$(document).ready(function()
{
	showSlides(1);
});