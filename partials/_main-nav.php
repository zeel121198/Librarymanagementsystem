<?php include_once(dirname(__DIR__) . "/_config.php"); 
 
?>




<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="<?= base_path ?>/">LMS</a>
  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="<?= base_path ?>/">Home</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_path ?>/about.php">About Us</a>
      </li>

      <?php if (ADMIN): ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="blogDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Book Management
          </a>
          <div class="dropdown-menu" aria-labelledby="blogDropdown">
            <a class="dropdown-item" href="<?= base_path ?>/posts/new.php">Add New Book</a>
            <a class="dropdown-item" href="<?= base_path ?>/posts">Update Book</a>
          </div>
          <li class="nav-item">
        <a class="nav-link" href="<?= base_path ?>/issue.php">Issue New Book</a>
      </li>
     
        </li>
      
        
      <?php endif ?>

      <?php if (AUTH): ?>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_path ?>/users/show.php?id=<?= $_SESSION['user']['id'] ?>">My Profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_path ?>/users/issuedbooks.php">Issued Books</a>
        </li>
      <?php endif ?>

      <?php if (ADMIN): ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="usersDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Students
          </a>
          <div class="dropdown-menu" aria-labelledby="usersDropdown">
            <a class="dropdown-item" href="<?= base_path ?>/users/new.php">Create a New student</a>
            <a class="dropdown-item" href="<?= base_path ?>/users">View All Users</a>
          </div>
        </li>
      <?php endif ?>
    </ul>

    <ul class="navbar-nav ml-auto">
      <?php if (!AUTH): ?>
        <li class="nav-item">
          <a href="<?= base_path ?>/sessions/login.php" class="nav-link">
            <i class="fa fa-unlock"></i>&nbsp;Login
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_path ?>/users/new.php" class="nav-link">
            <i class="fa fa-user"></i>&nbsp;Register
          </a>
        </li>
      <?php else: ?>
        <li class="nav-item">
          <a href="<?= base_path ?>/sessions/logout.php" class="nav-link">
            <i class="fa fa-lock"></i>&nbsp;Logout
          </a>
        </li>
      <?php endif ?>
    </ul>
  </div>
</nav>