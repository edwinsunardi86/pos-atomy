<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('master.product.index', [
            'active_gm' => 'Master',
            'active_m'  => 'products',
            'title'     => 'Product List'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('master.product.create', [
            'categories' => DB::table('categories')->get(),
            'active_gm' => 'Master',
            'active_m'  => 'products',
            'title'     => 'Product Create'
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
        $productCode = $request->input('product_code');
        $productName = $request->input('product_name');

        // ---check DuplicateProductCode and ProductName logic goes here---
        $checkDuplicate = DB::table('products')
            ->where('product_code', $productCode)
            ->orWhere('product_name', $productName)
            ->first();
        // --- IGNORE ---
        if(!$checkDuplicate){
            DB::table('products')->insert([
                'category_id'   => $request->input('category_id'),
                'product_code'  => $productCode,
                'product_name'  => $productName,
                'point_value'   => str_replace(',','',$request->input('point_value')),
                'price'         => str_replace(',','',$request->input('price')),
                'description'   => $request->input('description'),
                'created_at'    => now(),
                'created_by'    => Auth::user()->id
            ]);
            // return redirect()->route('products.index')->with('success', 'Product created successfully.');
            return response()->json(['icon' => 'success','message' => 'Product created successfully.'],200);
        } else {
            return response()->json(['icon' => 'error','message' => 'Duplicate Product Code or Product Name found.'],200);
        }

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
        return view('master.product.edit', [
            'product' => DB::table('products')->find($id),
            'categories' => DB::table('categories')->get(),
            'active_gm' => 'Master',
            'active_m'  => 'products',
            'title'     => 'Product Edit'
        ]);
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
        $productCode = $request->input('product_code');
        $productName = $request->input('product_name');

        // ---check DuplicateProductCode and ProductName logic goes here---
        $checkDuplicate = DB::table('products')
            ->where(function($query) use ($productCode, $productName) {
                $query->where('product_code', $productCode)
                      ->orWhere('product_name', $productName);
            })
            ->where('id', '!=', $id)
            ->first();
        // --- IGNORE ---
        if(!$checkDuplicate){
            $checkTransaction = DB::table('purchase_order_items')
                ->where('product_code', $id)
                ->first();
            if($checkTransaction){
                return response()->json(['icon' => 'error','message' => 'Cannot update product because it is associated with existing PO.'],200);
            }else{
                DB::table('products')
                ->where('id', $id)
                ->update([
                    'category_id'   => $request->input('category_id'),
                    'product_code'  => $productCode,
                    'product_name'  => $productName,
                    'point_value'   => str_replace(',','',$request->input('point_value')),
                    'price'         => str_replace(',','',$request->input('price')),
                    'description'   => $request->input('description'),
                    'updated_at'    => now(),
                    'updated_by'    => Auth::user()->id
                ]);
                return response()->json(['icon' => 'success','message' => 'Product updated successfully.'],200);
            }
        } else {
            return response()->json(['icon' => 'error','message' => 'Duplicate Product Code or Product Name found.'],200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $checkTransaction = DB::table('purchase_order_items')
            ->where('product_code', $id)
            ->first();
        if($checkTransaction){
            return response()->json(['icon' => 'error','message' => 'Cannot delete product because it is associated with existing PO.'],200);
        }else{
            DB::table('products')
                ->where('id', $id)
                ->delete();
            return response()->json(['icon' => 'success','message' => 'Product deleted successfully.'],200);
        }
    }

    public function dataTableProduct(Request $request){
        try {
            $data = DB::table('products')
                ->join('categories','products.category_id','=','categories.id')
                ->select('products.*', 'categories.category_name')
                ->get();

            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="'.url("products/".$row->id."/edit").'" class="edit btn btn-primary btn-sm">Edit</a> ';
                    $btn .= '<a class="delete-product btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" data-id="'.$row->id.'" data-product_code="'.$row->product_code.'" data-product_name="'.$row->product_name.'">Delete</a>';
                    return $btn;
                })
                ->make(true);
        } catch (\Exception $e) {
            Log::error('dataTableProduct error: '.$e->getMessage());
            return response()->json([
                'error' => 'Server error while fetching products',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function searchDataProduct(Request $request){
        $query = DB::table('products')
            ->join('categories', 'categories.id','=','categories.id')
            ->select('products.*', 'categories.category_name')
            ->where('product_name', 'like','%'.$request->product_name.'%')
            ->get();

        return response()->json($query,200);
    }
}
