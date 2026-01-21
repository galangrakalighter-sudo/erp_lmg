<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        $title = "Manejemen User";
        $mapping = [
            1 => 'Digital Marketing',
            2 => 'Business Dev',
        ];
        $userDivisi = Auth::user()->divisi;

        $data = User::with(['many_dmm', 'many_dm', 'many_cc'])
            ->whereNot('role', 'super_admin')
            ->whereNot('id', Auth::user()->id)
            ->where(function ($query) use ($userDivisi) {
                foreach (collect($userDivisi) as $divisiId) {
                    $query->orWhereJsonContains('divisi', $divisiId);
                }
            })
            ->orderBy('id', 'ASC')
            ->get()
            ->map(function ($user) use ($mapping) {
                $user->labels = collect($user->divisi)->map(function ($value) use ($mapping) {
                    return $mapping[$value] ?? 'Unknown';
                });
                
                return $user;
            });
        
        return view('users.index', compact('title', 'data'));
    }

    public function store(Request $request){
        $dmm_id = $request->dmm;
        $dm_id  = $request->dm;
        switch ($request->role) {
            case 'head_of_division':
                $hod_id = null;
                $dmm_id = null;
                $dm_id = null;
                break;
            case 'digital_marketing_manager':
                $hod_id = Auth::user()->role == "head_of_division" ? Auth::user()->id : (int)$request->hod_id;
                $dmm_id = null;
                $dm_id = null;
                break;
            case 'digital_marketing':
                $hod_id = User::find($request->dmm_id)->hod ?? null;
                $dmm_id = $request->dmm_id ?? null;
                $dm_id = null;
                break;
            case 'content_creator':
                $hod_id = User::find($request->dm_id)->hod ?? null;
                $dmm_id = User::find($request->dm_id)->dmm ?? null;
                $dm_id =  (int)$request->dm_id ?? null;
                break;
            default:
                break;
        }

        $divisi = Auth::user()->role == "super_admin" ? array_map('intval', (array)$request->divisi) : [(int)Auth::user()->divisi[0]];
        
        // dd(array_map('intval', (array)$request->divisi)[0]);
        // 3. Simpan ke Database
        $newUser = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'role'     => $request->role,
            'divisi'   => $divisi,
            'hod'      => $hod_id,
            'dmm'      => $dmm_id,
            'dm'       => $dm_id,
            'cc'       => null,
            'client'   => [],
        ]);

        if ($request->has('bawahan_ids') && is_array($request->bawahan_ids)) {
            foreach ($request->bawahan_ids as $subordinateId) {
                $subordinate = User::find($subordinateId);
                if ($subordinate) {
                    // Jika user baru adalah DMM, maka dia jadi 'dmm' bagi bawahannya
                    if ($request->role === 'digital_marketing_manager') {
                        $subordinate->update(['dmm' => $newUser->id]);
                    }
                    // Jika user baru adalah DM, maka dia jadi 'dm' bagi bawahannya
                    elseif ($request->role === 'digital_marketing') {
                        $subordinate->update(['dm' => $newUser->id]);
                    }
                }
            }
        }

        return redirect()->back()->with('success', 'Berhasil Membuat Akun');
    }

    public function update($id, Request $request){
        $dmm_id = $request->dmm;
        $dm_id = $request->dm;
        switch ($request->role) {
            case 'head_of_division':
                $hod_id = null;
                $dmm_id = null;
                $dm_id = null;
                break;
            case 'digital_marketing_manager':
                $hod_id = Auth::user()->role == "head_of_division" ? Auth::user()->id : (int)$request->hod_id;
                $dmm_id = null;
                $dm_id = null;
                break;
            case 'digital_marketing':
                $hod_id = User::find($request->dmm_id)->hod ?? null;
                $dmm_id = (int)$request->dmm ?? null;
                $dm_id = null;
                break;
            case 'content_creator':
                $hod_id = User::find($request->dm_id)->hod ?? null;
                $dmm_id = User::find($request->dm)->dmm ?? null;
                $dm_id =  (int)$request->dm ?? null;
                break;
            default:
                break;
        }
        
        $divisi = Auth::user()->role == "super_admin" ? array_map('intval', (array)$request->divisi) : [(int)Auth::user()->divisi[0]];
        
        // 3. Simpan ke Database
        User::where('id', $id)->update([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => $request->password ? bcrypt($request->password) : User::where('id', $id)->first()->password,
            'role'     => $request->role,
            'divisi'   => $divisi,
            'hod'      => $hod_id,
            'dmm'      => $dmm_id,
            'dm'       => $dm_id,
            'cc'       => null,
            'client'   => [],
        ]);

        if ($request->has('bawahan_ids') && is_array($request->bawahan_ids)) {
            foreach ($request->bawahan_ids as $subordinateId) {
                $subordinate = User::find($subordinateId);
                if ($subordinate) {
                    if ($request->role === 'digital_marketing_manager') {
                        $cc = User::where('cc', $subordinate->cc)->first();
                        $ccData = User::find($cc->id);
                        User::where('id', $subordinate->dmm)->update(['dm' => null]);
                        
                        $subordinate->update(['dmm' => $id]);
                        
                        $subordinate->update(['hod' => $hod_id]);

                        $ccData->update(['dmm' => $id]);

                        $ccData->update(['hod' => $hod_id]);

                    }elseif ($request->role === 'digital_marketing') {
                        User::where('id', $subordinate->dm)->update(['cc' => null]);
                        $subordinate->update(['dm' => $id]);
                        $subordinate->update(['hod' => $hod_id]);
                    }
                }
            }
        }

        return redirect()->back()->with('success', 'berhasil ubah data user');
    }

    public function destroy($id){
        $id = (int)$id;
        User::destroy($id);
        return redirect()->back()->with('success', 'User Berhasil di Hapus');
    }
}
