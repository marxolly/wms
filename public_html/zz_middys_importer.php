<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
$host = 'localhost';
$db   = 'cobaltma_newclientportal';
$user = 'cobaltma_cpsite';
$pass = '{,e3^bfcfcMp';
$charset = 'utf8';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

$pdo = new PDO($dsn, $user, $pass, $opt);


$rfile = fopen($root.'/data/middys consumables.csv', 'r') or die('could not open');

$line = 1;
//$skip_first = isset($_POST['header_row']);
$skip_first = true;
while (($row = fgetcsv($rfile)) !== FALSE)
{
    if($skip_first)
    {
        $skip_first = false;
        continue;
    }
    $sku = $row[0];
    $name = ucwords(strtolower($row[1]));
    $sql = "INSERT INTO items (name, sku, client_id)
            VALUES (?,?,?)";

    $pdo->prepare($sql)->execute([$name,$sku, 67]);
    echo "<p>$name - ( $sku ) inserted</p>";
}
?>