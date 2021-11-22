<?php require_once("../template/heading.php")?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Admin</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="crud.php">Entry</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="stock-management.php">Stock Management</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="report.php">Report</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- code here -->

<?php require_once("../template/footing.php")?>