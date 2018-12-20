<?php
$item_class = $module->get_item_class();
?>

<div class="pp-photo-gallery">
	<?php foreach ( $module->get_photos() as $photo ) {
		include $module->dir . 'includes/layout.php';
	} ?>

	<?php if ( 'masonry' == $settings->gallery_layout ) { ?>
		<div class="pp-photo-space"></div>
	<?php } ?>
</div>

<?php if ( isset( $settings->pagination ) && 'load_more' == $settings->pagination ) { ?>
	<?php if ( ! empty( $settings->images_per_page ) ) { ?>
	<div class="pp-gallery-pagination">
		<a href="#" class="pp-gallery-load-more"><?php echo $settings->load_more_text; ?></a>
	</div>
	<?php } ?>
<?php } ?>
