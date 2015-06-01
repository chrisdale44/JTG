<div class="centerForm">
	<form method="post" enctype="multipart/form-data" action="index.php?admin&amp;p=dash&amp;method=contact#tab-contact">
		<div class="inputWrapper">
			<label for="email">
				*E-mail
				<input type="text" id="email" name="email" maxlength="50" value="<?= $data['contact']['email'] ?>"/>
			</label>
		</div>
		<div class="inputWrapper">
			<label for="title">
				*Telephone
				<input type="text" id="telephone" name="telephone" maxlength="50" value="<?= $data['contact']['telephone'] ?>"/>
			</label>
		</div>
		<label>
			<input type="submit" value="Save" class="button darkGrey" /> 
		</label>
	</form>
</div>