<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class komposisiController extends Controller
{
    public function store(Request $request)
    {
        // dd($request->all());
        DB::table('komposisi')->insert([
            "produk_client_id" => $request->produk,
            "type_komposisi" => $request->type,
            "komposisi" => $request->komposisi
        ]);

        return redirect()->back()->with('success', 'Berhasil Menyimpan Data');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::table("komposisi")->where("id", $id)->update([
            'produk_client_id' => $request->produk,
            "type_komposisi" => $request->type,
            "komposisi" => $request->komposisi
        ]);

        return redirect()->back()->with('success', 'Berhasil Mengubah Data');
    }
    
    /**
     * Remove the specified resource from storage.
    */
    public function destroy(string $id)
    {
        DB::table("komposisi")->delete($id);
        return redirect()->back()->with('success', 'Berhasil Menghapus Data');
    }
}
