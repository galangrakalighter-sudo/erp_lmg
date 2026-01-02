<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class gayaKomunikasiController extends Controller
{
    public function store(Request $request)
    {
        // dd($request->all());
        DB::table('gaya_komunikasi')->insert([
            "produk_client_id" => $request->produk,
            "gaya_bicara" => $request->gaya_bicara,
            "gaya_bahasa" => $request->gaya_bahasa
        ]);

        return redirect()->back()->with('success', 'Berhasil Menyimpan Data');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::table("gaya_komunikasi")->where("id", $id)->update([
            'produk_client_id' => $request->produk,
            "gaya_bicara" => $request->gaya_bicara,
            "gaya_bahasa" => $request->gaya_bahasa
        ]);

        return redirect()->back()->with('success', 'Berhasil Mengubah Data');
    }
    
    /**
     * Remove the specified resource from storage.
    */
    public function destroy(string $id)
    {
        DB::table("gaya_komunikasi")->delete($id);
        return redirect()->back()->with('success', 'Berhasil Menghapus Data');
    }
}
