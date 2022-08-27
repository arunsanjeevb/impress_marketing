<?php
    session_start();
    session_destroy();
    setcookie("user_session", $user, time()-(3600*24*5));
    setcookie("role_session", $role, time()-(3600*24*5));
    setcookie("applist_session", $applist, time()-(3600*24*5));
    setcookie("rolelist_session", $rolelist, time()-(3600*24*5));
    header("Location:../index.php");
    
