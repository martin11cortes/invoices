<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public static function getInvoices(int $client_id = null)
    {
        $invoices = DB::raw('SELECT 
        po.invoice_number as invoice,
        c.name AS client,
        i.create_time as posted_date,
        i.status as status,
        (p.price * po.quantity) AS amount
    FROM
        product_order po
            INNER JOIN
        invoice i ON po.invoice_number = i.id_invoice
            INNER JOIN
        product p ON po.id_product = p.id_product
            INNER JOIN
        client c ON i.id_client = c.id_client
    GROUP BY i.id_invoice;');
        return $invoices;
    }

    public static function getInvoices2(int $id_client = null)
    {
        return DB::table('product_order', 'po')
            ->join('invoice as i', 'po.invoice_number', '=', 'i.id_invoice')
            ->join('product as p', 'po.id_product', '=', 'p.id_product')
            ->join('client as c', 'i.id_client', '=', 'c.id_client')
            ->selectRaw('po.invoice_number as invoice,
                    c.name AS client,
                    i.create_time as posted_date,
                    i.status as status,
                    SUM(p.price * po.quantity) AS amount')
            ->groupBy('i.id_invoice')
            ->when($id_client, function ($query, $id_client) {
                $query->where('i.id_client', $id_client);
            })->get();
    }

    public static function getClients()
    {
        return DB::select('select * from client;');
    }

    public static function getInvoiceDetail(int $id_invoice)
    {
        return DB::table('product_order', 'po')
            ->join('product as p', 'po.id_product', '=', 'p.id_product')
            ->selectRaw('p.description,
                    p.sku,
                    p.price,
                    po.quantity')
            ->when($id_invoice, function ($query, $id_invoice) {
                $query->where('po.invoice_number', $id_invoice);
            })->get();
    }
}
