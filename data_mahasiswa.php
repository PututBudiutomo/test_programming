<?php
include 'class/Mahasiswa.php';
$mahasiswa = new Mahasiswa();

if (isset($_POST['keyword'])) {
    $result = $mahasiswa->search($_POST['keyword']);
} else {
    // Jika tidak ada pencarian, tampilkan semua data
    $result = $mahasiswa->index();
}
?>

<?php
include 'header.php';
?>
<main class="h-auto border berder-2xl mt-20 flex">

    <?php
    include 'navbar.php';
    ?>

    <div class="p-20 ">
        <div class="flex mb-5 gap-5">
            <h1 class="text-3xl font-bold">Data Mahasiswa</h1>
            <btn class="btn btn-primary" onclick="my_modal_1.showModal()">Tambah Data</btn>

            <form  method="post">
                <input type="text" name="keyword" placeholder="Cari Data" class="input input-bordered w-96">
                <input type="submit" value="Cari" class="btn btn-primary">
            </form>
        </div>
        <div class="overflow-x-auto border">
            <table class="table">
                <!-- head -->
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>Nim</th>
                        <th>Program Studi</th>
                        <th>No.Hp</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($result as $data):
                        ?>
                        <tr class="text-center">
                            <td>
                                <?= $no++; ?>
                            </td>
                            <td>
                                <?= $data['nama']; ?>
                            </td>
                            <td>
                                <?= $data['nim']; ?>
                            </td>
                            <td>
                                <?= $data['program_studi']; ?>
                            </td>
                            <td>
                                <?= $data['no_hp']; ?>
                            </td>
                            <td>
                            <a href="edit_mahasiswa.php?nim=<?= $data['nim']; ?>" class="btn btn-primary">Edit</a>
                            <a href="#" class="btn btn-error">Hapus</a>
                            </td>
                        <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>
</main>

<?php
include 'footer.php';
?>

<!-- dialog tambah -->

<dialog id="my_modal_1" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Tambah data mahasiswa</h3>
        <p class="py-4">Press ESC key or click the button below to close</p>
        <form action="handle_form/proses_mahasiswa.php?aksi=tambah" method="post">
            <div class="form-control">
                <label class="label">
                    <span class="label-text">Nama Mahasiswa</span>
                </label>
                <input type="text" name="nama" id="nama" placeholder="Nama Lengkap" class="input input-bordered"
                    required />
            </div>

            <div class="form-control">
                <label class="label">
                    <span class="label-text">Nim</span>
                </label>
                <input type="text" name="nim" id="nim" placeholder="Nim" class="input input-bordered" required />
            </div>

            <div class="form-control">
                <label class="label">
                    <span class="label-text">Program Studi</span>
                </label>
                <input type="text" name="prodi" id="prodi" placeholder="Program Studi"
                    class="input input-bordered" required />
            </div>

            <div class="form-control">
                <label class="label">
                    <span class="label-text">No Hp</span>
                </label>
                <input type="text" name="no_hp" id="no_hp" placeholder="No Hp" class="input input-bordered" required />
            </div>
            <div class="form-control mt-6">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </form>
        <div class="modal-action">
            <form method="dialog">
                <button class="btn">Close</button>
            </form>
        </div>
    </div>
</dialog>
<!-- end dialog tambah -->>