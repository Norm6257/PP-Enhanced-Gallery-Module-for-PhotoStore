<?php

if ( 'justified' != $settings->gallery_layout ) {

	$desktop_col = ( $settings->photo_grid_count ) ? $settings->photo_grid_count : 4;
	$medium_col = ( $settings->photo_grid_count_medium ) ? $settings->photo_grid_count_medium : 2;
	$mobile_col = ( $settings->photo_grid_count_responsive ) ? $settings->photo_grid_count_responsive : 1;

	$space_desktop = ( $desktop_col - 1 ) * $settings->photo_spacing;
	$photo_columns_desktop = ( 100 - $space_desktop ) / $desktop_col;

	$space_tablet = ( $medium_col - 1 ) * $settings->photo_spacing;
	$photo_columns_tablet = ( 100 - $space_tablet ) / $medium_col;

	$space_mobile = ( $mobile_col - 1 ) * $settings->photo_spacing;
	$photo_columns_mobile = ( 100 - $space_mobile ) / $mobile_col;
?>

.fl-node-<?php echo $id; ?> .pp-photo-gallery-item {
	width: <?php echo $photo_columns_desktop;?>%;
	<?php if ( 'grid' == $settings->gallery_layout ) { ?>
		margin-right: <?php echo $settings->photo_spacing; ?>%;
	<?php } ?>
	margin-bottom: <?php echo $settings->photo_spacing; ?>%;
	<?php if ( 0 == $settings->photo_spacing && 'grid' == $settings->gallery_layout ) { ?>
		margin-right: <?php echo $settings->photo_spacing - ( 'none' != $settings->photo_border ? $settings->photo_border_width : 0 ); ?>px;
		margin-bottom: <?php echo $settings->photo_spacing - ( 'none' != $settings->photo_border ? $settings->photo_border_width : 0 ); ?>px;
	<?php } ?>
	
	<?php if ( $settings->photo_padding ) { ?>
		padding: <?php echo $settings->photo_padding; ?>px;
	<?php } ?>
	border-style: <?php echo $settings->photo_border; ?>;
	<?php if ( $settings->photo_border_width && 'none' != $settings->photo_border ) { ?>border-width: <?php echo $settings->photo_border_width; ?>px; <?php } ?>
	<?php if ( $settings->photo_border_color ) { ?> border-color: #<?php echo $settings->photo_border_color; ?>; <?php } ?>
	<?php if ( $settings->photo_border_radius >= 0 ) { ?> border-radius: <?php echo $settings->photo_border_radius; ?>px; <?php } ?>
	<?php if ( 'yes' == $settings->show_image_shadow ) { ?>
		-webkit-box-shadow: <?php echo $settings->image_shadow['horizontal']; ?>px <?php echo $settings->image_shadow['vertical']; ?>px <?php echo $settings->image_shadow['blur']; ?>px <?php echo $settings->image_shadow['spread']; ?>px <?php echo pp_hex2rgba( '#' . $settings->image_shadow_color, $settings->image_shadow_opacity / 100 ); ?>;
			-moz-box-shadow: <?php echo $settings->image_shadow['horizontal']; ?>px <?php echo $settings->image_shadow['vertical']; ?>px <?php echo $settings->image_shadow['blur']; ?>px <?php echo $settings->image_shadow['spread']; ?>px <?php echo pp_hex2rgba( '#' . $settings->image_shadow_color, $settings->image_shadow_opacity / 100 ); ?>;
				-o-box-shadow: <?php echo $settings->image_shadow['horizontal']; ?>px <?php echo $settings->image_shadow['vertical']; ?>px <?php echo $settings->image_shadow['blur']; ?>px <?php echo $settings->image_shadow['spread']; ?>px <?php echo pp_hex2rgba( '#' . $settings->image_shadow_color, $settings->image_shadow_opacity / 100 ); ?>;
					box-shadow: <?php echo $settings->image_shadow['horizontal']; ?>px <?php echo $settings->image_shadow['vertical']; ?>px <?php echo $settings->image_shadow['blur']; ?>px <?php echo $settings->image_shadow['spread']; ?>px <?php echo pp_hex2rgba( '#' . $settings->image_shadow_color, $settings->image_shadow_opacity / 100 ); ?>;
	<?php } ?>
	<?php if ( 'yes' == $settings->show_image_shadow_hover ) { ?>
		-webkit-transition: all <?php echo ($settings->image_shadow_hover_speed / 1000); ?>s ease-in;
			-moz-transition: all <?php echo ($settings->image_shadow_hover_speed / 1000); ?>s ease-in; ease-in;
				-ms-transition: all <?php echo ($settings->image_shadow_hover_speed / 1000); ?>s ease-in; ease-in;
					-o-transition: all <?php echo ($settings->image_shadow_hover_speed / 1000); ?>s ease-in; ease-in;
						transition: all <?php echo ($settings->image_shadow_hover_speed / 1000); ?>s ease-in; ease-in;
	<?php } ?>
}

.fl-node-<?php echo $id; ?> .pp-gallery-masonry-item {
	width: calc( <?php echo $photo_columns_desktop;?>% - 1px );
}

.fl-node-<?php echo $id; ?> .pp-photo-gallery-item:hover {
	<?php if ( 'yes' == $settings->show_image_shadow_hover ) { ?>
		-webkit-box-shadow: <?php echo $settings->image_shadow_hover['horizontal']; ?>px <?php echo $settings->image_shadow_hover['vertical']; ?>px <?php echo $settings->image_shadow_hover['blur']; ?>px <?php echo $settings->image_shadow_hover['spread']; ?>px <?php echo pp_hex2rgba( '#' . $settings->image_shadow_color_hover, $settings->image_shadow_opacity_hover / 100 ); ?>;
			-moz-box-shadow: <?php echo $settings->image_shadow_hover['horizontal']; ?>px <?php echo $settings->image_shadow_hover['vertical']; ?>px <?php echo $settings->image_shadow_hover['blur']; ?>px <?php echo $settings->image_shadow_hover['spread']; ?>px <?php echo pp_hex2rgba( '#' . $settings->image_shadow_color_hover, $settings->image_shadow_opacity_hover / 100 ); ?>;
				-o-box-shadow: <?php echo $settings->image_shadow_hover['horizontal']; ?>px <?php echo $settings->image_shadow_hover['vertical']; ?>px <?php echo $settings->image_shadow_hover['blur']; ?>px <?php echo $settings->image_shadow_hover['spread']; ?>px <?php echo pp_hex2rgba( '#' . $settings->image_shadow_color_hover, $settings->image_shadow_opacity_hover / 100 ); ?>;
					box-shadow: <?php echo $settings->image_shadow_hover['horizontal']; ?>px <?php echo $settings->image_shadow_hover['vertical']; ?>px <?php echo $settings->image_shadow_hover['blur']; ?>px <?php echo $settings->image_shadow_hover['spread']; ?>px <?php echo pp_hex2rgba( '#' . $settings->image_shadow_color_hover, $settings->image_shadow_opacity_hover / 100 ); ?>;
		-webkit-transition: all <?php echo ($settings->image_shadow_hover_speed / 1000); ?>s ease-in; ease-in;
			-moz-transition: all <?php echo ($settings->image_shadow_hover_speed / 1000); ?>s ease-in; ease-in;
				-ms-transition: all <?php echo ($settings->image_shadow_hover_speed / 1000); ?>s ease-in; ease-in;
					-o-transition: all <?php echo ($settings->image_shadow_hover_speed / 1000); ?>s ease-in; ease-in;
						transition: all <?php echo ($settings->image_shadow_hover_speed / 1000); ?>s ease-in; ease-in;
	<?php } ?>
}
<?php if ( $desktop_col > 1 ) { ?>
	.fl-node-<?php echo $id; ?> .pp-photo-gallery-item:nth-child(<?php echo $desktop_col; ?>n+1){
		clear: left;
	}
	.fl-node-<?php echo $id; ?> .pp-photo-gallery-item:nth-child(<?php echo $desktop_col; ?>n+0){
		clear: right;
	}
	.fl-node-<?php echo $id; ?> .pp-photo-gallery-item:nth-child(<?php echo $desktop_col; ?>n){
		margin-right: 0;
	}
<?php } ?>

.fl-node-<?php echo $id; ?> .pp-photo-gallery-item img,
.fl-node-<?php echo $id; ?> .pp-gallery-overlay,
.fl-node-<?php echo $id; ?> .pp-photo-gallery-content {
	<?php if ( $settings->photo_border_radius >= 0 ) { ?> border-radius: <?php echo $settings->photo_border_radius; ?>px; <?php } ?>
}

<?php if ( 'below' == $settings->show_captions && $settings->caption_bg_color ) { ?>
	.fl-node-<?php echo $id; ?> .pp-photo-gallery-item.has-caption img,
	.fl-node-<?php echo $id; ?> .has-caption .pp-gallery-overlay,
	.fl-node-<?php echo $id; ?> .has-caption .pp-photo-gallery-content {
		border-bottom-left-radius: 0;
		border-bottom-right-radius: 0;
	}

	.fl-node-<?php echo $id; ?> .pp-photo-gallery-item.has-caption .pp-photo-gallery-caption {
		<?php if ( $settings->photo_border_radius >= 0 ) { ?> border-bottom-left-radius: <?php echo $settings->photo_border_radius; ?>px; <?php } ?>
		<?php if ( $settings->photo_border_radius >= 0 ) { ?> border-bottom-right-radius: <?php echo $settings->photo_border_radius; ?>px; <?php } ?>
	}
<?php } ?>

.fl-node-<?php echo $id; ?> .pp-photo-space {
	width: <?php echo $settings->photo_spacing; ?>%;
}

<?php } ?>

<?php if ( 'below' == $settings->show_captions ) { ?>
	.fl-node-<?php echo $id; ?> .pp-photo-gallery-caption {
		<?php if ( $settings->caption_bg_color ) { ?>
			background-color: #<?php echo $settings->caption_bg_color; ?>;
		<?php } ?>
		padding-top: <?php echo $settings->caption_padding['top']; ?>px;
		padding-bottom: <?php echo $settings->caption_padding['bottom']; ?>px;
		padding-left: <?php echo $settings->caption_padding['left']; ?>px;
		padding-right: <?php echo $settings->caption_padding['right']; ?>px;
		text-align: <?php echo $settings->caption_alignment; ?>;
	}
<?php } ?>


<?php if ( 'lightbox' == $settings->click_action && ! empty( $settings->show_captions ) ) : ?>
	.mfp-gallery img.mfp-img {
		padding: 0;
	}

	.mfp-counter {
		display: block !important;
	}
<?php endif; ?>

<?php if ( 'none' != $settings->overlay_effects ) : ?>
	.fl-node-<?php echo $id; ?> .pp-gallery-overlay {
		<?php if ( 'solid' == $settings->overlay_type ) { ?>
			background: <?php echo ( '' != $settings->overlay_color ) ? pp_hex2rgba( '#' . $settings->overlay_color, ( $settings->overlay_color_opacity / 100 ) ) : 'rgba(0,0,0,.5)'; ?>;
		<?php } ?>

		<?php if ( 'gradient' == $settings->overlay_type ) : ?>
			background: -moz-linear-gradient(top,  <?php echo pp_hex2rgba( '#' . $settings->overlay_primary_color, ( $settings->overlay_color_opacity / 100 ) ); ?> 0%, <?php echo pp_hex2rgba( '#' . $settings->overlay_secondary_color, ( $settings->overlay_color_opacity / 100 ) ); ?> 100%); /* FF3.6+ */
			background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<?php echo pp_hex2rgba( '#' . $settings->overlay_primary_color, ( $settings->overlay_color_opacity / 100 ) ); ?>), color-stop(100%,<?php echo pp_hex2rgba( '#' . $settings->overlay_secondary_color, ( $settings->overlay_color_opacity / 100 ) ); ?>)); /* Chrome,Safari4+ */
			background: -webkit-linear-gradient(top,  <?php echo pp_hex2rgba( '#' . $settings->overlay_primary_color, ( $settings->overlay_color_opacity / 100 ) ); ?> 0%,<?php echo pp_hex2rgba( '#' . $settings->overlay_secondary_color, ( $settings->overlay_color_opacity / 100 ) ); ?> 100%); /* Chrome10+,Safari5.1+ */
			background: -o-linear-gradient(top,  <?php echo pp_hex2rgba( '#' . $settings->overlay_primary_color, ( $settings->overlay_color_opacity / 100 ) ); ?> 0%,<?php echo pp_hex2rgba( '#' . $settings->overlay_secondary_color, ( $settings->overlay_color_opacity / 100 ) ); ?> 100%); /* Opera 11.10+ */
			background: -ms-linear-gradient(top,  <?php echo pp_hex2rgba( '#' . $settings->overlay_primary_color, ( $settings->overlay_color_opacity / 100 ) ); ?> 0%,<?php echo pp_hex2rgba( '#' . $settings->overlay_secondary_color, ( $settings->overlay_color_opacity / 100 ) ); ?> 100%); /* IE10+ */
			background: linear-gradient(to bottom,  <?php echo pp_hex2rgba( '#' . $settings->overlay_primary_color, ( $settings->overlay_color_opacity / 100 ) ); ?> 0%,<?php echo pp_hex2rgba( '#' . $settings->overlay_secondary_color, ($settings->overlay_color_opacity / 100 ) ); ?> 100%); /* W3C */
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo pp_hex2rgba( '#' . $settings->overlay_primary_color, ( $settings->overlay_color_opacity / 100 ) ); ?>', endColorstr='<?php echo pp_hex2rgba( '#' . $settings->overlay_secondary_color, ( $settings->overlay_color_opacity / 100 ) ); ?>',GradientType=0 ); /* IE6-9 */
		<?php endif; ?>

		-webkit-transition: <?php echo ($settings->overlay_animation_speed / 1000); ?>s ease;
			-moz-transition: <?php echo ($settings->overlay_animation_speed / 1000); ?>s ease;
				-ms-transition: <?php echo ($settings->overlay_animation_speed / 1000); ?>s ease;
					-o-transition: <?php echo ($settings->overlay_animation_speed / 1000); ?>s ease;
						transition: <?php echo ($settings->overlay_animation_speed / 1000); ?>s ease;
	}
<?php endif; ?>

.fl-node-<?php echo $id; ?> .pp-gallery-overlay .pp-overlay-icon span {
	width: auto;
	height: auto;
	color: #<?php echo $settings->overlay_icon_color; ?>;
	font-size: <?php echo $settings->overlay_icon_size; ?>px;
	background-color: #<?php echo $settings->overlay_icon_bg_color; ?>;
	<?php if ( $settings->overlay_icon_radius ) { ?>border-radius: <?php echo $settings->overlay_icon_radius; ?>px;<?php } ?>
	<?php if ( $settings->overlay_icon_vertical_padding ) { ?>padding-top: <?php echo $settings->overlay_icon_vertical_padding; ?>px;<?php } ?>
	<?php if ( $settings->overlay_icon_vertical_padding ) { ?>padding-bottom: <?php echo $settings->overlay_icon_vertical_padding; ?>px;<?php } ?>
	<?php if ( $settings->overlay_icon_horizotal_padding ) { ?>padding-left: <?php echo $settings->overlay_icon_horizotal_padding; ?>px;<?php } ?>
	<?php if ( $settings->overlay_icon_horizotal_padding ) { ?>padding-right: <?php echo $settings->overlay_icon_horizotal_padding; ?>px;<?php } ?>
}

.fl-node-<?php echo $id; ?> .pp-gallery-overlay .pp-overlay-icon span:before {
	font-size: <?php echo $settings->overlay_icon_size; ?>px;
	width: auto;
	height: auto;
}

.fl-node-<?php echo $id; ?> .pp-photo-gallery-caption,
.fl-node-<?php echo $id; ?> .pp-gallery-overlay .pp-caption  {
	<?php if ( 'Default' != $settings->caption_font['family'] ) { ?>
		<?php FLBuilderFonts::font_css( $settings->caption_font ); ?>
	<?php } ?>
	<?php if ( 'default' != $settings->caption_font_size_toggle && $settings->caption_custom_font_size ) { ?>
		font-size: <?php echo $settings->caption_custom_font_size; ?>px;
	<?php } ?>
	<?php if ( $settings->caption_color ) { ?>
	color: #<?php echo $settings->caption_color; ?>;
	<?php } ?>
}

<?php if ( 'none' == $settings->overlay_effects && 'none' == $settings->hover_effects && 'hover' == $settings->show_captions ) { ?>
	.fl-node-<?php echo $id; ?> .pp-gallery-overlay {
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		opacity: 0;
	}
	.fl-node-<?php echo $id; ?> .pp-gallery-overlay .pp-overlay-inner {
		position: absolute;
		top: 50%;
		left: 50%;
		-webkit-transform: translate(-50%, -50%);
			-ms-transform: translate(-50%, -50%);
				transform: translate(-50%, -50%);
	}
	.fl-node-<?php echo $id; ?> .pp-photo-gallery-content:hover .pp-gallery-overlay {
		opacity: 1;
	}
<?php } ?>

<?php if ( 'fade' == $settings->overlay_effects ) { ?>
	.fl-node-<?php echo $id; ?> .pp-gallery-overlay {
		top: 0;
		bottom: 0;
		left: 0;
		right: 0;
		height: 100%;
		width: 100%;
		opacity: 0;
	}
	.fl-node-<?php echo $id; ?> .pp-gallery-overlay .pp-overlay-inner {
		position: absolute;
		top: 50%;
		left: 50%;
		-webkit-transform: translate(-50%, -50%);
			-ms-transform: translate(-50%, -50%);
				transform: translate(-50%, -50%);
	}
	.fl-node-<?php echo $id; ?> .pp-photo-gallery-content:hover .pp-gallery-overlay {
		opacity: 1;
	}
<?php } ?>

<?php if ( 'from-left' == $settings->overlay_effects ) { ?>
	.fl-node-<?php echo $id; ?> .pp-gallery-overlay {
		bottom: 0;
		left: 0;
		right: 0;
		width: 0;
		height: 100%;
	}
	.fl-node-<?php echo $id; ?> .pp-gallery-overlay .pp-overlay-inner {
		white-space: nowrap;
		color: white;
		font-size: 20px;
		position: absolute;
		overflow: hidden;
		top: 50%;
		left: 50%;
		-webkit-transform: translate(-50%, -50%);
			-ms-transform: translate(-50%, -50%);
				transform: translate(-50%, -50%);
	}
	.fl-node-<?php echo $id; ?> .pp-photo-gallery-content:hover .pp-gallery-overlay {
		width: 100%;
	}
<?php } ?>

<?php if ( 'from-right' == $settings->overlay_effects ) { ?>
	.fl-node-<?php echo $id; ?> .pp-gallery-overlay {
		bottom: 0;
		left: 100%;
		right: 0;
		width: 0;
		height: 100%;
	}
	.fl-node-<?php echo $id; ?> .pp-gallery-overlay .pp-overlay-inner {
		white-space: nowrap;
		color: white;
		font-size: 20px;
		position: absolute;
		overflow: hidden;
		top: 50%;
		left: 50%;
		-webkit-transform: translate(-50%, -50%);
			-ms-transform: translate(-50%, -50%);
				transform: translate(-50%, -50%);
	}
	.fl-node-<?php echo $id; ?> .pp-photo-gallery-content:hover .pp-gallery-overlay {
		width: 100%;
		left: 0;
	}
<?php } ?>

<?php if ( 'from-top' == $settings->overlay_effects ) { ?>
	.fl-node-<?php echo $id; ?> .pp-gallery-overlay {
		bottom: 100%;
		left: 0;
		right: 0;
		width: 100%;
		height: 0;
	}
	.fl-node-<?php echo $id; ?> .pp-gallery-overlay .pp-overlay-inner {
		white-space: nowrap;
		color: white;
		font-size: 20px;
		position: absolute;
		overflow: hidden;
		top: 50%;
		left: 50%;
		-webkit-transform: translate(-50%, -50%);
			-ms-transform: translate(-50%, -50%);
				transform: translate(-50%, -50%);
	}
	.fl-node-<?php echo $id; ?> .pp-photo-gallery-content:hover .pp-gallery-overlay {
		height: 100%;
		bottom: 0;
	}
<?php } ?>

<?php if ( 'from-bottom' == $settings->overlay_effects ) { ?>
	.fl-node-<?php echo $id; ?> .pp-gallery-overlay {
		bottom: 0;
		left: 0;
		right: 0;
		width: 100%;
		height: 0;
	}
	.fl-node-<?php echo $id; ?> .pp-gallery-overlay .pp-overlay-inner {
		white-space: nowrap;
		color: white;
		font-size: 20px;
		position: absolute;
		overflow: hidden;
		top: 50%;
		left: 50%;
		-webkit-transform: translate(-50%, -50%);
			-ms-transform: translate(-50%, -50%);
				transform: translate(-50%, -50%);
	}
	.fl-node-<?php echo $id; ?> .pp-photo-gallery-content:hover .pp-gallery-overlay {
		height: 100%;
	}
<?php } ?>

<?php if ( 'framed' == $settings->overlay_effects ) { ?>
	.fl-node-<?php echo $id; ?> .pp-gallery-overlay {
		top: 0;
		bottom: 0;
		left: 0;
		right: 0;
		height: 100%;
		width: 100%;
		opacity: 0;
	}
	.fl-node-<?php echo $id; ?> .pp-gallery-overlay .pp-overlay-inner {
		position: absolute;
		top: 50%;
		left: 50%;
		width: 100%;
		height: 100%;
		-webkit-transform: translate(-50%, -50%);
			-ms-transform: translate(-50%, -50%);
				transform: translate(-50%, -50%);
	}
	.fl-node-<?php echo $id; ?> .pp-gallery-overlay .pp-overlay-inner:before,
	.fl-node-<?php echo $id; ?> .pp-gallery-overlay .pp-overlay-inner:after {
		content: '';
		display: block;
		position: absolute;
		top: <?php echo ( $settings->overlay_spacing ) ? $settings->overlay_spacing . 'px' : '30px'; ?>;
		left: <?php echo ( $settings->overlay_spacing ) ? $settings->overlay_spacing . 'px' : '30px'; ?>;
		bottom: <?php echo ( $settings->overlay_spacing ) ? $settings->overlay_spacing . 'px' : '30px'; ?>;
		right: <?php echo ( $settings->overlay_spacing ) ? $settings->overlay_spacing . 'px' : '30px'; ?>;
		-webkit-transition: -webkit-transform .35s ease 0s;
			-ms-transition: -ms-transform .35s ease 0s;
				transition: transform .35s ease 0s;
	}
	.fl-node-<?php echo $id; ?> .pp-gallery-overlay .pp-overlay-inner:before {
		border-style: solid;
		border-width: 0;
		border-color: <?php echo ( $settings->overlay_border_color ) ? '#' . $settings->overlay_border_color : '#ffffff'; ?>;
		border-top-width: <?php echo ( $settings->overlay_border_width ) ? $settings->overlay_border_width . 'px' : '1px'; ?>;
		border-bottom-width: <?php echo ( $settings->overlay_border_width ) ? $settings->overlay_border_width . 'px' : '1px'; ?>;
		-webkit-transform: scale(0,1);
			-ms-transform: scale(0,1);
				transform: scale(0,1);
	}
	.fl-node-<?php echo $id; ?> .pp-gallery-overlay .pp-overlay-inner:after {
		border-style: solid;
		border-width: 0;
		border-color: <?php echo ( $settings->overlay_border_color ) ? '#' . $settings->overlay_border_color : '#ffffff'; ?>;
		border-left-width: <?php echo ( $settings->overlay_border_width ) ? $settings->overlay_border_width . 'px' : '1px'; ?>;
		border-right-width: <?php echo ( $settings->overlay_border_width ) ? $settings->overlay_border_width . 'px' : '1px'; ?>;
		-webkit-transform: scale(1,0);
			-ms-transform: scale(1,0);
				transform: scale(1,0);
	}

	.fl-node-<?php echo $id; ?> .pp-photo-gallery-content:hover .pp-gallery-overlay .pp-overlay-inner:before,
	.fl-node-<?php echo $id; ?> .pp-photo-gallery-content:hover .pp-gallery-overlay .pp-overlay-inner:after {
		-webkit-transform: scale(1);
			-ms-transform: scale(1);
				transform: scale(1);
	}

	.fl-node-<?php echo $id; ?> .pp-photo-gallery-content:hover .pp-gallery-overlay {
		opacity: 1;
	}
<?php } ?>

<?php if ( 'zoom-in' == $settings->hover_effects || 'zoom-out' == $settings->hover_effects || 'greyscale' == $settings->hover_effects || 'blur' == $settings->hover_effects || 'rotate' == $settings->hover_effects ) { ?>
	.fl-node-<?php echo $id; ?> .pp-gallery-overlay {
		top: 0;
		opacity: 0;
		overflow: hidden;
		<?php if ( 'none' == $settings->overlay_effects ) { ?>
			left: 0;
			width: 100%;
			height: 100%;
		<?php } ?>
	}
	.fl-node-<?php echo $id; ?> .pp-gallery-overlay .pp-overlay-inner {
		-webkit-box-orient: vertical;
		-webkit-box-direction: normal;
		-webkit-flex-direction: column;
			-ms-flex-direction: column;
				flex-direction: column;
		-webkit-box-pack: center;
		-webkit-justify-content: center;
		-ms-flex-pack: center;
		justify-content: center;
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		height: 100%;
		width: 100%;
	}
	.fl-node-<?php echo $id; ?> .pp-photo-gallery-content:hover .pp-gallery-overlay {
		opacity: 1;
		-webkit-transform: translate(0);
			-moz-transform: translate(0);
				-ms-transform: translate(0);
					-o-transform: translate(0);
						transform: translate(0);
	}
<?php } ?>

<?php if ( 'none' != $settings->hover_effects ) { ?>
.fl-node-<?php echo $id; ?> .pp-photo-gallery .pp-photo-gallery-content .pp-gallery-img {
	-webkit-transition: all <?php echo ($settings->image_animation_speed / 1000); ?>s ease;
		-moz-transition: all <?php echo ($settings->image_animation_speed / 1000); ?>s ease;
			-ms-transition: all <?php echo ($settings->image_animation_speed / 1000); ?>s ease;
				-o-transition: all <?php echo ($settings->image_animation_speed / 1000); ?>s ease;
					transition: all <?php echo ($settings->image_animation_speed / 1000); ?>s ease;
}
<?php } ?>

<?php if ( 'zoom-in' == $settings->hover_effects ) { ?>
	.fl-node-<?php echo $id; ?> .pp-photo-gallery .pp-photo-gallery-content .pp-gallery-img {
		-webkit-transform: scale(1);
			-moz-transform: scale(1);
				-ms-transform: scale(1);
					-o-transform: scale(1);
						transform: scale(1);
	}

	.fl-node-<?php echo $id; ?> .pp-photo-gallery .pp-photo-gallery-content:hover .pp-gallery-img {
		-webkit-transform: scale(1.3);
			-moz-transform: scale(1.3);
				-ms-transform: scale(1.3);
					-o-transform: scale(1.3);
						transform: scale(1.3);
	}
<?php } ?>

<?php if ( 'zoom-out' == $settings->hover_effects ) { ?>
	.fl-node-<?php echo $id; ?> .pp-photo-gallery .pp-photo-gallery-content .pp-gallery-img {
		-webkit-transform: scale(1.5);
			-moz-transform: scale(1.5);
				-ms-transform: scale(1.5);
					-o-transform: scale(1.5);
						transform: scale(1.5);
	}

	.fl-node-<?php echo $id; ?> .pp-photo-gallery .pp-photo-gallery-content:hover .pp-gallery-img {
		-webkit-transform: scale(1);
			-moz-transform: scale(1);
				-ms-transform: scale(1);
					-o-transform: scale(1);
						transform: scale(1);
	}
<?php } ?>

<?php if ( 'greyscale' == $settings->hover_effects ) { ?>
	.fl-node-<?php echo $id; ?> .pp-photo-gallery .pp-photo-gallery-content:hover .pp-gallery-img {
		-webkit-filter: grayscale(100%);
			-moz-filter: grayscale(100%);
				-ms-filter: grayscale(100%);
					filter: grayscale(100%);
	}
<?php } ?>

<?php if ( 'blur' == $settings->hover_effects ) { ?>
	.fl-node-<?php echo $id; ?> .pp-photo-gallery .pp-photo-gallery-content .pp-gallery-img {
		-webkit-filter: blur(0);
		filter: blur(0);
	}

	.fl-node-<?php echo $id; ?> .pp-photo-gallery .pp-photo-gallery-content:hover .pp-gallery-img {
		-webkit-filter: blur(3px);
		filter: blur(3px);
	}
<?php } ?>

<?php if ( 'rotate' == $settings->hover_effects ) { ?>
	.fl-node-<?php echo $id; ?> .pp-photo-gallery .pp-photo-gallery-content .pp-gallery-img {
		-webkit-transform: rotate(0) scale(1);
		transform: rotate(0) scale(1);
	}

	.fl-node-<?php echo $id; ?> .pp-photo-gallery .pp-photo-gallery-content:hover .pp-gallery-img {
		-webkit-transform: rotate(15deg) scale(1.6);
		transform: rotate(15deg) scale(1.6);
	}
<?php } ?>
.fl-node-<?php echo $id; ?> .pp-gallery-pagination {
	<?php if ( isset( $settings->load_more_alignment ) ) { ?>
		text-align: <?php echo $settings->load_more_alignment; ?>;
	<?php } ?>
}
.fl-node-<?php echo $id; ?> .pp-gallery-pagination .pp-gallery-load-more {
	<?php if ( isset( $settings->load_more_bg_color ) && ! empty( $settings->load_more_bg_color ) ) { ?>
		background-color: <?php echo pp_get_color_value( $settings->load_more_bg_color ); ?>;
	<?php } ?>
	<?php if ( isset( $settings->load_more_text_color ) && ! empty( $settings->load_more_text_color ) ) { ?>
		color: <?php echo pp_get_color_value( $settings->load_more_text_color ); ?>;
	<?php } ?>
	<?php if ( isset( $settings->load_more_border_width ) && ! empty( $settings->load_more_border_width ) ) { ?>
		border-width: <?php echo $settings->load_more_border_width; ?>px;
		<?php if ( isset( $settings->load_more_border_style ) ) { ?>
			border-style: <?php echo $settings->load_more_border_style; ?>;
		<?php } ?>
		<?php if ( isset( $settings->load_more_border_color ) && ! empty( $settings->load_more_border_color ) ) { ?>
			border-color: <?php echo pp_get_color_value( $settings->load_more_border_color ); ?>;
		<?php } ?>
	<?php } ?>
	<?php if ( isset( $settings->load_more_border_radius ) && ! empty( $settings->load_more_border_radius ) ) { ?>
		border-radius: <?php echo $settings->load_more_border_radius; ?>px;
	<?php } ?>
	<?php if ( isset( $settings->load_more_margin_top ) && ! empty( $settings->load_more_margin_top ) ) { ?>
		margin-top: <?php echo $settings->load_more_margin_top; ?>px;
	<?php } ?>
	<?php if ( isset( $settings->load_more_padding_top ) && ! empty( $settings->load_more_padding_top ) ) { ?>
		padding-top: <?php echo $settings->load_more_padding_top; ?>px;
	<?php } ?>
	<?php if ( isset( $settings->load_more_padding_left ) && ! empty( $settings->load_more_padding_left ) ) { ?>
		padding-left: <?php echo $settings->load_more_padding_left; ?>px;
	<?php } ?>
	<?php if ( isset( $settings->load_more_padding_bottom ) && ! empty( $settings->load_more_padding_bottom ) ) { ?>
		padding-bottom: <?php echo $settings->load_more_padding_bottom; ?>px;
	<?php } ?>
	<?php if ( isset( $settings->load_more_padding_right ) && ! empty( $settings->load_more_padding_right ) ) { ?>
		padding-right: <?php echo $settings->load_more_padding_right; ?>px;
	<?php } ?>
}
.fl-node-<?php echo $id; ?> .pp-gallery-pagination .pp-gallery-load-more:hover {
	<?php if ( isset( $settings->load_more_bg_hover_color ) && ! empty( $settings->load_more_bg_hover_color ) ) { ?>
		background-color: <?php echo pp_get_color_value( $settings->load_more_bg_hover_color ); ?>;
	<?php } ?>
	<?php if ( isset( $settings->load_more_text_hover_color ) && ! empty( $settings->load_more_text_hover_color ) ) { ?>
		color: <?php echo pp_get_color_value( $settings->load_more_text_hover_color ); ?>;
	<?php } ?>
	<?php if ( isset( $settings->load_more_border_hover_color ) && ! empty( $settings->load_more_border_hover_color ) ) { ?>
		border-color: <?php echo pp_get_color_value( $settings->load_more_border_hover_color ); ?>;
	<?php } ?>
}

.fancybox-<?php echo $id; ?>-overlay {
	background-image: none;
	<?php if ( ! empty( $settings->lightbox_overlay_color ) ) : ?>
		background-color: <?php echo ( false === strpos( $settings->lightbox_overlay_color, 'rgb' ) ) ? '#' . $settings->lightbox_overlay_color : $settings->lightbox_overlay_color; ?>;
	<?php endif; ?>
}

@media only screen and ( max-width: <?php echo $global_settings->medium_breakpoint; ?>px ) {
	
	<?php if ( 'justified' != $settings->gallery_layout ) { ?>
		.fl-node-<?php echo $id; ?> .pp-photo-gallery-item {
			width: <?php echo $photo_columns_tablet;?>%;
			<?php if ( $settings->photo_padding_medium ) { ?>
				padding: <?php echo $settings->photo_padding_medium; ?>px;
			<?php } ?>
		}

		<?php if ( 'grid' == $settings->gallery_layout ) { ?>
			.fl-node-<?php echo $id; ?> .pp-photo-gallery-item:nth-child(<?php echo $desktop_col; ?>n+1){
				clear: none;
			}
			.fl-node-<?php echo $id; ?> .pp-photo-gallery-item:nth-child(<?php echo $desktop_col; ?>n+0){
				clear: none;
			}
			.fl-node-<?php echo $id; ?> .pp-photo-gallery-item:nth-child(<?php echo $desktop_col; ?>n){
				margin-right: <?php echo $settings->photo_spacing; ?>%;
			}
			<?php if ( $medium_col > 1 ) { ?>
				.fl-node-<?php echo $id; ?> .pp-photo-gallery-item:nth-child(<?php echo $medium_col; ?>n+1){
					clear: left;
				}
				.fl-node-<?php echo $id; ?> .pp-photo-gallery-item:nth-child(<?php echo $medium_col; ?>n+0){
					clear: right;
				}
			<?php } ?>
			.fl-node-<?php echo $id; ?> .pp-photo-gallery-item:nth-child(<?php echo $medium_col; ?>n){
				margin-right: 0;
			}
		<?php } ?>
	<?php } ?>
	.fl-node-<?php echo $id; ?> .pp-photo-gallery-caption,
	.fl-node-<?php echo $id; ?> .pp-gallery-overlay .pp-caption  {
		<?php if ( 'default' != $settings->caption_font_size_toggle && $settings->caption_custom_font_size_medium ) { ?>
			font-size: <?php echo $settings->caption_custom_font_size_medium; ?>px;
		<?php } ?>
	}
	.fl-node-<?php echo $id; ?> .pp-gallery-pagination .pp-gallery-load-more {
		<?php if ( isset( $settings->load_more_padding_top_medium ) && ! empty( $settings->load_more_padding_top_medium ) ) { ?>
			padding-top: <?php echo $settings->load_more_padding_top_medium; ?>px;
		<?php } ?>
		<?php if ( isset( $settings->load_more_padding_left_medium ) && ! empty( $settings->load_more_padding_left_medium ) ) { ?>
			padding-left: <?php echo $settings->load_more_padding_left_medium; ?>px;
		<?php } ?>
		<?php if ( isset( $settings->load_more_padding_bottom_medium ) && ! empty( $settings->load_more_padding_bottom_medium ) ) { ?>
			padding-bottom: <?php echo $settings->load_more_padding_bottom_medium; ?>px;
		<?php } ?>
		<?php if ( isset( $settings->load_more_padding_right_medium ) && ! empty( $settings->load_more_padding_right_medium ) ) { ?>
			padding-right: <?php echo $settings->load_more_padding_right_medium; ?>px;
		<?php } ?>
		<?php if ( isset( $settings->load_more_margin_top_medium ) && ! empty( $settings->load_more_margin_top_medium ) ) { ?>
			margin-top: <?php echo $settings->load_more_margin_top_medium; ?>px;
		<?php } ?>
	}
}

@media only screen and ( max-width: <?php echo $global_settings->responsive_breakpoint; ?>px ) {
	<?php if ( 'justified' != $settings->gallery_layout ) { ?>
		.fl-node-<?php echo $id; ?> .pp-photo-gallery-item {
			width: <?php echo $photo_columns_mobile;?>%;
			<?php if ( $settings->photo_padding_responsive ) { ?>
				padding: <?php echo $settings->photo_padding_responsive; ?>px;
			<?php } ?>
		}
		<?php if ( 'grid' == $settings->gallery_layout ) { ?>
			.fl-node-<?php echo $id; ?> .pp-photo-gallery-item:nth-child(<?php echo $medium_col; ?>n+1){
				clear: none;
			}
			.fl-node-<?php echo $id; ?> .pp-photo-gallery-item:nth-child(<?php echo $medium_col; ?>n+0){
				clear: none;
			}
			.fl-node-<?php echo $id; ?> .pp-photo-gallery-item:nth-child(<?php echo $medium_col; ?>n){
				margin-right: <?php echo $settings->photo_spacing; ?>%;
			}
			<?php if ( $mobile_col > 1 ) { ?>
				.fl-node-<?php echo $id; ?> .pp-photo-gallery-item:nth-child(<?php echo $mobile_col; ?>n+1){
					clear: left;
				}
				.fl-node-<?php echo $id; ?> .pp-photo-gallery-item:nth-child(<?php echo $mobile_col; ?>n+0){
					clear: right;
				}
			<?php } ?>
			.fl-node-<?php echo $id; ?> .pp-photo-gallery-item:nth-child(<?php echo $mobile_col; ?>n){
				margin-right: 0;
			}
		<?php } ?>
	<?php } ?>

	.fl-node-<?php echo $id; ?> .pp-photo-gallery-caption,
	.fl-node-<?php echo $id; ?> .pp-gallery-overlay .pp-caption {
		<?php if ( 'default' != $settings->caption_font_size_toggle && $settings->caption_custom_font_size_responsive ) { ?>
			font-size: <?php echo $settings->caption_custom_font_size_responsive; ?>px;
		<?php } ?>
	}
	.fl-node-<?php echo $id; ?> .pp-gallery-pagination .pp-gallery-load-more {
		<?php if ( isset( $settings->load_more_padding_top_responsive ) && ! empty( $settings->load_more_padding_top_responsive ) ) { ?>
			padding-top: <?php echo $settings->load_more_padding_top_responsive; ?>px;
		<?php } ?>
		<?php if ( isset( $settings->load_more_padding_left_responsive ) && ! empty( $settings->load_more_padding_left_responsive ) ) { ?>
			padding-left: <?php echo $settings->load_more_padding_left_responsive; ?>px;
		<?php } ?>
		<?php if ( isset( $settings->load_more_padding_bottom_responsive ) && ! empty( $settings->load_more_padding_bottom_responsive ) ) { ?>
			padding-bottom: <?php echo $settings->load_more_padding_bottom_responsive; ?>px;
		<?php } ?>
		<?php if ( isset( $settings->load_more_padding_right_responsive ) && ! empty( $settings->load_more_padding_right_responsive ) ) { ?>
			padding-right: <?php echo $settings->load_more_padding_right_responsive; ?>px;
		<?php } ?>
		<?php if ( isset( $settings->load_more_margin_top_responsive ) && ! empty( $settings->load_more_margin_top_responsive ) ) { ?>
			margin-top: <?php echo $settings->load_more_margin_top_responsive; ?>px;
		<?php } ?>
	}
}
