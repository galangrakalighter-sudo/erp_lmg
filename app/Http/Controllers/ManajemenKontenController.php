<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManajemenKontenController extends Controller
{
    public function index($produk, $platform){
        $nama_produk = DB::table('produk_client')->where('id', $produk)->first();
        $kategory = DB::table("kategori_jasa")->where('id', $nama_produk->kategori_jasa_id)->first();
        
        $data = DB::table("data_jasa")
        ->join('type_produk', 'type_produk.id', '=', 'data_jasa.type_produk_id')
        ->join('strategy', 'strategy.id', '=', 'data_jasa.strategy_id')
        ->join('status', 'status.id', '=', 'data_jasa.status_id')
        ->join('pilar', 'pilar.id', '=', 'data_jasa.pilar_id')
        ->join('hooks', 'hooks.id', '=', 'data_jasa.hooks_id')
        ->join('jenis_body', 'jenis_body.id', '=', 'data_jasa.body_id')
        ->join('jenis_cta', 'jenis_cta.id', '=', 'data_jasa.cta_id')
        ->where('data_jasa.produk_client_id', $produk)
        ->where('data_jasa.platform', $platform)
        ->select('data_jasa.*', 'type_produk.type', 'strategy.strategy', 'status.nama_status', 'pilar.pilar', 'hooks.hooks', 'jenis_body.nama_body', 'jenis_cta.nama_cta')
        ->get();

        // LIST TABLE YANG AKAN DIKONDISIKAN
        $table = ['strategy', 'status', 'pilar', 'hooks', 'type_produk', 'jenis_body', 'jenis_cta'];

        $option = [];

        $title = "Manajemen Konten " . $nama_produk->nama;

        foreach($table as $tab){
            $datatable = DB::table($tab);
            if($kategory->id == 1){
                $option[$tab] = $datatable->where('kategori_id', 1);
            }else{
                $option[$tab] = $datatable->where('kategori_id', 2);
            }
            $option[$tab] = $datatable->where('status', 1)->get();
        }
        return view("manajemen.index", compact('data', 'nama_produk', 'option', 'title', 'kategory', 'platform'));
    }

    public function store($id, Request $request){
        $id = (int)$id;
        // Request yang valuenya diambil dari table yang berbeda
        $arr = ['type', 'strategy', 'pilar', 'hooks',   'status', 'jenis_body', 'jenis_cta'];
        $value = [];
        foreach($arr as $d){
            $value[$d] = (int)$request->$d; 
        }

        // Validasi Terlebih Dahulu
        $request->validate([
            'judul'             => 'required|string|max:255',
            'inspirasi'         => 'nullable|string',
            'platform'          => 'nullable|string',
            'type'              => 'required|integer',
            'strategy'          => 'required|integer',
            'pilar'             => 'required|integer',
            'hooks'             => 'required|integer',
            'jenis_body'        => 'required|integer',
            'jenis_cta'         => 'required|integer',
            'warna'             => 'nullable|string',
            'komposisi'         => 'nullable|string',
            'tanggal_posting'   => 'nullable|date',
            'tanggal_deadline'  => 'nullable|date',
            'link'              => 'nullable|string',
            'status'            => 'required|integer',
            'note'              => 'nullable|string',
        ]);

        // Kirim Data Ke Database
        try {
            DB::table('data_jasa')->insert([
                'produk_client_id' => (int)$id,
                'judul'            => $request->judul,
                'inspirasi'        => $request->inspirasi,
                'type_produk_id'   => $value['type'],
                'strategy_id'      => $value['strategy'],
                'pilar_id'         => $value['pilar'],
                'hooks_id'         => $value['hooks'],
                'body_id'          => $value['jenis_body'],
                'cta_id'           => $value['jenis_cta'],
                'background'       => $request->warna,
                'durasi'           => $request->durasi,
                'komposisi'        => $request->komposisi,
                'note'             => $request->note,
                'tanggal_posting'  => $request->tanggal_posting,
                'tanggal_deadline' => $request->tanggal_deadline,
                'link'             => $request->link,
                'status_id'        => $value['status'],
                'platform'         => $request->platform,
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);

            return redirect()->back()->with('success', 'Data berhasil disimpan');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function update($id, Request $request){
        $arr = ['type', 'strategy', 'pilar', 'hooks', 'status', 'jenis_body', 'jenis_cta'];
        $value = [];
        foreach($arr as $d){
            $value[$d] = (int)$request->$d; 
        }
        // dd($request->all());
        // Validasi Terlebih Dahulu
        $request->validate([
            'judul'             => 'required|string|max:255',
            'inspirasi'         => 'nullable|string',
            'platform'          => 'nullable|string',
            'type'              => 'required|integer',
            'strategy'          => 'required|integer',
            'pilar'             => 'required|integer',
            'hooks'             => 'required|integer',
            'jenis_body'        => 'required|integer',
            'jenis_cta'         => 'required|integer',
            'durasi'            => 'nullable|string|max:50',
            'warna'             => 'nullable|string',
            'komposisi'         => 'nullable|string',
            'tanggal_posting'   => 'nullable|date',
            'tanggal_deadline'  => 'nullable|date',
            'link'              => 'nullable|string',
            'status'            => 'required|integer',
            'note'              => 'nullable|string',
        ]);

        try {
            DB::table('data_jasa')->where('id', $id)->update([
                'judul'            => $request->judul,
                'inspirasi'        => $request->inspirasi,
                'type_produk_id'   => $value['type'],
                'strategy_id'      => $value['strategy'],
                'pilar_id'         => $value['pilar'],
                'hooks_id'         => $value['hooks'],
                'body_id'          => $value['jenis_body'],
                'cta_id'           => $value['jenis_cta'],
                'durasi'           => $request->durasi,
                'background'       => $value['warna'],
                'komposisi'        => $request->komposisi,
                'note'             => $request->note,
                'tanggal_posting'  => $request->tanggal_posting,
                'tanggal_deadline' => $request->tanggal_deadline,
                'link'             => $request->link,
                'status_id'        => $value['status'],
                'platform'         => $request->platform,
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);

            return redirect()->back()->with('success', 'Data berhasil diubah');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function destroy($id) {
        $id = (int)$id;
        DB::table("data_jasa")->delete($id);
        return redirect()->back()->with('success', 'Data Berhasil Di Hapus');
    }
}
