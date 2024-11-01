<?php
/*
Plugin Name: Unique Easy Share Posts
Description: Dashboard for admin to share posts with Google shorten URL in social media with one click.
Author: mbDeveloperz
Author URI:https://fiverr.com/mbdevelopers
Version: 1.0.1
Plugin URI:http://latestgovtjobz.com
*/
if(is_admin()){
	if(defined ("VZX_admin_MSPost_ACTIVE")) return;
	define("VZX_admin_MSPost_ACTIVE", true);
	define("VZX_admin_MSPost_DIR", dirname(__FILE__));
	define("VZX_admin_MSPost_URL", plugins_url(null, __FILE__));
	add_action("admin_menu","VZX_admin_MSPost_menu");
	function VZX_admin_MSPost_menu(){
		add_menu_page("Unique Easy Share Posts", "UEShare Post", "administrator", "wkc-mspost-share", "VZX_admin_mspost_page", plugins_url( 'unique-easy-share-posts/images/icon.jpg' ));
		add_submenu_page( 'wkc-mspost-share', 'Unique Easy Share Posts', 'Settings','administrator', 'mb-shares-settings', 'mb_shares_callback');
	    //call register settings function
	    add_action( 'admin_init', 'register_mbshares_settings' );
	}
	function VZX_admin_mspost_page(){
	?>
	<div class="wrap mywrap">
		<h2 class="ms-post-title"><?php print $GLOBALS['title']; ?></h2>
		<div class="vzx-mspost-content">
			<p class="slct1_status">Please Select a Post from dropdown to Share!</p>
			<form method="post" action="">
				<div class="form-group-field">
					<div class="left_label"><label>
						Select Post
					</label>
					</div>
					<div class="rigth_input">
					<select id="vzxms-post-slct" name="vzxms-post-slct" class="vzxms-post-slct">
					<option selected="selected" disabled> Select a Post </option>
					<?php
					global $post;
					$args = array( 'post_type'=>'post','posts_per_page' => 100,'post_status'      => 'publish');
					$myposts = get_posts( $args );
					foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
						<option value="<?php the_permalink();?>" imgsrc="<?php the_post_thumbnail_url(); ?>" post_title="<?php echo the_title ?>"><?php the_title(); ?></option>
					<?php endforeach; 
					wp_reset_postdata();?>
					</select>
					<div class="post-thumb"><h4 class="loading-data"><marquee direction="left">Loading Featued Image</marquee></h4><img src="<?php echo VZX_admin_MSPost_URL."/images/loading.gif" ?>" class="loading-data" id="loading-data"><img src="" id="post-thumb" style="display:none;"/></div>
					</div>
				</div>
				
				<div class="form-group-field">
					<div class="left_label"><label>
						Share Now
					</label>
					</div>
					<div class="rigth_input">
						<div class="share-ms_psot">
							<a id="twitter_ms_post" class="ms_post_share_btn disabled" type="button" href="" title="Tweet this!" target="_blank"><i class="fa fa-twitter-square fa-2x" aria-hidden="true"></i> Twitter </a>
							<a id="fb_ms_post"  class="ms_post_share_btn disabled" type="button" href="" title="Facebook" target="_blank"><i class="fa fa-facebook-square fa-2x" aria-hidden="true"></i> Facebook </a>
							<a id="gplus_ms_post"  class="ms_post_share_btn disabled" type="button" href="" title="Google" onclick="javascript:window.open(this.href,
'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" target="_blank"><i class="fa fa-google-plus-square fa-2x" aria-hidden="true"></i> Google Plus </a>
						<a id="pinterest_ms_post" class="ms_post_share_btn disabled" href="" target="_blank"><i class="fa fa-pinterest-square fa-2x" aria-hidden="true"></i> Pinterest </a>
						<a id="linkedin_ms_post" class="ms_post_share_btn disabled" href="" target="_blank"><i class="fa fa-linkedin-square fa-2x" aria-hidden="true"></i> LinkedIn</a>
						<a id="email_ms_post" class="ms_post_share_btn disabled" target="_blank" href=""><i class="fa fa-envelope-square fa-2x" aria-hidden="true"></i> Email</a>
						<a id="digg_ms_post" class="ms_post_share_btn disabled" target="_blank" href=""><i class="fa fa-digg fa-2x" aria-hidden="true"></i> Digg</a>
						<a id="reddit_ms_post" class="ms_post_share_btn disabled" target="_blank" href=""><i class="fa fa-reddit-square fa-2x" aria-hidden="true"></i> Reddit</a>
						<a id="tumblr_ms_post" class="ms_post_share_btn disabled" target="_blank" href=""><i class="fa fa-tumblr-square fa-2x" aria-hidden="true"></i> Tumblr</a>
						<a id="stumbleupon_ms_post" class="ms_post_share_btn disabled" target="_blank" href=""><i class="fa fa-stumbleupon-circle fa-2x" aria-hidden="true"></i> StumbleUpon</a>
						<a id="addmore_ms_post" class="ms_post_share_btn disabled" href=""><i class="fa fa-plus-square fa-2x" aria-hidden="true"></i> Add More Links</a>
						</div>
					</div>
				</div>
			</form>
		</div>
		<div class="ms-post-footer">
			<p> Copyright © Unique Easy Share Posts <span> | Developed By <a href="http://latestgovtjobz.com">mbDeveloperz</a> </span></p>
		</div><!-- end of footer -->
	</div><!-- end wrap -->	
	<?php }
	add_action("admin_enqueue_scripts", "vzx_mspost_jscs");
	function vzx_mspost_jscs(){
		wp_enqueue_style("mystyle.css", VZX_admin_MSPost_URL.'/css/style.css');
		wp_enqueue_style("myfont-awesome.css", VZX_admin_MSPost_URL.'/css/font-awesome.min.css');
		wp_enqueue_script("mycustom.js", VZX_admin_MSPost_URL.'/js/custom.js');
	}
	add_action('wp_head','VZX_admin_MSPost_ajaxurl');
	function VZX_admin_MSPost_ajaxurl() {
    	?>
    	<script type="text/javascript">
    	var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
    	</script>
    <?php
    }
    function mb_shares_callback(){
        ?>
        <div class="wrap">
            <div class="vzx-mspost-content">
            <h2 class="ms-post-title"><?php print $GLOBALS['title']; ?> | Settings Page</h2>
                <form method="post" action="options.php">
                    <p class="slct1_status">Show / Hide Links on Front Page (Single Page)</p>
                    <?php settings_fields( 'mbshares-settings-group' );
                    do_settings_sections( 'mbshares-settings-group' );
    				submit_button(); ?>
                </form>
            </div>
            <div class="ms-post-footer">
    			<p> Copyright © Unique Easy Share Posts <span> | Developed By <a href="http://latestgovtjobz.com">mbDeveloperz</a> </span></p>
    		</div><!-- end of footer -->
        </div>
   <?php }
   function register_mbshares_settings() {
    	//register our settings
    	register_setting( 'mbshares-settings-group', 'mbshares_links' );
    	add_settings_section(
            'setting_section_id', // ID
            '', // Title
            'print_section_info' , // Callback
            'mbshares-settings-group' // Page
        );  

        add_settings_field(
            'front_sh', // ID
            'Show / Hide', // Title 
            'front_sh_callback', // Callback
            'mbshares-settings-group', // Page
            'setting_section_id' // Section           
        );      
    }
    function print_section_info()
    {
        print 'To show the Social Media Links on Single Page';
    }
    function front_sh_callback()
    {
        $options = get_option( 'mbshares_links' );
            //echo esc_attr($options);
        echo "<select name='mbshares_links' class='mb_share_slct'>";
				echo "<option value='0' disabled='disbaled'>Select an Option</option>";
				echo "<option value='yes' ".selected( $options, yes ).">Yes</option>";
				echo "<option value='no' ".selected( $options, no ).">No</option>";
				echo "</select>";
    }
}
$opt_yes = get_option( 'mbshares_links' );
    if($opt_yes == 'yes'){
        add_action("wp_enqueue_scripts", "mb_mspost_jscs");
    	function mb_mspost_jscs(){
    		wp_enqueue_style("mystyle.css", plugins_url(null, __FILE__).'/css/fstyle.css');
    		wp_enqueue_style("myfont-awesome.css", plugins_url(null, __FILE__).'/css/font-awesome.min.css');
    	}
        add_filter( 'the_content', 'mb_sharelinks_content' );
        function mb_sharelinks_content( $content) {
            if(!is_page() || is_single()){
            global $post;
            $mb_post_link = get_the_permalink($post->ID);
            $mb_post_img = get_the_post_thumbnail_url($post->ID);
            $mb_post_title = get_the_title($post->ID);
                $content .= '<div class="share-ms_psot">
							<a id="twitter_ms_post" class="ms_post_share_btn" site="http://latestgovtjobz.com" type="button" href="http://twitter.com/home/?status='.$mb_post_link.'" title="Tweet this!" target="_blank"><i class="fa fa-twitter-square fa-2x" aria-hidden="true"></i> Twitter </a>
							<a id="fb_ms_post"  class="ms_post_share_btn" site="http://latestgovtjobz.com" type="button" href="http://www.facebook.com/sharer.php?u='.$mb_post_link.'" title="Facebook" target="_blank"><i class="fa fa-facebook-square fa-2x" aria-hidden="true"></i> Facebook </a>
								<a id="gplus_ms_post"  class="ms_post_share_btn" site="http://latestgovtjobz.com" type="button" href="https://plus.google.com/share?url='.$mb_post_link.'" title="Google" target="_blank"><i class="fa fa-google-plus-square fa-2x" aria-hidden="true"></i> Google Plus </a>
						<a id="pinterest_ms_post" class="ms_post_share_btn" site="http://latestgovtjobz.com" href="http://pinterest.com/pin/create/button/?url='.$mb_post_link.'&media='.$mb_post_img.'" target="_blank"><i class="fa fa-pinterest-square fa-2x" aria-hidden="true"></i> Pinterest </a>
						<a id="linkedin_ms_post" class="ms_post_share_btn" site="http://latestgovtjobz.com" href="http://www.linkedin.com/shareArticle?mini=true&amp;url='.$mb_post_link.'&media='.$mb_post_img.'" target="_blank"><i class="fa fa-linkedin-square fa-2x" aria-hidden="true"></i> LinkedIn</a>
						<a id="email_ms_post" class="ms_post_share_btn" site="http://latestgovtjobz.com" target="_blank" href="mailto:?Subject='.$mb_post_link.'&amp;Body='.$mb_post_title . $mb_post_link.'"><i class="fa fa-envelope-square fa-2x" aria-hidden="true"></i> Email</a>
						<a id="digg_ms_post" class="ms_post_share_btn" site="http://latestgovtjobz.com" target="_blank" href="http://digg.com/submit?url='.$mb_post_link.'&amp;title='.$mb_post_title.'"><i class="fa fa-digg fa-2x" aria-hidden="true"></i> Digg</a>
						<a id="reddit_ms_post" class="ms_post_share_btn" site="http://latestgovtjobz.com" target="_blank" href="http://www.reddit.com/submit?url='.$mb_post_link.'&amp;title='.$mb_post_title.'"><i class="fa fa-reddit-square fa-2x" aria-hidden="true"></i> Reddit</a>
						<a id="tumblr_ms_post" class="ms_post_share_btn" site="http://latestgovtjobz.com" target="_blank" href="http://www.tumblr.com/share/link?url='.$mb_post_link.'&amp;title='.$mb_post_title.'"><i class="fa fa-tumblr-square fa-2x" aria-hidden="true"></i> Tumblr</a>
						<a id="stumbleupon_ms_post" class="ms_post_share_btn" site="http://latestgovtjobz.com" target="_blank" href="http://www.stumbleupon.com/submit?url='.$mb_post_link.'&amp;title='.$mb_post_title.'"><i class="fa fa-stumbleupon-circle fa-2x" aria-hidden="true"></i> StumbleUpon</a>
							</div>';
            }
            return $content;
        }
    }
?>