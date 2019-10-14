<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">kcode</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">

    <ul class="navbar-nav m-auto">

      <li class="nav-item">
        <a class="nav-link" href="<?php echo URLROOT;?>">Home</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?php echo URLROOT;?>/pages/gallery">Gallery</a>
      </li>

<!--       <li class="nav-item">
        <a class="nav-link" href="#">Contact</a>
      </li> -->

      <?php if(isset($_SESSION["user"])): ?>

        <?php if($_SESSION["user_permission"] == "supreme"):?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT;?>/posts/add">Add Post</a>
          </li>
        <?php endif; ?>
      <?php endif;?>
    </ul>

    <div class="log-btn d-flex">
      <?php if(isset($_SESSION["user"])): ?>
          <a class="log-btn-link nav-link text-danger" href="<?php echo URLROOT;?>/users/logout">logout</a>
      <?php else: ?>
          <a class="log-btn-link nav-link" href="<?php echo URLROOT;?>/users/register">Register</a>
          <a class="log-btn-link nav-link" href="<?php echo URLROOT;?>/users/login">login</a>
      <?php endif;?>
    </div>
  </div>
</nav>