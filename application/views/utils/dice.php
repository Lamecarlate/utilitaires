<!--[code=dice;title=Dés;description=Un lanceur de dés, de 1d2 à 1d100]-->
<h1>Dés</h1>
<form action="" method="post" id="throw-dice">
	<?php 
		$dice_list = array(2,3,4,6,8,10,12,20,100) ; 
		$dice_type = (isset($processed_data['dice_type'])) ? intval($processed_data['dice_type']) : ''; 
		$dice_result = (isset($processed_data['result'])) ? intval($processed_data['result']) : ''; 
		$src = ($dice_result !== '' && $dice_type !== '') ? 'd' . $dice_type . '_' . $dice_result . '.png' : 'dice.gif';
		$alt = ($dice_result !== '' && $dice_type !== '') ? $dice_result : 'En attente de lancer';
	?>

	<div class="inputs">
		<?php foreach($dice_list as $die) : ?>
		<p class="form-group">
			<input type="radio" class="dice custom-radio" name="dice_type" id="d<?php echo $die ; ?>" value="<?php echo $die ; ?>" <?php if($dice_type === $die) echo 'checked="checked"' ; ?> />
			<label for="d<?php echo $die ; ?>">1d<?php echo $die ; ?></label>
		</p>
		<?php endforeach ; ?>
		<p class="form-group">
			<button type="submit">Lancer</button>
		</p>
	</div>
	<div class="result-wrapper">
		<!--<span class="result-text" id="result-text">
			<?php echo $dice_result ; ?>
		</span>-->
		<span class="result-img <?php if(!isset($processed_data['dice_type']) && !isset($processed_data['result'])) echo 'wait'; ?>" id="result-img">
			<img 
				id="dice-img" 
				src="assets/img/utils/dice/<?php echo $src ; ?>"
				alt="<?php echo $alt ; ?>"
				title="<?php echo $dice_result ; ?>"
			/>
		</span>
	</div>
</form>
<script src="assets/js/dice.js"></script>