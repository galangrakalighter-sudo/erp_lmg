<?php

namespace App\Http\Controllers;

use App\Models\ProdukClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Arr;

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

        $userClients = is_array(Auth::user()->client) ? Auth::user()->client : json_decode(Auth::user()->client, true) ?? [];
        $query = DB::table('produk_client')
        ->join('kategori_jasa', 'kategori_jasa.id', '=', 'produk_client.kategori_jasa_id')
        ->select('produk_client.*', 'kategori_jasa.category');
        if ($nama == "LGTR") {
            $query->where('produk_client.kategori_jasa_id', 1);
        } else {
            $query->whereIn('produk_client.kategori_jasa_id', [2, 3]);
        }

        if(Auth::user()->role != "head_of_division" && Auth::user()->role != "super_admin"){
            $query->whereIn('produk_client.id', $userClients);
        }
        
        $dataClient = $query->get();

        $dm = User::where('role', 'digital_marketing')->get();
        $cc = User::where('role', 'content_creator')->get();

        $title = "Produk";
        return view('cms.produk.index', compact('kategori', 'dataClient', 'title', 'dm', 'cc'));
    }

    public function store(Request $request){
        $id = (int)$request->kategori_jasa_id;
        $status = (int)$request->status;
        $array = [
            'platform' => $request->platform,
            'access' => $request->access,
        ];

        $produk = ProdukClient::create([
            "kategori_jasa_id" => $id,
            "nama" => $request->client,
            "status" => $status,
            "access_token" => $array
        ]);
            
        foreach($request->dm as $dmId){
            $user = User::find($dmId);
            if($user) {
                $clientLama = $user->client ?? []; 
                
                $clientBaru = array_unique(array_merge($clientLama, [$produk->id]));
                
                $user->update([
                    'client' => array_values($clientBaru)
                ]);
            }
        }

        $client_baru = array_unique(array_merge(Auth::user()->client ?? [], [$produk->id]));
        Auth::user()->update([
            'client' => array_values($client_baru)
        ]);

        foreach($request->cc as $ccId){
            $user = User::find($ccId);
            if($user) {
                $clientLama = $user->client ?? [];
                $clientBaru = array_unique(array_merge($clientLama, [$produk->id]));
                
                $user->update([
                    'client' => array_values($clientBaru)
                ]);
            }
        }

        return redirect()->back();
    }

    public function update($id, Request $request){
        $id = (int)$id;
        $kategori = (int)$request->kategori_jasa_id;
        $status = (int)$request->status;
        DB::transaction(function () use ($id, $kategori, $status, $request) {
            $array = [
                'platform' => $request->platform,
                'access' => $request->access,
            ];

            DB::table('produk_client')->where('id', $id)->update([
                "kategori_jasa_id" => $kategori,
                "nama" => $request->client,
                "status" => $status,
                "access_token" => json_encode($array)
            ]);

            User::whereIn('role', ['digital_marketing', 'content_creator'])
                ->whereJsonContains('client', $id)
                ->get()
                ->each(function($user) use ($id) {
                    $cleaned = collect($user->client)->reject(fn($val) => $val == $id)->values()->all();
                    $user->update(['client' => $cleaned]);
                });

            $selectedUserIds = collect($request->dm)
                ->merge($request->cc)
                ->filter()
                ->unique()
                ->all();

            foreach($selectedUserIds as $userId) {
                $user = User::find($userId);
                if($user) {
                    $updatedClients = collect($user->client)->push($id)->unique()->values()->all();
                    $user->update(['client' => $updatedClients]);
                }
            }
        });

        return redirect()->back();
    }

    public function destroy($id){
        $id = (int)$id;
        DB::table('produk_client')->where('id', $id)->delete($id);
        DB::transaction(function () use ($id) {

        User::whereIn('role', ['digital_marketing', 'content_creator'])
            ->whereJsonContains('client', $id)
            ->get()
            ->each(function($user) use ($id) {
                $cleaned = collect($user->client)->reject(fn($val) => $val == $id)->values()->all();
                $user->update(['client' => $cleaned]);
            });
        });
        return redirect()->back();
    }

    public function docs(){
        $title = "Access Token";
        return view('cms.produk.access_token', compact("title"));
    }
}
