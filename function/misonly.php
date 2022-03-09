<?php

if (strpos($fullname, 'admin.') !== false) {

}else{
    echo"<script>
        alert('For MIS Memeber only');
        window.location.href = 'index.php';
    </script>";
}




?>
