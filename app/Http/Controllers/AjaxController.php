<?php

namespace App\Http\Controllers;

use App\Helpers\Constant;
use App\Models\AddressBook;
use App\Models\Category;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\MerchantDataEntry;
use App\Models\Product;
use App\Models\State;
use App\Models\SubCategory;
use App\Models\User;
use Devfaysal\BangladeshGeocode\Models\District;
use Devfaysal\BangladeshGeocode\Models\Union;
use Devfaysal\BangladeshGeocode\Models\Upazila;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    public function get_category()
    {
        $data = Category::all();
        return response()->json($data);
    }
    public function get_subcategory($id)
    {
        $data = SubCategory::where('category_id', $id)->get();
        return response()->json($data);
    }
    public function get_rank()
    {
        // $data = Rank::all();
        // return response()->json($data);
    }

    public function username_check(string $username)
    {
        $user = User::where('username', $username)->first();
        if ($user == true) {
            return response()->json('yes');
        }
        return response()->json('no');
    }
    public function refer_username(string $username)
    {
        $user = User::where('username', $username)->where('type', Constant::USER_TYPE['user'])->where('status', Constant::USER_STATUS['active'])->first();
        if ($user == true) {
            return response()->json($user->name);
        }
        return response()->json('no');
    }
    public function agent_username(string $username)
    {
        $agent = User::where('username', $username)->where('type', Constant::USER_TYPE['agent'])->where('status', Constant::USER_STATUS['active'])->first();
        if ($agent == true) {
            return response()->json($agent->name);
        }
        return response()->json('no');
    }

    public function getUsers()
    {
        $data = User::where('status', Constant::USER_STATUS['active'])->where('type', Constant::USER_TYPE['user'])->get();
        return response()->json($data);
    }
    public function getBranchs()
    {
        $data = User::where('status', Constant::USER_STATUS['active'])->where('type', Constant::USER_TYPE['agent'])->get();
        return response()->json($data);
    }

    public function get_states($id)
    {
        $data = State::where('country_id', $id)->get();
        return response()->json($data);
    }

    public function get_tele_code($id)
    {
        $data = State::find($id);
        return response()->json($data->tele_code);
    }

    public function get_districts($division)
    {
        $data = District::where('division_id', $division)->get();
        return response()->json($data);
    }
    public function get_upazilas($district)
    {
        $data = Upazila::where('district_id', $district)->get();
        return response()->json($data);
    }

    public function get_unions($upazila)
    {
        $data = Union::where('upazila_id', $upazila)->get();
        return response()->json($data);
    }

    public function get_villages($union)
    {
        // $data = Village::where('union_id', $union)->get();
        // return response()->json($data);
    }

    public function get_user_documents($id)
    {
        $data = User::findOrFail($id);
        return response()->json($data);
    }



    public function getUserInfo($id)
    {
        $data = User::findOrFail($id);
        return view('admin.page.user.dataViewBody', ['data' => $data]);
    }


    public function getDesignation()
    {
        // $data = Rank::all();
        // return response()->json($data);
    }
    public function getAllProducts()
    {
        $data = Product::all();
        return response()->json($data);
    }

    public function getAllUserCount()
    {
        $data = User::where('type', Constant::USER_TYPE['user'])->get();
        $result = [
            'pending_count' => $data->where('status', 1)->count(),
            'approved_count' => $data->where('status', 0)->count(),
            'total_count' => $data->whereIn('status', [0, 1])->count()
        ];
        return response()->json($result);
    }

    public function address_book_insert(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'country_id' => 'required',
            'division_id' => 'required',
            'district_id' => 'required',
            'upazila_id' => 'required',
            'address' => 'required',
        ]);

        $data = AddressBook::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'phone' => $request->phone,
            'country_id' => $request->country_id,
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'upazila_id' => $request->upazila_id,
            'address' => $request->address,
            'date' => time(),
        ]);

        return response()->json($data);
    }

    public function get_address_book_data()
    {
        return response()->json(AddressBook::where('user_id', Auth::user()->id)->with('user', 'countryInfo', 'upazila', 'district', 'division')->get());
    }
    public function get_address_book_data_for_edit($id)
    {
        return response()->json(AddressBook::where('id', $id)->with('user', 'countryInfo', 'upazila', 'district', 'division')->first());
    }
    public function get_address_book_data_for_destroy($id)
    {
        $data = AddressBook::findOrFail($id);
        $data->delete();
        if ($data == true) {
            return response()->json('success');
        } else {
            return response()->json('not_delete');
        }
    }

    public function invoice_view($id)
    {
        $order = Invoice::find($id);
        $orderItems = InvoiceItem::where('invoice_id', $id)->get();
        return view('admin.page.order.modals.invoice_view_body', [
            'items' => $orderItems,
            'order' => $order,
        ]);
    }
}
