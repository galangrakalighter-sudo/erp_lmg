<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Swot;
class analizeSWOTController extends Controller
{
    public function index() {
        $title = "Analisa SWOT";
        $produk = DB::table('produk_client')->get();
        $data = Swot::join('produk_client', 'produk_client.id', '=', 'analize_swot.produk_client_id')
        ->select('analize_swot.*', 'produk_client.nama')
        ->get();
        return view('cms_market.swot.index', compact(
            'title',
            'produk',
            'data'
        ));
    }

    public function store(Request $request){
        // dd($request->all());
        $request->validate([
            'produk' => 'nullable|integer',
            'strenght' => 'nullable|string',
            'weakness' => 'nullable|string',
            'oportunity' => 'nullable|string',
            'threat' => 'nullable|string',
        ]);

        Swot::create([
            'produk_client_id' => $request->produk,
            'strenght' => $request->strenght,
            'weakness' => $request->weakness,
            'oportunity' => $request->oportunity,
            'threat' => $request->threat,
            "platform" => $request->platform
        ]);
        return redirect()->back()->with('success', 'Berhasil Di Simpan');
    }

    public function update($id, Request $request){
        $request->validate([
            'produk' => 'nullable|integer',
            'strenght' => 'nullable|string',
            'weakness' => 'nullable|string',
            'oportunity' => 'nullable|string',
            'threat' => 'nullable|string'
        ]);
        
        Swot::findOrFail($id)->update([
            'produk_client_id' => $request->produk,
            'strenght'         => $request->strenght, 
            'weakness'         => $request->weakness,
            'oportunity'       => $request->oportunity,
            'threat'           => $request->threat,
            "platform" => $request->platform
        ]);

        return redirect()->back()->with('success', 'Berhasil Di Simpan');
    }

    public function destroy($id){
        $id = (int)$id;
        Swot::destroy($id);
        return redirect()->back()->with('success', 'Berhasil Di Hapus');
    }
}