<form role="search" method="get" action="<?php echo home_url( '/' ); ?>" class="searchform navbar-form navbar-right">
	<div class="form-group">
		<input type="text" class="form-control searchfield" value="<?php echo get_search_query(); ?>" name="s" class="searchfield" />
	</div>
	<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
</form>