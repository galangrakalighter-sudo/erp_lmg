<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class audioBrandingController extends Controller
{
    public function store(Request $request)
    {
        // dd($request->all());
        DB::table('audio_brand')->insert([
            "produk_client_id" => $request->produk,
            "nama_audio" => $request->nama
        ]);

        return redirect()->back()->with('success', 'Berhasil Menyimpan Data');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::table("audio_brand")->where("id", $id)->update([
            'produk_client_id' => $request->produk,
            "nama_audio" => $request->nama
        ]);

        return redirect()->back()->with('success', 'Berhasil Mengubah Data');
    }
    
    /**
     * Remove the specified resource from storage.
    */
    public function destroy(string $id)
    {
        DB::table("audio_brand")->delete($id);
        return redirect()->back()->with('success', 'Berhasil Menghapus Data');
    }
}
