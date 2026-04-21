// ==========================================
// 4. VARIABEL & 5. TIPE DATA
// ==========================================
const namaCafe = "Aroma Senja";    // Tipe: String
let kapasitasTersisa = 5;          // Tipe: Number (Contoh sisa meja)
let isBuka = true;                 // Tipe: Boolean

// ==========================================
// 6. OUTPUT DASAR
// ==========================================
// Menampilkan pesan selamat datang di halaman
document.getElementById('output-welcome').innerText = "Selamat datang di sistem booking " + namaCafe;


// ==========================================
// 8. ARROW FUNCTION
// ==========================================
// Fungsi untuk menghitung total biaya perkiraan (Misal 1 orang rata-rata 25rb)
const hitungEstimasi = (jumlahOrang) => jumlahOrang * 25000;


// ==========================================
// 7. FUNGSI LOGIKA, 9. PERCABANGAN
// ==========================================
document.getElementById('formReservasi').addEventListener('submit', function(event) {
    event.preventDefault(); // Mencegah form reload halaman

    // Mengambil nilai input
    const emailInput = document.getElementById('email').value;
    const paxInput = parseInt(document.getElementById('pax').value);
    const notif = document.getElementById('notifikasi');

    // Tipe Data hasil input
    console.log("Email:", emailInput, "| Tipe:", typeof emailInput);
    console.log("Jumlah Orang:", paxInput, "| Tipe:", typeof paxInput);

    // Percabangan & Logika
    if (paxInput > kapasitasTersisa) {
        // Jika jumlah orang melebihi sisa meja
        notif.style.color = "red";
        notif.innerText = "Maaf, meja tidak cukup. Sisa kapasitas hanya " + kapasitasTersisa + " orang.";
    } 
    else if (paxInput <= 0) {
        // Logika jika input tidak valid
        notif.style.color = "orange";
        notif.innerText = "Mohon masukkan jumlah orang yang valid.";
    } 
    else {
        // Jika reservasi berhasil
        let estimasi = hitungEstimasi(paxInput);
        
        notif.style.color = "green";
        notif.innerText = "Reservasi Berhasil! Konfirmasi dikirim ke: " + emailInput + 
                          ". Estimasi pesanan minimal: Rp" + estimasi.toLocaleString('id-ID');
        
        // Mengurangi sisa kapasitas (Variabel dinamis)
        kapasitasTersisa -= paxInput;
    }
});