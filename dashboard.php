<?php 
session_start();
if(!isset($_SESSION['status'])){
    header("location: index.php");
}
?>

<?php 
include 'header.php';
?>

   
    <main class="h-auto border berder-2xl mt-20 flex">
      
        <?php 
        include 'navbar.php';   
        ?>

        <div>
            
        </div>
    </main>

<?php 
include 'footer.php';
?>