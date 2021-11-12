<?php 

$option9['sfsi_icons_float']              = (isset($option9['sfsi_icons_float']))               ? sanitize_text_field($option9['sfsi_icons_float']): 'no';

$option9['sfsi_icons_floatPosition']      = (isset($option9['sfsi_icons_floatPosition']))       ? sanitize_text_field($option9['sfsi_icons_floatPosition']) :'center-right';

$option9['sfsi_icons_floatMargin_top']    = (isset($option9['sfsi_icons_floatMargin_top']))     ? intval($option9['sfsi_icons_floatMargin_top']) : '';

$option9['sfsi_icons_floatMargin_bottom'] = (isset($option9['sfsi_icons_floatMargin_bottom']))  ? intval($option9['sfsi_icons_floatMargin_bottom']) : '';

$option9['sfsi_icons_floatMargin_left']   = (isset($option9['sfsi_icons_floatMargin_left']))    ? intval($option9['sfsi_icons_floatMargin_left']) : '';

$option9['sfsi_icons_floatMargin_right']  = (isset($option9['sfsi_icons_floatMargin_right']))   ? intval($option9['sfsi_icons_floatMargin_right']) : '';

$option9['sfsi_disable_floaticons']       = (isset($option9['sfsi_disable_floaticons']))        ? sanitize_text_field($option9['sfsi_disable_floaticons']): 'no';

$style                                    =  ($option9['sfsi_icons_float'] == "yes")            ? 'display: block;' : "display: none;";

?>

		<li class="sfsiLocationli">

            <div class="radio_section tb_4_ck cstmfltonpgstck" onclick="sfsi_toggleflotpage_que3(this);">

                <input name="sfsi_icons_float" <?php echo ($option9['sfsi_icons_float']=='yes') ?  'checked="true"' : '' ;?>  type="checkbox" value="yes" class="styled" />

                <p><span class="sfsi_toglepstpgspn"><?php _e("Floating over your website's pages",'ultimate-social-media-icons') ?></span></p>
            </div>

			<div class="sfsi_right_info" <?php echo 'style="'.$style.'"';?>>
            <p><span style="margin-left: 31px;"><?php _e("Define the location:",'ultimate-social-media-icons') ?></span></p>

                <div class="sfsi_tab_3_icns">

					

                    <ul class="sfsi_tab_3_icns flthmonpg">

                        

                        <div class="sfsi_position_divider">

                            <li>

                                <input name="sfsi_icons_floatPosition" <?php echo ( $option9['sfsi_icons_floatPosition']=='top-left') ?  'checked="true"' : '' ;?> type="radio" value="top-left" class="styled"  />

                                <span class="sfsi_flicnsoptn3 sfsioptntl"><?php _e("Top left",'ultimate-social-media-icons') ?></span>

                                <label><img src="<?php echo SFSI_PLUGURL;?>images/top_left.png" alt='error'/></label>

                            </li>

                            

                            <li>

                                <input name="sfsi_icons_floatPosition" <?php echo ( $option9['sfsi_icons_floatPosition']=='center-top') ?  'checked="true"' : '' ;?> type="radio" value="center-top" class="styled"  />

                                

                                <span class="sfsi_flicnsoptn3 sfsioptncl"><?php _e("Center top",'ultimate-social-media-icons') ?></span>

                                <label class="sfsi_float_position_icon_label"><img src="<?php echo SFSI_PLUGURL;?>images/float_position_icon.png" alt='error'/></label>

                            </li>                        

                            

                            <li>

                                <input name="sfsi_icons_floatPosition" <?php echo ( $option9['sfsi_icons_floatPosition']=='top-right') ?  'checked="true"' : '' ;?> type="radio" value="top-right" class="styled"  />

                                <span class="sfsi_flicnsoptn3 sfsioptntr"><?php _e("Top right",'ultimate-social-media-icons') ?></span>

                                <label><img src="<?php echo SFSI_PLUGURL;?>images/top_right.png" alt='error' /></label>

                            </li>

                        </div>

                        <div class="sfsi_position_divider">

                            <li>

                                <input name="sfsi_icons_floatPosition" <?php echo ( $option9['sfsi_icons_floatPosition']=='center-left') ?  'checked="true"' : '' ;?> type="radio" value="center-left" class="styled"  />

                                

                                <span class="sfsi_flicnsoptn3 sfsioptncl"><?php _e("Center left",'ultimate-social-media-icons') ?></span>

                                <label><img src="<?php echo SFSI_PLUGURL;?>images/center_left.png" alt='error'/></label>

                            </li>

                            <li></li>

                            

                            <li>

                                <input name="sfsi_icons_floatPosition" <?php echo ( $option9['sfsi_icons_floatPosition']=='center-right') ?  'checked="true"' : '' ;?> type="radio" value="center-right" class="styled"  />

                                <span class="sfsi_flicnsoptn3 sfsioptncr"><?php _e("Center right",'ultimate-social-media-icons') ?></span>

                                <label><img src="<?php echo SFSI_PLUGURL;?>images/center_right.png" alt='error'/></label>

                            </li>

                        

                        </div>

                        <div class="sfsi_position_divider">

                            <li>

                                <input name="sfsi_icons_floatPosition" <?php echo ( $option9['sfsi_icons_floatPosition']=='bottom-left') ?  'checked="true"' : '' ;?> type="radio" value="bottom-left" class="styled"  />

                                <span class="sfsi_flicnsoptn3 sfsioptnbl"><?php _e("Bottom left",'ultimate-social-media-icons') ?></span>

                                <label><img src="<?php echo SFSI_PLUGURL;?>images/bottom_left.png" alt='error'alt='error'/></label>

                            </li>

                    

                        <li>

                            <input name="sfsi_icons_floatPosition" <?php echo ( $option9['sfsi_icons_floatPosition']=='center-bottom') ?  'checked="true"' : '' ;?> type="radio" value="center-bottom" class="styled"  />

                            

                            <span class="sfsi_flicnsoptn3 sfsioptncr"><?php _e("Center bottom",'ultimate-social-media-icons') ?></span>

                            <label class="sfsi_float_position_icon_label sfsi_center_botttom"><img class="sfsi_img_center_bottom" src="<?php echo SFSI_PLUGURL;?>images/float_position_icon.png" alt='error'/></label>

                        </li>

                        <li>

                            <input name="sfsi_icons_floatPosition" <?php echo ( $option9['sfsi_icons_floatPosition']=='bottom-right') ?  'checked="true"' : '' ;?> type="radio" value="bottom-right" class="styled"  />

                            

                            <span class="sfsi_flicnsoptn3 sfsioptnbr"><?php _e("Bottom right",'ultimate-social-media-icons') ?></span>

                            <label><img src="<?php echo SFSI_PLUGURL;?>images/bottom_right.png" alt='error'/></label>

                        </li>

                        </div>

                    </ul>

                    

                    <div style="width: 88%; float: left; margin:25px 0 0 25px">

                    	

                    <h4 style="color: #5a6570 !important;font-family: 'helveticaneue-light';"><?php _e("Margin From:",'ultimate-social-media-icons') ?> </h4>

                    <ul class="sfsi_floaticon_margin_sec">

                                                
                        <li>

                            <label><?php _e("Top:",'ultimate-social-media-icons') ?></label>                                

                            <input name="sfsi_icons_floatMargin_top" type="text" value="<?php echo ($option9['sfsi_icons_floatMargin_top']!='') ?  $option9['sfsi_icons_floatMargin_top'] : '' ;?>" />

                            <ins><?php _e("Pixels",'ultimate-social-media-icons') ?></ins>

                        </li>



                        <li>

                            <label><?php _e("Bottom:",'ultimate-social-media-icons') ?></label>

                            <input name="sfsi_icons_floatMargin_bottom" type="text" value="<?php echo ($option9['sfsi_icons_floatMargin_bottom'] != '') ?  $option9['sfsi_icons_floatMargin_bottom'] : '' ;?>" />

                            <ins><?php _e("Pixels",'ultimate-social-media-icons') ?></ins>

                        </li>



                        <li>

                            <label><?php _e("Left:",'ultimate-social-media-icons') ?></label>

                            <input name="sfsi_icons_floatMargin_left" type="text" value="<?php echo ($option9['sfsi_icons_floatMargin_left']!='') ?  $option9['sfsi_icons_floatMargin_left'] : '' ;?>" />

                        <ins><?php _e("Pixels",'ultimate-social-media-icons') ?></ins>

                        </li>



                        <li>

                            <label><?php _e("Right:",'ultimate-social-media-icons') ?></label>

                            <input name="sfsi_icons_floatMargin_right" type="text" value="<?php echo ($option9['sfsi_icons_floatMargin_right']!='') ?  $option9['sfsi_icons_floatMargin_right'] : '' ;?>" />

                            <ins><?php _e("Pixels",'ultimate-social-media-icons') ?></ins>

                        </li>

                    </ul>

                    </div>

                    

                    <div style="width: 88%; float: left; margin:25px 0 0 7px">

                        <p style="line-height: 34px;">

                            <?php 
                                printf(
                                    __( 'The icons will be floating on your page. If you want them  %1$s "sticky"%2$s, please check out the %3$s Premium Plugin%4$s. Also in the Premium Plugin you can show the icons%5$s vertically%6$s, and give them  %7$s different settings for mobile. %8$s','ultimate-social-media-icons' ),
                                '<b>',   
                                '</b>',
                                '<a target="_blank" href="https://www.ultimatelysocial.com/usm-premium/"><b>',
                                '</b></a>',
                                '<b>',
                                '</b>',
                                '<b>',
                                '</b>'
                                );
                            ?>
                        </p>

                    </div>

                    <div class="sfsi_disable_floatingicons_mobile">

                        

                        <h4><?php _e("Want to disable the floating icons on mobile?",'ultimate-social-media-icons') ?></h4>

                        <ul class="sfsi_make_icons sfsi_plus_mobile_float">

                            <li>

                                <input name="sfsi_disable_floaticons" <?php echo ( $option9['sfsi_disable_floaticons']=='yes') ?  'checked="true"' : '' ;?> type="radio" value="yes" class="styled"  />

                                <span class="sfsi_flicnsoptn3"><?php _e("Yes",'ultimate-social-media-icons') ?></span>

                            </li>

                            <li>

                                <input name="sfsi_disable_floaticons" <?php echo ( $option9['sfsi_disable_floaticons']=='no') ?  'checked="true"' : '' ;?> type="radio" value="no" class="styled"/>

                                <span class="sfsi_flicnsoptn3"><?php _e("No",'ultimate-social-media-icons') ?></span>

                            </li>

                        </ul>

                    </div>

                </div>

			</div>

		</li>