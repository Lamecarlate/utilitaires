<ul class="links">
	<li>
		<a href="<?php echo site_url() ; ?>" class="menu-link">
			Accueil
		</a>
	</li>
	<?php 
	foreach($menu as $item) : 
	if(isset($item->code) && isset($item->title)) : 
	?>
	<li>
		<a href="<?php echo site_url($item->code) ; ?>" 
			class="menu-link <?php if(isset($current) && $current === $item->code) echo 'current' ; ?>">
			<?php echo $item->title ; ?>
		</a>
	</li>
	<?php 
	endif;
	endforeach; 
	?>
	<!-- <li class="link-credits">
		<a href="<?php echo site_url('credits') ; ?>"
			class="menu-link <?php if(isset($current) && $current === 'credits') echo 'current' ; ?>">
			Crédits
		</a>
	</li> -->
</ul>