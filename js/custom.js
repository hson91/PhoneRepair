/**
    * @package Stability Responsive HTML5 Template
    * 
    * Template Scripts
    * Created by Dan Fisher

    Init JS
    
    1. Main Navigation
    2. Isotope
    3. Magnific Popup
    4. Flickr
    5. Carousel (based on owl carousel plugin)
    6. Content Slider (based on owl carousel plugin)
    7. FitVid (responsive video)
    8. Sticky Header
    9. Shape Boxes
    10. SelfHosted Audio & Video
    11. Masonry Blog
    12. Parallax Background
*/

jQuery(function($){
$('.partners').css('display', 'block');
    var marginLeft = 0;
    var totalProduct = $('.slides .slide-item').size();
    var viewerWidth = $('#viewer').width();
    var itemWidth = 130;
    $('.slides').width(totalProduct * itemWidth*2);
    $('.slides .slide-item').width(itemWidth);
    
    var maxWidthtProduct = (totalProduct -7)* itemWidth;
    if(marginLeft <= - maxWidthtProduct){
        $('#control-right').addClass('control-right-deactive');
    }
    $('#control-left').click(function(){
        if(marginLeft > - maxWidthtProduct){
            marginLeft = marginLeft - (itemWidth + 130);
            $('.slides').animate({'margin-left': marginLeft+"px"}, 500);
        }
    });
    $('#control-right').click(function(){
        if(marginLeft != 0){
            marginLeft = marginLeft + (itemWidth + 130);
            $('.slides').animate({'margin-left': marginLeft+"px"}, 500);
        }
    });

});