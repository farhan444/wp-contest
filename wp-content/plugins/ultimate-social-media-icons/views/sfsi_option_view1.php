<?php

/* unserialize all saved option for first options */

$option1 = maybe_unserialize(get_option('sfsi_section1_options', false));

/*
	 * Sanitize, escape and validate values
	 */

$option1['sfsi_rss_display']         = (isset($option1['sfsi_rss_display']))

    ? sanitize_text_field($option1['sfsi_rss_display'])

    : 'yes';

$option1['sfsi_email_display']         = (isset($option1['sfsi_email_display']))
    ? sanitize_text_field($option1['sfsi_email_display'])
    : 'yes';
$option1['sfsi_facebook_display']     = (isset($option1['sfsi_facebook_display']))
    ? sanitize_text_field($option1['sfsi_facebook_display'])
    : 'yes';

$option1['sfsi_twitter_display']     = (isset($option1['sfsi_twitter_display']))
    ? sanitize_text_field($option1['sfsi_twitter_display'])
    : 'yes';
$option1['sfsi_youtube_display']     = (isset($option1['sfsi_youtube_display']))

    ? sanitize_text_field($option1['sfsi_youtube_display'])

    : 'no';

$option1['sfsi_pinterest_display']     = (isset($option1['sfsi_pinterest_display']))
    ? sanitize_text_field($option1['sfsi_pinterest_display'])
    : 'no';

$option1['sfsi_telegram_display']     = (isset($option1['sfsi_telegram_display']))
    ? sanitize_text_field($option1['sfsi_telegram_display'])
    : 'no';

$option1['sfsi_vk_display']         = (isset($option1['sfsi_vk_display']))
    ? sanitize_text_field($option1['sfsi_vk_display'])
    : 'no';

$option1['sfsi_ok_display']         = (isset($option1['sfsi_ok_display']))
    ? sanitize_text_field($option1['sfsi_ok_display'])
    : 'no';

$option1['sfsi_wechat_display']     = (isset($option1['sfsi_wechat_display']))
    ? sanitize_text_field($option1['sfsi_wechat_display'])
    : 'no';

$option1['sfsi_weibo_display']      = (isset($option1['sfsi_weibo_display']))
    ? sanitize_text_field($option1['sfsi_weibo_display'])
    : 'no';

$option1['sfsi_linkedin_display']     = (isset($option1['sfsi_linkedin_display']))
    ? sanitize_text_field($option1['sfsi_linkedin_display'])
    : 'no';

$option1['sfsi_instagram_display']     = (isset($option1['sfsi_instagram_display']))
    ? sanitize_text_field($option1['sfsi_instagram_display'])
    : 'no';
$option1['sfsi_whatsapp_display']     = (isset($option1['sfsi_whatsapp_display']))
    ? sanitize_text_field($option1['sfsi_whatsapp_display'])
    : 'no';
?>

<!-- Section 1 "Which icons do you want to show on your site? " main div Start -->

<div class="tab1">
    <p class="top_txt">
        <?php _e('In general,','ultimate-social-media-icons') ?>
        <span><?php _e('the more icons you offer the better','ultimate-social-media-icons') ?></span>
        <?php _e(' because people have different preferences, and more options mean that there’s something for everybody, increasing the chances that you get followed and/or shared.','ultimate-social-media-icons') ?>
    </p>
    <ul class="icn_listing">

        <!-- RSS ICON -->
        <li class="gary_bg">

            <div class="radio_section tb_4_ck">
                <input name="sfsi_rss_display" <?php echo ($option1['sfsi_rss_display'] == 'yes') ?  'checked="true"' : ''; ?> id="sfsi_rss_display" type="checkbox" value="yes" class="styled" />

            </div>

            <span class="sfsicls_rs_s"><?php _e('RSS','ultimate-social-media-icons') ?></span>

            <div class="right_info">

                <p><span><?php _e('Strongly recommended:','ultimate-social-media-icons') ?></span> 
                    <?php _e('RSS is still popular, esp. among the tech-savvy crowd.','ultimate-social-media-icons') ?>
                
                    <label class="expanded-area"><?php _e('RSS stands for Really Simply Syndication and is an easy way for people to read your content. You can learn more about it ','ultimate-social-media-icons') ?><a href="http://en.wikipedia.org/wiki/RSS" target="new" title="Syndication"><?php _e('here','ultimate-social-media-icons') ?></a>. </label></p>

                <a href="javascript:;" class="expand-area"><?php _e('Read more','ultimate-social-media-icons') ?></a>

            </div>

        </li>

        <!-- END RSS ICON -->

        <!-- EMAIL ICON -->
        <li class="gary_bg">
            <div class="radio_section tb_4_ck">

                <input name="sfsi_email_display" <?php echo ($option1['sfsi_email_display'] == 'yes') ?  'checked="true"' : ''; ?> id="sfsi_email_display" type="checkbox" value="yes" class="styled" />

            </div>

            <span class="sfsicls_email"><?php _e('Email','ultimate-social-media-icons') ?></span>

            <div class="right_info">

                <p><span><?php _e('Strongly recommended:','ultimate-social-media-icons') ?></span> <?php _e('Email is the most effective tool to build up followership.','ultimate-social-media-icons') ?>

                    <span style="float: right;margin-right: 13px; margin-top: -3px;">

                        <?php if (get_option('sfsi_footer_sec') == "yes") {
                            $nonce = wp_create_nonce("remove_footer"); ?>

                            <a style="font-size:13px;margin-left:30px;color:#777777;" href="javascript:;" class="sfsi_removeFooter" data-nonce="<?php echo $nonce; ?>"><?php _e('Remove credit link','ultimate-social-media-icons') ?></a>

                        <?php } ?>

                    </span>

                    <label class="expanded-area"><?php _e('Everybody uses email – that’s why it’s ','ultimate-social-media-icons') ?><a href="http://www.entrepreneur.com/article/230949" target="new"><?php _e('much more effective than social media','ultimate-social-media-icons') ?> </a><?php _e(' to make people follow you. Not offering an email subscription option means losing out on future traffic to your site.','ultimate-social-media-icons') ?> </label>

                </p>

                <a href="javascript:;" class="expand-area"><?php _e('Read more','ultimate-social-media-icons') ?></a>

            </div>

        </li>

        <!-- EMAIL ICON -->
        <!-- FACEBOOK ICON -->

        <li class="gary_bg">

            <div class="radio_section tb_4_ck"><input name="sfsi_facebook_display" <?php echo ($option1['sfsi_facebook_display'] == 'yes') ?  'checked="true"' : ''; ?> id="sfsi_facebook_display" type="checkbox" value="yes" class="styled" /></div>

            <span class="sfsicls_facebook"><?php _e('Facebook','ultimate-social-media-icons') ?></span>

            <div class="right_info">

                <p><span><?php _e('Strongly recommended:','ultimate-social-media-icons') ?></span> <?php _e('Facebook is crucial, esp. for sharing.','ultimate-social-media-icons') ?>

                    <label class="expanded-area"><?php _e('Facebook is the giant in the social media world, and even if you don’t have a Facebook account yourself you should display this icon, so that Facebook users can share your site on Facebook. ','ultimate-social-media-icons') ?></label>

                </p>

                <a href="javascript:;" class="expand-area"><?php _e('Read more','ultimate-social-media-icons') ?></a>

            </div>

        </li>


        <!-- END FACEBOOK ICON -->
        <!-- TWITTER ICON -->

        <li class="gary_bg">

            <div class="radio_section tb_4_ck"><input name="sfsi_twitter_display" <?php echo ($option1['sfsi_twitter_display'] == 'yes') ?  'checked="true"' : ''; ?> id="sfsi_twitter_display" type="checkbox" value="yes" class="styled" /></div>

            <span class="sfsicls_twt"><?php _e('Twitter','ultimate-social-media-icons') ?></span>

            <div class="right_info">

                <p><span><?php _e('Strongly recommended:','ultimate-social-media-icons') ?></span> <?php _e('Can have a strong promotional effect.','ultimate-social-media-icons') ?>

                    <label class="expanded-area"><?php _e('If you have a Twitter-account then adding this icon is a no-brainer. However, similar as with Facebook, even if you don’t have one you should still show this icon so that Twitter-users can share your site.','ultimate-social-media-icons') ?></label>

                </p>

                <a href="javascript:;" class="expand-area"><?php _e('Read more','ultimate-social-media-icons') ?></a>

            </div>

        </li>

        <!-- END TWITTER ICON -->
        <!-- YOUTUBE ICON -->

        <li class="sfsi_vertically_center">
            <div>
                <div class="radio_section tb_4_ck"><input name="sfsi_youtube_display" <?php echo ($option1['sfsi_youtube_display'] == 'yes') ?  'checked="true"' : ''; ?> id="sfsi_youtube_display" type="checkbox" value="yes" class="styled" /></div>
                <span class="sfsicls_utube"><?php _e('Youtube','ultimate-social-media-icons') ?></span>
            </div>
            <div class="right_info">
                <p><span><?php _e('It depends:','ultimate-social-media-icons') ?></span> <?php _e('Show this icon if you have a youtube account (and you should set up one if you have video content – that can increase your traffic significantly).','ultimate-social-media-icons') ?> </p>
            </div>
        </li>

        <!-- END YOUTUBE ICON -->

        <!-- LINKEDIN ICON -->
        <li class="sfsi_vertically_center">
            <div>
                <div class="radio_section tb_4_ck"><input name="sfsi_linkedin_display" <?php echo ($option1['sfsi_linkedin_display'] == 'yes') ?  'checked="true"' : ''; ?> id="sfsi_linkedin_display" type="checkbox" value="yes" class="styled" /></div>

                <span class="sfsicls_linkdin"><?php _e('LinkedIn','ultimate-social-media-icons') ?></span>
            </div>
            <div class="right_info">

                <p><span><?php _e('It depends:','ultimate-social-media-icons') ?></span><?php _e(' No.1 network for business purposes. Use this icon if you’re a LinkedInner.','ultimate-social-media-icons') ?></p>

            </div>

        </li>
        <!-- END LINKEDIN ICON -->


        <!-- PINTEREST ICON -->
        <li class="sfsi_vertically_center">
            <div>
                <div class="radio_section tb_4_ck"><input name="sfsi_pinterest_display" <?php echo ($option1['sfsi_pinterest_display'] == 'yes') ?  'checked="true"' : ''; ?> id="sfsi_pinterest_display" type="checkbox" value="yes" class="styled" /></div>

                <span class="sfsicls_pinterest"><?php _e('Pinterest','ultimate-social-media-icons') ?></span>

            </div>

            <div class="right_info">

                <p><span><?php _e('It depends: ','ultimate-social-media-icons') ?></span><?php _e('Show this icon if you have a Pinterest account (and you should set up one if you publish new pictures regularly – that can increase your traffic significantly).','ultimate-social-media-icons') ?> </p>

            </div>

        </li>
        <!-- END PINTEREST ICON -->

        <!-- INSTAGRAM ICON -->
        <li class="sfsi_vertically_center">
            <div>
                <div class="radio_section tb_4_ck"><input name="sfsi_instagram_display" <?php echo ($option1['sfsi_instagram_display'] == 'yes') ?  'checked="true"' : ''; ?> id="sfsi_instagram_display" type="checkbox" value="yes" class="styled" /></div>

                <span class="sfsicls_instagram"><?php _e('Instagram','ultimate-social-media-icons') ?></span>

            </div>

            <div class="right_info">

                <p><span><?php _e('It depends: ','ultimate-social-media-icons') ?></span><?php _e('Show this icon if you have an Instagram account.','ultimate-social-media-icons') ?> </p>

            </div>

        </li>
        <!-- END INSTAGRAM ICON -->
         <!-- WHATSAPP ICON -->
         <li class="sfsi_vertically_center">
            <div>
                <div class="radio_section tb_4_ck"><input name="sfsi_whatsapp_display" <?php echo ($option1['sfsi_whatsapp_display'] == 'yes') ?  'checked="true"' : ''; ?> id="sfsi_whatsapp_display" type="checkbox" value="yes" class="styled" /></div>

                <span class="sfsicls_whatsapp"><?php _e('WhatsApp','ultimate-social-media-icons') ?></span>
            </div>
            <div class="right_info">

                <p><span><?php _e('It depends: ','ultimate-social-media-icons') ?></span><?php _e('Show this icon if you want to allow users to share the page via WhatsApp.','ultimate-social-media-icons') ?> </p>

            </div>

        </li>
        <!-- END WHATSAPP ICON -->
        <!-- TELEGRAM ICON -->
        <li class="sfsi_vertically_center">
            <div>
                <div class="radio_section tb_4_ck"><input name="sfsi_telegram_display" <?php echo ($option1['sfsi_telegram_display'] == 'yes') ?  'checked="true"' : ''; ?> id="sfsi_telegram_display" type="checkbox" value="yes" class="styled" /></div>

                <span class="sfsicls_telegram"><?php _e('Telegram','ultimate-social-media-icons') ?></span>

            </div>

            <div class="right_info">

                <p><span><?php _e('It depends: ','ultimate-social-media-icons') ?></span><?php _e('Show this icon if you have a Telegram account.','ultimate-social-media-icons') ?> </p>

            </div>

        </li>
        <!-- END TELEGRAM ICON -->

        <!-- VK ICON -->
        <li class="sfsi_vertically_center">
            <div>
                <div class="radio_section tb_4_ck"><input name="sfsi_vk_display" <?php echo ($option1['sfsi_vk_display'] == 'yes') ?  'checked="true"' : ''; ?> id="sfsi_vk_display" type="checkbox" value="yes" class="styled" /></div>

                <span class="sfsicls_vk"><?php _e('VK','ultimate-social-media-icons') ?></span>
            </div>
            <div class="right_info">

                <p><span><?php _e('It depends: ','ultimate-social-media-icons') ?></span> <?php _e('Show this icon if you have a VK account.','ultimate-social-media-icons') ?></p>

            </div>

        </li>
        <!-- END VK ICON -->

        <!-- OK ICON -->
        <li class="sfsi_vertically_center">
            <div>

                <div class="radio_section tb_4_ck"><input name="sfsi_ok_display" <?php echo ($option1['sfsi_ok_display'] == 'yes') ?  'checked="true"' : ''; ?> id="sfsi_ok_display" type="checkbox" value="yes" class="styled" /></div>

                <span class="sfsicls_ok"><?php _e('Ok','ultimate-social-media-icons') ?></span>

            </div>

            <div class="right_info">

                <p><span><?php _e('It depends: ','ultimate-social-media-icons') ?></span><?php _e('Show this icon if you have an OK account.','ultimate-social-media-icons') ?> </p>

            </div>

        </li>
        <!-- END OK ICON -->

        <!-- WECHAT ICON -->
        <li class="sfsi_vertically_center">
            <div>
                <div class="radio_section tb_4_ck"><input name="sfsi_wechat_display" <?php echo ($option1['sfsi_wechat_display'] == 'yes') ?  'checked="true"' : ''; ?> id="sfsi_wechat_display" type="checkbox" value="yes" class="styled" /></div>

                <span class="sfsicls_wechat"><?php _e('WeChat','ultimate-social-media-icons') ?></span>
            </div>
            <div class="right_info">

                <p><span><?php _e('It depends: ','ultimate-social-media-icons') ?></span> <?php _e('Show this icon if you have a WeChat account.','ultimate-social-media-icons') ?></p>

            </div>

        </li>
        <!-- END WECHAT ICON -->
        <!-- WEIBO ICON -->
        <li class="sfsi_vertically_center">
            <div>

                <div class="radio_section tb_4_ck"><input name="sfsi_weibo_display" <?php echo ($option1['sfsi_weibo_display'] == 'yes') ?  'checked="true"' : ''; ?> id="sfsi_weibo_display" type="checkbox" value="yes" class="styled" /></div>

                <span class="sfsicls_weibo"><?php _e('Weibo','ultimate-social-media-icons') ?></span>

            </div>

            <div class="right_info">

                <p><span><?php _e('It depends: ','ultimate-social-media-icons') ?></span><?php _e('Show this icon if you have a Weibo account.','ultimate-social-media-icons') ?> </p>

            </div>

        </li>
        <!-- END INSTAGRAM ICON -->

        <!-- Custom icon section start here -->
        <?php if (get_option('sfsi_custom_icons') == 'no') { ?>
            <?php

            $icons = ($option1['sfsi_custom_files']) ? unserialize($option1['sfsi_custom_files']) : array();

            $total_icons = count($icons);

            end($icons);
            $endkey = key($icons);
            $endkey = (isset($endkey)) ? $endkey : 0;
            reset($icons);
            $first_key = key($icons);
            $first_key = (isset($first_key)) ? $first_key : 0;
            $new_element = 0;
            if ($total_icons > 0) {
                $new_element = $endkey + 1;
            }

            ?>
            <!-- Display all custom icons  -->

            <?php $count = 1;
            for ($i = $first_key; $i <= $endkey; $i++) : ?>
                <?php if (!empty($icons[$i])) : ?>

                    <?php $count++;
                endif;
            endfor; ?>

            <!-- Create a custom icon if total uploaded icons are less than 5 -->

            <?php if ($count <= 5) : ?>

                <li id="c<?php echo $new_element; ?>" class="custom bdr_btm_non sfsi_vertically_center">
                    <a class="pop-up" data-id="sfsi_quickpay-overlay" onclick="sfsi_open_quick_checkout(event)" target="_blank">
                        <div class="radio_section tb_4_ck" style="opacity:0.5">
                            <input type="checkbox" onclick="return false;"  value="yes" class="styled" disabled="true" />
                        </div>

                        <span class="custom-img" style="opacity:0.5">
                            <img src="<?php echo SFSI_PLUGURL . 'images/custom.png'; ?>" id="CImg_<?php echo $new_element; ?> " alt="error" />

                        </span>

                        <span class="custom custom-txt" style="font-weight:normal;opacity:0.5;margin-left:4px"><?php _e('Custom Icon ','ultimate-social-media-icons') ?> </span>

                    </a>

                    <div class="right_info">
                        <p style="padding-top: 2px;">
                            <label style="color: #12a252 !important; font-weight: bold;font-family: unset;">
                            <?php _e('Premium Feature:','ultimate-social-media-icons') ?>
                            </label>
                            <label><?php _e('Upload a custom icon if you have other accounts/websites you want to link to -','ultimate-social-media-icons') ?></label>
                            <a class="pop-up" style="cursor:pointer; color: #12a252 !important;border-bottom: 1px solid #12a252;text-decoration: none;font-weight: bold;font-family: unset;" data-id="sfsi_quickpay-overlay" onclick="sfsi_open_quick_checkout(event)" target="_blank">
                            <?php _e('Get it now.','ultimate-social-media-icons') ?>
                            </a>
                        </p>

                    </div>

                </li>

            <?php endif; ?>
        <?php } ?>
        <!-- END Custom icon section here -->

        <!-- Custom icon section start here -->

        <?php
        if (get_option('sfsi_custom_icons') == 'yes') { ?>
            <?php

            $icons = ($option1['sfsi_custom_files']) ? unserialize($option1['sfsi_custom_files']) : array();

            $total_icons = count($icons);

            end($icons);

            $endkey = key($icons);

            $endkey = (isset($endkey)) ? $endkey : 0;

            reset($icons);

            $first_key = key($icons);

            $first_key = (isset($first_key)) ? $first_key : 0;

            $new_element = 0;

            if ($total_icons > 0) {

                $new_element = $endkey + 1;
            }

            ?>

            <!-- Display all custom icons  -->

            <?php $count = 1;
            for ($i = $first_key; $i <= $endkey; $i++) : ?>
                <?php if (!empty($icons[$i])) : ?>

                    <li id="c<?php echo $i; ?>" class="custom">

                        <div class="radio_section tb_4_ck">

                            <input name="sfsiICON_<?php echo $i; ?>" checked="true" type="checkbox" value="yes" class="styled" element-type="cusotm-icon" />

                        </div>

                        <input type="hidden" name="nonce" value="<?php echo wp_create_nonce('deleteIcons'); ?>">

                        <span class="custom-img">

                            <img class="sfcm" src="<?php echo (!empty($icons[$i])) ?  esc_url($icons[$i]) : SFSI_PLUGURL . 'images/custom.png'; ?>" id="CImg_<?php echo $i; ?>" alt="error" />

                        </span>

                        <span class="custom custom-txt">Custom <?php echo $count; ?> </span>

                        <div class="right_info">

                        <p><span><?php _e('It depends:','ultimate-social-media-icons') ?></span> <?php _e('Upload a custom icon if you have other accounts/websites you want to link to.','ultimate-social-media-icons') ?> </p>
                        </div>

                    </li>

                    <?php $count++;
                endif;
            endfor; ?>

            <!-- Create a custom icon if total uploaded icons are less than 5 -->

            <?php if ($count <= 5) : ?>

                <li id="c<?php echo $new_element; ?>" class="custom bdr_btm_non sfsi_vertically_center">
                    <div>
                        <div class="radio_section tb_4_ck">

                            <input name="sfsiICON_<?php echo $new_element; ?>" type="checkbox" value="yes" class="styled" element-type="cusotm-icon" ele-type='new' />

                        </div>

                        <span class="custom-img">

                            <img src="<?php echo SFSI_PLUGURL . 'images/custom.png'; ?>" id="CImg_<?php echo $new_element; ?> " alt="error" />

                        </span>
                        <span class="custom custom-txt"><?php _e('Custom','ultimate-social-media-icons') ?><?php echo $count; ?> </span>

                    </div>

                    <div class="right_info">

                    <p><span><?php _e('It depends:','ultimate-social-media-icons') ?></span><?php _e('Upload a custom icon if you have other accounts/websites you want to link to.','ultimate-social-media-icons') ?>  </p>

                    </div>

                </li>

            <?php endif; ?>
        <?php } ?>
        <!-- END Custom icon section here -->

    </ul>

    <ul>

        <li class="sfsi_premium_brdr_box">

            <div class="sfsi_prem_icons_added">

                <div class="sf_si_prmium_head">
                <h2><?php _e('New:','ultimate-social-media-icons') ?> <span><?php _e('In our Premium Plugin we added icons for:','ultimate-social-media-icons') ?> </span></h2>
                </div>

                <div class="sfsi_premium_row">

                    <div class="sfsi_prem_cmn_rowlisting">

                        <span>

                            <img src="<?php echo SFSI_PLUGURL . 'images/snapchat.png'; ?>" id="CImg" alt="error" />

                        </span>

                        <span class="sfsicls_prem_text"><?php _e('Snapchat','ultimate-social-media-icons') ?></span>

                    </div>

                    <!-- <div class="sfsi_prem_cmn_rowlisting">

                        <span>

                            <img src="<?php echo SFSI_PLUGURL . 'images/whatsapp.png'; ?>" id="CImg" alt="error" />

                        </span>

                        <span class="sfsicls_prem_text">WhatsApp or Phone</span>

                    </div> -->

                    <div class="sfsi_prem_cmn_rowlisting">

                        <span>

                            <img src="<?php echo SFSI_PLUGURL . 'images/yummly.png'; ?>" id="CImg" alt="error" />

                        </span>

                        <span class="sfsicls_prem_text"><?php _e('Yummly','ultimate-social-media-icons') ?></span>

                    </div>

                    <div class="sfsi_prem_cmn_rowlisting">

                        <span>

                            <img src="<?php echo SFSI_PLUGURL . 'images/yelp.png'; ?>" id="CImg" alt="error" />

                        </span>

                        <span class="sfsicls_prem_text"><?php _e('Yelp','ultimate-social-media-icons') ?></span>

                    </div>

                    <div class="sfsi_prem_cmn_rowlisting">

                        <span>

                            <img src="<?php echo SFSI_PLUGURL . 'images/print.png'; ?>" id="CImg" alt="error" />

                        </span>

                        <span class="sfsicls_prem_text"><?php _e('Print','ultimate-social-media-icons') ?></span>

                    </div>

                    <div class="sfsi_prem_cmn_rowlisting">

                        <span>

                            <img src="<?php echo SFSI_PLUGURL . 'images/messenger.png'; ?>" id="CImg" />

                        </span>

                        <span class="sfsicls_prem_text"><?php _e('Messenger','ultimate-social-media-icons') ?></span>

                    </div>

                </div>

                <div class="sfsi_premium_row">

                    <div class="sfsi_prem_cmn_rowlisting">

                        <span>

                            <img src="<?php echo SFSI_PLUGURL . 'images/soundcloud.png'; ?>" id="CImg" alt="error" />

                        </span>

                        <span class="sfsicls_prem_text"><?php _e('Soundcloud','ultimate-social-media-icons') ?></span>

                    </div>

                    <div class="sfsi_prem_cmn_rowlisting">

                        <span>

                            <img src="<?php echo SFSI_PLUGURL . 'images/skype.png'; ?>" id="CImg" alt="error" />

                        </span>

                        <span class="sfsicls_prem_text"><?php _e('Skype','ultimate-social-media-icons') ?></span>

                    </div>

                    <div class="sfsi_prem_cmn_rowlisting">

                        <span>

                            <img src="<?php echo SFSI_PLUGURL . 'images/flickr.png'; ?>" id="CImg" alt="error" />

                        </span>

                        <span class="sfsicls_prem_text"><?php _e('Flickr','ultimate-social-media-icons') ?></span>

                    </div>

                    <div class="sfsi_prem_cmn_rowlisting">

                        <span>

                            <img src="<?php echo SFSI_PLUGURL . 'images/buffer.png'; ?>" id="CImg" alt="error" />

                        </span>

                        <span class="sfsicls_prem_text"><?php _e('Buffer','ultimate-social-media-icons') ?></span>

                    </div>

                    <div class="sfsi_prem_cmn_rowlisting">

                        <span>

                            <img src="<?php echo SFSI_PLUGURL . 'images/blogger.png'; ?>" id="CImg" alt="error" />

                        </span>

                        <span class="sfsicls_prem_text"><?php _e('Blogger','ultimate-social-media-icons') ?></span>

                    </div>

                    <div class="sfsi_prem_cmn_rowlisting">

                        <span>

                            <img src="<?php echo SFSI_PLUGURL . 'images/reddit.png'; ?>" id="CImg" alt="error" />

                        </span>

                        <span class="sfsicls_prem_text"><?php _e('Reddit','ultimate-social-media-icons') ?></span>

                    </div>

                </div>

                <div class="sfsi_premium_row">

                    <div class="sfsi_prem_cmn_rowlisting">

                        <span>

                            <img src="<?php echo SFSI_PLUGURL . 'images/vimeo.png'; ?>" id="CImg" alt="error" />

                        </span>

                        <span class="sfsicls_prem_text"><?php _e('Vimeo','ultimate-social-media-icons') ?></span>

                    </div>

                    <div class="sfsi_prem_cmn_rowlisting">

                        <span>

                            <img src="<?php echo SFSI_PLUGURL . 'images/tumblr.png'; ?>" id="CImg" alt="error" />

                        </span>

                        <span class="sfsicls_prem_text"><?php _e('Tumblr','ultimate-social-media-icons') ?></span>

                    </div>

                    <div class="sfsi_prem_cmn_rowlisting">

                        <span>

                            <img src="<?php echo SFSI_PLUGURL . 'images/houzz.png'; ?>" id="CImg" alt="error" />

                        </span>

                        <span class="sfsicls_prem_text">Houzz<?php _e('Houzz','ultimate-social-media-icons') ?></span>

                    </div>

                    <div class="sfsi_prem_cmn_rowlisting">

                        <span>

                            <img src="<?php echo SFSI_PLUGURL . 'images/xing.png'; ?>" id="CImg" alt="error" />

                        </span>

                        <span class="sfsicls_prem_text"><?php _e('Xing','ultimate-social-media-icons') ?></span>

                    </div>

                    <div class="sfsi_prem_cmn_rowlisting">

                        <span>

                            <img src="<?php echo SFSI_PLUGURL . 'images/twitch.png'; ?>" id="CImg" />

                        </span>

                        <span class="sfsicls_prem_text"><?php _e('Twitch','ultimate-social-media-icons') ?></span>

                    </div>

                    <div class="sfsi_prem_cmn_rowlisting">

                        <span>

                            <img src="<?php echo SFSI_PLUGURL . 'images/amazon.png'; ?>" id="CImg" alt="error" />

                        </span>

                        <span class="sfsicls_prem_text"><?php _e('Amazon','ultimate-social-media-icons') ?></span>

                    </div>

                </div>

                <div class="sfsi_premium_row">

                    <div class="sfsi_prem_cmn_rowlisting">

                        <span>

                            <img src="<?php echo SFSI_PLUGURL . 'images/angieslist.png'; ?>" id="CImg" alt="error" />

                        </span>

                        <span class="sfsicls_prem_text"><?php _e('Angie’s List','ultimate-social-media-icons') ?></span>

                    </div>

                    <div class="sfsi_prem_cmn_rowlisting">

                        <span>

                            <img src="<?php echo SFSI_PLUGURL . 'images/steam.png'; ?>" id="CImg" alt="error" />

                        </span>

                        <span class="sfsicls_prem_text"><?php _e('Steam','ultimate-social-media-icons') ?></span>

                    </div>

                </div>

                <!--<div class="sfsi_need_another_one_link">

                    <p>Need another one?<a href="mailto:biz@ultimatelysocial.com"> Tell us</a></p>

                </div>-->

                <div class="sfsi_need_another_tell_us" style="padding-top:20px">

                <a href="https://www.ultimatelysocial.com/all-platforms/" target="_blank"><?php _e('...and many more! See them here','ultimate-social-media-icons') ?></a>

                    <!--<a href="https://www.ultimatelysocial.com/usm-premium/?utm_source=usmi_settings_page&utm_campaign=more_platforms&utm_medium=banner" target="_blank">See all features Premium Plugin</a>-->

                </div>

            </div>

        </li>

    </ul>

    <input type="hidden" value="<?php echo SFSI_PLUGURL ?>" id="plugin_url" />

    <input type="hidden" value="" id="upload_id" />

    <?php sfsi_ask_for_help(1); ?>

    <!-- SAVE BUTTON SECTION   -->

    <div class="save_button tab_1_sav">

        <img src="<?php echo SFSI_PLUGURL ?>images/ajax-loader.gif" class="loader-img" alt="error" />

        <?php $nonce = wp_create_nonce("update_step1"); ?>

        <a href="javascript:;" id="sfsi_save1" title="Save" data-nonce="<?php echo $nonce; ?>"><?php _e('Save','ultimate-social-media-icons') ?></a>
    </div><!-- END SAVE BUTTON SECTION   -->

    <a class="sfsiColbtn closeSec" href="javascript:;"><?php _e('Collapse area','ultimate-social-media-icons') ?></a>
    <!-- ERROR AND SUCCESS MESSAGE AREA-->

    <p class="red_txt errorMsg" style="display:none"> </p>

    <p class="green_txt sucMsg" style="display:none"> </p>

</div>

<!-- END Section 1 "Which icons do you want to show on your site? " main div-->
