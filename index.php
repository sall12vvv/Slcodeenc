<?php
require_once 'encode-php.php';
require_once 'encode-js.php';
require_once 'encode-html.php';

$result = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type = $_POST['type'] ?? '';
    $code = $_POST['code'] ?? '';
    $layers = (int) ($_POST['layers'] ?? 1);

    if ($type === 'php') {
        $result = encode_php($code, $layers);
    } elseif ($type === 'js') {
        $result = encode_js($code, $layers);
    } elseif ($type === 'html') {
        $result = encode_html($code);
    } else {
        $result = "// Unsupported type.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Multi Encoder - PHP | JS | HTML</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; padding: 20px; }
        textarea, select, input[type=submit] {
            width: 100%; padding: 10px; margin-top: 10px; font-size: 16px;
        }
        .output {
            background: #fff; padding: 15px; margin-top: 20px; border: 1px solid #ccc;
            white-space: pre-wrap;
        }
    </style>
</head>
<body>
    <h2>Multi Encoder: PHP | JavaScript | HTML</h2>
    <form method="post">
        <label for="type">Pilih Jenis:</label>
        <select name="type" id="type">
            <option value="php">PHP</option>
            <option value="js">JavaScript</option>
            <option value="html">HTML</option>
        </select>

        <label for="layers">Jumlah Encode Base64 (PHP/JS):</label>
        <input type="number" name="layers" value="1" min="1" max="10">

        <label for="code">Masukkan Kode:</label>
        <textarea name="code" rows="10" placeholder="Paste your code here..."></textarea>

        <input type="submit" value="Encode">
    </form>

    <?php if ($result): ?>
        <div class="output">
            <h3>Hasil Encode:</h3>
            <textarea rows="20"><?= htmlspecialchars($result) ?></textarea>
        </div>
    <?php endif; ?>
</body>
</html>
