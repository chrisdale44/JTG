<a href="index.php?admin&amp;p=artwork" class="button">Add new artwork</a>

<table class="admin-table">
	<tr>
		<th>
			Artist
		</th>
		<th>
			Image
		</th>
		<th>
			Title
		</th>
		<th>
			Year
		</th>
		<th>
			Description
		</th>
		<th>
			Live
		</th>
		<th>
			Edit
		</th>
		<th>
			Delete
		</th>
	</tr>
<? while($row = mysqli_fetch_array($data['artwork'])): ?>
	<tr>
		<td>
			<?= $row['forename'] ?> <?= $row['surname'] ?>
		</td>
		<td>
			<img src="/fine_art_prints/images/artwork/<?= $row['image'] ?>" alt="<?= $row['title'] ?> by <?= $row['forename'] ?> <?= $row['surname'] ?>" class="artwork-small" />
		</td>
		<td>
			<?= $row['title'] ?>
		</td>
		<td>
			<?= $row['year'] ?>
		</td>
		<td>
			<?= substr($row['description'], 0, 30) ?><? if(strlen($row['description']) > 30) : ?>...<? endif; ?>
		</td>
		<td>
			<a href="index.php?admin&amp;p=dash&amp;method=toggle&amp;id=<?= $row['artID'] ?>&amp;bool=<?= $row['live'] ?>"><?= $data['bool'][$row['live']] ?></a>
		</td>
		<td>
			<a href="index.php?admin&amp;p=artwork&amp;id=<?= $row['artID'] ?>">Edit</a>
		</td>
		<td>
			<a href="index.php?admin&amp;p=dash&amp;method=delart&amp;id=<?= $row['artID'] ?>">Delete</a>
		</td>
	</tr>
<? endwhile; ?>
</table>