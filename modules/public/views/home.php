<!-- artist navigation bar -->
<ul class="artistNav">
	<li>
		<a href="#" data-filter="*" class="selected">
			View All
		</a>
	</li>
	<? foreach ($data['artists'] as $key => $row) : ?>
	<li>
		<a href="#" data-filter=".<?= $row['artistID'] ?>">
			<?= $row["forename"] ?> <?= $row["surname"] ?>
		</a>
	</li>
	<? endforeach; ?>
</ul>

<!-- image grid of artwork -->
<div class="img-grid-container">
	<? foreach ($data['artwork'] as $key => $row) : ?>
		<div class="tile <?= $row['artistID'] ?> animated">
			<a href="/fine_art_prints/images/artwork/<?= strtolower($row['image']) ?>" class="img-container" data-rel="lightcase">
				<img src="/fine_art_prints/images/artwork/<?= strtolower($row['image']) ?>" 
					alt="<?= $row["title"] ?> by <?= $row["forename"] ?> <?= $row["surname"] ?>" />
				<div class="title">
					<?= $row["title"] ?> by <?= $row["forename"] ?> <?= $row["surname"] ?>
				</div>
			</a>			
		</div>
	<? endforeach; ?>
</div>