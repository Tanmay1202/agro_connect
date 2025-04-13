<?php
session_start();
session_destroy();//clears all session data
header("Location: LoginPage.php");//redirects to login
exit();//prevents further execution

?>