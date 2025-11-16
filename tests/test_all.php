<?php

function test($label, $callback) {
    echo "TEST: $label ... ";
    $result = $callback();

    if ($result) echo "OK\n";
    else {
        echo "FAILED\n";
        exit(1);
    }
}

function post($path, $data) {
    $ch = curl_init("http://localhost:8000/" . $path);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    return curl_exec($ch);
}

test("Registrasi user baru", function() {
    $res = post("webb/register.php", [
        "username" => "ci_user",
        "password" => "123456",
    ]);
    return !empty($res); 
});

test("Login user", function() {
    $res = post("webb/login.php", [
        "username" => "ci_user",
        "password" => "123456",
    ]);
    return !empty($res);
});

test("Tambah kontak", function() {
    $res = post("webb/backend/add-kontak.php", [
        "nama" => "Tester CI",
        "nomor" => "0812345678",
    ]);
    return !empty($res);
});

echo "\nSEMUA TES LULUS ✓\n";
