
<?php 
    require_once("./template/heading.php");
    require_once("./connector/connection.php");
    if (isset($_SESSION['user-login'])) {
        // header("Location: index.php");
        windowLocationHref("katalog.php");
    }
    if (isset($_REQUEST['btn-register'])) {
        // header("Location: register.php");
        windowLocationHref("register.php");
    }
    if (isset($_REQUEST['btn-login'])) {
        $email = $_REQUEST['inp-email'];
        $password = $_REQUEST['inp-password'];

        if ($email == "admin" && $password == "meja_kursi_aramyzda_2021") {
            // header("Location: ./admin/index.php");
            $_SESSION['admin'] = "ahiahi";
            windowLocationHref("./admin/index.php");
        }

        $stmt = $conn->prepare("SELECT * FROM user where email = ?");
        $stmt -> bind_param("s", $email);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();

        $usernameKembar = true;
        $passwordKembar = true;
        
        if ($user == null || $user == "") $usernameKembar = false;
        else if ($user['password'] != $password) $passwordKembar = false;

        if (!$usernameKembar) {
            alert('username tidak ada!');
        }
        else if (!$passwordKembar) {
            alert('password salah!');
        }
        else {
            $_SESSION['user-login'] = $user;
            alert('berhasil login');
            windowLocationHref("katalog.php");
        }
    }
?>
    <div class="vh-100  d-flex justify-content-center align-items-center  bg-dark">
        <div class="row h-75 w-75">

            <div class="col-lg-7 col-sm-12 loginBg d-flex justify-content-center align-items-center">
                <div class=" fs-4 text-light">
                     Aramyzda
                </div>
            </div>

            <div class="col-lg-5 col-sm-12 p-5  bg-light">
                <h1>Login</h1>
                <form method="POST">
                    <div class="form-group">
                        <label for="inp-username">Email</label>
                        <input type="text" class="form-control" id="inp-username" placeholder="Enter username or email" name="inp-email">
                    </div>
                    <div class="form-group mb-2">
                        <label for="inp-password">Password</label>
                        <input type="password" class="form-control" id="inp-password" placeholder="Password" name="inp-password">
                    </div>
                    <button name="btn-login" type="submit" class="btn btn-primary">Login</button>
                    <button name="btn-register" type="submit" class="btn border btn-light">Go to register</button>
                </form>
            </div>

        </div>

    </div>
<?php require_once("./template/footing.php")?>