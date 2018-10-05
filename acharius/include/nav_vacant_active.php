<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container">

      <div class="dropdown">
      <button class="dropbtn"><img style="vertical-align:middle" src="https://www.achariuslab.com/account/img/user.png" height="20px" width="20px"></button>
      <div class="dropdown-content">
        <a href="https://www.achariuslab.com/account/self/index.php">My profile</a>
        <a href="https://www.achariuslab.com/account/logout.php">Log out</a>
      </div>
    </div>


    <style>
    /* Style The Dropdown Button */
    .dropbtn {
        background-color: #4CAF50;
        color: white;
        padding: 16px;
        font-size: 16px;
        border: none;
        cursor: pointer;
    }

    /* The container <div> - needed to position the dropdown content */
    .dropdown {
        position: relative;
        display: inline-block;
    }

    /* Dropdown Content (Hidden by Default) */
    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
    }

    /* Links inside the dropdown */
    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    /* Change color of dropdown links on hover */
    .dropdown-content a:hover {background-color: #f1f1f1}

    /* Show the dropdown menu on hover */
    .dropdown:hover .dropdown-content {
        display: block;
    }

    /* Change the background color of the dropdown button when the dropdown content is shown */
    .dropdown:hover .dropbtn {
        background-color: #3e8e41;
    }
    </style>


    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="https://www.achariuslab.com/account/participative.php" style="color:#7fb0ff;">Participative

          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="https://www.achariuslab.com/account/index.php">My parcels

          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="https://www.achariuslab.com/account/top.php">Top</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="https://www.achariuslab.com/account/vacant.php">To buy
            <span class="sr-only">(current)</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="https://www.achariuslab.com/account/showcase.php">ShowCase</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
