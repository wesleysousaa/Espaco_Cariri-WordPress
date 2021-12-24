<?php
 /**
  *
  *
  *
  */
?>
<div class="row clearfix">
	<div class="col-sm-12">
		<?php
			the_posts_pagination( 
				array(
					'mid_size' 	=> 2,
					'prev_text' => __( '&laquo;', 'newspaper-magazine' ),
					'next_text' => __( '&raquo;', 'newspaper-magazine' ),
				) 
			);
		?>
	</div>
</div>