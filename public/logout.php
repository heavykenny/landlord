<?php

function removeTokenFromCookie(): void
{
    setcookie('token', '', time() - 3600, '/');
    header('Location: index.php');
}

removeTokenFromCookie();