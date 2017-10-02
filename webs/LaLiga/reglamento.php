<?php
include('../../menuinicial.php');
$ipvisitante=$_SERVER["REMOTE_ADDR"];
ContadorVisitas($ipvisitante,'reglamento');
?>


<?php
include('../../footerinicial.php');
?>

<script src="webs/js/reglamento.js"></script>
