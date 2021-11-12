<?php
	/* unserialize all saved option for  section 5 options */
	$icons 		= ($option1['sfsi_custom_files']) ? unserialize($option1['sfsi_custom_files']) : array() ;
	$option3	= maybe_unserialize(get_option('sfsi_section3_options',false));
	$option5	= maybe_unserialize(get_option('sfsi_section5_options',false));
	$custom_icons_order = unserialize($option5['sfsi_CustomIcons_order']);
	if(!isset($option5['sfsi_telegramIcon_order'])){                     
        $option5['sfsi_telegramIcon_order']    = '11';
    }
    if(!isset($option5['sfsi_vkIcon_order'])){                     
        $option5['sfsi_vkIcon_order']    = '12';
    }
    if(!isset($option5['sfsi_okIcon_order'])){                     
        $option5['sfsi_okIcon_order']    = '13';
    }
    if(!isset($option5['sfsi_weiboIcon_order'])){                     
        $option5['sfsi_weiboIcon_order']    = '14';
    }
    if(!isset($option5['sfsi_wechatIcon_order'])){                     
        $option5['sfsi_wechatIcon_order']    = '15';
    }
    if(!isset($option5['sfsi_whatsappIcon_order'])){                     
        $option5['sfsi_whatsappIcon_order']    = '16';
    }
	$icons_order = array(
		$option5['sfsi_rssIcon_order']		=> 'rss',
		$option5['sfsi_emailIcon_order']	=> 'email',
		$option5['sfsi_facebookIcon_order']	=> 'facebook',
		$option5['sfsi_twitterIcon_order']	=> 'twitter',
		$option5['sfsi_youtubeIcon_order']	=> 'youtube',
		$option5['sfsi_pinterestIcon_order']=> 'pinterest',
		$option5['sfsi_linkedinIcon_order']	=> 'linkedin',
		$option5['sfsi_instagramIcon_order']=> 'instagram',
		$option5['sfsi_telegramIcon_order']=> 'telegram',
		$option5['sfsi_vkIcon_order']=> 'vk',
		$option5['sfsi_okIcon_order']=> 'ok',
		$option5['sfsi_weiboIcon_order']=> 'weibo',
		$option5['sfsi_wechatIcon_order']=> 'wechat',
		$option5['sfsi_whatsappIcon_order']=> 'whatsapp',

	) ;
	
	/*
	 * Sanitize, escape and validate values
	 */
	$option5['sfsi_icons_size'] 				= 	(isset($option5['sfsi_icons_size']))
														? intval($option5['sfsi_icons_size'])
														: '';
	$option5['sfsi_icons_spacing'] 				= 	(isset($option5['sfsi_icons_spacing']))
														? intval($option5['sfsi_icons_spacing'])
														: '';
	$option5['sfsi_icons_Alignment'] 			= 	(isset($option5['sfsi_icons_Alignment']))
														? sanitize_text_field($option5['sfsi_icons_Alignment'])
														: '';
	$option5['sfsi_icons_Alignment_via_widget'] = 	(isset($option5['sfsi_icons_Alignment_via_widget']))
														? sanitize_text_field($option5['sfsi_icons_Alignment_via_widget'])
														: '';	
	$option5['sfsi_icons_Alignment_via_shortcode'] 	= 	(isset($option5['sfsi_icons_Alignment_via_shortcode']))
														? sanitize_text_field($option5['sfsi_icons_Alignment_via_shortcode'])
														: '';
	$option5['sfsi_icons_perRow'] 				= 	(isset($option5['sfsi_icons_perRow']))
														? intval($option5['sfsi_icons_perRow'])
														: '';
	$option5['sfsi_icons_ClickPageOpen']		= 	(isset($option5['sfsi_icons_ClickPageOpen']))
														? sanitize_text_field($option5['sfsi_icons_ClickPageOpen'])
														:'';	
	$option5['sfsi_icons_stick'] 				= 	(isset($option5['sfsi_icons_stick']))
														? sanitize_text_field($option5['sfsi_icons_stick'])
														: '';
	$option5['sfsi_rss_MouseOverText'] 			= 	(isset($option5['sfsi_rss_MouseOverText']))
														? sanitize_text_field($option5['sfsi_rss_MouseOverText'])
														: '';
	$option5['sfsi_email_MouseOverText'] 		= 	(isset($option5['sfsi_email_MouseOverText']))
														? sanitize_text_field($option5['sfsi_email_MouseOverText'])
														:'';
	$option5['sfsi_twitter_MouseOverText'] 		= 	(isset($option5['sfsi_twitter_MouseOverText']))
														? sanitize_text_field($option5['sfsi_twitter_MouseOverText'])
														: '';
	$option5['sfsi_facebook_MouseOverText'] 	= 	(isset($option5['sfsi_facebook_MouseOverText']))
														? sanitize_text_field($option5['sfsi_facebook_MouseOverText'])
														: '';
	$option5['sfsi_linkedIn_MouseOverText'] 	= 	(isset($option5['sfsi_linkedIn_MouseOverText']))
														? sanitize_text_field($option5['sfsi_linkedIn_MouseOverText'])
														: '';
	$option5['sfsi_pinterest_MouseOverText']	= 	(isset($option5['sfsi_pinterest_MouseOverText']))
														? sanitize_text_field($option5['sfsi_pinterest_MouseOverText'])
														: '';
	$option5['sfsi_youtube_MouseOverText'] 		= 	(isset($option5['sfsi_youtube_MouseOverText']))
														? sanitize_text_field($option5['sfsi_youtube_MouseOverText'])
														: '';
	$option5['sfsi_instagram_MouseOverText']	= 	(isset($option5['sfsi_instagram_MouseOverText']))
														? sanitize_text_field($option5['sfsi_instagram_MouseOverText'])
														: '';
	$option5['sfsi_telegram_MouseOverText']		= 	(isset($option5['sfsi_telegram_MouseOverText']))
														? sanitize_text_field($option5['sfsi_telegram_MouseOverText'])
														: '';
	$option5['sfsi_vk_MouseOverText']			= 	(isset($option5['sfsi_vk_MouseOverText']))
														? sanitize_text_field($option5['sfsi_vk_MouseOverText'])
														: '';
	$option5['sfsi_ok_MouseOverText']			= 	(isset($option5['sfsi_ok_MouseOverText']))
														? sanitize_text_field($option5['sfsi_ok_MouseOverText'])
														: '';
	$option5['sfsi_weibo_MouseOverText']		= 	(isset($option5['sfsi_weibo_MouseOverText']))
														? sanitize_text_field($option5['sfsi_weibo_MouseOverText'])
														: '';
	$option5['sfsi_wechat_MouseOverText']		= 	(isset($option5['sfsi_wechat_MouseOverText']))
														? sanitize_text_field($option5['sfsi_wechat_MouseOverText'])
														: '';
	$option5['sfsi_whatsapp_MouseOverText']		= 	(isset($option5['sfsi_whatsapp_MouseOverText']))
														? sanitize_text_field($option5['sfsi_whatsapp_MouseOverText'])
														: '';
	$sfsi_icons_suppress_errors 				=   (isset($option5['sfsi_icons_suppress_errors']))
														? sanitize_text_field($option5['sfsi_icons_suppress_errors'])
														: 'no';
	$sfsi_icons_sharing_and_traffic_tips 				=   (isset($option5['sfsi_icons_sharing_and_traffic_tips']))
	? sanitize_text_field($option5['sfsi_icons_sharing_and_traffic_tips'])
	: 'yes';
	if(is_array($custom_icons_order) ) 
	{
		foreach($custom_icons_order as $data)
		{
			$icons_order[$data['order']] = $data;
		}
	}
	ksort($icons_order);
?>

<!-- Section 5 "Any other wishes for your main icons?" main div Start -->
<div class="tab5">
<h4><?php _e( 'Order of your icons', 'ultimate-social-media-icons' ); ?></h4>
    <!-- icon drag drop  section start here -->	
    <ul class="share_icon_order" >
        <?php 
	 	$ctn = 0;
	 	foreach($icons_order as $index=>$icn) :

		  switch ($icn) : 
          case 'rss' :?>
            	 <li class="rss_section" data-index="<?php echo $index; ?>" id="sfsi_rssIcon_order">
                	<a href="#" title="RSS"><img src="<?php echo SFSI_PLUGURL; ?>images/rss.png" alt="RSS" /></a>
                 </li>
          <?php break; ?><?php case 'email' :?>
          		<li class="email_section " data-index="<?php echo $index; ?>" id="sfsi_emailIcon_order">
                	<a href="#" title="Email"><img src="<?php echo SFSI_PLUGURL; ?>images/<?php echo $email_image; ?>" alt="Email" class="icon_img" /></a>
                </li>
          <?php break; ?><?php case 'facebook' :?>
          		<li class="facebook_section " data-index="<?php echo $index; ?>" id="sfsi_facebookIcon_order">
                	<a href="#" title="Facebook"><img src="<?php echo SFSI_PLUGURL; ?>images/facebook.png" alt="Facebook" /></a>
                </li>
          <?php break; ?><?php case 'twitter' :?>
          		<li class="twitter_section " data-index="<?php echo $index; ?>" id="sfsi_twitterIcon_order">
                	<a href="#" title="Twitter" ><img src="<?php echo SFSI_PLUGURL; ?>images/twitter.png" alt="Twitter" /></a>
                </li>
          <?php break; ?><?php case 'youtube' :?>
          		<li class="youtube_section " data-index="<?php echo $index; ?>" id="sfsi_youtubeIcon_order">
                	<a href="#" title="YouTube" ><img src="<?php echo SFSI_PLUGURL; ?>images/youtube.png" alt="YouTube" /></a>
                </li>
          <?php break; ?><?php case 'pinterest' :?>
          		<li class="pinterest_section " data-index="<?php echo $index; ?>" id="sfsi_pinterestIcon_order">
                	<a href="#" title="Pinterest" ><img src="<?php echo SFSI_PLUGURL; ?>images/pinterest.png" alt="Pinterest" /></a>
                </li>
          <?php break; ?><?php case 'linkedin' :?>
          		<li class="linkedin_section " data-index="<?php echo $index; ?>" id="sfsi_linkedinIcon_order">
                	<a href="#" title="Linked In" ><img src="<?php echo SFSI_PLUGURL; ?>images/linked_in.png" alt="Linked In" /></a>
                </li>
          <?php break; ?><?php case 'instagram' :?>
          		<li class="instagram_section " data-index="<?php echo $index; ?>" id="sfsi_instagramIcon_order">
                	<a href="#" title="Instagram" ><img src="<?php echo SFSI_PLUGURL; ?>images/instagram.png" alt="Instagram" /></a>
                </li>
		  <?php break; ?><?php case 'telegram' :?>
          		<li class="telegram_section " data-index="<?php echo $index; ?>" id="sfsi_telegramIcon_order">
                	<a href="#" title="telegram" ><img src="<?php echo SFSI_PLUGURL; ?>images/icons_theme/default/default_telegram.png" height="54px;" alt="telegram" /></a>
                </li>
		  <?php break; ?><?php case 'vk' :?>
          		<li class="vk_section " data-index="<?php echo $index; ?>" id="sfsi_vkIcon_order">
                	<a href="#" title="vk" ><img src="<?php echo SFSI_PLUGURL; ?>images/icons_theme/default/default_vk.png" height="54px;" alt="vk" /></a>
                </li>
		  <?php break; ?><?php case 'ok' :?>
          		<li class="ok_section " data-index="<?php echo $index; ?>" id="sfsi_okIcon_order">
                	<a href="#" title="ok" ><img src="<?php echo SFSI_PLUGURL; ?>images/icons_theme/default/default_ok.png" height="54px;" alt="ok" /></a>
                </li>
		  <?php break; ?><?php case 'weibo' :?>
          		<li class="weibo_section " data-index="<?php echo $index; ?>" id="sfsi_weiboIcon_order">
                	<a href="#" title="weibo" ><img src="<?php echo SFSI_PLUGURL; ?>images/icons_theme/default/default_weibo.png" height="54px;" alt="weibo" /></a>
                </li>
		  <?php break; ?><?php case 'wechat' :?>
          		<li class="wechat_section " data-index="<?php echo $index; ?>" id="sfsi_wechatIcon_order">
                	<a href="#" title="wechat" ><img src="<?php echo SFSI_PLUGURL; ?>images/icons_theme/default/default_wechat.png" height="54px;" alt="wechat" /></a>
                </li>
          <?php break; ?><?php case 'whatsapp' :?>
          		<li class="whatsapp_section " data-index="<?php echo $index; ?>" id="sfsi_whatsappIcon_order">
                	<a href="#" title="whatsapp" ><img src="<?php echo SFSI_PLUGURL; ?>images/icons_theme/default/default_whatsapp.png" height="54px;" alt="whatsapp" /></a>
                </li>
		  <?php break; ?><?php default   :?><?php if(isset($icons[$icn['ele']]) && !empty($icons[$icn['ele']]) && filter_var($icons[$icn['ele']], FILTER_VALIDATE_URL) ): ?>
          		<li class="custom_iconOrder sfsiICON_<?php echo $icn['ele']; ?>" data-index="<?php echo $index; ?>" element-id="<?php echo $icn['ele']; ?>" >
                	<a href="#" title="Custom Icon" ><img src="<?php echo $icons[$icn['ele']]; ?>" alt="Linked In" class="sfcm" /></a>
                </li> 
                <?php endif; ?><?php break; ?><?php  endswitch; ?><?php endforeach; ?> 
     
    </ul> <!-- END icon drag drop section start here -->

    <span class="drag_drp">
		<?php _e( '(Drag &amp; Drop)', 'ultimate-social-media-icons' ); ?>
	</span>
    
    <!-- icon's size and spacing section start here -->	
    <div class="row">
		<h4><?php _e( 'Size &amp; spacing of your icons', 'ultimate-social-media-icons' ); ?></h4>
		<div class="icons_size"><span><?php _e("Size:",'ultimate-social-media-icons') ?></span><input name="sfsi_icons_size" value="<?php echo ($option5['sfsi_icons_size']!='') ?  $option5['sfsi_icons_size'] : '' ;?>" type="text" /><ins><?php _e("pixels wide ",'ultimate-social-media-icons') ?> &amp; <?php _e(" tall",'ultimate-social-media-icons') ?></ins> <span class="last"><?php _e("Spacing between icons:",'ultimate-social-media-icons') ?></span><input name="sfsi_icons_spacing" type="text" value="<?php echo ($option5['sfsi_icons_spacing']!='') ?  $option5['sfsi_icons_spacing'] : '' ;?>" /><ins><?php _e( 'Pixels', 'ultimate-social-media-icons' ) ?></ins></div>

		<div class="icons_prem_disc">			
			<p class="sfsi_prem_plu_desc"><?php 
                printf(
                    __( '%1$sNew:%2$s The Premium Plugin also allows you to define the vertical distance between the icons (and set this differently for mobile vs. desktop): %3$sGo premium now%4$s or learn more.%5$s','ultimate-social-media-icons' ),
                    '<b>',
                    '</b>',
                    '<a class="pop-up sfisi_font_bold" data-id="sfsi_quickpay-overlay" onclick="sfsi_open_quick_checkout(event)" style="cursor:pointer;border-bottom: 1px solid #12a252;color: #12a252 !important;font-weight:bold" target="_blank">',
                    '</a><a href="https://www.ultimatelysocial.com/usm-premium/?utm_source=usmi_settings_page&utm_campaign=more_spacings&utm_medium=banner" class="sfsi_font_inherit" style="color: #12a252 !important" target="_blank">',
                    '</a>'
                );
            ?></p>
		</div>
    </div>
    
    <div class="row" style="font-size: 17px;">
	<h4><?php _e( 'Alignments', 'ultimate-social-media-icons' ); ?></h4>
	<div class="icons_size" style="width: max-content;display:flow-root">
		<span style="font-size: 17px;"><?php _e( 'Icons per row:', 'ultimate-social-media-icons' ); ?></span>
		<input name="sfsi_icons_perRow" type="text" value="<?php echo ($option5['sfsi_icons_perRow']!='') ?  $option5['sfsi_icons_perRow'] : '' ;?>" />
		<ins class="leave_empty" style="margin-bottom: 34px;font-size: 17px;"><?php _e("Leave empty if you don't want to",'ultimate-social-media-icons') ?> <br /><?php _e("define this",'ultimate-social-media-icons') ?> </ins>
	</div>
	<div class="icons_size" style="width: max-content;">
		<div style="width: 232px;float: left;position: relative;">
		<span style="line-height: 26px;margin-bottom: 22px;font-size: 17px;"><?php _e("Alignment of icons within a widget:",'ultimate-social-media-icons') ?></span>
			
		</div>
		<div class="field">
			<select name="sfsi_icons_Alignment_via_widget" id="sfsi_icons_Alignment_via_widget" class="styled">
				<option value="center" <?php echo ($option5['sfsi_icons_Alignment_via_widget']=='center') ?  'selected="selected"' : '' ;?>><?php _e("Centered",'ultimate-social-media-icons') ?></option>
				<option value="right" <?php echo ($option5['sfsi_icons_Alignment_via_widget']=='right') ?  'selected="selected"' : '' ;?>><?php _e("Right",'ultimate-social-media-icons') ?></option>
				<option value="left" <?php echo ($option5['sfsi_icons_Alignment_via_widget']=='left') ?  'selected="selected"' : '' ;?>><?php _e("Left",'ultimate-social-media-icons') ?></option>
			</select>
		</div>
	</div>
	<div class="icons_size" style="width: max-content;">
	<div style="width: 232px;float: left;position: relative;">
			<span style="line-height: 26px;margin-bottom: 22px;font-size: 17px;"><?php _e("Alignment of icons if placed via shortcode:",'ultimate-social-media-icons') ?></span>
		</div>
		<div class="field">
			<select name="sfsi_icons_Alignment_via_shortcode" id="sfsi_icons_Alignment_via_shortcode" class="styled">
				<option value="center" <?php echo ($option5['sfsi_icons_Alignment_via_shortcode']=='center') ?  'selected="selected"' : '' ;?>><?php _e("Centered",'ultimate-social-media-icons') ?></option>
				<option value="right" <?php echo ($option5['sfsi_icons_Alignment_via_shortcode']=='right') ?  'selected="selected"' : '' ;?>><?php _e("Right",'ultimate-social-media-icons') ?></option>
				<option value="left" <?php echo ($option5['sfsi_icons_Alignment_via_shortcode']=='left') ?  'selected="selected"' : '' ;?>><?php _e("Left",'ultimate-social-media-icons') ?></option>
			</select>
		</div>
	</div>
	<div class="icons_size" style="width: max-content;">
	<div style="width: 232px;float: left;position: relative;">
			<span style="line-height: 26px;margin-bottom: 10px;font-size: 17px;"><?php _e("Alignment of icons In the second row:",'ultimate-social-media-icons') ?></span>
			<ins class="sfsi_icons_other_allign" style="bottom: -22px;left: 0;width: 200px;color: rgb(128,136,145);">
				<?php _e("(with respect to icons in the first row; only relevant if your icons show in two or more rows)",'ultimate-social-media-icons') ?>
			</ins>
		</div>
		<div class="field">
			<select name="sfsi_icons_Alignment" id="sfsi_icons_Alignment" class="styled">
				<option value="center" <?php echo ($option5['sfsi_icons_Alignment']=='center') ?  'selected="selected"' : '' ;?>><?php _e("Centered",'ultimate-social-media-icons') ?></option>
				<option value="right" <?php echo ($option5['sfsi_icons_Alignment']=='right') ?  'selected="selected"' : '' ;?>><?php _e("Right",'ultimate-social-media-icons') ?></option>
				<option value="left" <?php echo ($option5['sfsi_icons_Alignment']=='left') ?  'selected="selected"' : '' ;?>><?php _e("Left",'ultimate-social-media-icons') ?></option>
			</select>
		</div>
	</div>

    <div class= "sfsi_new_prmium_follw" style="margin-top: 38px;">
		<?php 
			printf(
				__( '%1$s New: %2$s In the Premium Plugin you can show the icons vertically and give them different alignment options for icons placed on mobile. %3$s  See all features. %4$s', 'ultimate-social-media-icons' ),
				'<p><b>',
				'</b>',
				'<a href="https://www.ultimatelysocial.com/usm-premium/?utm_source=usmi_settings_page&utm_campaign=more_alignment_options&utm_medium=banner" class="sfsi_font_inherit" target="_blank">',
				'</a></p>'
			);
		?>
	</div>

    </div>
    
    <div class="row new_wind">
		<h4><?php _e("New window",'ultimate-social-media-icons') ?></h4>
		<div class="row_onl"><p><?php _e("If a user clicks on your icons, do you want to open the page in a new window?",'ultimate-social-media-icons') ?>
		</p>
			<ul class="enough_waffling">
		    	<li>
		    		<input name="sfsi_icons_ClickPageOpen" <?php echo ($option5['sfsi_icons_ClickPageOpen']=='yes') ?  'checked="true"' : '' ;?> type="radio" value="yes" class="styled"  />
		    		<label><?php _e("Yes",'ultimate-social-media-icons') ?></label>
		    	</li>
				<li>
					<input name="sfsi_icons_ClickPageOpen" <?php echo ($option5['sfsi_icons_ClickPageOpen']=='no') ?  'checked="true"' : '' ;?> type="radio" value="no" class="styled" />
					<label><?php _e("No",'ultimate-social-media-icons') ?></label>
				</li>
	      	</ul>
      	</div>
    </div>

   
     <!-- icon's floating and stick section start here -->	
    <div class="row sticking">
	
		<h4><?php _e("Sticky icons",'ultimate-social-media-icons') ?></h4>
		
		<div class="clear float_options" <?php if($option5['sfsi_icons_stick']=='yes') :?> style="display:none" <?php endif;?>>

	
		</div> 
	
	<div class="space">
		
		<p class="list"><?php _e("Make icons stick?",'ultimate-social-media-icons') ?></p>

		<ul class="enough_waffling">
			
			<li>
				<input name="sfsi_icons_stick" <?php echo ($option5['sfsi_icons_stick']=='yes') ?  'checked="true"' : '' ;?> type="radio" value="yes" class="styled"  />
				<label><?php _e("Yes",'ultimate-social-media-icons') ?></label>
			</li>

			<li>
				<input name="sfsi_icons_stick" <?php echo ($option5['sfsi_icons_stick']=='no') ?  'checked="true"' : '' ;?>  type="radio" value="no" class="styled" />
				<label><?php _e("No",'ultimate-social-media-icons') ?></label>
			</li>

		</ul>

		
		<p><?php 
			printf(
				__( 'If you select «Yes» here, then the icons which you placed via %1$swidget%2$s or %3$sshortcode%4$s will still be visible on the screen as user scrolls down your page, i.e. they will stick at the top.', 'ultimate-social-media-icons' ),
				'<span style="text-decoration: underline;"><b>',
				'</b></span>',
				'<span style="text-decoration: underline;"><b>',
				'</b></span>'
			);
		?></p>
		

		<p><?php 
			printf(
				__( 'This is not to be confused with making the icons permanently placed in the same position, which is possible in the %1$s Premium Plugin.%2$s', 'ultimate-social-media-icons' ),
				'<a target="_blank" href="https://www.ultimatelysocial.com/usm-premium"><b>',
				'</b></a>'
			);
		?></p>

  	</div>

</div><!-- END icon's floating and stick section -->

<!--*************  Sharing texts & pictures section STARTS *****************************-->

<div class="row sfsi_custom_social_data_setting" id="custom_social_data_setting">

		<h4><?php _e("Sharing texts & pictures?",'ultimate-social-media-icons') ?></h4>
		<p><?php _e("On the pages where you edit your posts/pages, you’ll see a (new) section where you can define which pictures & text should be shared. This extra section is displayed on the following:",'ultimate-social-media-icons') ?></p>		

			<?php 
				$checkedS   = (isset($option5['sfsi_custom_social_hide']) && $option5['sfsi_custom_social_hide']=="yes") ? 'checked="checked"': '';	
				$checked    = (isset($option5['sfsi_custom_social_hide']) && $option5['sfsi_custom_social_hide']=="yes") ? '': 'checked="checked"';
				$checkedVal = (isset($option5['sfsi_custom_social_hide'])) ? $option5['sfsi_custom_social_hide']: 'no';				
			?>
		<div class="social_data_post_types">
			<ul class="socialPostTypesUl">
				<li>
					<div class="radio_section tb_4_ck">
						<input type="checkbox" <?php echo $checked; ?> value="page" class="styled"  />
						<label class="cstmdsplsub"><?php _e("Page",'ultimate-social-media-icons') ?></label>
					</div>
				</li>
            	<li>
					<div class="radio_section tb_4_ck">
						<input type="checkbox" <?php echo $checked; ?> value="post" class="styled"  />
						<label class="cstmdsplsub"><?php _e("Post",'ultimate-social-media-icons') ?></label>
					</div>
				</li>						
            </ul>

            <ul class="sfsi_show_hide_section">
           		<li>
					<div class="radio_section tb_4_ck">
						<input name="sfsi_custom_social_hide" type="checkbox" <?php echo $checkedS; ?> value="<?php echo $checkedVal; ?>" class="styled"  />
						<label class="cstmdsplsub"><?php _e("Hide section for all",'ultimate-social-media-icons') ?></label>
					</div>
				</li>
            </ul>
 		</div>

		<div class="sfsi_new_prmium_follw sfsi_social_sharing" style="margin-bottom: 15px;">
		<p><?php 
			printf(
				__( 'Note: This feature is currently only available in the Premium Plugin. %1$sGo premium now%2$s or learn more.%3$s', 'ultimate-social-media-icons' ),
				 '<a class="pop-up sfisi_font_bold" data-id="sfsi_quickpay-overlay" onclick="sfsi_open_quick_checkout(event)" style="cursor:pointer;border-bottom: 1px solid #12a252;color: #12a252 !important;font-weight:bold" target="_blank">',
				 '</a><a href="https://www.ultimatelysocial.com/usm-premium/?utm_source=usmi_settings_page&utm_campaign=define_pic_and_text&utm_medium=banner" class="sfsi_font_inherit" target="_blank">',
				 '</a>'
			);
		?></p>
		</div>
</div>

<!--********************  Sharing texts & pictures section CLOSES ************************************************-->

 <!-- mouse over text section start here -->
 <div class="row mouse_txt">
 	<h4><?php _e("Mouseover text",'ultimate-social-media-icons') ?></h4>
	<p>
	<?php _e("If you’ve given your icon only one function (i.e. no pop-up where user can perform different actions) then you can define here what text will be displayed if a user moves his mouse over the icon:",'ultimate-social-media-icons') ?>
	</p>
	<div class="space">
		<div class="clear"></div>
		<div class="mouseover_field rss_section">
			<label><?php _e("RSS:",'ultimate-social-media-icons') ?></label><input name="sfsi_rss_MouseOverText" value="<?php echo ($option5['sfsi_rss_MouseOverText']!='') ?  $option5['sfsi_rss_MouseOverText'] : '' ;?>" type="text" />
		</div>
		<div class="mouseover_field email_section">
			<label><?php _e("Email:",'ultimate-social-media-icons') ?></label><input name="sfsi_email_MouseOverText" value="<?php echo ($option5['sfsi_email_MouseOverText']!='') ?  $option5['sfsi_email_MouseOverText'] : '' ;?>" type="text" />
		</div>
		
		<div class="clear">
		<div class="mouseover_field twitter_section">
			<label><?php _e("Twitter:",'ultimate-social-media-icons') ?></label>
			<input name="sfsi_twitter_MouseOverText" value="<?php echo ($option5['sfsi_twitter_MouseOverText']!='') ?  $option5['sfsi_twitter_MouseOverText'] : '' ;?>" type="text" />
		</div>
		<div class="mouseover_field facebook_section">
			<label><?php _e("Facebook:",'ultimate-social-media-icons') ?></label>
			<input name="sfsi_facebook_MouseOverText" value="<?php echo ($option5['sfsi_facebook_MouseOverText']!='') ?  $option5['sfsi_facebook_MouseOverText'] : '' ;?>" type="text" />
		</div>
		</div>
		<div class="clear">
		<div class="mouseover_field linkedin_section">
			<label><?php _e("LinkedIn:",'ultimate-social-media-icons') ?></label>
			<input name="sfsi_linkedIn_MouseOverText" value="<?php echo ($option5['sfsi_linkedIn_MouseOverText']!='') ?  $option5['sfsi_linkedIn_MouseOverText'] : '' ;?>"  type="text" />
		</div>
		<div class="mouseover_field wechat_section">
				<label><?php _e("WeChat:",'ultimate-social-media-icons') ?></label>
				<input name="sfsi_wechat_MouseOverText" value="<?php echo ($option5['sfsi_wechat_MouseOverText']!='') ?  $option5['sfsi_wechat_MouseOverText'] : '' ;?>" type="text" />
		    </div>
		</div>
		<div class="clear">
			<div class="mouseover_field whatsapp_section">
				<label><?php _e("WhatsApp:<",'ultimate-social-media-icons') ?>/label>
				<input name="sfsi_whatsapp_MouseOverText" value="<?php echo ($option5['sfsi_whatsapp_MouseOverText']!='') ?  $option5['sfsi_whatsapp_MouseOverText'] : '' ;?>" type="text" />
	    	</div>
		</div>

		<div class="clear">
		<div class="mouseover_field pinterest_section">
			<label><?php _e("Pinterest:",'ultimate-social-media-icons') ?></label>
			<input name="sfsi_pinterest_MouseOverText" value="<?php echo ($option5['sfsi_pinterest_MouseOverText']!='') ?  $option5['sfsi_pinterest_MouseOverText'] : '' ;?>" type="text" />
		</div>
		<div class="mouseover_field youtube_section">
			<label><?php _e("Youtube:",'ultimate-social-media-icons') ?></label>
			<input name="sfsi_youtube_MouseOverText" value="<?php echo ($option5['sfsi_youtube_MouseOverText']!='') ?  $option5['sfsi_youtube_MouseOverText'] : '' ;?>" type="text" />
		</div>
		</div>
		<div class="clear">
		    <div class="mouseover_field instagram_section">
				<label><?php _e("Instagram:",'ultimate-social-media-icons') ?></label>
				<input name="sfsi_instagram_MouseOverText" value="<?php echo ($option5['sfsi_instagram_MouseOverText']!='') ?  $option5['sfsi_instagram_MouseOverText'] : '' ;?>" type="text" />
			</div>
			<div class="mouseover_field telegram_section">
				<label><?php _e("Telegram:",'ultimate-social-media-icons') ?></label>
				<input name="sfsi_telegram_MouseOverText" value="<?php echo ($option5['sfsi_telegram_MouseOverText']!='') ?  $option5['sfsi_telegram_MouseOverText'] : '' ;?>" type="text" />
		    </div>
		</div>
		<div class="clear">
		    <div class="mouseover_field vk_section">
				<label><?php _e("VK:",'ultimate-social-media-icons') ?></label>
				<input name="sfsi_vk_MouseOverText" value="<?php echo ($option5['sfsi_vk_MouseOverText']!='') ?  $option5['sfsi_vk_MouseOverText'] : '' ;?>" type="text" />
			</div>
			<div class="mouseover_field ok_section">
				<label><?php _e("Ok:",'ultimate-social-media-icons') ?></label>
				<input name="sfsi_ok_MouseOverText" value="<?php echo ($option5['sfsi_ok_MouseOverText']!='') ?  $option5['sfsi_ok_MouseOverText'] : '' ;?>" type="text" />
		    </div>
		</div>
		<div class="clear">
		    <div class="mouseover_field weibo_section">
				<label><?php _e("Weibo:",'ultimate-social-media-icons') ?></label>
				<input name="sfsi_weibo_MouseOverText" value="<?php echo ($option5['sfsi_weibo_MouseOverText']!='') ?  $option5['sfsi_weibo_MouseOverText'] : '' ;?>" type="text" />
			</div>
			
		</div>
        <div class="clear"> </div>  
		<div class="custom_m">
        	<?php 
                $sfsiMouseOverTexts =  unserialize($option5['sfsi_custom_MouseOverTexts']);
                $count = 1; for($i=$first_key; $i <= $endkey; $i++) :
            ?><?php if(!empty( $icons[$i])) : ?>
                
                <div class="mouseover_field custom_section sfsiICON_<?php echo $i; ?>">
                    <label><?php _e("Custom",'ultimate-social-media-icons') ?> <?php echo $count; ?>:</label>
                    <input name="sfsi_custom_MouseOverTexts[]" value="<?php echo (isset($sfsiMouseOverTexts[$i]) && $sfsiMouseOverTexts[$i]!='') ?sanitize_text_field($sfsiMouseOverTexts[$i]) : '' ;?>" type="text" file-id="<?php echo $i; ?>" />
                </div>
                  
                <?php if($count%2==0): ?>
                
                <div class="clear"> </div>  
            <?php endif; ?><?php $count++; endif; endfor; ?>
		</div>
		
	</div>

	</div>
	<!-- END mouse over text section -->

    <div class="row new_wind">
		<h4><?php _e("Error reporting",'ultimate-social-media-icons') ?></h4>
		<div class="row_onl"><p><?php _e("Suppress error messages?",'ultimate-social-media-icons') ?></p>
			<ul class="enough_waffling">
		    	<li>
		    		<input name="sfsi_icons_suppress_errors" <?php echo ($sfsi_icons_suppress_errors=='yes') ?  'checked="true"' : '' ;?> type="radio" value="yes" class="styled"  />
		    		<label><?php _e("Yes",'ultimate-social-media-icons') ?></label>
		    	</li>
				<li>
					<input name="sfsi_icons_suppress_errors" <?php echo ($sfsi_icons_suppress_errors=='no') ?  'checked="true"' : '' ;?> type="radio" value="no" class="styled" />
					<label><?php _e("No",'ultimate-social-media-icons') ?></label>
				</li>
	      	</ul>
      	</div>
	</div>

	<div class="row new_wind">
		<h4><?php _e("Tips",'ultimate-social-media-icons') ?></h4>
		<div class="row_onl"><p><?php _e("Show more useful tips for more sharing & traffic?",'ultimate-social-media-icons') ?></p>
			<ul class="enough_waffling">
		    	<li>
		    		<input name="sfsi_icons_sharing_and_traffic_tips" <?php echo ($sfsi_icons_sharing_and_traffic_tips=='yes') ?  'checked="true"' : '' ;?> type="radio" value="yes" class="styled"  />
		    		<label><?php _e("Yes",'ultimate-social-media-icons') ?></label>
		    	</li>
				<li>
					<input name="sfsi_icons_sharing_and_traffic_tips" <?php echo ($sfsi_icons_sharing_and_traffic_tips=='no') ?  'checked="true"' : '' ;?> type="radio" value="no" class="styled" />
					<label><?php _e("No",'ultimate-social-media-icons') ?></label>
				</li>
	      	</ul>
      	</div>
	</div>
	
	<!-- <div class="row new_wind">
		<h4>Tips</h4>
		<div class="row_onl"><p>Show useful tips for more sharing & traffic?</p>
			<ul class="enough_waffling">
		    	<li>
		    		<input name="sfsi_icons_hide_banners" checked="true"  type="radio" value="yes" class="styled"  />
		    		<label>Yes</label>
		    	</li>
				<li>
					<input name="sfsi_icons_hide_banners" type="radio" value="no" class="styled" />
					<label>No</label>
				</li>
	      	</ul>
      	</div>
    </div> -->

	<?php sfsi_ask_for_help(5); ?>
    <!-- SAVE BUTTON SECTION   --> 
    <div class="save_button">
         <img src="<?php echo SFSI_PLUGURL ?>images/ajax-loader.gif" alt="error" class="loader-img" />
         <?php  $nonce = wp_create_nonce("update_step5"); ?>
         <a href="javascript:;" id="sfsi_save5" title="Save" data-nonce="<?php echo $nonce;?>"><?php _e("Save",'ultimate-social-media-icons') ?></a>
    </div>
    <!-- END SAVE BUTTON SECTION   -->
    
    <a class="sfsiColbtn closeSec" href="javascript:;" ><?php _e("Collapse area",'ultimate-social-media-icons') ?></a>
    <label class="closeSec"></label>
        
    <!-- ERROR AND SUCCESS MESSAGE AREA-->
    <p class="red_txt errorMsg" style="display:none"> </p>
    <p class="green_txt sucMsg" style="display:none"> </p>
    <div class="clear"></div>
    
</div>
<!-- END Section 5 "Any other wishes for your main icons?"-->
