<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    // Daftar akun disimpan di array (tanpa database). Format: username => password
    private $akun = [
        'pakdapur' => 'ompreng123',
        'lingga' => 'mbg2026',
        'dava' => 'tahu2iris',
    ];

    // Menampilkan halaman login
    public function login()
    {
        return view('login');
    }

    // Memproses form login
    public function prosesLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $username = $request->input('username');
        $password = $request->input('password');

        // Cek apakah username ada di array dan password-nya cocok
        if (! isset($this->akun[$username]) || $this->akun[$username] != $password) {
            return redirect()->route('login')
                ->withErrors(['username' => 'Username atau password salah.'])
                ->withInput(['username' => $username]);
        }

        // Kirim username ke dashboard lewat request parameter (?username=...)
        return redirect()->route('dashboard', ['username' => $username]);
    }

    public function dashboard(Request $request)
    {
        $username = $request->query('username');

        if (! isset($this->akun[$username])) {
            return redirect()->route('login')->withErrors(['username' => 'Silakan login dulu.']);
        }

        $ompreng = [
            'porsi' => 3120,
            'anggaranPerPorsi' => 15000,
            'sampaiDiOmpreng' => 8200,
            'insiden' => 15,
            'jamNasi' => '11.00',
            'jamLauk' => '13.30',
        ];

        // Hitung selisih dan persentase untuk grafik batang
        $ompreng['selisih'] = $ompreng['anggaranPerPorsi'] - $ompreng['sampaiDiOmpreng'];
        $ompreng['persen'] = round($ompreng['sampaiDiOmpreng'] / $ompreng['anggaranPerPorsi'] * 100);

        $kabarDapur = [
            ['jam' => '06.10', 'isi' => 'Truk lauk datang dua jam terlambat. Ayam diganti tahu, laporan tetap menulis ayam.'],
            ['jam' => '07.30', 'isi' => 'Susu kotak ditukar air mineral karena "lebih menyehatkan".'],
            ['jam' => '09.00', 'isi' => 'Foto ompreng untuk laporan diambil dari menu Senin minggu lalu.'],
            ['jam' => '10.45', 'isi' => 'Wali kelas melapor sayur berbau asam. Jawaban dapur: fermentasi alami.'],
            ['jam' => '11.20', 'isi' => 'Laporan ke pusat terkirim: semua berjalan lancar dan bergizi.'],
        ];

        return view('dashboard', [
            'username' => $username,
            'ompreng' => $ompreng,
            'kabarDapur' => $kabarDapur,
        ]);
    }

    public function pengelolaan(Request $request)
    {
        $username = $request->query('username');

        if (! isset($this->akun[$username])) {
            return redirect()->route('login')->withErrors(['username' => 'Silakan login dulu.']);
        }

        $menuMingguIni = [
            ['hari' => 'Senin', 'diProposal' => 'Nasi, ayam bakar madu, tumis buncis, jeruk, susu', 'diOmpreng' => 'Nasi, tahu dua iris, kuah sayur', 'anggaran' => 15000, 'terpakai' => 8200, 'status' => 'layak'],
            ['hari' => 'Selasa', 'diProposal' => 'Nasi, ikan kembung goreng, sayur bayam, pisang, susu', 'diOmpreng' => 'Nasi, ikan (ukurannya debatable), bayam layu', 'anggaran' => 15000, 'terpakai' => 7900, 'status' => 'dicicip'],
            ['hari' => 'Rabu', 'diProposal' => 'Nasi, rendang, capcay, semangka, susu', 'diOmpreng' => 'Nasi, kuah rendang tanpa daging, kerupuk', 'anggaran' => 15000, 'terpakai' => 6500, 'status' => 'ditarik'],
            ['hari' => 'Kamis', 'diProposal' => 'Nasi, telur balado, sop wortel, apel, susu', 'diOmpreng' => 'Nasi, telur setengah, air sop', 'anggaran' => 15000, 'terpakai' => 8800, 'status' => 'layak'],
            ['hari' => 'Jumat', 'diProposal' => 'Nasi kuning, ayam suwir, urap, melon, susu', 'diOmpreng' => 'Nasi kuning, suwiran yang katanya ayam', 'anggaran' => 15000, 'terpakai' => 7400, 'status' => 'dicicip'],
        ];

        $petugas = [
            ['nama' => 'Dava', 'tugas' => 'Kepala masak', 'catatan' => 'Hafal resep, belum pernah lihat bahannya lengkap'],
            ['nama' => 'Hayden', 'tugas' => 'Belanja bahan', 'catatan' => 'Nota selalu rapi, timbangan selalu kurang'],
            ['nama' => 'Azhim', 'tugas' => 'Pengemasan ompreng', 'catatan' => 'Bisa isi 400 ompreng per jam, lauknya menyusul'],
            ['nama' => 'Lingga', 'tugas' => 'Dokumentasi', 'catatan' => 'Ahli sudut foto yang membuat tahu terlihat seperti ayam'],
            ['nama' => 'Andrew', 'tugas' => 'Pengantaran', 'catatan' => 'Tiba tepat waktu kalau jalan sepi dan truk mau hidup'],
        ];

        // Jumlahkan anggaran dan biaya yang terpakai selama seminggu
        $totalAnggaran = 0;
        $totalTerpakai = 0;
        foreach ($menuMingguIni as $menu) {
            $totalAnggaran += $menu['anggaran'];
            $totalTerpakai += $menu['terpakai'];
        }

        return view('pengelolaan', [
            'username' => $username,
            'menuMingguIni' => $menuMingguIni,
            'petugas' => $petugas,
            'totalAnggaran' => $totalAnggaran,
            'totalTerpakai' => $totalTerpakai,
        ]);
    }

    public function profile(Request $request)
    {
        $username = $request->query('username');

        if (! isset($this->akun[$username])) {
            return redirect()->route('login')->withErrors(['username' => 'Silakan login dulu.']);
        }

        $profil = [
            'jabatan' => 'Kepala Dapur Unit 07',
            'bergabung' => 'Januari 2026',
            'pelatihanGizi' => 'Dijadwalkan, belum tahu kapan',
        ];

        $riwayatTandaTangan = [
            ['tanggal' => '3 Nov 2026', 'dokumen' => 'Berita acara serah terima 3.120 ompreng', 'catatan' => 'Ditandatangani sebelum ompreng dihitung'],
            ['tanggal' => '4 Nov 2026', 'dokumen' => 'Laporan uji kelayakan bahan', 'catatan' => 'Uji dilakukan dengan dicium'],
            ['tanggal' => '5 Nov 2026', 'dokumen' => 'Klarifikasi insiden sakit perut', 'catatan' => 'Penyebab tertulis: anak kurang sarapan'],
            ['tanggal' => '6 Nov 2026', 'dokumen' => 'Pengajuan tambahan anggaran', 'catatan' => 'Alasan: harga tahu naik'],
        ];

        return view('profile', [
            'username' => $username,
            'profil' => $profil,
            'riwayatTandaTangan' => $riwayatTandaTangan,
        ]);
    }

    public function logout()
    {
        return redirect()->route('login')->with('pesan', 'Kamu sudah keluar dari dapur.');
    }
}
