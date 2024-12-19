<?php
date_default_timezone_set('Asia/Yangon');

session_start();
$userLoggedIn = false;

// Check if session variables are set
if (isset($_SESSION['user_id']) && isset($_SESSION['name'])) {
    $userLoggedIn = true;
} else {
    // Fallback to cookie-based validation
    if (isset($_COOKIE['user_id']) && isset($_COOKIE['name'])) {
        $_SESSION['user_id'] = $_COOKIE['user_id'];
        $_SESSION['name'] = $_COOKIE['name'];
        $userLoggedIn = true;
    }
}

// Redirect to login if not logged in
if (!$userLoggedIn) {
    header("Location: login.php");
    exit;
}

require_once 'api/db_pdo.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Arena Entertainment</title>
    <meta name="theme-color" content="#190038">
    <meta name="twitter:description" content="Arena Entertainment, Yangon, Myanmar.">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:image" content="assets/img/arena.jpeg">
    <meta name="description" content="Arena Entertainment, Yangon, Myanmar">
    <meta property="og:image" content="assets/img/arena.jpeg">
    <meta property="og:type" content="website">
    <meta name="twitter:title" content="Arena Entertainment">
    <link rel="icon" type="image/jpeg" sizes="474x474" href="assets/img/arena.jpeg">
    <link rel="icon" type="image/jpeg" sizes="474x474" href="assets/img/arena.jpeg">
    <link rel="icon" type="image/jpeg" sizes="474x474" href="assets/img/arena.jpeg">
    <link rel="icon" type="image/jpeg" sizes="474x474" href="assets/img/arena.jpeg">
    <link rel="icon" type="image/jpeg" sizes="474x474" href="assets/img/arena.jpeg">
    <link rel="stylesheet" href="assets/dist/css/bootstrap.min.css">
    <link rel="manifest" href="manifest.json">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/line-awesome.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">

    <style>
        @media (min-width: 768px) {
            body {
                display: block;
                margin: auto;
                max-width: 600px;
            }
        }

        .tdmErrorMessage {
            color: red;
            background-color: black;
            padding: 0.3rem;
            margin-bottom: 0.3rem;
        }

        .la {
            font-size: 1.8rem;
            color: white;
        }

        a {
            margin-top: -0.6rem;
        }

        .tdm-button {
            color: var(--bs-gray-100);
        }

        .card-number {
            color: whitesmoke;
            font-size: 0.8rem;
        }

        .pay-link {
            text-decoration: initial;
        }

        .row {
            margin-left: 0rem;
            margin-right: 0rem;
        }

        .arena-bg {
            background: #190038;
        }

        .arena-sofa {
            background-color: #d5bcfc;
            border-radius: 1rem;
            padding: 1rem;
            font-size: 11px;
            color: black;
            width: 100px;
        }

        .standing_table{
            background-color: #F8A508;
            border-radius: 1rem;
            padding: 1rem;
            font-size: 11px;
            color: black;
            width: 100px;
        }
        .regular_sofa{
            background-color: #00FD03;
            border-radius: 1rem;
            padding: 1rem;
            font-size: 11px;
            color: black;
            width: 100px;
        }
        .bronze_sofa{
            background-color: #13B1F2;
            border-radius: 1rem;
            padding: 1rem;
            font-size: 11px;
            color: black;
            width: 100px;
        }
        .silver_sofa{
            background-color: #FA62FF;
            border-radius: 1rem;
            padding: 1rem;
            font-size: 11px;
            color: black;
            width: 100px;
        }
        .diamond_sofa{
            background-color: #06F8EF;
            border-radius: 1rem;
            padding: 1rem;
            font-size: 11px;
            color: black;
            width: 100px;
        }
        .booked_sofa{
            background-color: #D70000;
            border-radius: 1rem;
            padding: 1rem;
            font-size: 11px;
            color: black;
            width: 100px;
        }

    </style>
</head>