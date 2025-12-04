<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('transaction.purchase_order.index', [
            'active_gm' => 'Transaction',
            'active_m'  => 'purchase_orders',
            'title'     => 'Purchase Order List'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transaction.purchase_order.create', [
            'products' => DB::table('products')->get(),
            'active_gm' => 'Transaction',
            'active_m'  => 'purchase_orders',
            'title'     => 'Purchase Order Create'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function datatablePurchaseOrders()
    {
        try {
            $data = DB::table('purchase_orders AS po')
            ->select('po.id','po.order_number','po.sales_date',DB::raw('SUM(poi.price) AS total_price'))
                ->join('purchase_order_items as poi','poi.id_header','=','po.id')
                ->join('products as p','p.product_code','=','poi.product_code')
                ->get();

            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="'.url("purchase_orders/".$row->id."/edit").'" class="edit btn btn-primary btn-sm">Edit</a> ';
                    $btn .= '<a class="delete-po btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" data-id="'.$row->id.'" data-order_number="'.$row->order_number.'">Delete</a>';
                    return $btn;
                })
                ->make(true);
        } catch (\Exception $e) {
            \Log::error('dataTablePurchaseOrders error: '.$e->getMessage());
            return response()->json([
                'error' => 'Server error while fetching products',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}

