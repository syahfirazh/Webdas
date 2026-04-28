<?php 
include 'koneksi.php'; 

// Logika PHP untuk menyimpan reservasi ke Database
$notif_db = "";
if (isset($_POST['submit_reservasi'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pax = (int)$_POST['pax'];
    $tanggal = $_POST['tanggal'];

    $sql = "INSERT INTO reservasi (email, pax, tanggal) VALUES ('$email', '$pax', '$tanggal')";
    
    if (mysqli_query($conn, $sql)) {
        $notif_db = "Data reservasi berhasil disimpan di Database!";
    } else {
        $notif_db = "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aroma Senja - Coffee & Eatery</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <h1>Aroma Senja</h1>
        <p>Menyeduh Cerita di Setiap Cangkir</p>
        <nav>
            <ul>
                <li><a href="#tentang">Tentang</a></li>
                <li><a href="#menu">Menu</a></li>
                <li><a href="#reservasi">Reservasi</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="tentang">
            <article>
                <h2>Tentang Kami</h2>
                <p>Didirikan sejak tahun 2020, Aroma Senja hadir untuk memberikan pengalaman minum kopi yang autentik.<br>
                Kami menggunakan biji kopi pilihan langsung dari petani lokal di Indonesia.</p>
                <img src="cafe.png" alt="Suasana Cafe" class="hero-img">
            </article>
        </section>

        <hr>

        <section id="menu">
            <h3>Menu Andalan Kami (Database)</h3>
            <p onmouseover="this.style.color='brown'" onmouseout="this.style.color='black'">
                *Arahkan kursor ke sini untuk melihat info harga terbaru.
            </p>
            <table>
                <thead>
                    <tr>
                        <th>Nama Minuman</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM menu";
                    $result = mysqli_query($conn, $query);
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                <td>{$row['nama_minuman']}</td>
                                <td>{$row['kategori']}</td>
                                <td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>

        <aside>
            <h4>Promo Minggu Ini!</h4>
            <p>Beli 2 Kopi Susu Gula Aren, gratis 1 Brownies Cokelat. Berlaku s/d hari Jumat.</p>
            <button onclick="alert('Promo ini berlaku khusus makan di tempat (dine-in)!')">Cek Syarat Promo</button>
        </aside>

        <section id="reservasi">
            <h3>Booking Meja</h3>
            <p id="output-welcome"></p>
            
            <?php if($notif_db != ""): ?>
                <div style="color: blue; margin-bottom: 10px;"><?php echo $notif_db; ?></div>
            <?php endif; ?>

            <form id="formReservasi" method="POST" action="">
                <div class="field">
                    <label for="email">Email Konfirmasi:</label>
                    <input type="email" id="email" name="email" required placeholder="nama@email.com">
                </div>

                <div class="field">
                    <label for="pax">Jumlah Orang (Max 10):</label>
                    <input type="number" id="pax" name="pax" min="1" max="10" value="2" required>
                </div>

                <div class="field">
                    <label for="tanggal">Tanggal Kunjungan:</label>
                    <input type="date" id="tanggal" name="tanggal" required>
                </div>

                <button type="submit" name="submit_reservasi" id="btnSubmit">Cek & Simpan Reservasi</button>
            </form>
            
            <div id="notifikasi" style="margin-top: 20px; font-weight: bold;"></div>
        </section>
    </main>

    <footer>
        <p>&copy; 2026 Aroma Senja Coffee. Jl. Kenangan No. 123.</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>