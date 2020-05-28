<!-- Start SearchForm -->
<form method="get" class="searchform" role="search" action="<?php echo esc_url(home_url( '/' )); ?>">
  <fieldset>
  	<input name="s" type="text" placeholder="<?php esc_attr_e( 'Search', 'bronx' ); ?>" class="s">
  	<input type="submit" value="Search">
  </fieldset>
</form>
<!-- End SearchForm -->