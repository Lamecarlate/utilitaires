<h1>Utilitaires</h1>
<ul class="home-links">
	<?php
	foreach($menu_home as $item) : 
	if(isset($item->code) && isset($item->title)) : 
	?>
	<li class="home-link-wrapper">
		<a href="<?php echo site_url($item->code) ; ?>" class="home-link bg-<?php echo $item->code ; ?>">
			<h2 class="home-link-title"><?php echo $item->title ; ?></h2>
			<?php if(isset($item->description)) : ?>
			<div class="home-link-description"><?php echo $item->description ; ?></div>
			<?php endif ; ?>
		</a>
	</li>
	<?php 
	endif;
	endforeach; 
	?>
</ul>