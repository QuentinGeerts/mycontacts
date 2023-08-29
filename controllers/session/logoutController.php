<?php

unset($_SESSION['id']);
unset($_SESSION['email']);
unset($_SESSION['role']);
unset($_SESSION['lastname']);
unset($_SESSION['firstname']);

session_destroy();

header('Location: ?section=login');
