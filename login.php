<?php
session_start();

// Om redan inloggad
if (isset($_SESSION["user"])) {
    header("Location: index.php");
    exit;
}

// Hårdkodade användare
$users = [
    [
        "username" => "admin",
        "password" => "admin123",
        "role" => "admin"
    ],
    [
        "username" => "user",
        "password" => "user123",
        "role" => "user"
    ]
];

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    foreach ($users as $user) {
        if ($user["username"] === $username && $user["password"] === $password) {
            $_SESSION["user"] = $user["username"];
            $_SESSION["role"] = $user["role"];

            header("Location: index.php");
            exit;
        }
    }

    $error = "Fel användarnamn eller lösenord";
}
?>
