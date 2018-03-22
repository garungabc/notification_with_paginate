// we are using bootstrap version 4
import 'bootstrap';

(function($) {
    $(document).ready(function() {
	    $('.notification').click(function(){
	        $(".list_notification").toggle();
	    	var ele = this;
	    	return (ele.tog = !ele.tog) ? callAjaxGetNotify() : '';
	    });

	    function callAjaxGetNotify() {
	    	jQuery.ajax({
	            type: "POST",
	            url: ajax_obj.ajax_url,
	            data: {
	                action: 'get_notification',
	            },
	            beforeSend: function(){
	            	$('.list_notification .notify-wrap').append('<li class="text-center"><i class="fa fa-spinner fa-spin" style="font-size:24px"></i></li>');
	            },
	            success: function(response) {
	            	$('.list_notification .notify-wrap').html('');
	                $('.list_notification .notify-wrap').append(response);
	                $('.notification > .icon > sup').html(0);
	            }
	        });
	    }
    });
})(jQuery)
 