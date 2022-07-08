<table border="1">
    <thead>
        <tr>
            <th>No.</th>
            <th>Tahun Akademik</th>
            <th>Nama</th>
            <th>Nomor Pendaftaran</th>
            <th>Jalur Masuk</th>
            <th>Asal Sekolah</th>
            <th>Kelengkapan Berkas</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($seleksi as $i => $d)
        <tr>
            <td>{{ $i+1 }}</td>
            <td width="20">{{ $d->tahun_akademik->tahun }}</td>
            <td width="40">{{ $d->daftar->nama }}</td>
            <td width="20">{{ $d->nim }}</td>
            <td width="20">{{ $d->daftar->jalur->judul }}</td>
            <td width="40">{{ $d->daftar->slta }}</td>
            <td width="40">{{ $d->ket_berkas == null ? 'Berkas Lengkap' : $d->ket_berkas}}</td>
        </tr>
        @endforeach
    </tbody>
</table>