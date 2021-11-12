<?php 

$sfsi_show_via_widget = "no";

if(isset($option9['sfsi_show_via_widget']) && !empty($option9['sfsi_show_via_widget'])){
	$sfsi_show_via_widget = $option9['sfsi_show_via_widget'];
}

$label_style 	 = 'style="display:none;font-size: 19px;line-height: 45px;"';
$checked 	 	 = '';

if($sfsi_show_via_widget =='yes'){			
	$label_style = 'style="display:block;font-size: 19px;line-height: 45px;"';
	$checked     = 'checked="true"';
}

?>

<li class="sfsi_show_via_widget_li">
	
	<div class="radio_section tb_4_ck" onclick="checkforinfoslction(this);">
		
		<input name="sfsi_show_via_widget" <?php echo $checked ;?>  id="sfsi_show_via_widget_li" type="checkbox" value="<?php echo $sfsi_show_via_widget; ?>" class="styled"  />

	</div>
	
	<div class="sfsi_right_info">
		<p style="margin-bottom: -33px">
			<span class="sfsi_toglepstpgspn"><?php _e("Show them via a widget",'ultimate-social-media-icons') ?></span><br>
			
			<label  <?php echo $label_style; ?> class="sfsiplus_sub-subtitle ckckslctn"><?php _e("Go to the ",'ultimate-social-media-icons') ?><a href="<?php echo admin_url('widgets.php');?>"><?php _e("widget area",'ultimate-social-media-icons') ?></a><?php _e(" and drag & drop it where you want to show them!",'ultimate-social-media-icons') ?> 
				
			</label>
		</p>

	</div>

</li>