<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\User;
use App\Models\Village;
use Devfaysal\BangladeshGeocode\Models\District;
use Devfaysal\BangladeshGeocode\Models\Division;
use Devfaysal\BangladeshGeocode\Models\Union;
use Devfaysal\BangladeshGeocode\Models\Upazila;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = 'Country';
        $data=[
            'title'=>'Country',
        ];

        if (request()->ajax()) {
            $get = Country::query();
            return DataTables::of($get)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->name ?? '';
                })
                ->addColumn('currency_name', function ($row) {
                    return $row->currency_name ?? '';
                })
                ->addColumn('currency_symbol', function ($row) {
                    return $row->currency_symbol ?? '';
                })
                ->addColumn('timezone', function ($row) {
                    return $row->timezone ?? '';
                })
                ->addColumn('action', function ($get) use ($data) {
                    $button = '<button onclick="edit('.$get->id.');" type="button" class="btn btn-sm btn-primary mr-2"><i class="fas fa-edit"></i></button>';
                    $button .= '<button onclick="destroy('. $get->id .')" type="button" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.page.country.index',compact('data','pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'country_name' => ['required'],
            'currency_name' => ['required'],
            'currency_symbol' => ['required'],
            'timezone' => ['required'],
        ]);

        $data = new Country;
        $data->name = $request->country_name;
        $data->currency_name = $request->currency_name;
        $data->currency_symbol = $request->currency_symbol;
        $data->timezone = $request->timezone;
        $data->save();

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return Country::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'country_name' => ['required'],
            'currency_name' => ['required'],
            'currency_symbol' => ['required'],
            'timezone' => ['required'],
        ]);

        $data = Country::findOrFail($id);
        $data->name = $request->country_name;
        $data->currency_name = $request->currency_name;
        $data->currency_symbol = $request->currency_symbol;
        $data->timezone = $request->timezone;

        $data->save();

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $country = Country::findOrFail($id);
        $country->delete();
        return $country;
    }

    public function division_index(){
        $pageTitle = 'Division List';

        if (request()->ajax()) {
            $get = Division::query();
            return DataTables::of($get)
                ->addIndexColumn()
                ->addColumn('action', function ($get) {
                    $button = '<button onclick="edit('.$get->id.');" type="button" class="btn btn-sm btn-primary mr-2"><i class="fas fa-edit"></i></button>';
                    $button .= '<button onclick="destroy('. $get->id .')" type="button" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.page.country.divisions',compact('pageTitle'));
    }

    public function division_store(Request $request){

        $data = $request->validate([
            'name' => ['required', 'unique:'.Division::class],
            'bn_name' => ['required', 'unique:'.Division::class],
            'url' => ['required'],
        ]);

        $data = new Division;
        $data->name = $request->name;
        $data->bn_name = $request->bn_name;
        $data->url = $request->url;
        $data->save();

        return response()->json($data);
    }

    public function division_edit($id){
        return Division::findOrFail($id);
    }

    public function division_update(Request $request, $id){
        $data = $request->validate([
            'name' => ['required'],
            'bn_name' => ['required'],
            'url' => ['required'],
        ]);

        $data = Division::findOrFail($id);
        $data->name = $request->name;
        $data->bn_name = $request->bn_name;
        $data->url = $request->url;
        $data->save();

        return response()->json($data);
    }

    public function division_remove($id){
        $data_check = District::where('division_id', $id)->first();
        if($data_check == false){
            $data = Division::findOrFail($id);
            $data->delete();
            return response()->json($data);
        }
        else{
            return 'not_delete';
        }
    }

    public function district_index(){
        $pageTitle = 'District List';
        $divisions = Division::all();

        if (request()->ajax()) {
            $get = District::query();
            return DataTables::of($get)
                ->addIndexColumn()
                ->addColumn('division', function ($get) {
                    return $get->division->name;
                })
                ->addColumn('action', function ($get) {
                    $button = '<button onclick="edit('.$get->id.');" type="button" class="btn btn-sm btn-primary mr-2"><i class="fas fa-edit"></i></button>';
                    $button .= '<button onclick="destroy('. $get->id .')" type="button" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>';
                    return $button;
                })
                ->rawColumns(['action','division'])
                ->make(true);
        }
        return view('admin.page.country.district',compact('pageTitle', 'divisions'));
    }

    public function district_store(Request $request){
        $data = $request->validate([
            'division_id' => ['required'],
            'name' => ['required', 'unique:'.District::class],
            'bn_name' => ['required', 'unique:'.District::class],
            'url' => ['required']
        ]);

        $data = new District;
        $data->division_id = $request->division_id;
        $data->name = $request->name;
        $data->bn_name = $request->bn_name;
        $data->url = $request->url;
        $data->save();

        return response()->json($data);
    }

    public function district_remove($id){
        $data_check = Upazila::where('district_id', $id)->first();
        if($data_check == false){
            $data = District::findOrFail($id);
            $data->delete();
            return response()->json($data);
        }
        else{
            return 'not_delete';
        }
    }

    public function district_edit($id){
        return District::findOrFail($id);
    }

    public function district_update(Request $request, $id){
        $data = $request->validate([
            'division_id' => ['required'],
            'name' => ['required'],
            'bn_name' => ['required'],
            'url' => ['required'],
        ]);

        $data = District::findOrFail($id);
        $data->division_id = $request->division_id;
        $data->name = $request->name;
        $data->bn_name = $request->bn_name;
        $data->url = $request->url;
        $data->save();

        return response()->json($data);
    }

    public function upzila_index(){
        $pageTitle = 'Upzila List';
        $divisions = Division::all();

        if (request()->ajax()) {
            $get = Upazila::query();
            return DataTables::of($get)
                ->addIndexColumn()
                ->addColumn('district', function ($get) {
                    return $get->district->name;
                })
                ->addColumn('division', function ($get) {
                    return $get->district->division->name;
                })
                ->addColumn('action', function ($get) {
                    $button = '<button onclick="edit('.$get->id.');" type="button" class="btn btn-sm btn-primary mr-2"><i class="fas fa-edit"></i></button>';
                    $button .= '<button onclick="destroy('. $get->id .')" type="button" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>';
                    return $button;
                })
                ->rawColumns(['action','division', 'district'])
                ->make(true);
        }
        return view('admin.page.country.upzila',compact('pageTitle', 'divisions'));
    }

    public function upzila_store(Request $request){
        $data = $request->validate([
            'district_id' => ['required'],
            'name' => ['required', 'unique:'.Upazila::class],
            'bn_name' => ['required', 'unique:'.Upazila::class],
            'url' => ['required']
        ]);

        $data = new Upazila;
        $data->district_id = $request->district_id;
        $data->name = $request->name;
        $data->bn_name = $request->bn_name;
        $data->url = $request->url;
        $data->save();

        return response()->json($data);
    }
    public function upzila_edit($id){
        return Upazila::with('district')->findOrFail($id);
    }

    public function upzila_update(Request $request, $id){
        $data = $request->validate([
            'district_id' => ['required'],
            'name' => ['required'],
            'bn_name' => ['required'],
            'url' => ['required'],
        ]);

        $data = Upazila::findOrFail($id);
        $data->district_id = $request->district_id;
        $data->name = $request->name;
        $data->bn_name = $request->bn_name;
        $data->url = $request->url;
        $data->save();

        return response()->json($data);
    }

    public function upzila_remove($id){
        $data_check = Union::where('upazila_id', $id)->first();
        if($data_check == false){
            $data = Upazila::findOrFail($id);
            $data->delete();
            return response()->json($data);
        }
        else{
            return 'not_delete';
        }
    }

    public function union_index(){
        $pageTitle = 'Union List';
        $divisions = Division::all();

        if (request()->ajax()) {
            $get = Union::query();
            return DataTables::of($get)
                ->addIndexColumn()
                ->addColumn('upzila', function ($get) {
                    return $get->upazila->name;
                })
                ->addColumn('district', function ($get) {
                    return $get->upazila->district->name;
                })
                ->addColumn('division', function ($get) {
                    return $get->upazila->district->division->name;
                })
                ->addColumn('action', function ($get) {
                    $button = '<button onclick="edit('.$get->id.');" type="button" class="btn btn-sm btn-primary mr-2"><i class="fas fa-edit"></i></button>';
                    $button .= '<button onclick="destroy('. $get->id .')" type="button" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>';
                    return $button;
                })
                ->rawColumns(['action','division', 'district', 'upzila'])
                ->make(true);
        }
        return view('admin.page.country.union',compact('pageTitle', 'divisions'));
    }

    public function union_store(Request $request){
        $data = $request->validate([
            'upazila_id' => ['required'],
            'name' => ['required', 'unique:'.Union::class],
            'bn_name' => ['required', 'unique:'.Union::class],
            'url' => ['required']
        ]);

        $data = new Union;
        $data->upazila_id = $request->upazila_id;
        $data->name = $request->name;
        $data->bn_name = $request->bn_name;
        $data->url = $request->url;
        $data->save();

        return response()->json($data);
    }

    public function union_edit($id){
        $d = Union::findOrFail($id);
        $data = [
            'union' => $d,
            'upazila' => $d->upazila_id,
            'district' => $d->upazila->district_id,
            'division' => $d->upazila->district->division_id,
        ];
        return $data;
    }

    public function union_update(Request $request, $id){
        $data = $request->validate([
            'upazila_id' => ['required'],
            'name' => ['required'],
            'bn_name' => ['required'],
            'url' => ['required'],
        ]);

        $data = Union::findOrFail($id);
        $data->upazila_id = $request->upazila_id;
        $data->name = $request->name;
        $data->bn_name = $request->bn_name;
        $data->url = $request->url;
        $data->save();

        return response()->json($data);
    }

    public function union_remove($id){
        $data_check = Village::where('union_id', $id)->first();
        if($data_check == false){
            $data = Union::findOrFail($id);
            $data->delete();
            return response()->json($data);
        }
        else{
            return 'not_delete';
        }
    }

}
