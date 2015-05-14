<?php
/**
 * The template for displaying search forms.
 *
 * @package WordPress
 * @subpackage Rozana
 * @since rozana 1.0
 */
?>
<form role="search" method="get" id="searchform" class="search animated" action="<?php echo esc_url( home_url( '/' ) ); ?>" data-animation="fadeInUp">
	<div class="input-group">
		<input type="text" class="form-control" name="s" id="s"  value="" placeholder="<?php esc_attr_e( 'Search...', 'samathemes' ); ?>">
		<input type="hidden" name="post_type" value="post" />
		<span class="input-group-btn">
			<button type="submit" class="btn" id="searchsubmit"><i class="fa fa-search"></i></button>
		</span>
	</div>
</form>