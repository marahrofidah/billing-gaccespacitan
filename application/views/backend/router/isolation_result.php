<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hasil Isolir</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 32px; background: #f4f6f9; color: #212529; }
        main { max-width: 640px; margin: 8vh auto; padding: 24px; background: #fff; border-radius: 8px; box-shadow: 0 2px 12px rgba(0, 0, 0, .1); }
        .result { padding: 16px; border-radius: 4px; line-height: 1.5; }
        .success { color: #155724; background: #d4edda; }
        .failure { color: #721c24; background: #f8d7da; }
        button { margin-top: 20px; padding: 10px 16px; border: 0; border-radius: 4px; background: #007bff; color: #fff; cursor: pointer; }
    </style>
</head>
<body>
    <main>
        <h1>Hasil Isolir</h1>
        <div class="result <?= $success ? 'success' : 'failure' ?>" role="alert">
            <?= html_escape($message) ?>
        </div>
        <button type="button" onclick="history.back()">Kembali ke halaman pelanggan</button>
    </main>
</body>
</html>
