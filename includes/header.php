<ul class="topnav">
  <?php if (isset($_SESSION['id'])) { ?>
    <!-- <div class="button" onclick="location.href='./includes/logout.php'">
    Signout
  </div> -->

    <li class="right"><a href="./includes/logout.php">Sign out</a>
    <?php } else { ?>
      <!-- <div class="button" onclick="location.href='./forms/signup_form.php'">
        Signup
      </div> -->
    <li><a href="./forms/signup_form">Sign Up</a></li>
  <?php } ?>
  <?php if (isset($_SESSION['id'])) { ?>
    <!-- <div class="button" onclick="location.href='./camera.php'">
      Camera
    </div> -->
    <li><a href="./camera.php">Camera</a></li>
    <!-- <div class="button" onclick="location.href='./gallery.php'">
      Gallery
    </div> -->
    <li><a href="./gallery.php">Gallery</a>
    <li><a href="./index.php">home</a>
    <li><a href="./updateInfo.php">edit info</a>
    <?php } ?>
    </div>