<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Expense;
use App\Models\Sale;
use App\Models\Job;
use Barryvdh\DomPDF\Facade\Pdf;

class PrintReport extends Controller
{
    public $fromDate;
    public $toDate;
    // public $sales = [];
    // public $jobs = [];
    // public $expenses = [];
    // public $totalSales = 0;
    // public $totalJobs = 0;
    // public $totalExpenses = 0;
    // public $grandTotal = 0;


    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $from, $to)
    {
        $this->fromDate = Carbon::parse($from)->format('Y-m-d');
        $this->toDate = Carbon::parse($to)->format('Y-m-d');

        $sales = Sale::whereBetween('created_at', [$this->fromDate, $this->toDate])
            ->where('sale_type', 'sale')
            ->orderBy('created_at', 'desc')
            ->get();
        $totalSales = $sales->sum('total_amount');

        $jobs = Job::whereBetween('created_at', [$this->fromDate, $this->toDate])
            ->orderBy('created_at', 'desc')
            ->get();
        $totalJobs = $jobs->sum('total_amount');

        $expenses = Expense::whereBetween('created_at', [$this->fromDate, $this->toDate])
            ->orderBy('created_at', 'desc')
            ->get();
        $totalExpenses = $expenses->sum('amount');

        $grandTotal = $totalSales + $totalJobs - $totalExpenses;

        $logo = public_path('storage/' . config('settings.logo'));

        $pdf = Pdf::loadView('report', [
            'logo' => $logo,
            'sales' => $sales,
            'jobs' => $jobs,
            'expenses' => $expenses,
            'total_sales' => $totalSales,
            'total_jobs' => $totalJobs,
            'total_expenses' => $totalExpenses,
            'grand_total' => $grandTotal,
            'asOf' => $this->fromDate . '/' . $this->toDate
        ]);
        $pdf->setOption(['dpi' => 150, 'defaultFont' => 'monospace']);
        $pdf->setPaper('a5', 'portrait');
        return $pdf->stream();
    }
}
