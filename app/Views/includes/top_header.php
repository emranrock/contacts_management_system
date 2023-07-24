<header>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="#"><?= ucfirst($sitename); ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="<?php echo base_url(); ?>">Home <span class="sr-only">(current)</span></a>
        </li>

      </ul>
      <!-- <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form> -->
      <ul class="navbar-nav navbar-right">
        <?php
        if (isset($_SESSION['logged_in'])) { ?>
          <li class="nav-item">
            <a class="nav-link" href="#">Time Spent:- <span id="timer"></span></a>
          </li>
          <li class="nav-item">
            <label for="" class="nav-link">Welcome <?php echo $_SESSION['name']; ?></label>
          </li>
          <li class="nav-item">
            <a class="btn nav-link logout_btn" href="<?php echo base_url('home/logout'); ?>">Logout</a>
          </li>
        <?php } else { ?>
          <li class="nav-item">
            <a class="btn btn-secondary nav-link trigger-btn" data-toggle="modal" href="#login_modal">Login</a>
          </li>
        <?php } ?>
        <li class="nav-item">
          <a class="nav-link" href="#">Page Execution Time <?php //echo $this->benchmark->elapsed_time(); ?></a>
        </li>
      </ul>
    </div>
  </nav>
</header>