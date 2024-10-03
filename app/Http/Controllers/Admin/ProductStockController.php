<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Traits\RowIndex;
use App\Helpers\Traits\StockTrait;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductStock;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProductStockController extends Controller
{
    use RowIndex, StockTrait;
    public function index(){
        $pageTitle = 'Product Stock List';
        if (request()->ajax()) {
            $data = Product::orderBy('id', 'DESC');

            $dataCollection = $data;
            return DataTables::of($dataCollection)
                ->addColumn('sl', function ($row) {
                    return $this->dt_index($row);
                })
                ->addColumn('product', function ($row) {
                    return $row->title;
                })
                ->addColumn('total_qty', function ($row) {
                    return $this->companyProductTotalQTY($row->id);
                })
                ->addColumn('total_sales_qty', function ($row) {
                    return $this->companyProductSale($row->id);
                })
                ->addColumn('stock', function ($row) {
                    return $this->companyProductStock($row->id);
                })
                ->rawColumns(['sl', 'product', 'total_qty', 'total_sales_qty'])
                ->make(true);
        }
        return view('admin.page.product_stock.index', compact('pageTitle'));
    }

    public function create(){
        $pageTitle = 'Add New Product Stock';
        if (request()->ajax()) {
            $data = ProductStock::orderBy('id', 'DESC');

            $dataCollection = $data;
            return DataTables::of($dataCollection)
                ->addColumn('sl', function ($row) {
                    return $this->dt_index($row);
                })
                ->addColumn('product', function ($row) {
                    return $row->product->title ?? 'N/A';
                })

                ->addColumn('action', function ($row) {
                    $btn1 = '<button onclick="edit('.$row->id.');" type="button" class="btn btn-sm btn-primary mr-2"><i class="fas fa-edit"></i></button>';
                    $btn2 = '<button onclick="destroy('. $row->id .')" type="button" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>';
                    return $btn1.$btn2;
                })
                ->rawColumns(['action', 'sl', 'product'])
                ->make(true);
        }
        return view('admin.page.product_stock.create', compact('pageTitle'));
    }
    public function store(Request $request){
        // return $request;
        $request->validate([
            'product_id' => 'required',
            'qty' => 'required',
            'note' => 'nullable',
        ]);

        $data = ProductStock::create([
            'product_id' => $request->product_id,
            'qty' => $request->qty,
            'note' => $request->note,
        ]);

        return response()->json($data);
    }

    public function edit($id){
        $data = ProductStock::findOrFail($id);
        return response()->json($data);
    }

    public function destroy($id){
        $data = ProductStock::findOrFail($id);
        $data->forceDelete();
        return response()->json($data);
    }
    public function update(Request $request, $id){
        $data = ProductStock::findOrFail($id);
        $request->validate([
            'product_id' => 'required',
            'qty' => 'required',
            'note' => 'nullable',
        ]);

        $data->product_id = $request->product_id;
        $data->qty = $request->qty;
        $data->note = $request->note;
        $data->save();

        return response()->json($data);
    }
}
