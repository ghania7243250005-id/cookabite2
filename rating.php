<?php
// rating.php
// Koneksi database rating CookaBite menggunakan PDO.
// Sesuaikan konfigurasi di dbconfig.php sesuai environment hosting Anda.
$config = require __DIR__ . '/dbconfig.php';

$host = $config['host'] ?? 'localhost';
$db   = $config['db'] ?? 'cookabite';
$user = $config['user'] ?? 'root';
$pass = $config['pass'] ?? '';
$charset = $config['charset'] ?? 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Koneksi database gagal: ' . $e->getMessage()]);
    exit;
}

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Ambil data rating/ulasan dari tabel reviews
    $stmt = $pdo->query('SELECT id, nama, rating, ulasan, created_at FROM reviews ORDER BY created_at DESC');
    $reviews = $stmt->fetchAll();
    echo json_encode($reviews);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Terima payload JSON atau form POST
    $input = json_decode(file_get_contents('php://input'), true);
    $data = is_array($input) ? $input : $_POST;

    $nama = trim($data['nama'] ?? '');
    $rating = (int)($data['rating'] ?? 0);
    $ulasan = trim($data['ulasan'] ?? '');

    if ($nama === '' || $rating < 1 || $rating > 5 || $ulasan === '') {
        http_response_code(422);
        echo json_encode(['error' => 'Nama, rating, dan ulasan harus diisi dengan benar.']);
        exit;
    }

    $stmt = $pdo->prepare('INSERT INTO reviews (nama, rating, ulasan) VALUES (:nama, :rating, :ulasan)');
    $stmt->execute([
        ':nama'   => $nama,
        ':rating' => $rating,
        ':ulasan' => $ulasan,
    ]);

    echo json_encode(['success' => true, 'id' => $pdo->lastInsertId()]);
    exit;
}

http_response_code(405);
echo json_encode(['error' => 'Method not allowed']);
