<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pengajuan</title>
    <script>
        function updateParticipants() {
            const jumlahPeserta = document.getElementById('jumlah_peserta').value;
            const pesertaContainer = document.getElementById('peserta_container');
            
            // Kosongkan container
            pesertaContainer.innerHTML = '';
            
            // Tambahkan input sesuai jumlah peserta
            for (let i = 1; i <= jumlahPeserta; i++) {
                const inputGroup = document.createElement('div');
                inputGroup.innerHTML = `
                    <label for="nama_peserta_${i}">Nama Peserta ${i}</label>
                    <input type="text" name="nama_peserta[]" id="nama_peserta_${i}" placeholder="Nama Peserta ${i}" required>
                `;
                pesertaContainer.appendChild(inputGroup);
            }
        }
    </script>
</head>
<body>
    <h1>Buat Pengajuan</h1>
    <form action="{{ route('pengajuan.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('post')
        
        <div>
            <label for="nama_perwakilan">Nama Perwakilan</label>
            <input type="text" name="nama_perwakilan" id="nama_perwakilan" placeholder="Nama Perwakilan" required>
        </div>
        
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Email" required>
        </div>
        
        <div>
            <label for="no_hp">No. HP</label>
            <input type="text" name="no_hp" id="no_hp" placeholder="No. HP" required>
        </div>
        
        <div>
            <label for="no_hp_alternatif">No. HP Alternatif</label>
            <input type="text" name="no_hp_alternatif" id="no_hp_alternatif" placeholder="No. HP Alternatif" required>
        </div>
        
        <div>
            <label for="nama_instansi">Nama Instansi</label>
            <input type="text" name="nama_instansi" id="nama_instansi" placeholder="Nama Instansi" required>
        </div>
        
        <div>
            <label for="alamat_instansi">Alamat Instansi</label>
            <input type="text" name="alamat_instansi" id="alamat_instansi" placeholder="Alamat Instansi" required>
        </div>
        
        <div>
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal">
        </div>
        
        <div>
            <label for="jam">Jam</label>
            <input type="time" name="jam" id="jam">
        </div>
        
        <div>
            <label for="topik_diskusi">Topik Diskusi</label>
            <input type="text" name="topik_diskusi" id="topik_diskusi">
        </div>
        
        <div>
            <label for="jumlah_peserta">Jumlah Peserta</label>
            <input type="number" name="jumlah_peserta" id="jumlah_peserta" placeholder="Jumlah Peserta" min="1" oninput="updateParticipants()" required>
        </div>
        
        <div id="peserta_container">
            <!-- Input Nama Peserta Dinamis Akan Ditambahkan Di Sini -->
        </div>
        
        <div>
            <label for="kabupaten_id">Kabupaten</label>
            <select name="kabupaten_id" id="kabupaten_id" required>
                <!-- Options will be populated by Laravel Blade -->
                @foreach($kabupatens as $kabupaten)
                    <option value="{{ $kabupaten->id }}">{{ $kabupaten->kabupaten }}</option>
                @endforeach
            </select>
        </div>
        
        <div>
            <label for="lokasi_id">Lokasi</label>
            <select name="lokasi_id" id="lokasi_id" required>
                <!-- Options will be populated by Laravel Blade -->
                @foreach($lokasis as $lokasi)
                    <option value="{{ $lokasi->id }}">{{ $lokasi->lokasi }}</option>
                @endforeach
            </select>
        </div>
        
        <div>
            <label for="cv">CV</label>
            <input type="file" name="cv" id="cv" accept=".pdf" required>
        </div>
        
        <div>
            <label for="surat_pengajuan">Surat Pengajuan</label>
            <input type="file" name="surat_pengajuan" id="surat_pengajuan" accept=".pdf" required>
        </div>

        <div>
            <input type="submit" value="Simpan">
        </div>
    </form>
</body>
</html>
