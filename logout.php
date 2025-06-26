<?php
session_start();
session_unset(); // unsets all the session variables 
session_destroy();  // destroys the session


// JS pop up and redirect
echo "<script>
    alert('You have been logged out.');
    window.location.href = 'auth/login.php'; 
</script>";
exit();
?>
