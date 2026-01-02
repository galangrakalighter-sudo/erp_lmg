<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class StrategyController extends Controller
{
    public function index($name){
        $datatable = DB::table("strategy");
        if($name == "LGTR"){
            $data = $datatable->where("kategori_id", 1);
        }else{
            $data = $datatable->where("kategori_id", 2);
        }
        $data = $datatable->get();
        $title = "Strategy";
        return view('cms.strategy.index', compact('data', 'title'));
    }

    public function store(Request $request, $name){
        if($name == "LGTR"){
            $divisi = 1;
        }else {
            $divisi = 2;
        }
        $status = (int)$request->status;
        DB::table("strategy")->insert([
            "strategy" => $request->strategy,
            "status" => $status,
            "kategori_id" => $divisi
        ]);

        return redirect()->back();
    }

    public function update($id, Request $request){
        $id = (int)$id;
        $status = (int)$request->status;
        DB::table('strategy')->where('id', $id)->update([
            "strategy" => $request->strategy,
            "status" => $status
        ]);

        return redirect()->back();
    }

    public function destroy($id){
        $id = (int)$id;
        DB::table('strategy')->where('id', $id)->delete($id);

        return redirect()->back();
    }
}
