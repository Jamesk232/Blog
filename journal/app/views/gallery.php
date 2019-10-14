<?php $data["banner-name"] = "index"; ?>

<?php include "include/head.php"; ?>
<?php include "include/nav.php"; ?>
<?php include "include/banner.php"; ?>

<?php if(isset($_SESSION["user_permission"]) && $_SESSION["user_permission"] == "supreme"):?>
<div class="add-image">
	<form action="<?php echo URLROOT;?>/posts/addimage" method="POST" enctype="multipart/form-data">
		<div class="form-group">
			<label for="addImage">Add Image to gallery :</label>
			<input type="file" class="form-control" name="image" id="addImage">
		</div>
		<button type="submit" class="btn btn-primary" name="upload">Upload</button>
	</form>
</div>

<?php endif; ?>

<div class="gallery-container">
	<div class="gallery-col">
		<?php foreach($data["images"] as $images):?>
			<a href="<?php echo URLROOT;?>/posts/fromgallery/<?php echo $images['image'];?>" class="gallery-col-wrapper">
				<img src="<?php echo URLROOT;?>/uploads/<?php echo $images["image"];?>" style="width: 100%;">
			</a>
		<?php endforeach;?>

	</div>

</div>

<?php include "include/footer.php"; ?>