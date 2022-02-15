<?php
session_start();
unset($_SESSION['user']);
unset($_SESSION['dataOfSign']);
unset($_SESSION['url']);
unset($_SESSION['leftMenu']);
header('Location: home');