<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Positioning;
use Illuminate\Support\Facades\DB;
class positioningController extends Controller
{
    public function index(){
        $title = "Target Audience";
        $produk = DB::table('produk_client')->get();
        $data = Positioning::join('produk_client', 'produk_client.id', '=', 'positioning.produk_client_id')
        ->select('positioning.*', 'produk_client.nama')
        ->get();
        
        return view('cms_market.positioning.index', compact(
            'title',
            'produk',
            'data'
        ));
    }

    public function store(Request $request){
        $request->validate([
            "indikator" => "nullable|string",
            "deskripsi" => "nullable|string"
        ]);

        Positioning::create([
            "produk_client_id" => $request->produk,
            "indikator" => $request->indikator,
            "deskripsi" => $request->deskripsi
        ]);

        return redirect()->back()->with('success', 'Berhasil Di Simpan');
    }

    public function update($id, Request $request){
        // dd($request->all());
        $request->validate([
            "indikator" => "nullable|string",
            "deskripsi" => "nullable|string"
        ]);
        Positioning::findOrFail($id)->update([
            "produk_client_id" => $request->produk,
            "indikator" => $request->indikator,
            "deskripsi" => $request->deskripsi
        ]);

        return redirect()->back()->with('success', 'Berhasil Di Simpan');
    }

    public function destroy($id){
        $id = (int)$id;
        Positioning::destroy($id);
        return redirect()->back()->with('success', 'Berhasil Di Hapus');
    }
}
