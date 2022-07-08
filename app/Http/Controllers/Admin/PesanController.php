<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\SendMail;
use App\Models\Balasan;
use App\Models\Kontak;
use App\Models\Pesan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PesanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'pesan' => Pesan::with(['balasan'])->orderBy('tgl_pesan', 'desc')->get(),
        ];

        return view('admin.pesan', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'subjek' => 'required',
            'balasan' => 'required',
        ]);

        $pesan = Pesan::find($request->pesan_id);

        Balasan::create([
            'subjek' => $request->subjek,
            'isi' => $request->balasan,
            'pesan_id' => $request->pesan_id,
        ]);

        $attr = [
            'nama' => $pesan->nama,
            'pesan' => $request->balasan,
            'subject' => $request->subjek,
        ];

        Mail::to($request->email)->send(new SendMail($attr));

        return back()->with('success', 'Pesan berhasil dikirimkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pesan  $pesan
     * @return \Illuminate\Http\Response
     */
    public function show(Pesan $pesan)
    {
        $pesan->load(['balasan']);
        $pesan['myEmail'] = Kontak::all()->first()->email;

        return response()->json($pesan);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pesan  $pesan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pesan $pesan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pesan  $pesan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pesan $pesan)
    {
        // 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pesan  $pesan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pesan $pesan)
    {
        $pesan->delete();

        return 'Pesan berhasil dihapus';
    }
}
