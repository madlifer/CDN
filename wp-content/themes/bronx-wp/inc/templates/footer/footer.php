<?php
$footer_columns = ot_get_option( 'footer_columns', 'fourcolumns');
$footer_color = ot_get_option( 'footer_color', 'light');

$footer_classes[] = 'footer';
$footer_classes[] = $footer_color;
?>
<footer class="<?php echo esc_attr(implode(' ', $footer_classes)); ?>">
	<div class="row">
		<?php if ($footer_columns == 'fourcolumns') { ?>
	  <div class="small-12 medium-6 large-3 columns">
	  	<?php dynamic_sidebar('footer1'); ?>
	  </div>
	  <div class="small-12 medium-6 large-3 columns">
	  	<?php dynamic_sidebar('footer2'); ?>
	  </div>
	  <div class="small-12 medium-6 large-3 columns">
	    <?php dynamic_sidebar('footer3'); ?>
	  </div>
	  <div class="small-12 medium-6 large-3 columns">
	    <?php dynamic_sidebar('footer4'); ?>
	  </div>
	  <?php } elseif ($footer_columns == 'threecolumns') { ?>
	  <div class="small-12 medium-6 large-4 columns">
	  	<?php dynamic_sidebar('footer1'); ?>
	  </div>
	  <div class="small-12 medium-6 large-4 columns">
	  	<?php dynamic_sidebar('footer2'); ?>
	  </div>
	  <div class="small-12 large-4 columns">
	      <?php dynamic_sidebar('footer3'); ?>
	  </div>
	  <?php } elseif ($footer_columns == 'twocolumns') { ?>
	  <div class="small-12 medium-6 columns">
	  	<?php dynamic_sidebar('footer1'); ?>
	  </div>
	  <div class="small-12 medium-6 columns">
	  	<?php dynamic_sidebar('footer2'); ?>
	  </div>
	  <?php } elseif ($footer_columns == 'doubleleft') { ?>
	  <div class="small-12 large-6 columns">
	  	<?php dynamic_sidebar('footer1'); ?>
	  </div>
	  <div class="small-12 medium-6 large-3 columns">
	  	<?php dynamic_sidebar('footer2'); ?>
	  </div>
	  <div class="small-12 medium-6 large-3 columns">
	      <?php dynamic_sidebar('footer3'); ?>
	  </div>
	  <?php } elseif ($footer_columns == 'doubleright') { ?>
	  <div class="small-12 medium-6 large-3 columns">
	  	<?php dynamic_sidebar('footer1'); ?>
	  </div>
	  <div class="small-12 medium-6 large-3 columns">
	  	<?php dynamic_sidebar('footer2'); ?>
	  </div>
	  <div class="small-12 large-6 columns">
	      <?php dynamic_sidebar('footer3'); ?>
	  </div>
	  <?php } elseif ($footer_columns == 'fivecolumns') { ?>
	  <div class="small-12 medium-6 large-2 columns">
	  	<?php dynamic_sidebar('footer1'); ?>
	  </div>
	  <div class="small-12 medium-6 large-3 columns">
	  	<?php dynamic_sidebar('footer2'); ?>
	  </div>
	  <div class="small-12 medium-6 large-2 columns">
	  	<?php dynamic_sidebar('footer3'); ?>
	  </div>
	  <div class="small-12 medium-6 large-3 columns">
	  	<?php dynamic_sidebar('footer4'); ?>
	  </div>
	  <div class="small-12 large-2 columns">
	  	<?php dynamic_sidebar('footer5'); ?>
	  </div>
	  <?php } elseif ($footer_columns == 'onecolumns') { ?>
	  <div class="small-12 columns">
	  	<?php dynamic_sidebar('footer1'); ?>
	  </div>
	  <?php } ?>
	</div>
</footer>