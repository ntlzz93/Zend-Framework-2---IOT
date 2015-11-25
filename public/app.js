/**
 * do simple slideshow
 */
$(function(){
    $('.fadein img:gt(0)').hide();	// hide the img element other than the first under the element with "fadein" class
    setInterval(function(){	// setting interval timer: 3 seconds
      $('.fadein :first-child').fadeOut()	// fadeOut effect to the first element
         .next('img').fadeIn()	// fadeIn effect to the next img element
         .end().appendTo('.fadein');},	// place the current iterator reference to the first element, and appending to the last
      3000);
});
