<!-- artist navigation bar -->
<ul class="artistNav">
	<li>
		<a href="javascript:void(0);" data-filter="*" class="selected">
			View All
		</a>
	</li>
	<? if (mysqli_num_rows($data['artists'])) :
		while ($row = mysqli_fetch_array($data['artists'])) : ?>
	<li>
		<a href="javascript:void(0);" data-filter=".<?= $row['artistId'] ?>">
			<?= $row["forename"] ?> <?= $row["surname"] ?>
		</a>
	</li>
	<? endwhile;
	endif; ?>
</ul>

<!-- image grid of artwork -->
<div class="img-grid-container">
	<? if (mysqli_num_rows($data['artwork'])) : 
		while ($row = mysqli_fetch_array($data['artwork'])) : ?>
		<div class="tile <?= $row['artistId'] ?> animated">
			<a href="/images/artwork/<?= $row['image'] ?>" class="img-container" data-rel="lightcase">
				<img src="/images/artwork/<?= $row['image'] ?>" 
					alt="<?= $row["title"] ?> by <?= $row["forename"] ?> <?= $row["surname"] ?>" />
			</a>			
			<div class="art-info">
				<a href="javascript:void(0);" class="artist" data-filter=".<?= $row['artistId'] ?>"><?= $row["forename"] ?> <?= $row["surname"] ?></a>
				<a href="/images/artwork/<?= $row['image'] ?>" class="title" data-rel="lightcase"><?= $row["title"] ?></a>
			</div>
		</div>
	<? endwhile; 
	endif; ?>
</div>