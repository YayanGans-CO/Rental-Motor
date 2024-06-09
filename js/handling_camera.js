$(document).ready(function() {
    // Membuat objek scanner baru
    let scanner = new Instascan.Scanner({ 
        // Menentukan elemen video tempat scanner akan ditampilkan
        video: document.getElementById('preview'),
        // Menonaktifkan efek mirror pada kamera depan
        mirror: true,
        // Menggunakan kamera depan
        facingMode: 'user'
    });

    // Menambahkan event listener untuk saat QR code terdeteksi
    scanner.addListener('scan', function(content) {
        // Mengirim konten QR code ke process_pesan.php menggunakan metode POST
        fetch('process_pesan.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'barcode=' + encodeURIComponent(content),
        })
        .then(response => {
            // Redirect ke halaman yang diperlukan setelah data terkirim
            window.location.href = 'rental_berjalan.php';
        })
        .catch(error => {
            console.error('Error:', error);
            // Handle error jika terjadi kesalahan saat mengirim data
        });
    });


    // Mengambil daftar kamera yang tersedia
    Instascan.Camera.getCameras().then(function(cameras) {
        // Jika ada kamera yang tersedia
        if (cameras.length > 0) {
            // Memulai scanner dengan kamera pertama yang tersedia
            scanner.start(cameras[0]);
        } else {
            // Jika tidak ada kamera yang tersedia, tampilkan pesan error
            console.error('Tidak ada kamera yang tersedia.');
        }
    }).catch(function(e) {
        // Menangani kesalahan dan menampilkannya dalam konsol
        console.error(e);
    });
});