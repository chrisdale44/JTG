<form method="post" enctype="multipart/form-data" action="index.php?admin&amp;p=dash&amp;method=about#tab-about">
	<label for="about">
		*About
		<br/>
		<textarea id="about" name="about" cols="80" rows="8"><?= $data['about']['about'] ?></textarea>
	</label>
	<br/>
	<label>
		<input type="submit" value="Save" /> 
	</label>
</form>