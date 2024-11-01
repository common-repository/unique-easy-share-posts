var $ = jQuery;
$(document).ready(function(){
	$("#vzxms-post-slct").on('change', function(e){
		e.preventDefault();
		$("#post-thumb").css("display", "none");
	    $post_title = $("#vzxms-post-slct option:selected").attr("post_title");
	    $imgsrc = $("#vzxms-post-slct option:selected").attr("imgsrc");
	    $slct_val = $(this).val();
	    $(".loading-data").css("display","block");
	    setTimeout(function(){ 
	        $(".loading-data").css("display","none");
	    }, 1000);
	    $("#post-thumb").attr("src",$imgsrc);
	    $("#post-thumb").css("display", "block");
		$("#twitter_ms_post").attr("href","http://twitter.com/home/?status="+$slct_val);
		$("#fb_ms_post").attr("href","http://www.facebook.com/sharer.php?u="+$slct_val);
		$("#gplus_ms_post").attr("href","https://plus.google.com/share?url="+$slct_val);
		$("#pinterest_ms_post").attr("href","http://pinterest.com/pin/create/button/?url="+$slct_val+"&media="+$imgsrc);
		$("#stumbleupon_ms_post").attr("href","http://www.stumbleupon.com/submit?url="+$slct_val+"&amp;title="+$post_title);
		$("#digg_ms_post").attr("href","http://digg.com/submit?url="+$slct_val+"&amp;title="+$post_title);
		$("#reddit_ms_post").attr("href","http://www.reddit.com/submit?url="+$slct_val+"&amp;title="+$post_title);
		$("#email_ms_post").attr("href","mailto:?Subject="+$post_title+"&amp;Body="+$post_title + $slct_val);
		$("#tumblr_ms_post").attr("href","http://www.tumblr.com/share/link?url="+$slct_val+"&amp;title="+$post_title);
		$("#linkedin_ms_post").attr("href","http://www.linkedin.com/shareArticle?mini=true&amp;title="+$post_title+"&amp;url="+$slct_val+"&media="+$imgsrc);
		$("#stumbleupon_ms_post").removeClass('disabled');
		$("#email_ms_post").removeClass('disabled');
		$("#tumblr_ms_post").removeClass('disabled');
		$("#reddit_ms_post").removeClass('disabled');
		$("#digg_ms_post").removeClass('disabled');
		$("#linkedin_ms_post").removeClass('disabled');
		$("#pinterest_ms_post").removeClass('disabled');
		$("#twitter_ms_post").removeClass('disabled');
		$("#fb_ms_post").removeClass('disabled');
		$("#gplus_ms_post").removeClass('disabled'); 
	});
});