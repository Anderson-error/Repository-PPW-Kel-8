<?php 

session_start();

date_default_timezone_set('Asia/Kuala_Lumpur');

// config database
$host     = "localhost"; // Host MySQL (biasanya localhost)
$username = "id22130339_kelompok8"; // Username MySQL
$password = "Kelompok8."; // Password MySQL
$database = "id22130339_tteokbeokki"; // Nama database yang digunakan

// buat koneksi
$koneksi = mysqli_connect($host, $username, $password, $database);

const KATEGORI_MENU = [
    'Makanan',
    'Minuman',
    // 'Dessert',
];

const ROLES = [
    'STAFF',
    'SUPERADMIN'
];

const PROTECTED_PAGE = [
    'akun',
    'dashboard',
    'kasir',
    'menu-index',
    'menu-create',
    'menu-edit',
    'pengguna-index',
    'pengguna-create',
    'pengguna-edit',
    'pengeluaran-index',
    'pengeluaran-create',
    'pengeluaran-edit',
    'riwayat-transaksi'
];

function checkPermission()
{
    $paths = explode('/', $_SERVER['REQUEST_URI']);

    $current_path = end($paths);

    if ($current_path !== "") {
        $current_page = explode('.', $current_path)[0];

        if (in_array($current_page, PROTECTED_PAGE) && !isset($_SESSION['user'])) {
            echo "<script>alert('Akses Ditolak !');</script>";
            echo "<script>window.location.href='index.php'</script>";
            die();
        }
    }

}

checkPermission();

function getData(string $query, bool $is_take_one_data = false) : array
{
    global $koneksi;

    $result = mysqli_query($koneksi, $query);

    $data = [];

    if (mysqli_num_rows($result) > 0) {
        if ($is_take_one_data) {
            $data = mysqli_fetch_assoc($result);
        } else {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
        }
    }

    return $data;
}

function setData(string $query) : bool
{
    global $koneksi;

    mysqli_query($koneksi, $query);

    return (mysqli_affected_rows($koneksi) > 0) ? true : false;
}

function uploadImage($file) : string
{
    $nama_file = date('Ymd_His') . "-" . $file['name'];
    $temp_name = $file['tmp_name'];
    $folder    = "assets/upload/menu/";

    $proses_upload = move_uploaded_file($temp_name, $folder . $nama_file);

    return $nama_file; 
}

function rupiah($nominal) : string
{
    $nominal_integer = intval($nominal);

    return "Rp " . number_format($nominal_integer, 0, ',', '.');
}

function tanggalIndo(string $tanggal) : string
{
	$bulan = array (
		1 => 'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);
 
	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

function truncateText(string $text, int $max_length) : string
{
    return (strlen($text) > $max_length) ? substr($text, 0, $max_length) . "..." : $text;
}

function login(string $email, string $password) : bool
{
    $password_encrypted = md5($password);

    $query = "SELECT * FROM tb_pengguna WHERE email = '$email' AND password = '$password_encrypted'";

    $user = getData($query, true);

    $login_valid = (!empty($user)) ? true : false;

    if ($login_valid) {
        $_SESSION['is_login'] = true;
        $_SESSION['user'] = [
            'id'    => $user['id'],
            'nama'  => $user['nama'],
            'email' => $user['email'],
            'role'  => $user['role'],
        ];
    }

    return $login_valid;
}

function getDataToko() : array
{
    $toko = getData("SELECT * FROM tb_toko LIMIT 1", true);

    return $toko;
}

function updateSaldo(bool $is_pemasukan, $nominal) : void
{
    $data_toko = getDataToko();

    $saldo_toko = intval($data_toko['saldo']);

    if ($is_pemasukan) {
        $saldo_toko += intval($nominal);
    } else {
        $saldo_toko -= intval($nominal);
    }

    $query2 = "UPDATE tb_toko SET saldo = $saldo_toko WHERE id = " . $data_toko['id'];
    $proses2 = setData($query2);
}