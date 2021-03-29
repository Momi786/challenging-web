<?php

session_start();

function urlPrefix()
{
    if (basename(getcwd()) === basename(__DIR__)) {
        return './';
    } elseif (basename(dirname(getcwd())) === basename(__DIR__)) {
        return '../';
    } elseif (basename(dirname(dirname(getcwd()))) === basename(__DIR__)) {
        return '../../';
    } elseif (basename(dirname(dirname(dirname(getcwd())))) === basename(__DIR__)) {
        return '../../../';
    } else {
        return './';
    }
}

if (isset($_SESSION['id'])) {
    if (basename(getcwd()) === 'login'  || basename(getcwd()) === 'register'  || basename(getcwd()) === basename(__DIR__)) {
        header("Location: " . urlPrefix() . "dashboard/");
        die();
    } else {
    }
} else {
    if (strpos(getcwd(), 'dashboard') === false) {
    } else {
        header("Location: " . urlPrefix() . "php-apis/logout.php");
        die();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <title>Challenge Site</title>
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-light bg-white shadow">
        <div class="container-fluid">
            <ul class="navbar-nav me-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-list"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li>
                            <a class="dropdown-item" href="<?php echo urlPrefix(); ?>"><i class="bi bi-person-fill me-2"></i>Home</a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <?php if (isset($_SESSION['id'])) { ?>

                            <li><a class="dropdown-item" href="<?php echo urlPrefix() . 'dashboard/'; ?>">Dashboard</a></li>
                            <li><a class="dropdown-item" href="<?php echo urlPrefix() . 'dashboard/find-opponent/'; ?>">Find Opponent</a></li>
                            <li><a class="dropdown-item" href="<?php echo urlPrefix() . 'dashboard/challenges/'; ?>">Challenges</a></li>
                            <li><a class="dropdown-item" href="<?php echo urlPrefix() . 'dashboard/tournaments/'; ?>">Tournaments</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="<?php echo urlPrefix() . 'dashboard/deposits/'; ?>">Deposits</a></li>
                            <li><a class="dropdown-item" href="<?php echo urlPrefix() . 'dashboard/withdrawal/'; ?>">Withdraw</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="<?php echo urlPrefix() . 'dashboard/profile/'; ?>">Profile</a></li>
                            <li><a class="dropdown-item" href="<?php echo urlPrefix() . 'ranking/'; ?>">Ranking</a></li>
                            <li><a class="dropdown-item" href="<?php echo urlPrefix() . 'dashboard/refer/'; ?>">Refer Friends</a></li>
                            <li><a class="dropdown-item" href="<?php echo urlPrefix() . 'help/'; ?>">Help</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="<?php echo urlPrefix() . 'php-apis/logout.php'; ?>">Logout</a></li>

                        <?php } else { ?>

                            <li><a class="dropdown-item" href="<?php echo urlPrefix() . 'login/'; ?>">Enter</a></li>
                            <li><a class="dropdown-item" href="<?php echo urlPrefix() . 'register/'; ?>">Register</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="<?php echo urlPrefix() . 'ranking/'; ?>">Ranking</a></li>
                            <li><a class="dropdown-item" href="<?php echo urlPrefix() . 'help/'; ?>">Help</a></li>

                        <?php } ?>

                    </ul>
                </li>
            </ul>
            <a class="navbar-brand" href="<?php echo urlPrefix(); ?>">Challenge Site</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">

                    <?php if (isset($_SESSION['id'])) { ?>

                        <li class="nav-item">
                            <a class="btn btn-lg btn-outline-secondary border-0" aria-current="page" href="<?php echo urlPrefix() . 'dashboard/profile/'; ?>">
                                <?php

                                include_once urlPrefix() . 'php-apis/db-config.php';

                                $user_id = $_SESSION['id'];

                                $sql = "SELECT * FROM users WHERE id=$user_id";
                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo $row['first_name'] . ' ' . $row['last_name'];
                                    }
                                } else {
                                    header("Location: " . urlPrefix() . "php-apis/logout.php");
                                    die();
                                }

                                ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-lg btn-outline-secondary border-0" aria-current="page" href="<?php echo urlPrefix() . 'dashboard/profile/'; ?>"><i class="bi bi-person-circle"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-lg btn-outline-secondary border-0" aria-current="page" href="<?php echo urlPrefix() . 'dashboard/notifications/'; ?>">
                                <i class="bi bi-bell-fill"></i>
                                <span class="badge bg-secondary">
                                    <?php

                                    $sql2 = "SELECT COUNT(*) AS unread_notifs FROM notifications WHERE notif_for = $user_id AND notif_status = 'unread'";
                                    $result2 = mysqli_query($conn, $sql2);

                                    if (mysqli_num_rows($result2) > 0) {
                                        while ($row2 = mysqli_fetch_assoc($result2)) {
                                            echo $row2['unread_notifs'];
                                        }
                                    } else {
                                        echo "0";
                                    }

                                    ?>
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-lg btn-outline-secondary border-0" aria-current="page" href="<?php echo urlPrefix() . 'dashboard/refer/'; ?>">REFER FRIENDS</a>
                        </li>

                    <?php } else { ?>

                        <li class="nav-item">
                            <a class="btn btn-lg btn-outline-secondary border-0" aria-current="page" href="<?php echo urlPrefix() . 'login/'; ?>">ENTER</a>
                        </li>

                    <?php } ?>

                </ul>
            </div>
        </div>
    </nav>