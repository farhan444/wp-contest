<!------------------------------------------------------Banners on other plugins’ settings pages ----------------------------------------------------------->

<!---------------recovering sharedcount Check sharecount plugins is active --------------->
<?php
	$option5 = maybe_unserialize(get_option('sfsi_section5_options',false));
    $sfsi_icons_sharing_and_traffic_tips =  (isset($option5['sfsi_icons_sharing_and_traffic_tips']) &&  ($option5['sfsi_icons_sharing_and_traffic_tips']) == "yes");
   if (!is_plugin_active('Ultimate-Premium-Plugin/usm_premium_icons.php') && $sfsi_icons_sharing_and_traffic_tips) {
        $current_site_url = 0 . $_SERVER['REQUEST_URI'];
        $sfsi_dismiss_sharecount = maybe_unserialize(get_option('sfsi_dismiss_sharecount', false));
        $sfsi_dismiss_gallery = maybe_unserialize(get_option('sfsi_dismiss_gallery', false));
        $sfsi_dismiss_optimization = maybe_unserialize(get_option('sfsi_dismiss_optimization', false));
        $sfsi_dismiss_gdpr = maybe_unserialize(get_option('sfsi_dismiss_gdpr', false));
        $sfsi_dismiss_google_analytic = maybe_unserialize(get_option('sfsi_dismiss_google_analytic', false));
        $sfsi_dismiss_woocommerce = maybe_unserialize(get_option('sfsi_dismiss_woocommerce', false));
        $sfsi_dismiss_twitter = maybe_unserialize(get_option('sfsi_dismiss_twitter', false));

        /*var_dump($sfsi_dismiss_sharecount,$sfsi_dismiss_gallery,$sfsi_dismiss_optimization,$sfsi_dismiss_gdpr,$sfsi_dismiss_google_analytic);
        foreach ($gallery_plugins as $key => $gallery_plugin) {
            $sfsi_show_gallery_banner = sfsi_check_on_plugin_page($gallery_plugin['dir_slug'], $gallery_plugin['option_name'], $current_site_url);
            if ($gallery_plugin['option_name'] == 'robo-gallery-settings') {
                // var_dump(($sfsi_show_gallery_banner),'lfjgdjkf');
            }
            // var_dump($sfsi_show_gallery_banner,$gallery_plugin['option_name'] );

        }*/
        $socialObj = new sfsi_SocialHelper();
        $current_url = site_url();
        $fb_data = $socialObj->sfsi_banner_get_fb($current_url);
        $check_fb_count_more_than_one = $fb_data > 0 || $socialObj->sfsi_get_pinterest($current_url) > 0;
        $sfsi_fb_count =  get_option('sfsi_fb_count', false);
        $sfsi_fb_count_check_for_shares =  $sfsi_fb_count > 0;
        ?>
       <?php
            if (is_ssl() && $sfsi_fb_count_check_for_shares && ($sfsi_dismiss_sharecount['show_banner'] == "yes" || false == $sfsi_dismiss_sharecount)) {
                // also check if there is likes on http page 
                foreach ($google_analytics as $key => $sharecount_plugin) {
                    $sfsi_show_sharecount_banner = sfsi_check_on_plugin_page($sharecount_plugin['dir_slug'], $sharecount_plugin['option_name'], $current_site_url);
                    if ($sfsi_show_sharecount_banner) {
                        ?>
                   <div class="sfsi_new_prmium_follw sfsi_banner_body">
                       <p style="font-size:18px !important">
                           <b><?php _e("You’re on https, that’s great!",'ultimate-social-media-icons') ?> </b><?php _e("– However: we noticed that you still have share & like counts (from social media) on your old (http://) urls. If you don’t want to lose them, check out",'ultimate-social-media-icons') ?> <a href="https://www.ultimatelysocial.com/usm-premium/?utm_source=usmi_other_plugins_settings_page&utm_campaign=sharedcount_recovery_banner&utm_medium=banner" class="sfsi_font_inherit" target="_blank" style="color:#1a1d20 !important;text-decoration: underline;"><span></span><?php _e("Check the Theme",'ultimate-social-media-icons') ?> this plugin</a><?php _e("which has a share count recovery feature.",'ultimate-social-media-icons') ?>  <a href="https://www.ultimatelysocial.com/usm-premium/?withqp=1&discount=RECOVERSHARECOUNT&utm_source=usmi_other_plugins_settings_page&utm_campaign=sharedcount_recovery_banner&utm_medium=banner" class="sfsi_font_inherit" target="_blank" style="color:#1a1d20 !important;font-weight: bold;"><span>&#10151;</span> <span style="text-decoration: underline;"></span> <span style="text-decoration: underline;"><?php _e("Get it now at 20% discount",'ultimate-social-media-icons') ?></span> </a>
                       </p>

                       <div style="text-align:right;">

                           <form method="post" class="sfsi_premiumNoticeDismiss" style="padding-bottom:8px;">

                               <input type="hidden" name="sfsi-dismiss-sharecount" value="true">

                               <input type="submit" name="dismiss" value="Dismiss" />

                           </form>

                       </div>
                   </div>
       <?php
                    }
                    if ($sfsi_show_sharecount_banner) {
                        break;
                    }
                }
            }
            ?>
       <!---------------End check optimization plugins is active--------------->

       <!---------------Pinterest on mouse-over Check gallery plugins is active --------------->
       <?php
            if ($sfsi_dismiss_gallery['show_banner'] == "yes" || false == $sfsi_dismiss_gallery) {
                foreach ($gallery_plugins as $key => $gallery_plugin) {
                    $sfsi_show_gallery_banner = sfsi_check_on_plugin_page($gallery_plugin['dir_slug'], $gallery_plugin['option_name'], $current_site_url);

                    if ($sfsi_show_gallery_banner) {
                        if (function_exists("sfsi_get_plugin")) {
                            $plugin = sfsi_get_plugin($gallery_plugin['dir_slug']);
                        } else {
                            $plugin = array();
                        }
                        ?>
                   <div class="sfsi_new_prmium_follw sfsi_banner_body">
                       <div>
                           <p style="margin-bottom: 12px !important;"><b><?php _e("Get more traffic from your pictures",'ultimate-social-media-icons') ?> </b><?php _e("– The Ultimate Social Media Premium Plugin allows to show a Pinterest save-icon after users move over your pictures, increasing sharing activity significantly.",'ultimate-social-media-icons') ?>
                           </p>
                           <p style="font-size:18px !important">
                               <?php _e("It works very well with the ",'ultimate-social-media-icons') ?><b><?php echo ($plugin["Name"]); ?><?php _e("plugin",'ultimate-social-media-icons') ?> </b><?php _e("which you are using, resulting in more traffic for your site.",'ultimate-social-media-icons') ?> 
                               <a href="https://www.ultimatelysocial.com/usm-premium/?withqp=1&discount=PINTERESTDISCOUNT&utm_source=usmi_other_plugins_settings_page&utm_campaign=pinterest_mouse_over&utm_medium=banner" class="sfsi_font_inherit" target="_blank" style="color:#1a1d20 !important;font-weight: bold;"><span>&#10151;</span> <span style="text-decoration: underline;"></span>
                                   <span style="text-decoration: underline;"><?php _e("Get it now at 20% discount",'ultimate-social-media-icons') ?></span>
                               </a>
                           </p>
                       </div>

                       <div style="text-align:right;">

                           <form method="post" class="sfsi_premiumNoticeDismiss" style="padding-bottom:8px;">

                               <input type="hidden" name="sfsi-dismiss-gallery" value="true">

                               <input type="submit" name="dismiss" value="Dismiss" />

                           </form>

                       </div>
                   </div>
       <?php
                    }
                    if ($sfsi_show_gallery_banner) {
                        break;
                    }
                }
            }
            ?>
       <!---------------End check gallery plugins is active --------------->


       <!---------------Website speed Check optimization plugins is active --------------->
       <?php
            if ($sfsi_dismiss_optimization['show_banner'] == "yes" || false == $sfsi_dismiss_optimization) {
                foreach ($optimization_plugins as $key => $optimization_plugin) {
                    $sfsi_show_optimization_banner = sfsi_check_on_plugin_page($optimization_plugin['dir_slug'], $optimization_plugin['option_name']);
                    if ($sfsi_show_optimization_banner) {
                        ?>
                   <div class="sfsi_new_prmium_follw sfsi_banner_body">
                       <p style="font-size:18px !important">
                       <b><?php _e("Make your website load faster",'ultimate-social-media-icons') ?> </b><?php _e("– the Ultimate Social Media",'ultimate-social-media-icons') ?><a href="https://www.ultimatelysocial.com/usm-premium/?utm_source=usmi_other_plugins_settings_page&utm_campaign=website_load_faster&utm_medium=banner" class="sfsi_font_inherit" target="_blank" style="color:#1a1d20 !important;text-decoration: underline;"><span></span><?php _e("Premium Plugin",'ultimate-social-media-icons') ?> </a> <?php _e("is the most optimized sharing plugin for speed. It also includes support to help you optimize it for minimizing loading time.",'ultimate-social-media-icons') ?><a href="https://www.ultimatelysocial.com/usm-premium/?withqp=1&discount=MORESPEEED&utm_source=usmi_other_plugins_settings_page&utm_campaign=website_load_faster&utm_medium=banner" class="sfsi_font_inherit" target="_blank" style="color:#1a1d20 !important;font-weight: bold;"><span>&#10151;</span> <span style="text-decoration: underline;"></span> <span style="text-decoration: underline;"><?php _e("Get it now at 20% discount",'ultimate-social-media-icons') ?></span> </a>
                       </p>
                       <div style="text-align:right;">
                           <form method="post" class="sfsi_premiumNoticeDismiss" style="padding-bottom:8px;">

                               <input type="hidden" name="sfsi-dismiss-optimization" value="true">

                               <input type="submit" name="dismiss" value="Dismiss" />

                           </form>

                       </div>
                   </div>

       <?php
                    }
                    if ($sfsi_show_optimization_banner) {
                        break;
                    }
                }
            }
            ?>
       <!---------------End check optimization plugins is active--------------->


       <!---------------GDPR compliance Check GDPR plugins is active--------------->
       <?php
            if ($sfsi_dismiss_gdpr['show_banner'] == "yes" || false == $sfsi_dismiss_gdpr) {

                foreach ($gdpr_plugins as $key => $gdpr_plugin) {
                    $sfsi_show_gdpr_banner = sfsi_check_on_plugin_page($gdpr_plugin['dir_slug'], $gdpr_plugin['option_name'], $current_site_url);
                    if ($sfsi_show_gdpr_banner) {
                        ?>
                   <div class="sfsi_new_prmium_follw sfsi_banner_body">
                       <p style="font-size:18px !important">
                           <b><?php _e("Make sure your site is GDPR compliant ",'ultimate-social-media-icons') ?> </b><?php _e("– As part of the Ultimate Social Media",'ultimate-social-media-icons') ?>
                           <a href="https://www.ultimatelysocial.com/usm-premium/?utm_source=usmi_other_plugins_settings_page&utm_campaign=website_load_faster&utm_medium=banner" class="sfsi_font_inherit" target="_blank" style="color:#1a1d20 !important;text-decoration: underline;"><span></span>
                               <?php _e("Premium Plugin",'ultimate-social-media-icons') ?>
                           </a>
                           <?php _e("you can request a review (at no extra charge) to check if your sharing icons are GDPR compliant.",'ultimate-social-media-icons') ?> <a href="https://www.ultimatelysocial.com/usm-premium/?withqp=1&discount=GDPRCOMPLIANT&utm_source=usmi_other_plugins_settings_page&utm_campaign=gdpr_compliance&utm_medium=banner" class="sfsi_font_inherit" target="_blank" style="color:#1a1d20 !important;font-weight: bold;"><span>&#10151;</span> <span style="text-decoration: underline;"></span> <span style="text-decoration: underline;"><?php _e("Get it now at 20% discount ",'ultimate-social-media-icons') ?></span> </a>
                       </p>
                       <div style="text-align:right;">

                           <form method="post" class="sfsi_premiumNoticeDismiss" style="padding-bottom:8px;">

                               <input type="hidden" name="sfsi-dismiss-gdpr" value="true">

                               <input type="submit" name="dismiss" value="Dismiss" />

                           </form>

                       </div>
                   </div>
       <?php
                    }
                    if ($sfsi_show_gdpr_banner) {
                        break;
                    }
                }
            }
            ?>
       <!---------------End check GDPR plugins is active--------------->


       <!---------------More traffic Check Google analytics plugin is active--------------->
       <?php
            if ($sfsi_dismiss_google_analytic['show_banner'] == "yes" || false == $sfsi_dismiss_google_analytic) {
                foreach ($sharecount_plugins as $key => $google_analytic) {
                    $sfsi_show_google_analytic_banner = sfsi_check_on_plugin_page($google_analytic['dir_slug'], $google_analytic['option_name'], $current_site_url);
                    if ($sfsi_show_google_analytic_banner) {
                        ?>
                   <div class="sfsi_new_prmium_follw sfsi_banner_body">
                       <div>
                           <p style="font-size:18px !important">
                               <b><?php _e("Get 20%+ more traffic ",'ultimate-social-media-icons') ?></b><?php _e("– from more likes & shares with the Ultimatelysocial Premium Plugin. Or get a refund within 20 days.",'ultimate-social-media-icons') ?> <a href="https://www.ultimatelysocial.com/usm-premium/?withqp=1&discount=MORETRAFFIC&utm_source=usmi_other_plugins_settings_page&utm_campaign=more_traffic&utm_medium=banner" class="sfsi_font_inherit" target="_blank" style="color:#1a1d20 !important;font-weight: bold;"><span>&#10151;</span> <span style="text-decoration: underline;"></span> <span style="text-decoration: underline;"><?php _e("Get it now at 20% discount",'ultimate-social-media-icons') ?></span> </a>
                           </p>
                       </div>
                       <div style="text-align:right;">

                           <form method="post" class="sfsi_premiumNoticeDismiss" style="padding-bottom:8px;">

                               <input type="hidden" name="sfsi-dismiss-google-analytic" value="true">

                               <input type="submit" name="dismiss" value="Dismiss" />

                           </form>

                       </div>
                   </div>
       <?php
                    }
                    if ($sfsi_show_google_analytic_banner) {
                        break;
                    }
                }
            }

            ?>
       <!---------------End Check Google analytics plugin is active--------------->

       <!---------------Check Woocommerce plugin is active--------------->
       <?php
            if ($sfsi_dismiss_woocommerce['show_banner'] == "yes" || false == $sfsi_dismiss_woocommerce) {
                foreach ($woocommerce_plugins as $key => $woocommerce_plugin) {
                    $sfsi_show_woocommerce_banner = sfsi_check_on_plugin_page($woocommerce_plugin['dir_slug'], $woocommerce_plugin['option_name']);
                    if ($sfsi_show_woocommerce_banner) {
                        ?>
                   <div class="sfsi_new_prmium_follw sfsi_banner_body" style="margin-top: 90px;">
                       <div>
                           <p style="font-size:18px !important">
                               <b><?php _e("Get more sales ",'ultimate-social-media-icons') ?></b><?php _e("with the Ultimate Social Media",'ultimate-social-media-icons') ?>
                               <a href="https://www.ultimatelysocial.com/usm-premium/?utm_source=usmi_other_plugins_settings_page&utm_campaign=woocommerce&utm_medium=banner" class="sfsi_font_inherit" target="_blank" style="color:#1a1d20 !important;text-decoration: underline;"><span></span>
                                   <?php _e("Premium Plugin",'ultimate-social-media-icons') ?>
                               </a>
                               <?php _e("by adding social share icons to your product pages. More shares equals more publicity, and more publicity means more new customers.",'ultimate-social-media-icons') ?>
                               <a href="https://www.ultimatelysocial.com/usm-premium/?withqp=1&discount=WOOCOMMERCE&utm_source=usmi_other_plugins_settings_page&utm_campaign=woocommerce&utm_medium=banner" class="sfsi_font_inherit" target="_blank" style="color:#1a1d20 !important;font-weight: bold;"><span>&#10151;</span> <span style="text-decoration: underline;"></span> <span style="text-decoration: underline;"><?php _e("Get it now at 20% discount",'ultimate-social-media-icons') ?></span> </a>
                           </p>
                       </div>
                       <div style="text-align:right;">

                           <form method="post" class="sfsi_premiumNoticeDismiss" style="padding-bottom:8px;">

                               <input type="hidden" name="sfsi-dismiss-woocommerce" value="true">

                               <input type="submit" name="dismiss" value="Dismiss" />

                           </form>

                       </div>
                   </div>
       <?php
                    }
                    if ($sfsi_show_woocommerce_banner) {
                        break;
                    }
                }
            }
            ?>
       <!---------------End Woocommerce plugin is active--------------->

       <!---------------Check Twitter plugin's is active--------------->
       <?php
            if ($sfsi_dismiss_twitter['show_banner'] == "yes" || false == $sfsi_dismiss_twitter) {
                foreach ($twitter_plugins as $key => $twitter_plugin) {
                    $sfsi_show_twitter_banner = sfsi_check_on_plugin_page($twitter_plugin['dir_slug'], $twitter_plugin['option_name']);
                    if ($sfsi_show_twitter_banner) {
                        ?>
                   <div class="sfsi_new_prmium_follw sfsi_banner_body">
                       <div>
                           <p style="font-size:18px !important">
                               <b><?php _e("Get more visibility on Twitter ",'ultimate-social-media-icons') ?></b><?php _e("by displaying more information than a standard Tweet. Attach images and automatically pull the titles & links of the posts to make them much more attractive and visual with the Ultimate Social Media",'ultimate-social-media-icons') ?>
                               <a href="https://www.ultimatelysocial.com/usm-premium/?utm_source=usmi_other_plugins_settings_page&utm_campaign=twitter&utm_medium=banner" class="sfsi_font_inherit" target="_blank" style="color:#1a1d20 !important;text-decoration: underline;"><span></span>
                                   <?php _e("Premium Plugin",'ultimate-social-media-icons') ?></a>.
                               <a href="https://www.ultimatelysocial.com/usm-premium/?withqp=1&discount=TWITTER&utm_source=usmi_other_plugins_settings_page&utm_campaign=twitter&utm_medium=banner" class="sfsi_font_inherit" target="_blank" style="color:#1a1d20 !important;font-weight: bold;"><span>&#10151;</span> <span style="text-decoration: underline;"></span> <span style="text-decoration: underline;"><?php _e("Get it now at 20% discount",'ultimate-social-media-icons') ?></span> </a>
                           </p>
                       </div>
                       <div style="text-align:right;">

                           <form method="post" class="sfsi_premiumNoticeDismiss" style="padding-bottom:8px;">

                               <input type="hidden" name="sfsi-dismiss-twitter" value="true">

                               <input type="submit" name="dismiss" value="Dismiss" />

                           </form>

                       </div>
                   </div>
   <?php
                }
                if ($sfsi_show_twitter_banner) {
                    break;
                }
            }
        }
    }
    ?>
   <!---------------End Twitter plugin's is active--------------->

   <!------------------------------------------------------End Banners on other plugins’ settings pages ----------------------------------------------------------->