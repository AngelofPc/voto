// setInterval(function(){
//
// var width = $(window).width();
//
// if(width < 768){
// 	alert("hello");
// }
//
// }, 20);

var menuCounter = 0;
var removeCounter = 0;
var width = $(window).width();
// alert(width);
// interval functions for css
setInterval(
  function(){
    var width = $(document).width();


    if (width < 758)
    {
$('#j-list').hide();
$('.first-img').hide();
$('.first-img-sub').fadeIn('slow');

    }
		if (width > 758)
		{
			$('.first-img').fadeIn('slow');
			$('.first-img-sub').hide();
			$('#j-list').show();
		}

if (width < 768 && menuCounter == 0){
  $('.nav-btn').show();
}


  if (width < 768){
$('.j-list').hide();
    }

  if (width > 768){
  $('.j-list').show();
  $('.nav-btn').hide();
  $('.menu-div').hide();

  }

//
  //the wrap css starts here
  if (width < 990){
    $('.j-intro').css({"left":"20px","top":"70px"});
    $('.j-logo').css({"margin-left": "25px"});
    $('.intro-revity-para').css({'font-size': '22.0px'});
  }
  if (width > 990){
    $('.j-intro').css({"left":"60px", "top": "95px"});
    $('.j-logo').css({"margin-left": "60px"});
    $('.intro-revity-para').css({'font-size': '24.0px'});
  }

//



},
1
);
//end the css interval checks







//button click events
  $('.menu-div').hide();
  $('.nav-remove').hide();

$('.nav-btn').click(function(){
  $('.menu-div').show('slow');
  menuCounter = 1;
  $('.nav-btn').hide();
	// $('.overlay-back').fadeIn('slow');
	$('.overlay').addClass('blur');
  $('.nav-remove').show(1, function(){
    // setInterval(
    // function(){var width =  $(document).width(); if (width > 700){$('.nav-btn').show();$('.nav-remove').hide()}},1);
  });

});


$('.nav-remove').click(function(){
  menuCounter = 0;
  $('.menu-div').hide('slow');
  $('.nav-btn').show();
  $('.nav-remove').hide();
	$('.overlay').removeClass('blur');

	// $('.overlay-back').fadeOut('slow');
});
