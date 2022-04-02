<?php
require('./public/header.php');
require('./public/views/generator.php');
echo"</header>";
if (isset($_GET['page'])) {
    if (file_exists('./public/views/' . $_GET['page'] . '.php')) {
        require('./public/views/' . $_GET['page'] . '.php');
    } else {
        require('./public/views/error.php');
    }
	require('./public/footer.php');
} else {
?>

<?php 
	require('./public/footer.php');
}
?>