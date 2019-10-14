<?php include "include/head.php"; ?>
<?php include "include/nav.php"; ?>

<?php if(empty($data["post"])):?>
	<?php header("Location:".URLROOT."/pages/gallery");?>

	<?php else: ?>
		<div class="post-details-container container">
			<!-- edit and delete button -->
			<?php if(isset($_SESSION["user_permission"]) && $_SESSION["user_permission"] == "supreme"):?>
				<div class="post-buttons d-flex justify-content-end">
					<a class="edit-button text-primary" href="<?php echo URLROOT;?>/posts/edit/<?php echo $data['post']['id'];?>">Edit</a>
					<a class="delete-button text-danger" href="<?php echo URLROOT;?>/posts/delete/<?php echo $data['post']['id'];?>">Delete</a>
				</div>
			<?php endif; ?>
			<!-- post banner -->
			<div class="details-banner">
				<img src="<?php echo URLROOT;?>/uploads/<?php echo $data['post']['image']; ?>">
			</div>
			<!-- post title -->
			<div class="post-details-title d-flex flex-column">
				<h1><?php echo $data["post"]["title"];?></h1>
				<!-- date -->
				<span class="date-span text-muted">Posted on <?php echo date("m-d-Y", strtotime($data["post"]["upload_date"]));?></span>

			</div>

			<!-- post content -->
			<div class="post-details-content my-4">
				<p>
					<?php echo nl2br($data["post"]["content"]);?>
				</p>
			</div>
		</div>
	<?php endif; ?>

<?php include "include/footer.php";?>