<?php
$page = basename($_SERVER['PHP_SELF']);
if(isset($_POST['logout'])){
    session_unset();
    session_destroy();
    header('location: login.php');

    exit;
}
?>

<div class="sidebar bg-dark text-white p-3 d-flex flex-column">

    <!-- BAGIAN ATAS -->
    <div>
        <h4 class="text-center mb-4">Dashboard</h4>

        <div class="d-grid gap-2">
        <a href="/main/Dashboard/produk.php" class="btn btn-outline-light <?= $page == 'produk.php' ? 'active' : '' ?>">Produk</a>
        <a href="/main/Dashboard/history.php" class="btn btn-outline-light <?= $page == 'history.php' ? 'active' : '' ?>">History</a>
        <a href="/main/Dashboard/profile.php" class="btn btn-outline-light <?= $page == 'profile.php' ? 'active' : '' ?>">Profile</a>
        </div>
    </div>

    <!-- BAGIAN BAWAH -->
    <div class="d-grid gap-2 mt-auto">
        <a href="/main/index.php" class="btn btn-outline-light">Home</a>
        <form method="post" action="/fitur/logout.php">
            <button type="submit" class="btn btn-outline-light w-100" name="logout">Log out</button>
        </form>
    </div>

</div>
