<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PrintItem extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $items = Item::orderBy('updated_at', 'desc')->get();
        // ->withSum('sales', 'total_amount')
        $logo = public_path('storage/' . config('settings.logo'));

        $pdf = Pdf::loadView('item', [
            'logo' => $logo,
            'items' => $items,
            'asOf' => date("Y-m-d")
        ]);
        $pdf->setOption(['dpi' => 150, 'defaultFont' => 'monospace']);
        $pdf->setPaper('a5', 'portrait');
        return $pdf->stream();
    }
}
