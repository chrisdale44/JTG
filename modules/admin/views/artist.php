<a href="index.php?admin&amp;p=dash#tab-artists">Back</a>

<form method="post" enctype="multipart/form-data" action="index.php?admin&amp;p=artist&amp;method=submit<? if($data['id']): ?>&amp;id=<?= $data['id'] ?><? endif; ?>">
	<label for="forename">
		Forename
		<input type="text" id="forename" name="forename" maxlength="50" value="<?= $data['artist']['forename'] ?>"/>
	</label>
	
	<label for="surname">
		*Surname
		<input type="text" id="surname" name="surname" maxlength="50" value="<?= $data['artist']['surname'] ?>"/>
	</label>
	
	<label for="bio">
		Biography
		<textarea id="bio" name="bio" cols="80" rows="8"><?= $data['artist']['bio'] ?></textarea>
	</label>

	<label>
		<input type="submit" value="Save" /> 
	</label>
</form>