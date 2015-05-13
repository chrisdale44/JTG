<a href="index.php?admin&amp;p=dash#tab-artwork">Back</a>

<form method="post" enctype="multipart/form-data" action="index.php?admin&amp;p=artwork&amp;method=submit<? if($data['artworkId']): ?>&amp;id=<?= $data['artworkId'] ?><? endif; ?>">
	<label>
		<? if($data['artwork']): ?>
			<img src='/images/artwork/<?= $data['artwork']['image'] ?>' alt='<?= $data['artwork']['title'] ?> by <?= $data['artwork']['forename'] ?> <?= $data['artwork']['surname']; ?>' class='artwork-medium' /><br/>
		<? endif; ?>
		*Image
		<input name="image" type="file" />
	</label>
	<br/>

	<label for="artist">
		*Artist
	</label>
	<br/>
	<select id="artist" name="artist">
	<? while($row = mysqli_fetch_array($data['artists'])): ?>
		<option value="<?= $row['artistId'] ?>" <? if($row['artistId'] == $data['artwork']['artistId']): ?> selected="selected" <? endif; ?> ><?= $row['forename'] ?> <?= $row['surname']; ?></option>
	<? endwhile; ?>
	</select>
	<br/>

	<label>
		*Title
		<input type="text" name="title" maxlength="50" value="<?= $data['artwork']['title'] ?>"/>
	</label>
	<br/>

	<label>
		Year
		<input type="text" name="year" maxlength="4" value="<?= $data['artwork']['year'] ?>"/>
	</label>
	<br/>

	<label for="desc">
		Description
	</label>
		<br/>
		<textarea id="desc" name="desc" cols="60" rows="8"><?= $data['artwork']['description'] ?></textarea>
	<br/>

	<input type="submit" value="Save" /> 
</form>