<?php 

session_start();

if(!isset($_SESSION['status'])){
    header("location: index.php");
}
?>

<?php 
include 'header.php';
?>

    <header class="flex px-48 h-auto py-8 bg-white shadow drop-shadow-md items-center w-screen fixed insert-0 z-50 top-0">
        <a href="dashboard.php" class="text-2xl font-bold text-blue-600">Sistem Informasi Akademik</a>
    </header>

    <main class="h-auto border berder-2xl mt-20 flex">
        <nav class="h-screen py-10 border fixed insert-0 z-40">
            <ul class="flex flex-col">
                <li class="py-2 px-8 border-b border-gray-200">
                    <a href="dashboard.php" class="text-blue-600 font-bold">Dashboard</a>
                </li>
                <li class="py-2 px-8 border-b border-gray-200">
                    <a href="mahasiswa.php" class="text-blue-600 font-bold"> Data Mahasiswa</a>
                </li>
                <li class="py-2 px-8 border-b border-gray-200">
                    <a href="Prodi.php" class="text-blue-600 font-bold">Data Pogram Studi</a>
                </li>
                <li class="py-2 px-8 border-b border-gray-200">
                    <a href="matakuliah.php" class="text-blue-600 font-bold">Data Matakuliah</a>
                </li>
                <li class="py-2 px-8 border-b border-gray-200">
                    <a href="logout.php" class="text-blue-600 font-bold">Logout</a>
                </li>
            </ul>

        </nav>
    </main>

<?php 
include 'footer.php';
?>