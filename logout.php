<?php
session_start();
if(session_destroy()) // Destroying All Sessions
{
header("Location: http://localhost/ComplaintRegistration/complaintStatus.php"); // Redirecting To Home Page
}
?>