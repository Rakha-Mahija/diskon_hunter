<?php 
session_start();
include __DIR__ . '/../layout/header.php'; 
include __DIR__ . '/../../service/database.php';

$id = $_SESSION["id_user"];
$periksa = "SELECT * FROM users WHERE id='$id'";   
$result = mysqli_query($db, $periksa);

$row = mysqli_fetch_assoc($result)
?>

<div class="d-flex min-vh-100">
    <?php include __DIR__ . '/../layout/sidebar.php'; ?>

    <div class="flex-grow-1 p-4 bg-light">
        <head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Settings - Diskon Hunter</title>

  <!-- Font: Poppins -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="/main/CSS/Setting.css" />
</head>
<body>

  <main class="page">
    <!-- CARD -->
    <section class="settings-card" aria-label="Settings Card">

      <!-- MENU -->
      <aside class="settings-menu" aria-label="Settings Menu">
        <h1 class="settings-title">Settings</h1>

        <p class="menu-label">Account</p>
        <button class="menu-item active" data-target="panel-profile" type="button">
          Your Profile
        </button>
        <button class="menu-item" data-target="panel-edit" type="button">
          Edit Profile
        </button>

        <p class="menu-label">Actions</p>
        <button class="menu-item danger" data-target="panel-delete" type="button">
          Delete Account
        </button>
      </aside>

      <!--CONTENT -->
      <div class="settings-content" aria-label="Settings Content">
        
        <section id="panel-profile" class="panel show">
        <h2 class="profile-title">Your Profile</h2>

        <div class="profile-card">
            <table class="profile-table">
            <tr>
                <td class="profile-label">"<?= $row['username'] ?>"</td>
                <td class="profile-value" id="profile-name">.</td>
            </tr>
            <tr>
                <td class="profile-label">"<?= $row['email'] ?>"</td>
                <td class="profile-value" id="profile-email">.</td>
            </tr>
            <tr>
                <td class="profile-label">Joined</td>
                <td class="profile-value" id="profile-joined">"<?= $row['created_at'] ?>"</td>
            </tr>
            </table>
        </div>
        </section>

        <!-- EDIT PROFILE -->
        <section id="panel-edit" class="panel">
          <h2 class="panel-title">Edit Profile</h2>

          <form class="form" action="/../../fitur/editproses.php" method="post">
            <div class="field">
              <label for="name">Name</label>
              <input name="username" id="name" type="text" value="<?= $row['username'] ?>" />
            </div>

            <div class="field">
              <label for="email">Email</label>
              <input name="email" id="email" type="email" value="<?= $row['email'] ?>" />
            </div>

            <div class="field">
              <label for="password">New Password</label>
              <input name="password" id="password" type="password" value="<?= $row['password'] ?>" />
            </div>

            <button class="btn primary" type="submit" id="saveChangesBtn" name="edit">
              Save Changes
            </button>
          </form>
        </section>

        <!-- DELETE ACCOUNT -->
        <section id="panel-delete" class="panel">
          <h2 class="panel-title">Delete Account</h2>

          <form action="/../../fitur/delete.php" method="post" >
          <div class="confirm-box">
            <p class="confirm-question">Apakah kamu yakin ingin menghapus account?</p>
            <p class="confirm-desc">
              Tindakan ini <strong>tidak bisa dibatalkan</strong>. Semua data akun akan dihapus permanen.
            </p>

            <div class="confirm-actions">
              <button class="btn danger" type="submit" id="deleteYesBtn" name="hapus">Yes, Delete</button>
            </div>
           </form>
          </div>
        </section>

        

      </div>
    </section>
  </main>

  <script>
    // ======= PANEL SWITCH =======
    const menuItems = document.querySelectorAll(".menu-item");
    const panels = document.querySelectorAll(".panel");

    function openPanel(targetId) {
      panels.forEach(p => p.classList.remove("show"));
      const panel = document.getElementById(targetId);
      if (panel) panel.classList.add("show");
    }

    menuItems.forEach(btn => {
      btn.addEventListener("click", () => {
        menuItems.forEach(b => b.classList.remove("active"));
        btn.classList.add("active");
        openPanel(btn.dataset.target);
      });
    });

    // =======  ACTIONS  =======
    /*const saveBtn = document.getElementById("saveChangesBtn");
    saveBtn.addEventListener("click", () => {
      alert("Changes saved (demo).");
    });
    ijin dijadikan komentar dulu,kalau ada yang sadar tolong di hapus*/
    // Delete account confirm
    document.getElementById("deleteYesBtn").addEventListener("click", () => {
      alert("Account deleted (demo).");
    });
    // Logout confirm
    document.getElementById("logoutYesBtn").addEventListener("click", () => {
      alert("Logged out (demo).");
    });
  </script>

</body>
    </div>
</div>

</body>
</html>
