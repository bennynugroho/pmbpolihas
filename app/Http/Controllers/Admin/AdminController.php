<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Formulir;
use App\Models\InfoPendaftaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // Akun Admin
    public function showEditAkun(Request $request)
    {
        $akun = User::find($request->id);

        $view = '
            <div class="mb-3">
                <label for="name_akun" class="form-label">Nama</label>
                <input type="text" class="form-control" name="nama" id="name_akun" value="'. $akun->nama .'" placeholder="Masukkan nama akun">
            </div>
            <div class="mb-3">
                <label for="email_akun" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email_akun" value="'. $akun->email .'" placeholder="Masukkan email akun">
            </div>
            <div class="mb-3">
                <button type="button" id="btn-show-pass" onclick="showFormPass()" class="btn btn-sm btn-warning text-white">Ganti Password ?</button>
                <button type="button" style="display: none;" id="btn-hide-pass" onclick="hideFormPass()" class="btn btn-sm btn-danger text-white">Tutup form ganti password</button>
            </div>
            <div class="mb-3" style="display: none;" id="form-pass">
                <label class="form-label" for="input-password">Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" name="password" id="input-password" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;">
                    <span class="input-group-text pt-1" id="changeTypePass" onclick="changeTypePass()"><i class="bi bi-eye"></i></span>
                </div>
            </div>
        ';

        return $view;
    }

    public function updateAkun(Request $request)
    {
        $akun = User::find($request->id);

        if($request->password == null){
            $akun->update([
                'nama'  => $request->nama,
                'email' => $request->email,
            ]);
        }else{
            $akun->update([
                'nama'     => $request->nama,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
            ]);
        }

        return back()->with('success', 'Akun berhasil di ubah');
    }
    // Akhir Akun Admin

    // Info Pendaftaran
    public function showEditInfo(Request $request){
        $info = InfoPendaftaran::find($request->id);

        $view = '
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="tanggal_mulai" class="form-label">Tanggal Mulai Pendaftaran</label>
                        <input type="date" class="form-control" name="tanggal_mulai" id="tanggal_mulai" value="'. $info->tgl_awal_daftar .'" placeholder="Masukkan tanggal" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="tanggal_selesai" class="form-label">Tanggal Akhir Pendaftaran</label>
                        <input type="date" class="form-control" name="tanggal_selesai" id="tanggal_selesai" value="'. $info->tgl_akhir_daftar .'" placeholder="Masukkan tanggal" required>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="tanggal_bayar" class="form-label">Terakhir Pembayaran</label>
                <input type="date" class="form-control" name="tanggal_bayar" id="tanggal_bayar" value="'. $info->terakhir_pembayaran .'" placeholder="Masukkan tanggal" required>
            </div>
            <div class="mb-3">
                <label for="bank" class="form-label">Bank</label>
                <input type="text" class="form-control" name="bank" id="bank" value="'. $info->bank .'" placeholder="Masukkan bank" required>
            </div>
            <div class="mb-3">
                <label for="rekening" class="form-label">Rekening</label>
                <input type="text" class="form-control" name="rekening" id="rekening" value="'. $info->rekening .'" placeholder="Masukkan rekening" required>
            </div>
        ';

        return $view;
    }

    public function updateInfoDaftar(Request $request){
        $info = InfoPendaftaran::find($request->id);

        $info->update([
            'tgl_awal_daftar'     => $request->tanggal_mulai,
            'tgl_akhir_daftar'    => $request->tanggal_selesai,
            'terakhir_pembayaran' => $request->tanggal_bayar,
            'bank'                => $request->bank,
            'rekening'            => $request->rekening,
        ]);

        return back()->with('success', 'Info pendaftaran berhasil diupdate');
    }
    // Akhir Info Pendaftaran

    // Formulir Pendaftaran
    public function updateFormulir(Request $request)
    {
        $formulir = Formulir::find($request->id);
        $file = $request->file('formulir');

        Storage::disk('local')->delete('public/formulir/'. $formulir->path);
        $file->storeAs('public/formulir', $file->getClientOriginalName());

        $formulir->update([
            'path' => $file->getClientOriginalName(),
        ]);

        return back()->with([
            'success' => 'Data berhasil diupdate',
            'tab' => 'formulir',
        ]);
    }
    // Akhir Formulir Pendaftaran
}
