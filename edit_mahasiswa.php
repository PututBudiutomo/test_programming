<?php
include 'class/Mahasiswa.php';
$mahasiswa = new Mahasiswa();
$nim = $_GET['nim'];
$data = $mahasiswa->edit($nim);

?>

<?php
include 'header.php';
?>


<main class="h-auto border berder-2xl mt-20 flex">
    <?php
    include 'navbar.php';
    ?>
    <div class="p-20 w-auto  ">
        <form class="p-5 border w-[600px]" action="handle_form/proses_mahasiswa.php?aksi=update" method="post">
            <div class="form-control">
                <label class="label">
                    <span class="label-text">Nama Mahasiswa</span>
                </label>
                <input type="text" name="nama" id="nama" placeholder="Nama Lengkap" class="input input-bordered"
                    required value="<?= $data['nama'] ?>" />
            </div>

            <div class="form-control">
                <label class="label">
                    <span class="label-text">Nim</span>
                </label>
                <input type="text" name="nim" id="nim" placeholder="Nim" class="input input-bordered" required value="<?= $data['nim'] ?>"/>
            </div>

            <div class="form-control">
                <label class="label">
                    <span class="label-text">Program Studi</span>
                </label>
                <input type="text" name="prodi" id="prodi" placeholder="Program Studi" class="input input-bordered"
                    required  value="<?= $data['program_studi'] ?>" />
            </div>

            <div class="form-control">
                <label class="label">
                    <span class="label-text">No Hp</span>
                </label>
                <input type="text" name="no_hp" id="no_hp" placeholder="No Hp" class="input input-bordered" required  value="<?= $data['no_hp'] ?>"/>
            </div>
            <div class="form-control mt-6">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</main>

<?php
include 'footer.php';
?>

