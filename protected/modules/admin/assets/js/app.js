$(document).ready(function(){
    /* Profile Main */
    var profileFirstClick = true;
    $('.user-action i').click(function(){
        if(profileFirstClick){
            $('.profiles').slideDown(400); 
            profileFirstClick = false;
        }else{
            $('.profiles').slideUp(400);
            profileFirstClick = true;
        }
    });
    
    $('.content').click(function(){
        if(profileFirstClick == false){
            profileFirstClick = true;
            $('.profiles').slideUp(400);
        }
        $('.colors').slideUp(400);
    });
    /* Calendar Main */
    setInterval(function(){
        $('.calendar').html(currentDateTime());
    }, 1000);
    
    /*---------*/
    $('#dola_type').change(function(){
        filterDolas();
    });
    $('#customer_type').change(function(){
        filterCus();
    });
    $('#dolas_from').change(function(){
        filterDolas(); 
    });
    $('#dolas_to').change(function(){
        filterDolas(); 
    });
    $('#dola_export').click(function(){
        $(this).attr('disabled', 'disabled');
        $('.message-show').html('Exporting...!').fadeIn();
        $.ajax({
            url: url + '/revenues/index',
            data: {dolas_type : $('#dola_type').val(), dolas_from : $('#dolas_from').val(), dolas_to : $('#dolas_to').val(), exports:'exports'},
            success:function(datas){
                $('#dola_export').removeAttr('disabled');
                $('.message-show').html('Exported!').delay(2000).fadeOut(400);
            },
            error:function(err){
                $('#dola_export').removeAttr('disabled');
                $('.message-show').html('File opened in another program! Please close first to save!').delay(2000).fadeOut(400);
            }
        }); 
    });
    $('#customer_export').click(function(){
        $(this).attr('disabled', 'disabled');
        $('.message-show').html('Exporting...!').fadeIn();
        $.ajax({
            url: url + '/customers/index',
            data: {customer_type : $('#customer_type').val(), exports:'exports'},
            success:function(datas){
				console.log(datas);
                $('#customer_export').removeAttr('disabled');
                $('.message-show').html('Exported!').delay(2000).fadeOut(400);
            },
            error:function(err){
                $('#customer_export').removeAttr('disabled');
                $('.message-show').html('File opened in another program! Please close first to save!').delay(2000).fadeOut(400);
            }
        }); 
    });
    
    $('#gototop').click(function(){
        $('html, body').animate({scrollTop : 0},400);
        return false;
    });
    
    /**
    /* Change color 
    var bgColor = '#57B484';
    var borderColor = '#67BD90';
    var activeColor = '#39865E';
    $('#picker').farbtastic(function(color){
        bgColor = color;
        $('.left, .left ul li a, .home-item a, .bnt-form, .message-show, .filter-external input[type="button"]').css({'background':bgColor});
        $('.header, .profiles').css({'border-bottom':'2px solid '+bgColor});
        $('.footer').css({'border-top':'2px solid '+bgColor});
        $('.action a i, .head i, .filter-external a.download').css({'color':bgColor});
        $('.table table thead tr').css({'border-bottom':'1px solid '+bgColor});
        $('.pagination ul li.active a').css({'background':bgColor, 'border':'1px solid '+bgColor});
        $('.left ul li.active a').css({'background':activeColor});
        $('.left ul li a,  .home-item a').hover(function(){
            $(this).css({'background':activeColor});
        }, function(){
            if(!$(this).parent().hasClass('active')){
                $(this).css({'background':bgColor});
            }
        });
        setCookie('bgColor', bgColor, 1000);
    });
    $('#picker-2').farbtastic(function(color){
        borderColor = color;
        $('.left ul li').css({'border-bottom':'1px solid '+borderColor});
        setCookie('borderColor', borderColor, 1000);   
    });
    $('#picker-3').farbtastic(function(color){
        activeColor = color;
        $('.left ul li.active a').css({'background':activeColor});
        $('.left ul li a,  .home-item a').hover(function(){
            $(this).css({'background':activeColor});
        }, function(){
            if(!$(this).parent().hasClass('active')){
                $(this).css({'background':bgColor});
            }
        });
        setCookie('activeColor', activeColor, 1000);   
    }); 
    $('#show-colors').click(function(){
        $('.colors').slideDown(400);
        $('.profiles').slideUp(400);
        return false; 
    });
    */
});
function sendMail(data){
	if(data != ''){
		$('#email-data').val(data);
		$('.sendemail').slideDown(400);
		return false;
	}else{
		alert('Hãy chọn email trước khi gửi');
	}
}

function filterDolas(){
    $.ajax({
        url: url + '/revenues/index',
        data: {dolas_type : $('#dola_type').val(), dolas_from : $('#dolas_from').val(), dolas_to : $('#dolas_to').val(), filter:'filter'},
        success:function(datas){
            $('.data').html(datas);
        }
    }); 
}
function filterCus(){
	$.ajax({
        url: url + '/customers/index',
        data: {customer_type : $('#customer_type').val(), filter:'filter'},
        success:function(datas){
            $('.data').html(datas);
        }
    }); 
}

function currentDateTime(){
    var currentdate = new Date(); 
    var weekday=new Array(7);
    weekday[0]="Sun";
    weekday[1]="Mon";
    weekday[2]="Tue";
    weekday[3]="Wed";
    weekday[4]="Thu";
    weekday[5]="Fri";
    weekday[6]="Sat";
    var datetime = weekday[currentdate.getDay()] + ", "
                + (currentdate.getDate() < 10 ? '0'+ currentdate.getDate() : currentdate.getDate()) + "/"
                + (currentdate.getMonth()+1 < 10 ? '0' + (currentdate.getMonth()+1) : currentdate.getMonth()+1)  + "/" 
                + currentdate.getFullYear() + " - "  
                + (currentdate.getHours() < 10 ? '0' + currentdate.getHours() : currentdate.getHours()) + ":"  
                + (currentdate.getMinutes() < 10 ? '0' + currentdate.getMinutes() : currentdate.getMinutes()) + ":" 
                + (currentdate.getSeconds() < 10 ? '0' + currentdate.getSeconds() : currentdate.getSeconds());
    return datetime;
}
function setCookie(c_name,value,exdays)
{
    var exdate=new Date();
    exdate.setDate(exdate.getDate() + exdays);
    var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString()) + "; path=/";
    document.cookie=c_name + "=" + c_value;
}
function getCookie(c_name)
{
    var c_value = document.cookie;
    var c_start = c_value.indexOf(" " + c_name + "=");
    if (c_start == -1)
    {
        c_start = c_value.indexOf(c_name + "=");
    }
    if (c_start == -1)
    {
        c_value = null;
    }
    else
    {
        c_start = c_value.indexOf("=", c_start) + 1;
        var c_end = c_value.indexOf(";", c_start);
        if (c_end == -1)
        {
            c_end = c_value.length;
        }
        c_value = unescape(c_value.substring(c_start,c_end));
    }
    return c_value;
}