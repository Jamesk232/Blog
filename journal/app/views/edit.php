<?php include "include/head.php"; ?>
<?php include "include/nav.php"; ?>


<div class="form-container container">
	<h3 class="form-title">Edit Post</h3>
	<form class="edit-post-form" method="POST" action="<?php echo URLROOT;?>/posts/edit/<?php echo $data['post']['id'];?>">

		<div class="form-group">
			<label for="title">Title</label>
			<input type="text" class="form-control" name="title" id="title" value="<?php echo $data['title'];?>">
		</div>

		<div class="form-group">
			<label for="summary">Summary</label>
			<textarea type="text" class="form-control" rows="10" name="summary" id="summary"><?php echo $data['summary'];?></textarea>
		</div>		

		<div class="form-group">
			<label for="content">Content</label>
			<textarea type="text" class="form-control" rows="10" name="content" id="content" placeholder="content"><?php echo $data['content'];?></textarea>			
		</div>

		<button type="submit" class="btn btn-primary" name="edit">Finish Editing</button>
	</form>
</div>


<?php include "include/footer.php"; ?>