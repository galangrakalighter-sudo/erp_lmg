<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\MarketResearch\MarketResearchService;
class marketResearchController extends Controller
{
    protected $market;
    public function __construct(MarketResearchService $market)
    {
        $this->market = $market;
    }

    public function index($id, $platform){
        $data = $this->market->getMarket((int)$id, $platform);
        $title = "Market Research";
        // dd($data['data']);
        $arr=[];
        foreach($data['data'][3] as $d){
            array_push($arr, $d);
        }
        $produk = DB::table('produk_client')->where('id', $id)->first();
        // dd($arr);
        return view('market.index', compact('data', 'title', 'produk', 'platform'));
    }
}
