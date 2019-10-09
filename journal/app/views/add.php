
<?php include "include/head.php"; ?>
<?php include "include/nav.php"; ?>
<?php include "include/banner.php"; ?>

<div class="form-container container">
	<h3 class="form-title">Add Post</h3>
	<form class="add-post-form" action="<?php echo URLROOT;?>/posts/add" method="POST" enctype="multipart/form-data">

		<div class="form-group">
			<label for="image">Select Image:</label>
			<input type="file" name="image" id="image">
		</div>

	  	<div class="form-group">
	    	<label for="title">Title</label>
	    	<input type="text" class="form-control" id="title" name="title">
	  	</div>

	  	<div class="form-group">
	    	<label for="summary">Summary</label>
	    	<textarea class="form-control" id="summary" name="summary" rows="5"></textarea>
	  	</div>

	  	<div class="form-group">
	    	<label for="content">Content</label>
	    	<textarea class="form-control" id="content" name="content" rows="10"></textarea>
	  	</div>

	  	<button type="submit" class="btn btn-primary" name="add">Add Post</button>
	</form>
</div>



<?php include "include/footer.php"; ?>