
<?php include "include/head.php"; ?>
<?php include "include/nav.php"; ?>

<div class="form-container container">

	<h3 class="form-title">Add Post</h3>
	<form class="add-post-form" action="<?php echo URLROOT;?>/posts/add" method="POST" enctype="multipart/form-data">

		<div class="form-group">
			<label for="image">Select Image:</label>
			<input type="file" name="image" id="image">
			<span class="error-reporting">
				<?php echo ($data["image_err"] ? $data["image_err"] : "");?>
			</span>
		</div>

	  	<div class="form-group">
	    	<label for="title">Title</label>
	    	<input type="text" class="form-control" id="title" name="title" value="<?php echo $data['title'] ? $data['title'] : '';?>">
			<span class="error-reporting">
				<?php echo ($data["title_err"] ? $data["title_err"] : "");?>
			</span>
	  	</div>

	  	<div class="form-group">
	    	<label for="summary">Summary</label>
	    	<textarea class="form-control" id="summary" name="summary" rows="5"><?php echo $data['summary'] ? $data['summary'] : '';?></textarea>
			<span class="error-reporting">
				<?php echo ($data["summary_err"] ? $data["summary_err"] : "");?>
			</span>
	  	</div>

	  	<div class="form-group">
	    	<label for="content">Content</label>
	    	<textarea class="form-control" id="content" name="content" rows="10"><?php echo $data['content'] ? $data['content'] : '';?></textarea>
			<span class="error-reporting">
				<?php echo ($data["content_err"] ? $data["content_err"] : "");?>
			</span>
	  	</div>

	  	<button type="submit" class="btn btn-primary" name="add">Add Post</button>
	</form>
</div>



<?php include "include/footer.php"; ?>