<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\PDFExport;
use Barryvdh\DomPDF\Facade\Pdf;
class PDFController extends Controller
{
    protected $pdf;

    public function __construct(PDFExport $pdf)
    {
        $this->pdf = $pdf;
    }

    public function exportPDF($id, $halaman){
        $produk = DB::table('produk_client')->where('id', (int)$id)->first();
        switch ($halaman) {
            case "Manajemen Konten":
                $data = $this->pdf->getDataManajemen($produk->id);
                $kategory = DB::table("kategori_jasa")->where('id', $produk->kategori_jasa_id)->first();
                $pdf = Pdf::loadView('pdf.manajemen', compact('data', 'kategory'))
                ->setPaper('a4', 'landscape');
                break;
            case "Branding":
                $data = $this->pdf->getDataBranding($produk->id);
                $pdf = Pdf::loadView('pdf.branding', compact('data'))
                ->setPaper('a4', 'landscape');
                break;
            case "Market Research":
                $data = $this->pdf->getDataMarket($produk->id);
                $pdf = Pdf::loadView('pdf.market', compact('data'))
                ->setPaper('a4', 'landscape');
                break;
            default:
            break;
        }
        return $pdf->download('Data-Produk-Halaman-'.$halaman.'.pdf');
    }
}
