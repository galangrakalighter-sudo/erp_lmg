<?php

namespace App\Http\Controllers;

use App\Models\ProdukClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    public function index($nama){
        $kategoriQuery = DB::table('kategori_jasa');
        if($nama == "LGTR"){
            $kategoriQuery = $kategoriQuery->where('id', 1);
        }else {
            $kategoriQuery = $kategoriQuery->whereIn('id', [2,3]);
        }
        $kategori = $kategoriQuery->get();

        $query = DB::table('produk_client')
        ->join('kategori_jasa', 'kategori_jasa.id', '=', 'produk_client.kategori_jasa_id')
        ->select('produk_client.*', 'kategori_jasa.category');
        if ($nama == "LGTR") {
            $query->where('produk_client.kategori_jasa_id', 1);
        } else {
            $query->whereIn('produk_client.kategori_jasa_id', [2, 3]);
        }

        $dataClient = $query->get();
        $title = "Produk";
        return view('cms.produk.index', compact('kategori', 'dataClient', 'title'));
    }

    public function store(Request $request){
        // dd($request->all());
        $id = (int)$request->kategori_jasa_id;
        $status = (int)$request->status;
        $array = [
            'platform' => $request->platform,
            'access' => $request->access,
        ];

        ProdukClient::create([
            "kategori_jasa_id" => $id,
            "nama" => $request->client,
            "status" => $status,
            "access_token" => $array
        ]);

        return redirect()->back();
    }

    public function update($id, Request $request){
        // dd($request->all());
        $id = (int)$id;
        $kategori = (int)$request->kategori_jasa_id;
        $status = (int)$request->status;
        $array = [
            'platform' => $request->platform,
            'access' => $request->access,
        ];
        DB::table('produk_client')->where('id', $id)->update([
            "kategori_jasa_id" => $kategori,
            "nama" => $request->client,
            "status" => $status,
            "access_token" => $array
        ]);

        return redirect()->back();
    }

    public function destroy($id){
        $id = (int)$id;
        DB::table('produk_client')->where('id', $id)->delete($id);

        return redirect()->back();
    }

    public function docs(){
        $title = "Access Token";
        return view('cms.produk.access_token', compact("title"));
    }
}
