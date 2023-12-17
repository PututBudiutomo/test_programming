<?php 
 include 'header.php';
?>
    <div class="hero min-h-screen bg-base-200">
        <div class="hero-content flex-col lg:flex-row-reverse">
            <!-- handle pesan -->

            <?php 
                if(isset($_GET['pesan']) && $_GET['pesan'] === 'gagal'){
                    echo "<div class='alert alert-error'>Login gagal, email atau password salah!</div>";
                }else if(isset($_GET['pesan']) && $_GET['pesan'] === 'berhasil'){
                    echo "<div class='alert alert-success'>Registrasi berhasil, silahkan login!</div>";
                }
            ?>

            <div class="text-center lg:text-left">
                <h1 class="text-5xl font-bold">Login now!</h1>
                <p class="py-6">Provident cupiditate voluptatem et in. Quaerat fugiat ut assumenda excepturi
                    exercitationem quasi. In deleniti eaque aut repudiandae et a id nisi.</p>
            </div>
            <div class="card shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
                <form action="handle_form/proses_auth.php?aksi=login" method="post" class="card-body">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Email</span>
                        </label>
                        <input type="email" name="email" placeholder="email" class="input input-bordered" required />
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Password</span>
                        </label>
                        <input type="password"  name="password" placeholder="password" class="input input-bordered" required />
                       
                    </div>
                    <div class="form-control mt-6">
                        <button class="btn btn-primary">Login</button>
                    </div>

                    <label class="label">
                        <h1 class="label-text-alt ">Dont have account ?</h1>
                        <a href="register.php" class="label-text-alt link link-hover text-blue-500">Register</a>
                    </label>

                </form>
            </div>
        </div>
    </div>

<?php 
 include 'footer.php';
?>