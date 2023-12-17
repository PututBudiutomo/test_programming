

<!DOCTYPE html>
<html 
data-theme="light"
lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.20/dist/full.min.css" rel="stylesheet" type="text/css" />

</head>

<body>
    <div class="hero min-h-screen bg-base-200">
        <div class="hero-content flex-col lg:flex-row-reverse">
            <div class="text-center lg:text-left">
                <h1 class="text-5xl font-bold">Register now!</h1>
                <p class="py-6">Provident cupiditate voluptatem et in. Quaerat fugiat ut assumenda excepturi
                    exercitationem quasi. In deleniti eaque aut repudiandae et a id nisi.</p>
            </div>
            <div class="card shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
                <form class="card-body" action="proses_auth.php?aksi=register" method="post">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Nama Langkap</span>
                        </label>
                        <input type="text" name="nama"  id="nama" placeholder="Nama Lengkap" class="input input-bordered" required />
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Email</span>
                        </label>
                        <!-- pesan email sudah terdaftar -->
                        <?php 
                            if (isset($_GET['pesan']) && $_GET['pesan'] === 'gagal') {
                                echo "<div class='alert alert-error'>Email sudah terdaftar!</div>";
                            }
                        ?>
                        <input type="email" name="email"  id="email" placeholder="email" class="input input-bordered" required />
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">No. HP</span>
                        </label>
                        <input type="text" name="no_hp" id="no_hp" placeholder="No Hp" class="input input-bordered" required />
                    </div>


                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Password</span>
                        </label>
                        <input type="password" name="password" id="password" placeholder="password" class="input input-bordered" required />
                    </div>
                    <div class="form-control mt-6">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

                    <label class="label">
                        <h1 class="label-text-alt ">Have account ?</h1>
                        <a href="login.php" class="label-text-alt link link-hover text-blue-500">Login</a>
                    </label>

                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.tailwindcss.com"></script>
</body>

</html>