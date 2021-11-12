<?php 

$rss_readmore_text='Note: Also if you already offer a newsletter it makes sense to offer this option too, because it will get you more readers, as expained here.';
$ress_readmore_button='Ok, keep it active for the time being,I want to see how it works';
$rss_readmore_text2='Deactivate it';

define('rss_readmore', $rss_readmore_text);
define('ress_readmore_button', $ress_readmore_button);
define('rss_readmore_text2', $rss_readmore_text2);

$feedId 		= sanitize_text_field(get_option('sfsi_feed_id',false));
$connectToFeed 	= "http://api.follow.it/?".base64_encode("userprofile=wordpress&feed_id=".$feedId);
$connectFeedLgn	= "http://api.follow.it/?".base64_encode("userprofile=wordpress&feed_id=".$feedId."&logintype=login");
?>

<div class="pop-overlay read-overlay sfsi_feedClaimingOverlay" >
    <div class="pop_up_box sfsi_pop_up"  >
        <img src="<?php echo SFSI_PLUGURL; ?>images/newclose.png" id="close_popup" class="sfsicloseBtn" alt="error" />
        <center>
            <form id="calimingOptimizationForm" method="get" action="https://api.follow.it/wpclaimfeeds/getFullAccess" target="_blank">
                <h1><?php _e("Enter the email you want to use",'ultimate-social-media-icons') ?></h1>
                <div class="form-field">
                    <input type="hidden" name="feed_id" value="<?php echo $feedId; ?>" />
                    <input type="email" name="email" value="<?php echo get_option("admin_email"); ?>" placeholder="Your email" style="color: #000 !important;"/>
                </div>
                <div class="save_button">
                    <a href="javascript:;" id="sfsi_getMeFullAccess" class="sfsi_getMeFullAccess_class" data-nonce-fetch-feed-id="<?php echo wp_create_nonce( 'sfsi_get_feed_id' );?>" title="Give me access">
                        <?php _e("Give me access!",'ultimate-social-media-icons') ?>
                    </a>
                </div>
                <p>
                	<?php _e("This will create your FREE acccount on",'ultimate-social-media-icons') ?> <a target="_blank" href="https://follow.it/"><?php _e("follow.it",'ultimate-social-media-icons') ?></a>.<?php _e("We will treat your data (and your subscribers’ data!) highly confidentially, see our ",'ultimate-social-media-icons') ?><a target="_blank" href="https://follow.it/info/privacy"><?php _e("Privacy Policy",'ultimate-social-media-icons') ?></a>.
              </p>
               
            </form>
        </center>    
	</div>
</div>

<div class="pop-overlay read-overlay" >
    <div class="pop_up_box sfsi_pop_up"  >
        <img src="<?php echo SFSI_PLUGURL; ?>images/close.jpg" id="close_popup" class="sfsicloseBtn" alt="error" />
        <h4 id="readmore_text"><?php _e("ote: Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",'ultimate-social-media-icons') ?>N</h4>
</div>
</div>

<!-- Custom icon upload  Pop-up {Change by Monad}-->
<div class="pop-overlay upload-overlay" >
     
	<form id="customIconFrm" method="post" action="<?php echo admin_url( 'admin-ajax.php?action=UploadIcons' ); ?>" enctype="multipart/form-data" >
        <div class="pop_up_box upload_pop_up" id="tab1" style="min-height: 155px;">
            <img src="<?php echo SFSI_PLUGURL; ?>images/close.jpg" id="close_Uploadpopup" alt="error" class="sfsicloseBtn" />
            <div class="sfsi_uploader">
                <div class="sfsi_popupcntnr">
                    <h3><?php _e("Steps:",'ultimate-social-media-icons') ?></h3>
                    <ul class="flwstep">
                        <li><?php _e("1. Click on",'ultimate-social-media-icons') ?> <span> << </span> <span><?php _e("Upload ",'ultimate-social-media-icons') ?> </span> <span> >> </span><?php _e("Upload ",'ultimate-social-media-icons') ?><?php _e(" below ",'ultimate-social-media-icons') ?> </li>
                        <li><?php _e("2. Upload the icon into the media gallery!",'ultimate-social-media-icons') ?></li>
                        <li><?php _e("3. Click on ",'ultimate-social-media-icons') ?> <span> << </span> <span> <?php _e("Insert into post ",'ultimate-social-media-icons') ?></span> <span> >> </span> </li>
                    </ul>    
                    <div class="upldbtn"><input name=""  type="button" value="Upload" class="upload_butt" onclick="upload_image_icon(this)" /></div>
                </div>
            </div>
          
            <input type="hidden" name="total_cusotm_icons" value="<?php echo $count;?>" id="total_cusotm_icons" class="mediam_txt" />
            <!--<a href="javascript:;" id="close_Uploadpopup" title="Done">Done</a>-->
            <label style="color:red" class="uperror"></label>
        </div>
	
   	</form>
   
   <script type="text/javascript">
   function upload_image_icon(ref)
   {
	    formfield = jQuery(ref).attr('name');
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
		window.send_to_editor = function(html) {
			var url = jQuery('img',html).attr('src');
			if(url == undefined) 
			{
				var url = jQuery(html).attr('src');
			}
			tb_remove();
			sfsi_newcustomicon_upload(url,'<?php echo wp_create_nonce('UploadIcons'); ?>','<?php echo wp_create_nonce('deleteIcons'); ?>"');
		}
		return false;
	}
   </script>
   
</div><!-- Custom icon upload  Pop-up-->
<?php 
	   $active_theme  = $option3['sfsi_actvite_theme'];
     $icons_baseUrl = SFSI_PLUGURL."/images/icons_theme/".$active_theme."/";
     $visit_iconsUrl= SFSI_PLUGURL."/images/visit_icons/";
     $soicalObj     = new sfsi_SocialHelper();

     $twitetr_share = 'http://follow.it';
     $twitter_text  = 'Create Your Perfect Newspaper for free';

     if(isset($option2['sfsi_twitter_followUserName']) && !empty($option2['sfsi_twitter_followUserName'])){
          $twitetr_share = "https://twitter.com/".$option2['sfsi_twitter_followUserName'];
          $twitter_text  = $option2['sfsi_twitter_aboutPageText'];
     }
?>

<!-- Facebook  example pop up -->
<div class="fb-overlay read-overlay fbex-s2" >
    <div class="pop_up_box_ex sfsi_pop_up adPopWidth" >
        <img src="<?php echo SFSI_PLUGURL; ?>images/close.jpg" id="close_popup" alt="error" class="sfsicloseBtn" />
	    <h4 id="readmore_text"><?php _e("Move over the Facebook-icon…",'ultimate-social-media-icons') ?> </h4>
    
        <div class="adminTooltip" >
           <a href="javascript:"><img width="51" class="sfsi_wicon" src="<?php echo SFSI_PLUGURL; ?>images/facebook.png" title="facebook" alt="facebook" /></a>
           <div class="sfsi_tool_tip_2 sfsi_tool_tip_2_inr fb_tool_bdr" style="width: 59px;margin-left: -48.5px;">
               <span class="bot_arow bot_fb_arow "></span>
               <div class="sfsi_inside fbb">
                   <div class="fb_1"><img src="<?php echo $visit_iconsUrl."facebook.png"; ?>" alt="error" /></div>    
                   <div class="fb_2"><img src="<?php echo $visit_iconsUrl."fblike_bck.png"; ?>" alt="error"/></div>
                   <div class="fb_3"><img src="<?php echo $visit_iconsUrl."fbshare_bck.png"; ?>" alt="error"/></div>
               </div>    
           </div>
   		
        </div>
    </div>
</div><!-- END Facebook  example pop up -->
<?php
	  $twit_tolCls  = "100";
	  $twt_margin   = "63";  
	  $icons_space  = $option5['sfsi_icons_spacing'];

    if(isset($option2['sfsi_twitter_followUserName']) && !empty($option2['sfsi_twitter_followUserName'])){
      $twitter_user = $option2['sfsi_twitter_followUserName'];
      $twit_tolCls  = round(strlen($twitter_user)*4+100+20);
      $main_margin  = round($icons_space)/2;
      $twt_margin   = round($twit_tolCls/2+$main_margin+6);             
    }

?>
<!-- twiiter example pop-up -->
<div class="pop-overlay read-overlay twex-s2" >
    <div class="pop_up_box_ex sfsi_pop_up adPopWidth" >
        <img src="<?php echo SFSI_PLUGURL; ?>images/close.jpg" alt="error" id="close_popup" class="sfsicloseBtn" />
    	<h4 id="readmore_text"><?php _e("Move over the Twiiter-icon… ",'ultimate-social-media-icons') ?></h4>
    
        <div class="adminTooltip" >
        	<a href="javascript:"><img width="51" class="sfsi_wicon" src="<?php echo SFSI_PLUGURL; ?>images/twitter.png" title="Twitter" alt="Twitter" /></a>
            <div class="sfsi_tool_tip_2 sfsi_tool_tip_2_inr twt_tool_bdr" style="width: 59px;margin-left: -48.5px;">
           		<span class="bot_arow bot_twt_arow"></span>
           		<div class="sfsi_inside" >
           			<div class="twt_3"><img src="<?php echo $visit_iconsUrl."twitter.png"; ?>" alt="error" /></div>
                    <div class="twt_1"><img src="<?php echo $visit_iconsUrl."twfollow_bck.png"; ?>" alt="error"/></div>
           			<div class="twt_2"><img src="<?php echo $visit_iconsUrl."twtweet_bck.png"; ?>" alt="error"/></div>
          		</div>    
            </div>
   		</div>
    </div>
</div><!-- END twiiter example pop-up -->
<?php 
	$youtube_url = isset($option2['sfsi_youtube_pageUrl']) && !empty($option2['sfsi_youtube_pageUrl']) ?  $option2['sfsi_youtube_pageUrl'] : 'http://www.youtube.com/user/follow.it' ;
	$youtube_user= isset($option4['sfsi_youtube_user']) && !empty($option4['sfsi_youtube_user']) ?  $option4['sfsi_youtube_user'] : 'follow.it' ;
?>
<!-- You tube  example pop up -->
<div class="pop-overlay read-overlay ytex-s2" >
    <div class="pop_up_box_ex sfsi_pop_up adPopWidth" >
        <img src="<?php echo SFSI_PLUGURL; ?>images/close.jpg" id="close_popup" class="sfsicloseBtn" />
    	<h4 id="readmore_text"><?php _e("Move over the YouTube-icon…  ",'ultimate-social-media-icons') ?></h4>
    	
        <div class="adminTooltip" >
        	<a href="javascript:"><img width="51" class="sfsi_wicon" src="<?php echo SFSI_PLUGURL; ?>images/youtube.png" title="youtube" alt="youtube" /></a>
        	<div class="sfsi_tool_tip_2 sfsi_tool_tip_2_inr utube_tool_bdr"  style=" margin-left: -67px; width: 96px;" >
           		<span class="bot_arow bot_utube_arow"></span>
           		<div class="sfsi_inside">
               		<div class="utub_visit"><img src="<?php echo $visit_iconsUrl."youtube.png"; ?>" alt="error" /></div>
           			<div class="utub_2"><img src="<?php echo $visit_iconsUrl."youtube_bck.png"; ?>"alt="error" /></div>
                </div>    
        	</div>
   		</div>
	</div>
</div><!-- END You tube  example pop up -->

<?php 

$pin_url= isset($option2['sfsi_pinterest_pageUrl']) && !empty($option2['sfsi_pinterest_pageUrl']) ?  $option2['sfsi_pinterest_pageUrl'] : 'http://pinterest.com/follow.it' ;
?>
<!-- Pinterest  example pop up -->
<div class="pop-overlay read-overlay pinex-s2" >
    <div class="pop_up_box_ex sfsi_pop_up adPopWidth" >
        <img src="<?php echo SFSI_PLUGURL; ?>images/close.jpg" id="close_popup" class="sfsicloseBtn" />
    	<h4 id="readmore_text"><?php _e("Move over the Pinterest-icon…  ",'ultimate-social-media-icons') ?></h4>
    
     	<div class="adminTooltip" >
        <a href="javascript:"><img width="51" class="sfsi_wicon" src="<?php echo SFSI_PLUGURL; ?>images/pinterest.png" title="pinterest" alt="pinterest" /></a>
        <div class="sfsi_tool_tip_2 sfsi_tool_tip_2_inr printst_tool_bdr"  style=" width: 73px; margin-left: -55.5px;" >
           <span class="bot_arow bot_pintst_arow"></span>
           <div class="sfsi_inside">
               <div class="prints_visit"><img src="<?php echo $visit_iconsUrl."pinterest.png"; ?>" alt="error"/></div>
               <div class="prints_visit_1"><img src="<?php echo $visit_iconsUrl."pinit_bck.png"; ?>" alt="error"/></div>
           </div>    
        </div>
   	</div>
  </div>
</div> <!-- END Pinterest  example pop up -->

<?php 
	$linnked_share = isset($option2['sfsi_linkedin_pageURL']) && !empty($option2['sfsi_linkedin_pageURL']) ?  $option2['sfsi_linkedin_pageURL'] : 'https://www.linkedin.com/' ;
	$linkedIncom   = isset($option2['sfsi_linkedin_followCompany']) && !empty($option2['sfsi_linkedin_followCompany']) ?  $option2['sfsi_linkedin_followCompany'] : '904740' ;
	$ln_product    = isset($option2['sfsi_linkedin_recommendProductId']) && !empty($option2['sfsi_linkedin_recommendProductId']) ?  $option2['sfsi_linkedin_recommendProductId'] : '201714' ;
?>
<!-- LinkedIn  example pop up -->
<div class="pop-overlay read-overlay linkex-s2" style="display: block;z-index: -1;opacity: 0;" >
    <div class="pop_up_box_ex sfsi_pop_up adPopWidth" >
    	<img src="<?php echo SFSI_PLUGURL; ?>images/close.jpg" id="close_popup" class="sfsicloseBtn" />
    	<h4 id="readmore_text"><?php _e("Move over the LinkedIn-icon… ",'ultimate-social-media-icons') ?></h4>
        <div class="adminTooltip" >
        	<a href="javascript:"><img width="51" class="sfsi_wicon" src="<?php echo SFSI_PLUGURL;?>images/linked_in.png" title="LinkedIn" alt="LinkedIn"/></a>
        	<div class="sfsi_tool_tip_2 sfsi_tool_tip_2_inr linkedin_tool_bdr"  style=" width: 99px; margin-left: -68.5px;">
           		<span class="bot_arow bot_linkedin_arow"></span>
           		<div class="sfsi_inside">
           		   <div style="margin:1px 5px;" class="linkin_1"><img src="<?php echo $visit_iconsUrl."linkedIn.png"; ?>" /></div>
                   <div class="linkin_2"><img src="<?php echo $visit_iconsUrl."linkinflw_bck.png"; ?>" alt="error" /></div>
                   <div class="linkin_3"><img src="<?php echo $visit_iconsUrl."lnkdin_share_bck.png"; ?>" alt="error"/></div>
                   <div class="linkin_4"><img src="<?php echo $visit_iconsUrl."lnkrecmd_bck.png"; ?>" alt="error"/></div>
           		</div>    
        	</div>
   		</div>
  </div>
</div> <!-- END LinkedIn  example pop up -->
<!-- email deactivate pop-ups -->

<div class="pop-overlay read-overlay demail-1" >
    <div class="pop_up_box sfsi_pop_up " >

			<?php 
					printf(
						__( '%1s Note: Also if you already offer a newsletter it makes sense to offer this option too, because it will get you %2s more readers %3s  , as explained %4s here. %5s ','ultimate-social-media-icons' ),
						'<h4>',   
						'<span class="mediam_txt">',
						'</span>',
						'<a href="http://api.follow.it/rss" target="new" style="color:#5A6570;display: inline;text-decoration:underline">',
						'</a></h4>'
					);
			?>
       <div class="button"><a href="javascript:;" class="hideemailpop" title="Ok, keep it active for the time being,I want to see how it works"><?php _e("Ok, keep it active for the time being, ",'ultimate-social-media-icons') ?> <br />
		<?php _e("I want to see how it works",'ultimate-social-media-icons') ?></a></div>
       <a href="javascript:;" id="deac_email2" title="Deactivate it"><?php _e("Deactivate it",'ultimate-social-media-icons') ?></a>
  </div>
</div>

<div class="pop-overlay read-overlay demail-2">
    <div class="pop_up_box sfsi_pop_up">
       <h4 class="activate"><?php _e("Ok, fine, however for using this plugin for FREE, please support us by activating a link back to our site:",'ultimate-social-media-icons') ?></h4>
       <?php $nonce = wp_create_nonce("active_footer");?>
  <div class="button"><a href="javascript:;" class="activate_footer activate" title="Ok, activate link" data-nonce="<?php echo $nonce;?>"><?php _e("Ok, activate link",'ultimate-social-media-icons') ?></a></div>
<a href="javascript:;" id="deac_email3" title="Don’t activate link"><?php _e("Don’t activate link",'ultimate-social-media-icons') ?></a>
  </div>
</div>

<div class="pop-overlay read-overlay demail-3" >
    <div class="pop_up_box sfsi_pop_up " >
       <h4><?php _e("You’re a toughie. Last try: As a minimum, could you please review this plugin (with 5 stars)? It only takes a minute. Thank you! ",'ultimate-social-media-icons') ?></h4>
  <div class="button"><a href="https://wordpress.org/support/plugin/ultimate-social-media-icons/reviews/" target="new" class="hidePop activate" title="Ok, Review it" >Ok, Review it</a></div>
        <a href="javascript:;" class="hidePop" title="Don’t review and exit"><?php _e("Don’t review and exit",'ultimate-social-media-icons') ?></a>
  </div>
</div> <!-- END email deactivate pop-ups -->

<!--Custom Skin popup {Monad}-->
<div class="pop-overlay cstmskins-overlay" >
    <div class="cstmskin_popup" >
        <img src="<?php echo SFSI_PLUGURL; ?>images/close.jpg" id="custmskin_clspop" class="sfsicloseBtn" alt="error"/>
        
        <div class="cstomskins_wrpr">
            <h3><?php _e("Upload custom icons",'ultimate-social-media-icons') ?></h3>
            <div class="custskinmsg">
                <?php _e("Here you can upload custom icons which perform the same actions as the standard icons.",'ultimate-social-media-icons') ?>
                
                <ul>
                    <li><?php _e("1. Click ons",'ultimate-social-media-icons') ?> <span> << </span> <span><?php _e("Upload",'ultimate-social-media-icons') ?> </span> <span> >> </span> <?php _e(" below",'ultimate-social-media-icons') ?></li>
                    <li><?php _e("2. Upload the icon into the media gallery",'ultimate-social-media-icons') ?> </li>
                    <li><?php _e(" 3. Click on  ",'ultimate-social-media-icons') ?><span> << </span> <span><?php _e("  Insert into post ",'ultimate-social-media-icons') ?></span> <span> >> </span> </li>
                </ul>
            </div>
            
            <ul class="cstmskin_iconlist">
            	<li>
                	<div class="cstm_icnname"><?php _e("RSS  ",'ultimate-social-media-icons') ?></div>
                    <div class="cstmskins_btn">
                    	<?php
							$nonce = wp_create_nonce("deleteCustomSkin");
							if(get_option("rss_skin"))
							{
								$rss_skin = get_option("rss_skin");
								echo "<img src='".$rss_skin."' width='30px' height='30px' class='imgskin' alt='Rs'>";
								echo '<a href="javascript:" onclick="upload_image(this);" title="rss_skin" class="cstmskin_btn">Update</a>';
								echo '<a href="javascript:" onclick="deleteskin_icon(this);" title="rss_skin" data-nonce="'.$nonce.'" class="cstmskin_btn">Delete</a>';
							}
							else
							{
								echo "<img src='' width='30px' height='30px' class='imgskin skswrpr' alt='Rs'>";
								echo '<a href="javascript:" onclick="upload_image(this);" title="rss_skin" class="cstmskin_btn">Upload</a>';
								echo '<a href="javascript:" onclick="deleteskin_icon(this);" title="rss_skin" data-nonce="'.$nonce.'" class="cstmskin_btn dlt_btn">Delete</a>';
							}
						?>
                    </div>
                </li>
                <li>
                	<div class="cstm_icnname"><?php _e("Email",'ultimate-social-media-icons') ?></div>
                    <div class="cstmskins_btn">
                    	<?php 
							if(get_option("email_skin"))
							{
								$email_skin = get_option("email_skin");
								echo "<img src='".$email_skin."' width='30px' height='30px' class='imgskin' alt='Email'>";
								echo '<a href="javascript:" onclick="upload_image(this);" title="email_skin" class="cstmskin_btn">Update</a>';
								echo '<a href="javascript:" onclick="deleteskin_icon(this);" title="email_skin" data-nonce="'.$nonce.'" class="cstmskin_btn">Delete</a>';
							}
							else
							{
								echo "<img src='' width='30px' height='30px' class='imgskin skswrpr' alt='Email'>";
								echo '<a href="javascript:" onclick="upload_image(this);" title="email_skin" class="cstmskin_btn">Upload</a>';
								echo '<a href="javascript:" onclick="deleteskin_icon(this);" title="email_skin" data-nonce="'.$nonce.'" class="cstmskin_btn dlt_btn">Delete</a>';
							}
						?>
                    </div>
                </li>
                <li>
                	<div class="cstm_icnname"><?php _e("Facebook",'ultimate-social-media-icons') ?></div>
                    <div class="cstmskins_btn">
                    	<?php 
							if(get_option("facebook_skin"))
							{
								$facebook_skin = get_option("facebook_skin");
								echo "<img src='".$facebook_skin."' width='30px' height='30px'  class='imgskin' alt='Facebook'>";
								echo '<a href="javascript:" onclick="upload_image(this);" title="facebook_skin" class="cstmskin_btn">Update</a>';
								echo '<a href="javascript:" onclick="deleteskin_icon(this);" title="facebook_skin" data-nonce="'.$nonce.'" class="cstmskin_btn">Delete</a>';
							}
							else
							{
								echo "<img src='' width='30px' height='30px' class='imgskin skswrpr' alt='Facebook'>";
								echo '<a href="javascript:" onclick="upload_image(this);" title="facebook_skin" class="cstmskin_btn">Upload</a>';
								echo '<a href="javascript:" onclick="deleteskin_icon(this);" title="facebook_skin" data-nonce="'.$nonce.'" class="cstmskin_btn dlt_btn">Delete</a>';
							}
						?>
                    </div>
                </li>
                <li>
                	<div class="cstm_icnname"><?php _e("Twitter",'ultimate-social-media-icons') ?></div>
                    <div class="cstmskins_btn">
                    	<?php 
							if(get_option("twitter_skin"))
							{
								$twitter_skin = get_option("twitter_skin");
								echo "<img src='".$twitter_skin."' width='30px' height='30px' class='imgskin' alt='Twitter'>";
								echo '<a href="javascript:" onclick="upload_image(this);" title="twitter_skin" class="cstmskin_btn">Update</a>';
								echo '<a href="javascript:" onclick="deleteskin_icon(this);" title="twitter_skin" data-nonce="'.$nonce.'" class="cstmskin_btn">Delete</a>';
							}
							else
							{
								echo "<img src='' width='30px' height='30px' class='imgskin skswrpr' alt='Twitter'>";
								echo '<a href="javascript:" onclick="upload_image(this);" title="twitter_skin" class="cstmskin_btn">Upload</a>';
								echo '<a href="javascript:" onclick="deleteskin_icon(this);" title="twitter_skin" data-nonce="'.$nonce.'" class="cstmskin_btn dlt_btn">Delete</a>';
							}
						?>
                    </div>
                </li>
                
                <li>
                	<div class="cstm_icnname"><?php _e("Share",'ultimate-social-media-icons') ?></div>
                    <div class="cstmskins_btn">
                    	<?php 
							if(get_option("share_skin"))
							{
								$share_skin = get_option("share_skin");
								echo "<img src='".$share_skin."' width='30px' height='30px' class='imgskin' alt='Share'>";
								echo '<a href="javascript:" onclick="upload_image(this);" title="share_skin" class="cstmskin_btn">Update</a>';
								echo '<a href="javascript:" onclick="deleteskin_icon(this);" title="share_skin" data-nonce="'.$nonce.'" class="cstmskin_btn">Delete</a>';
							}
							else
							{
								echo "<img src='' width='30px' height='30px' class='imgskin skswrpr' alt='Share'>";
								echo '<a href="javascript:" onclick="upload_image(this);" title="share_skin" class="cstmskin_btn">Upload</a>';
								echo '<a href="javascript:" onclick="deleteskin_icon(this);" title="share_skin" data-nonce="'.$nonce.'" class="cstmskin_btn dlt_btn">Delete</a>';
							}
						?>
                    </div>
                </li>
                <li>
                	<div class="cstm_icnname"><?php _e("Youtube",'ultimate-social-media-icons') ?></div>
                    <div class="cstmskins_btn">
                    	<?php 
							if(get_option("youtube_skin"))
							{
								$youtube_skin = get_option("youtube_skin");
								echo "<img src='".$youtube_skin."' width='30px' height='30px'  class='imgskin' alt='Youtube'>";
								echo '<a href="javascript:" onclick="upload_image(this);" title="youtube_skin" class="cstmskin_btn">Update</a>';
								echo '<a href="javascript:" onclick="deleteskin_icon(this);" title="youtube_skin" data-nonce="'.$nonce.'" class="cstmskin_btn">Delete</a>';
							}
							else
							{
								echo "<img src='' width='30px' height='30px' class='imgskin skswrpr' alt='Youtube'>";
								echo '<a href="javascript:" onclick="upload_image(this);" title="youtube_skin" class="cstmskin_btn">Upload</a>';
								echo '<a href="javascript:" onclick="deleteskin_icon(this);" title="youtube_skin" data-nonce="'.$nonce.'" class="cstmskin_btn dlt_btn">Delete</a>';
							}
						?>
                    </div>
                </li>
                <li>
                	<div class="cstm_icnname"><?php _e("Linkedin",'ultimate-social-media-icons') ?></div>
                    <div class="cstmskins_btn">
                    	<?php 
							if(get_option("linkedin_skin"))
							{
								$linkedin_skin = get_option("linkedin_skin");
								echo "<img src='".$linkedin_skin."' width='30px' height='30px'  class='imgskin' alt='Linkedin'>";
								echo '<a href="javascript:" onclick="upload_image(this);" title="linkedin_skin" class="cstmskin_btn">Update</a>';
								echo '<a href="javascript:" onclick="deleteskin_icon(this);" title="linkedin_skin" data-nonce="'.$nonce.'" class="cstmskin_btn">Delete</a>';
							}
							else
							{
								echo "<img src='' width='30px' height='30px' class='imgskin skswrpr' alt='Linkedin'>";
								echo '<a href="javascript:" onclick="upload_image(this);" title="linkedin_skin" class="cstmskin_btn">Upload</a>';	
								echo '<a href="javascript:" onclick="deleteskin_icon(this);" title="linkedin_skin" data-nonce="'.$nonce.'" class="cstmskin_btn dlt_btn">Delete</a>';
							}
						?>
                    </div>
                </li>
                <li>
                	<div class="cstm_icnname"><?php _e("Pinterest",'ultimate-social-media-icons') ?></div>
                    <div class="cstmskins_btn">
                    	<?php 
							if(get_option("pintrest_skin"))
							{
								$pintrest_skin = get_option("pintrest_skin");
								echo "<img src='".$pintrest_skin."' width='30px' height='30px' class='imgskin' alt='Pinterset'>";
								echo '<a href="javascript:" onclick="upload_image(this);" title="pintrest_skin" class="cstmskin_btn">Update</a>';
								echo '<a href="javascript:" onclick="deleteskin_icon(this);" title="pintrest_skin" data-nonce="'.$nonce.'" class="cstmskin_btn">Delete</a>';
							}
							else
							{
								echo "<img src='' width='30px' height='30px' class='imgskin skswrpr' alt='Pinterset'>";
								echo '<a href="javascript:" onclick="upload_image(this);" title="pintrest_skin" class="cstmskin_btn">Upload</a>';
								echo '<a href="javascript:" onclick="deleteskin_icon(this);" title="pintrest_skin" data-nonce="'.$nonce.'" class="cstmskin_btn dlt_btn">Delete</a>';
							}
						?>
                    </div>
                </li>
                <li>
                	<div class="cstm_icnname"><?php _e("Instagram",'ultimate-social-media-icons') ?></div>
                    <div class="cstmskins_btn">
                    	<?php 
							if(get_option("instagram_skin"))
							{
								$instagram_skin = get_option("instagram_skin");
								echo "<img src='".$instagram_skin."' width='30px' height='30px' class='imgskin' alt='instagram'>";
								echo '<a href="javascript:" onclick="upload_image(this);" title="instagram_skin" class="cstmskin_btn">Update</a>';
								echo '<a href="javascript:" onclick="deleteskin_icon(this);" title="instagram_skin" data-nonce="'.$nonce.'" class="cstmskin_btn">Delete</a>';
							}
							else
							{
								echo "<img src='' width='30px' height='30px' class='imgskin skswrpr' alt='instagram'>";
								echo '<a href="javascript:" onclick="upload_image(this);" title="instagram_skin" class="cstmskin_btn">Upload</a>';
								echo '<a href="javascript:" onclick="deleteskin_icon(this);" title="instagram_skin" data-nonce="'.$nonce.'" class="cstmskin_btn dlt_btn">Delete</a>';		
							}
						?>
                    </div>
				</li>
				<li>
                	<div class="cstm_icnname"><?php _e("Telegram",'ultimate-social-media-icons') ?></div>
                    <div class="cstmskins_btn">
                    	<?php 
							if(get_option("telegram_skin"))
							{
								$telegram_skin = get_option("telegram_skin");
								echo "<img src='".$telegram_skin."' width='30px' height='30px' class='imgskin' alt='telegram'>";
								echo '<a href="javascript:" onclick="upload_image(this);" title="telegram_skin" class="cstmskin_btn">Update</a>';
								echo '<a href="javascript:" onclick="deleteskin_icon(this);" title="telegram_skin" data-nonce="'.$nonce.'" class="cstmskin_btn">Delete</a>';
							}
							else
							{
								echo "<img src='' width='30px' height='30px' class='imgskin skswrpr' alt='telegram'>";
								echo '<a href="javascript:" onclick="upload_image(this);" title="telegram_skin" class="cstmskin_btn">Upload</a>';
								echo '<a href="javascript:" onclick="deleteskin_icon(this);" title="telegram_skin" data-nonce="'.$nonce.'" class="cstmskin_btn dlt_btn">Delete</a>';		
							}
						?>
                    </div>
				</li>
				<li>
                	<div class="cstm_icnname"><?php _e("VK",'ultimate-social-media-icons') ?></div>
                    <div class="cstmskins_btn">
                    	<?php 
							if(get_option("vk_skin"))
							{
								$vk_skin = get_option("vk_skin");
								echo "<img src='".$vk_skin."' width='30px' height='30px' class='imgskin' alt='vk'>";
								echo '<a href="javascript:" onclick="upload_image(this);" title="vk_skin" class="cstmskin_btn">Update</a>';
								echo '<a href="javascript:" onclick="deleteskin_icon(this);" title="vk_skin" data-nonce="'.$nonce.'" class="cstmskin_btn">Delete</a>';
							}
							else
							{
								echo "<img src='' width='30px' height='30px' class='imgskin skswrpr' alt='vk'>";
								echo '<a href="javascript:" onclick="upload_image(this);" title="vk_skin" class="cstmskin_btn">Upload</a>';
								echo '<a href="javascript:" onclick="deleteskin_icon(this);" title="vk_skin" data-nonce="'.$nonce.'" class="cstmskin_btn dlt_btn">Delete</a>';		
							}
						?>
                    </div>
				</li>
				<li>
                	<div class="cstm_icnname"><?php _e("Ok",'ultimate-social-media-icons') ?></div>
                    <div class="cstmskins_btn">
                    	<?php 
							if(get_option("ok_skin"))
							{
								$ok_skin = get_option("ok_skin");
								echo "<img src='".$ok_skin."' width='30px' height='30px' class='imgskin' alt='ok'>";
								echo '<a href="javascript:" onclick="upload_image(this);" title="ok_skin" class="cstmskin_btn">Update</a>';
								echo '<a href="javascript:" onclick="deleteskin_icon(this);" title="ok_skin" data-nonce="'.$nonce.'" class="cstmskin_btn">Delete</a>';
							}
							else
							{
								echo "<img src='' width='30px' height='30px' class='imgskin skswrpr' alt='ok'>";
								echo '<a href="javascript:" onclick="upload_image(this);" title="ok_skin" class="cstmskin_btn">Upload</a>';
								echo '<a href="javascript:" onclick="deleteskin_icon(this);" title="ok_skin" data-nonce="'.$nonce.'" class="cstmskin_btn dlt_btn">Delete</a>';		
							}
						?>
                    </div>
				</li>
				<li>
                	<div class="cstm_icnname"><?php _e("Weibo",'ultimate-social-media-icons') ?></div>
                    <div class="cstmskins_btn">
                    	<?php 
							if(get_option("weibo_skin"))
							{
								$weibo_skin = get_option("weibo_skin");
								echo "<img src='".$weibo_skin."' width='30px' height='30px' class='imgskin' alt='weibo'>";
								echo '<a href="javascript:" onclick="upload_image(this);" title="weibo_skin" class="cstmskin_btn">Update</a>';
								echo '<a href="javascript:" onclick="deleteskin_icon(this);" title="weibo_skin" data-nonce="'.$nonce.'" class="cstmskin_btn">Delete</a>';
							}
							else
							{
								echo "<img src='' width='30px' height='30px' class='imgskin skswrpr' alt='weibo'>";
								echo '<a href="javascript:" onclick="upload_image(this);" title="weibo_skin" class="cstmskin_btn">Upload</a>';
								echo '<a href="javascript:" onclick="deleteskin_icon(this);" title="weibo_skin" data-nonce="'.$nonce.'" class="cstmskin_btn dlt_btn">Delete</a>';		
							}
						?>
                    </div>
				</li>
				<li>
                	<div class="cstm_icnname"><?php _e("WeChat",'ultimate-social-media-icons') ?></div>
                    <div class="cstmskins_btn">
                    	<?php 
							if(get_option("wechat_skin"))
							{
								$wechat_skin = get_option("wechat_skin");
								echo "<img src='".$wechat_skin."' width='30px' height='30px' class='imgskin' alt='wechat'>";
								echo '<a href="javascript:" onclick="upload_image(this);" title="wechat_skin" class="cstmskin_btn">Update</a>';
								echo '<a href="javascript:" onclick="deleteskin_icon(this);" title="wechat_skin" data-nonce="'.$nonce.'" class="cstmskin_btn">Delete</a>';
							}
							else
							{
								echo "<img src='' width='30px' height='30px' class='imgskin skswrpr' alt='wechat'>";
								echo '<a href="javascript:" onclick="upload_image(this);" title="wechat_skin" class="cstmskin_btn">Upload</a>';
								echo '<a href="javascript:" onclick="deleteskin_icon(this);" title="wechat_skin" data-nonce="'.$nonce.'" class="cstmskin_btn dlt_btn">Delete</a>';		
							}
						?>
                    </div>
				</li>
				
                
            </ul>
            <div class="cstmskins_sbmt">
            	<a href="javascript:" class="done_btn" onclick="SFSI_done('<?php echo wp_create_nonce('Iamdone');  ?>');"><?php _e("I'm done!",'ultimate-social-media-icons') ?></a> 
            </div>
           
        </div>
    	<script type="text/javascript">
		   function upload_image(ref)
		   {
				var title = jQuery(ref).attr('title');
				tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
				window.send_to_editor = function(html) {
					var url = jQuery('img',html).attr('src');
					if(url == undefined) 
					{
						var url = jQuery(html).attr('src');
					}
					sfsi_customskin_upload(title+'='+url, ref,'<?php echo wp_create_nonce('UploadSkins') ?>');
					tb_remove();
				}
				return false;
			}
		 </script>
    </div>
</div>

<!-- quickpay overlay -->
<div class="pop-overlay read-overlay sfsi_quickpay-overlay" style="background:rgba(255,255,255,.6);z-index:9999;overflow-y:auto">
  <div class="pop_up_box sfsi_pop_up" style="padding-left: 0;padding-right: 0;padding-top:0;margin-top:7%;width:50%;">
    <div class="" >
      <h2 style="font-size: 30px; padding: 30px 10px ; border:1px solid #eee;background:#fbfbfb;text-align:center" ><?php _e("How do you want to pay?",'ultimate-social-media-icons') ?></h2>
    </div>   
    <div class="sfsi_quick-pay-box" style="display:none">
      <div>
        <div class="sfsi_row sfsi_text_center">
          <sellcodes-checkout offer="XdHlrQnc" button-text="Buy Now" show-pay-methods="true" link-image-card="https://sellcodes.com/assets/images/credit_card_method.png" link-image-paypal="<?php echo SFSI_PLUGURL; ?>images/paypal-1.png"/>
          <script src="https://sellcodes.com/quick-checkout/sellcodes-checkout.js"></script>
        </div>
        <div class="sfsi_subheading" style="text-align: center;color:#888;margin:20px;" ><?php _e("Click will establish a connection to Sellcodes.com",'ultimate-social-media-icons') ?></div>
      </div>
      <div class="sfsi_quick-pay-box_container"  style="background: #fbfbfb;padding-top: 20px;padding-bottom: 20px;border-top:1px solid #eee" >
        <div class="sfsi_quick-pay-box_on_box" style="background: transparent; padding: 0 10px; display:block; width: 97%; position: absolute; font-weight: 700; letter-spacing: 2px; text-align: center; font-size: 20px; color: #000000;" ><span style="background: #fbfbfb; padding: 0 20px;">Key points</span></div>
        <div style="margin:10px 70px;border-radius:10px;border:1px solid #bbb;font-size: 17px;line-height: 28px;" >
          <ol style="padding: 15px 20px 10px 10px; font-size: 18px; letter-spacing: 0.5px; color: #000000;">
            <li><?php _e("You‘ll get access to",'ultimate-social-media-icons') ?> <a href="https://www.ultimatelysocial.com/usm-premium/" target="_black" style="color: #000000;"><?php _e("all premium features",'ultimate-social-media-icons') ?></a></li>
            <li><?php _e("The plugin is ",'ultimate-social-media-icons') ?><b><?php _e("priced really fairly",'ultimate-social-media-icons') ?></b><?php _e("starting at",'ultimate-social-media-icons') ?> <del><?php _e("49.98 USD",'ultimate-social-media-icons') ?></del> <?php _e("today: 40% off!",'ultimate-social-media-icons') ?></li>
            <li><b><?php _e("Use it for lifetime:",'ultimate-social-media-icons') ?></b><?php _e("Support and updates are limited to six months, however after that it will not be disabled, you can keep using the plugin (even if you don‘t renew",'ultimate-social-media-icons') ?> )</li>
            <li><?php _e("One license is valid for one site (as support is included), but we ",'ultimate-social-media-icons') ?><b><?php _e("offer 20% discounts",'ultimate-social-media-icons') ?></b> <?php _e("for all future purchases",'ultimate-social-media-icons') ?></li>
            <li><?php _e("We provide a ",'ultimate-social-media-icons') ?><b><?php _e("14 day money-back guarantee",'ultimate-social-media-icons') ?></b><?php _e("if you‘re not satisfied for",'ultimate-social-media-icons') ?>  <u><?php _e("any reason",'ultimate-social-media-icons') ?></u></li>
          </ol>
          <div style="text-align: center;margin-bottom:20px; color: #000000; letter-spacing: 0.5px;" ><?php _e("Still have questions? ",'ultimate-social-media-icons') ?><a href="" onclick="event.preventDefault();sfsi_open_chat();sfsi_close_quickpay()" style="display:inline;font-weight: inherit; color: #000000;"><?php _e("Please ask! ",'ultimate-social-media-icons') ?></a></div>
        </div>
        <div style="text-align: center;font-size:20px; margin: 40px 0 25px 0; letter-spacing: 1px;" >
          <a href="" onclick="event.preventDefault();sfsi_close_quickpay();" style="color: #000000; font-weight: 700;"><?php _e("Close ",'ultimate-social-media-icons') ?></a>
        </div>  
      </div>
    </div>
  </div>
</div>
