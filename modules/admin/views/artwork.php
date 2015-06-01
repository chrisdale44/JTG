<a href="index.php?admin&amp;p=dash#tab-artwork" class="button darkGrey">Back</a>

<div class="centerForm">
	<form method="post" enctype="multipart/form-data" action="index.php?admin&amp;p=artwork&amp;method=submit<? if($data['artworkId']): ?>&amp;id=<?= $data['artworkId'] ?><? endif; ?>">
		<div class="inputWrapper">	
			<label>
				<? if($data['artwork']): ?>
					<img src='/images/artwork/<?= $data['artwork']['image'] ?>' alt='<?= $data['artwork']['title'] ?> by <?= $data['artwork']['forename'] ?> <?= $data['artwork']['surname']; ?>' class='artwork-medium' /><br/>
				<? endif; ?>
				*Image
				<input name="image" type="file" />
			</label>
		</div>
		<div class="inputWrapper">
			<label for="artist">
				*Artist
			</label>
			<select id="artist" name="artist">
			<? while($row = mysqli_fetch_array($data['artists'])): ?>
				<option value="<?= $row['artistId'] ?>" <? if($row['artistId'] == $data['artwork']['artistId']): ?> selected="selected" <? endif; ?> ><?= $row['forename'] ?> <?= $row['surname']; ?></option>
			<? endwhile; ?>
			</select>
		</div>
		<div class="inputWrapper">
			<label>
				*Title
				<input type="text" name="title" maxlength="50" value="<?= $data['artwork']['title'] ?>"/>
			</label>
		</div>
		<div class="inputWrapper">
			<label>
				Year
				<input type="text" name="year" maxlength="4" value="<?= $data['artwork']['year'] ?>"/>
			</label>
		</div>
		<div class="inputWrapper">
			<label for="medium">
				Medium
			</label>
			<select id="medium" name="medium">
				<option value="print" <? if($data['artwork']['medium'] == 'print'): ?> selected="selected" <? endif; ?> >Print</option>
				<option value="photo" <? if($data['artwork']['medium'] == 'photo'): ?> selected="selected" <? endif; ?> >Photo</option>
			</select>
		</div>
		
		<label for="desc" class="leftAlign">
			Description
		</label>
		<br/>
		<textarea id="desc" name="desc" cols="60" rows="8"><?= $data['artwork']['description'] ?></textarea>
		<br/>
		<input type="submit" value="Save" class="button darkGrey" /> 
	</form>
</div>