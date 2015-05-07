<a href="index.php?admin&amp;p=dash#tab-artwork">Back</a>

<form method="post" enctype="multipart/form-data" action="index.php?admin&amp;p=artwork&amp;method=submit<? if($data['artworkId']): ?>&amp;id=<?= $data['artworkId'] ?><? endif; ?>">
	<label for="image">
		<? if($data['artwork']): ?>
			<img src='/fine_art_prints/images/artwork/<?= $data['artwork']['image'] ?>' alt='<?= $data['artwork']['title'] ?> by <?= $data['artwork']['forename'] ?> <?= $data['artwork']['surname']; ?>' class='artwork-medium' /><br/>
		<? endif; ?>
		*Image
		<input name="image" type="file" />
	</label>
	<br/>
	<label for="artist">
		*Artist
		<br/>
		<select id="artist" name="artist">
		<? while($row = mysqli_fetch_array($data['artists'])): ?>
			<option value="<?= $row['artistID'] ?>" <? if($row['artistID'] == $data['artwork']['artistID']): ?> selected="selected" <? endif; ?> ><?= $row['forename'] ?> <?= $row['surname']; ?></option>
		<? endwhile; ?>
		</select>
	</label>
	<br/>
	<label for="title">
		*Title
		<input type="text" id="title" name="title" maxlength="50" value="<?= $data['artwork']['title'] ?>"/>
	</label>
	<br/>
	<label for="year">
		Year
		<input type="text" id="year" name="year" maxlength="4" value="<?= $data['artwork']['year'] ?>"/>
	</label>
	<br/>
	<label for="desc">
		Description
		<br/>
		<textarea id="desc" name="desc" cols="60" rows="8"><?= $data['artwork']['description'] ?></textarea>
	</label>
	<br/>
	<label>
		<input type="submit" value="Save" /> 
	</label>
</form>