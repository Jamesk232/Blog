<?php include "include/head.php"; ?>
<?php include "include/nav.php"; ?>
<?php include "include/banner.php"; ?>


<div class="content-container container">
	<div class="row justify-content-between">

		<!-- posts container holds all posts -->
		<div class="posts-container col-md-8">

			<!-- featured post -->
			<?php if($data["posts"]): ?>

			<a class="featured-link" href="<?php echo URLROOT;?>/posts/singlepost/<?php echo $data['posts'][0]['id'];?>">
				<div class="featured-post">
					<h5 style="color: #000;">Featured Post</h5>
					<!-- featured post image -->
					<div class="featured-post-img">
						<img src="<?php echo URLROOT;?>/uploads/<?php echo $data['posts'][0]['image'];?>">
					</div>

					<!-- featured title -->
					<div class="featured-post-title">
						<h3><?php echo $data["posts"][0]["title"]; ?></h3>
					</div>

					<!-- featured upload date -->
					<div class="featured-post-date pb-2">
						<span class="date-span text-muted">Uploaded on: <?php echo $data["posts"][0]["upload_date"]; ?></span>
					</div>

					<!-- featured post summary -->
					<div class="featured-post-summary">
						<?php echo $data["posts"][0]["summary"]; ?>
					</div>

				</div>
			</a>

			<!-- The rest of the posts -->
			<div class="posts-wrapper col d-flex flex-wrap">
				<?php foreach($data["posts"] as $posts): ?>

					<!-- post -->
					<a class="post-link" href="<?php echo URLROOT;?>/posts/singlepost/<?php echo $posts['id'];?>">
						<div class="post f-flex flex-row">

							<!-- post image -->
							<div class="post-image">
								<img src="<?php echo URLROOT;?>/uploads/<?php echo $posts['image'];?>">
							</div>

							<!-- post title -->
							<div class="post-title">
								<h4><?php echo $posts["title"];?></h4>
							</div>

							<!-- upload date -->
							<div class="post-date">
								<span class="date-span text-muted">Uploaded on: <?php echo $posts["upload_date"]; ?></span>
							</div>

							<!-- post summary -->
							<div class="post-summary">
								<?php echo $posts["summary"]; ?>
							</div>
						
						</div>
					</a>

				<?php endforeach; ?>
			</div>
			<?php else: ?>
				<div class="no-post" style="width: 200px; margin: 50px auto; text-align: center;"><?php echo "NO POSTS YET"; ?></div>
			<?php endif; ?>
		</div>

		<!-- about me container -->
		<div class="about-container d-flex flex-column col-md-4">

			<!-- about me title -->
			<h5>About Me</h5>

			<!-- about me profile pic -->
			<div class="about-img">
				<img src="<?php echo URLROOT;?>/uploads/IMG-2445.jpg">
			</div>

			<!-- about me name -->
			<div class="about-name">
				<h5>James Karanja</h5>
			</div>

			<!-- about text -->
			<div class="about-text">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			</div>

			<!-- about social -->
			<div class="about-social">
				<a href="#0"><i class="fa fa-lg fa-facebook" aria-hidden="true"></i></a>
				<a href="#0"><i class="fa fa-lg fa-instagram" aria-hidden="true"></i></a>
			</div>
		</div>
	</div>
</div>


<?php include "include/footer.php"; ?>
