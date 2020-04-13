<?php
session_start();
if (!isset($_SESSION['us']) || empty($_SESSION['us']))
{
	header('Location: ../index.html');
}
?>