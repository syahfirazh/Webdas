// VARIABEL & TIPE DATA
const namaCafe = "Aroma Senja"; 
let kapasitasTersisa = 15; // Kita asumsikan ada 15 meja kosong hari ini

// OUTPUT DASAR
document.getElementById('output-welcome').innerText = "Halo! Selamat datang di sistem booking " + namaCafe;

// ARROW FUNCTION
const hitungEstimasi = (jumlahOrang) => jumlahOrang * 25000;

// LOGIKA & PERCABANGAN
document.getElementById('formReservasi').addEventListener('submit', function(event) {
    // Kita tidak menggunakan event.preventDefault() di sini agar PHP bisa menerima data POST, 
    // namun kita tetap menjalankan logika pengecekan di sisi klien.

    const emailInput = document.getElementById('email').value;
    const paxInput = parseInt(document.getElementById('pax').value);
    const notif = document.getElementById('notifikasi');

    if (paxInput > kapasitasTersisa) {
        event.preventDefault(); // Batalkan kirim ke PHP jika meja penuh
        notif.style.color = "red";
        notif.innerText = "Maaf, kapasitas tidak cukup. Sisa meja hanya untuk " + kapasitasTersisa + " orang.";
    } 
    else {
        let estimasi = hitungEstimasi(paxInput);
        console.log("Reservasi diproses untuk:", emailInput);
        alert("Validasi Berhasil! Estimasi pesanan minimal Anda: Rp" + estimasi.toLocaleString('id-ID'));
    }
});