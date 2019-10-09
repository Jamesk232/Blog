<?php include "include/head.php"; ?>
<?php include "include/nav.php"; ?>


<div class="post-details-container container">
	<!-- post banner -->
	<div class="details-banner">
		<img src="<?php echo URLROOT;?>/uploads/<?php echo $data['post']['image']; ?>">
	</div>
	<!-- post title -->
	<div class="post-details-title">
		<h1><?php echo $data["post"]["title"];?></h1>
			<span class="date-span text-muted">Posted on <?php echo date("m-d-Y", strtotime($data["post"]["upload_date"]));?>
	</span>
	</div>
	<!-- post date -->

	<!-- post content -->
	<div class="post-details-content my-4">
		<p>
			<?php echo nl2br($data["post"]["content"]);?>
		</p>
	</div>
</div>

<?php include "include/footer.php";?>