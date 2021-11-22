<?php 
  require_once("./connector/connection.php");
  if (isset($_SESSION['user-login'])) {
    $stmt = $conn -> prepare("SELECT p.*, c.quantity FROM cart c, product p WHERE id_user = ? AND p.id = c.id_product");
    $stmt -> bind_param("i", $_SESSION['user-login']['id']);
    $stmt -> execute();
    $carts = $stmt -> get_result() -> fetch_all(MYSQLI_ASSOC);
  }
?>
<div id="mySidebar" class="sidebar h-100">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
  <div class="col h-100">
    <div class="row align-self-start d-flex  justify-content-center text-light fs-4 ">Your Cart</div>

    <div class=" align-item-start h-75 ">
      <!-- cek ada user  -->
    <?php if(isset($_SESSION['user-login'])){
      foreach ($carts as $key => $cart) { 
    ?>
      <div class="d-flex justify-content-center cart-item" style="height: 75px;">
        <div class=" m-1 gbrCart d-flex justify-content-center align-items-center hoverable expand-hover" style="width:20%">
          <img class="h-100" src="<?=$cart['image_source']?>" alt="" class="itemGbrCart">
        </div>
        <div class=" m-1 itemNameCart d-flex text-light align-items-center" style="width:70%;">
          <?=$cart['name']?>
        </div>
        <div class="m-1 itemCountCart d-flex text-light align-items-center" style="width:10%">
          <?= $cart['quantity'] ?>x
        </div>
      </div>
    <?php
      }
    ?>
      </div>
      <div class="row align-self-end text-light h-25 d-flex justify-content-center">
        <a href="./cart.php" class="d-flex justify-content-center">
          <button class="button" href="./cart.php"><span>To Checkout </span></button>
        </a>
      </div>
    <?php
    }
    else{
    ?>
      <div class="d-flex justify-content-center align-items-center">
            <a class="d-flex justify-content-center align-items-center" style="text-decoration:none;" href="login.php"> Please Login first
            </a>
      </div>
    </div>
      <div class="row align-self-end text-light h-25 d-flex justify-content-center">

      </div>
    <?php
    }
    ?>
    
  </div>
</div>


<script>
function openNav() {
  document.getElementById("mySidebar").style.width = "400px";
  
}

function closeNav() {
  document.getElementById("mySidebar").style.width = "0";
  
}
function mobileOpen(){
  $("#theMobileSidebar").removeClass("mobileSidebarClosed");
  $("#theMobileSidebar").addClass("mobileSidebar");
}
function mobileClose(){
  $("#theMobileSidebar").addClass("mobileSidebarClosed");
  $("#theMobileSidebar").removeClass("mobileSidebar");
}
</script>
<div class="mobileSidebarClosed p-2" id="theMobileSidebar">
    <ul class = "d-flex flex-column list-style-none fs-6 text light">
      <li class="iconSidebar fs-1  pb-5 text-light align-self-end" onclick="mobileClose()"><i class="fa fa-bars"></i> </li>

      <a class="" style="text-decoration:none;" href="index.php">
        <li class = "text-light pt-5 pb-3 fs-4">HOME</li>
      </a>
      <a class="" style="text-decoration:none;" href="katalog.php">
        <li class = "text-light pb-3 fs-4">CATALOGUE</li>
      </a>
      <a class="" style="text-decoration:none;" href="profile.php">
        <li class = "text-light pb-3 fs-4">ACCOUNT</li>
      </a>
      <a class="" style="text-decoration:none;" href="cart.php">
        <li class = "text-light pb-3 fs-4">CHECK OUT</li>
      </a>
    </ul>
</div>
<div class="mainHead pcView">
    <div class="headBg col-12 "></div>
    <div class="col-12" id ="header">
    <div class="d-flex  text-white p-3">
      <div class="w-25 text-dark">
        kiri
      </div>
      <a href="./index.php" class="w-50 fs-1 d-flex justify-content-center text-center" style="text-decoration:none;">
        <div class="w-50 fs-1 text-center text-light">
          <!-- Aramyzda logo-->
          Aramyzda
        </div>
      </a>

      <div class="w-25 ">
      <ul class="d-flex list-style-none justify-content-end align-items-center fs-6 h-100">
          <li class="px-2">
            <i class="fa fa-search" aria-hidden="true"></i> Search
          </li>
          <li class="px-2">
            <?php 
              if (isset($_SESSION['user-login'])) {
            ?>
              <div class="dropdown">
                <a class="text-light text-decoration-none dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-user" aria-hidden="true"></i> <?= $_SESSION['user-login']['first_name'] ?>
                </a>

                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                  <li><a class="dropdown-item" href="" onclick="logOff()">Log Off</a></li>
                </ul>
              </div>
            <?php 
              } else {
            ?>
              <a href="login.php" class="text-light text-decoration-none"><i class="fa fa-user" aria-hidden="true"></i> Account</a>
            <?php 
              }
            ?>
          </li>
          <li class="px-2 pe-4" onclick="openNav()">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart
          </li>
        </ul>
      </div>
    </div>
    <div class="w-100 d-flex">
      <ul class="w-25 bg-black text-light align-items-center d-flex">
            
      </ul>
      <ul class="d-flex w-50 bg-black p-1 justify-content-center align-items-center list-style-none ">
        <a class="text-light nav-link active" href="index.php"><li>HOME</li></a>
        <a class="text-light nav-link active" href="katalog.php"><li>CATALOGUE</li></a>
        <a class="text-light nav-link active" href="cart.php"><li>CART</li></a>
        <a class="text-light nav-link active" href="#"><li>TRANSACTION</li></a>
      </ul>
      <ul class="w-25 bg-black d-flex justify-content-end">
        kanan 
      </ul>
    </div>
  </div>
</div>

<div class="mainHead mobileView ">
    <div class="headBg col-12 "></div>
    <div class="col-12" id ="header">
    <div class="d-flex  text-white p-3">
      <div class="w-25 text-dark">
        <div class="fa fa-bars text-light fs-1" onclick="mobileOpen()"></div>
          
      </div>
      <div class="w-50 text-light fs-1 text-center">
        <!-- Aramyzda logo-->
        Aramyzda
      </div>
      <div class="w-25 text-dark">
        kanan
      </div>

    </div>
    <?php 
          if (isset($_SESSION['user-login'])) {
        ?>
          <ul class="w-100 text-light justify-content-end p-3 d-flex">
            Welcome,  <?= $_SESSION['user-login']['first_name'] ?>
          </ul>
          <?php
          }
          else{
          ?>
            <ul class="w-100 align-items-center d-flex">
            
            </ul>
          <?php
          }
          ?>
    
    
  </div>
</div>

<script>
  function logOff() {
    $.ajax({
      type: "post",
      url: "./ajax/log_off.php",
      success: function (response) {

      }
    });
  }
</script>

<?php 
  // echo "<pre>";
  // print_r($_SESSION);
  // echo "</pre>";
?>