<a href="index.php?admin&amp;p=dash#tab-artists" class="button darkGrey">Back</a>

<div class="centerForm">
	<form method="post" enctype="multipart/form-data" action="index.php?admin&amp;p=artist&amp;method=submit<? if($data['id']): ?>&amp;id=<?= $data['id'] ?><? endif; ?>">
		<div class="inputWrapper">
			<label for="forename">
				Forename
				<input type="text" id="forename" name="forename" maxlength="50" value="<?= $data['artist']['forename'] ?>"/>
			</label>
		</div>
		<div class="inputWrapper">
			<label for="surname">
				*Surname
				<input type="text" id="surname" name="surname" maxlength="50" value="<?= $data['artist']['surname'] ?>"/>
			</label>
		</div>
		<div class="inputWrapper">
			<label for="bio">
				Biography
				<textarea id="bio" name="bio" cols="80" rows="8"><?= $data['artist']['bio'] ?></textarea>
			</label>
		</div>
		<label>
			<input type="submit" value="Save" class="button darkGrey" /> 
		</label>
	</form>
</div>