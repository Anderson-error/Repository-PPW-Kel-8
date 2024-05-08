<?php include 'template/header.php'; ?>

<?php

// cek jika user sudah login, maka alihkan ke halaman utama
if (isset($_SESSION['is_login']) && $_SESSION['is_login'] === true) {
    echo "<script>window.location.href='dashboard.php'</script>";
}

if (isset($_POST['submit'])) {
    $user_login = login($_POST['email'], $_POST['password']);

    if ($user_login === false) {
        echo "<script>alert('Kredensial tidak valid !');</script>";
    } else {
        echo "<script>alert('Login berhasil');</script>";
        echo "<script>window.location.href='dashboard.php'</script>";
    }
}

?>

<main id="main">

    <section id="menu" style="padding: 0;">
        <div class="container">
            <div class="row justify-content-center align-items-center" style="height: 80vh;">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            Login <?= $toko['nama_toko'] ?>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email address</label>
                                    <input 
                                        type="email" 
                                        name="email"
                                        class="form-control" 
                                        id="email"
                                        aria-describedby="emailHelp"
                                        required>
                                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input 
                                        type="password" 
                                        name="password"
                                        class="form-control" 
                                        id="password" 
                                        required>
                                </div>
                                <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<?php include 'template/footer.php'; ?>