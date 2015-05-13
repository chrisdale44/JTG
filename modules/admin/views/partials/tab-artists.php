<a href="index.php?admin&amp;p=artist" class="button">Add new artist</a>

<table class="admin-table">
	<tr>
		<th>
			Artist
		</th>
		<th>
			Bio
		</th>
		<th>
			Edit
		</th>
		<th>
			Delete
		</th>
	</tr>
<? while($row = mysqli_fetch_array($data['artists'])): ?>
	<tr>
		<td>
			<?= $row['forename'] ?> <?= $row['surname'] ?>
		</td>
		<td>
			<?= substr($row['bio'], 0, 30) ?><? if(strlen($row['bio']) > 30) : ?>...<? endif; ?>
		</td>
		<td>
			<a href="index.php?admin&amp;p=artist&amp;id=<?= $row['artistId'] ?>">Edit</a>
		</td>
		<td>
			<a href="index.php?admin&amp;p=dash&amp;method=delartist&amp;id=<?= $row['artistId'] ?>">Delete</a>
		</td>
	</tr>
<? endwhile; ?>
</table>