<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Blade;

use App\Models\User;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function invoices(Request $request)
    {
        $invoices = User::getInvoices2($request->input('client'));
        $clients = User::getClients();
        return view('welcome', [
            'invoices' => $invoices,
            'clients' => $clients,
            'query' => $request->input('client')
        ]);
    }

    public function invoice_detail(Request $request, int $id_invoice)
    {
        $products = User::getInvoiceDetail($id_invoice);
        return view('details', [
            'products' => $products,
            'id' => $id_invoice
        ]);
    }
}
