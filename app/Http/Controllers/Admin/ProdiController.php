<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Biaya;
use App\Models\Kurikulum;
use App\Models\Prodi;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'prodi'     => Prodi::all(),
        ];

        return view('admin.prodi.prodi', $data);
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
        $validate = $request->validate([
            'nama' => 'required',
            'visi' => 'required',
            'misi' => 'required',
            'foto' => 'required|image',
        ]);

        $validate['slug'] = SlugService::createSlug(Prodi::class, 'slug', $request->nama);

        $foto = $request->file('foto');
        $foto->storeAs('public/prodi', $foto->hashName());
        $validate['foto'] = $foto->hashName();

        $prodi = Prodi::create($validate)->id;

        Biaya::create([
            'prodi_id' => $prodi,
        ]);

        return back()->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prodi = Prodi::find($id);

        $view = '
            <p class="mb-0">Visi</p>
            <ol>
        ';
        
        foreach($prodi->getVisi as $visi){
            if($visi != ''){
                $view .= '<li>'. trim($visi, '\r\n') .'</li>';
            }
        }

        $view .= '</ol>';

        $view .= '
            <p class="mb-0">Misi</p>
            <ol>
        ';
        
        foreach($prodi->getMisi as $misi){
            if($misi != ''){
                $view .= '<li>'. trim($misi, '\r\n') .'</li>';
            }
        }

        $view .= '</ol>';
        
        return $view;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'prodi' => Prodi::find($id),
        ];

        return view('admin.prodi.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $prodi = Prodi::find($id);

        $validate = $request->validate([
            'nama' => 'required',
            'visi' => 'required',
            'misi' => 'required',
            'foto' => 'image',
        ]);

        if($request->nama != $prodi->nama){
            $validate['slug'] = SlugService::createSlug(Prodi::class, 'slug', $request->nama);
        }

        if($request->file('foto')){
            $foto = $request->file('foto');

            if($prodi->foto){
                Storage::disk('local')->delete('public/prodi/'. $prodi->foto);
            }

            $foto->storeAs('public/prodi/', $foto->hashName());

            $validate['foto'] = $foto->hashName();
        }

        $prodi->update($validate);

        return redirect(route('prodi.index'))->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prodi = Prodi::find($id);

        Storage::disk('local')->delete('public/prodi/'. $prodi->foto);

        $prodi->biaya->delete();

        $prodi->delete();

        // return back()->with('success', 'Data berhasil dihapus');
        return 'Data berhasil dihapus';
    }

    public function createSlug($prodi){ 
        $slug = SlugService::createSlug(Prodi::class, 'slug', $prodi);

        return response()->json(['slug' => $slug]);
    }
}
