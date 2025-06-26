<?php
session_start();
session_unset();
session_destroy();

echo "<script>
    alert('You have been logged out.');
    window.location.href = 'auth/login.php'; // or wherever you want to send them
</script>";
exit();
?>
