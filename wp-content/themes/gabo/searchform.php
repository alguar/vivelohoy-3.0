<script type="text/javascript">
    function toggle_visibility(id) {
    	event.preventDefault();
       var e = document.getElementById(id);
       if(e.style.display == 'block')
          e.style.display = 'none';
       else
          e.style.display = 'block';
    }
</script>

<div id="search">
	<form style="max-width: 180px" role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
		<label>
			<span class="screen-reader-text"><?php _e( 'Search', 'gabo' ); ?>:</span>
			<input type="search" placeholder="<?php _e( 'Search', 'gabo' ); ?>…" value="" name="s" title="<?php _e( 'Search', 'gabo' ); ?>:" />
		</label>
	</form>
</div>