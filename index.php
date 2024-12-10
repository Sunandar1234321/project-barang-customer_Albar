<?php
session_start();
include 'data_barang.php';
include 'data_customer.php';

function resetIds(&$data) {
    $newId = 1;
    foreach ($data as &$item) {
        $item['id'] = $newId++;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_barang'])) {
        $id = end($barang)['id'] + 1;
        $nama_barang = $_POST['nama_barang'];
        $harga = $_POST['harga'];
        $stok = $_POST['stok'];
        $barang[] = ['id' => $id, 'nama_barang' => $nama_barang, 'harga' => $harga, 'stok' => $stok];
    } elseif (isset($_POST['delete_barang'])) {
        $id = $_POST['delete_barang'];
        foreach ($barang as $key => $item) {
            if ($item['id'] == $id) {
                unset($barang[$key]);
                break;
            }
        }
        // Reset ID setelah penghapusan
        resetIds($barang);
    } elseif (isset($_POST['add_customer'])) {
        $id = end($customer)['id'] + 1;
        $nama_customer = $_POST['nama_customer'];
        $email = $_POST['email'];
        $no_telepon = $_POST['no_telepon'];
        $customer[] = ['id' => $id, 'nama_customer' => $nama_customer, 'email' => $email, 'no_telepon' => $no_telepon];
    } elseif (isset($_POST['delete_customer'])) {
        $id = $_POST['delete_customer'];
        foreach ($customer as $key => $cust) {
            if ($cust['id'] == $id) {
                unset($customer[$key]);
                break;
            }
        }
        // Reset ID setelah penghapusan
        resetIds($customer);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
    body {
    font-family: Arial, sans-serif;
    margin: 20px;
    padding: 0;
    background-color: #f4f4f4;
}

h1, h2 {
    color: #333;
}

form {
    margin-bottom: 20px;
}

form input, form button {
    padding: 5px;
    margin-right: 10px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

table, th, td {
    border: 1px solid #ddd;
}

th, td {
    padding: 8px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}

tr:nth-child(even) {
    background-color: #f9f9f9;
}

button {
    background-color: #d9534f;
    color: white;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
}

button:hover {
    background-color: #c9302c;
}

</style>
<body>
    <h1>Selamat Datang di Toko Online</h1>
    
    <h2>Daftar Barang</h2>
    <form method="post">
        <input type="text" name="nama_barang" placeholder="Nama Barang" required>
        <input type="number" name="harga" placeholder="Harga" required>
        <input type="number" name="stok" placeholder="Stok" required>
        <button type="submit" name="add_barang">Tambah Barang</button>
    </form>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Hapus</th>
        </tr>
        <?php
        foreach ($barang as $item) {
            echo "<tr>";
            echo "<td>" . $item['id'] . "</td>";
            echo "<td>" . $item['nama_barang'] . "</td>";
            echo "<td>" . $item['harga'] . "</td>";
            echo "<td>" . $item['stok'] . "</td>";
            echo "<td><form method='post' style='display:inline'><button type='submit' name='delete_barang' value='" . $item['id'] . "'>Hapus</button></form></td>";
            echo "</tr>";
        }
        ?>
    </table>

    <h2>Daftar Customer</h2>
    <form method="post">
        <input type="text" name="nama_customer" placeholder="Nama Customer" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="no_telepon" placeholder="No Telepon" required>
        <button type="submit" name="add_customer">Tambah Customer</button>
    </form>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama Customer</th>
            <th>Email</th>
            <th>No Telepon</th>
            <th>Hapus</th>
        </tr>
        <?php
        foreach ($customer as $cust) {
            echo "<tr>";
            echo "<td>" . $cust['id'] . "</td>";
            echo "<td>" . $cust['nama_customer'] . "</td>";
            echo "<td>" . $cust['email'] . "</td>";
            echo "<td>" . $cust['no_telepon'] . "</td>";
            echo "<td><form method='post' style='display:inline'><button type='submit' name='delete_customer' value='" . $cust['id'] . "'>Hapus</button></form></td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>