<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Constant;
use App\Helpers\Traits\getAllDownlineUsersTrait;
use App\Helpers\Traits\GetUserRankPITrait;
use App\Helpers\Traits\ImageTrait;
use App\Helpers\Traits\RowIndex;
use App\Http\Controllers\Controller;
use App\Http\Requests\Rules\CheckEmailValidationRole;
use App\Http\Requests\Rules\UsernameCheckRole;
use App\Mail\UserApproveMail;
use App\Mail\UserOTPMail;
use App\Mail\UserRegisterMail;
use App\Models\Category;
use App\Models\Country;
use App\Models\User;
use Devfaysal\BangladeshGeocode\Models\Division;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;
use Yajra\DataTables\Facades\DataTables;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    use RowIndex, getAllDownlineUsersTrait, ImageTrait, GetUserRankPITrait;

    public function index() {
        if (request()->has('customer_list')){
            $pageTitle = 'Customer List';
        }
        elseif (request()->has('blocked_customer_list')){
            $pageTitle = 'Blocked Customer List';
        }
        else {
            $pageTitle = 'All Customer List';
        }

        if (request()->ajax()) {

            if (request()->has('customer_list')) {
                $data = User::where('type', Constant::USER_TYPE['customer'])->where('status', Constant::USER_STATUS['active']);
            }
            elseif (request()->has('blocked_customer_list')) {
                $data = User::where('type', Constant::USER_TYPE['customer'])->where('status', Constant::USER_STATUS['deactive']);
            }
            else {
                $data = User::where('type', Constant::USER_TYPE['customer'])->whereIn('status', [Constant::USER_STATUS['active'], Constant::USER_STATUS['deactive']]);
            }

            // if(request()->email_verifid == 'verified'){
            //     $data = $data->whereNotNull('email_verified_at');
            // }

            // if(request()->email_verifid == 'not_verified'){
            //     $data = $data->whereNull('email_verified_at');
            // }

            $dataCollection = $data->orderBy('id', 'DESC');
            return DataTables::of($dataCollection)
                ->addColumn('sl', function ($row) {
                    return $this->dt_index($row);
                })

                ->addColumn('image', function ($row) {
                    $image = defaultImg($row->gender);
                    if($row->image != null){
                        $image = asset('uploads/user/profile/'.$row->image);
                    }

                    $html =  <<<HTML
                        <div class="text-center" uk-lightbox>
                            <a href="$image">
                                <img style="width: 60px; height: 60px; border: 1px solid #ddd; border-radius: 2px;" class="img-fluid" src="$image" alt="">
                            </a>
                        </div>
                    HTML;

                    return $html;
                })

                ->addColumn('pharmacy_type', function ($row) {
                    return getConstantIndex($row->pharmacy_type, Constant::PHARMACY_TYPE) ?? '';
                })

                ->addColumn('status', function ($row) {
                    $html = '';
                    if($row->status == Constant::USER_STATUS['active']){
                        $html = '<span class="badge badge-success">Approved</span>';
                    }
                    else{
                        $html = '<span class="badge badge-danger">Non-Approved</span>';
                    }
                    return $html;
                })

                ->addColumn('email_verified', function ($row) {
                    $html = '';
                    if($row->email_verified_at != null){
                        $html = '<span class="badge badge-success">Verified</span>';
                    }
                    else{
                        $html = '<span class="badge badge-danger">Unverified</span>';
                    }
                    return $html;
                })

                ->addColumn('details', function ($row) {
                    $html = '<button onclick="DataView('. $row->id .')" type="button" class="btn btn-sm btn-success mb-1"><i class="fa fa-eye"></i></button> <br>';

                    // $html .= '<button onclick="documentView('.$row->id.')" type="button" class="btn btn-sm btn-success mb-1"><i class="fas fa-file-alt"></i></button>';
                    return $html;
                })

                ->addColumn('action', function ($row) {

                    $editUrl = route('admin.user.edit', $row->id).'?customer';

                    $btn1 = '<a href="'.$editUrl.'" class="btn btn-sm btn-primary m-2"><i class="fas fa-edit"></i></a>';

                    $btn2 = '<button onclick="destroy('. $row->id .')" type="button" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>';

                    $btn3 = '<a href="javascript::" onclick="change_status('. $row->id .', '.Constant::USER_STATUS['active'].');" class="btn btn-sm btn-success m-2"><i class="fas fa-check"></i></a>';

                    $btn4 = '<a href="javascript::" onclick="change_status('. $row->id .', '.Constant::USER_STATUS['deactive'].');" class="btn btn-sm btn-danger m-2"><i class="fas fa-times"></i></a>';

                    if($row->status == Constant::USER_STATUS['active']){
                        return $btn1.$btn4;
                    }
                    else{
                        return $btn1.$btn3;
                    }

                })
                ->rawColumns(['action', 'sl' ,'type', 'status', 'image', 'email_verified', 'details', 'pharmacy_type'])
                ->make(true);
        }

        return view('admin.page.user.user-list', compact('pageTitle'));
    }

    public function create() {
        $pageTitle = 'Customer Create';
        $user = '';
        $countries = Country::all();
        $divisions = Division::all();
        $rand_user = rand(10,99).rand(20,99).rand(0,9);
        $username = 'DB'.$rand_user;
        return view('admin.page.user.create', compact('pageTitle', 'user', 'countries', 'username', 'divisions'));
    }

    public function check($id) {
        return back()->with('message', "message is successfull");
    }

    public function store(Request $request){

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'numeric', 'unique:'.User::class, 'unique:'.User::class, new UsernameCheckRole],
            'email' => ['required', 'string', 'lowercase', 'email', 'unique:'.User::class, 'max:255', new CheckEmailValidationRole],
            'gender' => ['required'],
            'country' => ['required'],
            'division_id' => ['required'],
            'district_id' => ['required'],
            'upazila_id' => ['nullable'],
            'union_id' => ['nullable'],
            'tele_code' => ['required'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'status' => ['required'],
            'type' => ['required'],
        ]);

        $otp = rand(1,9).rand(1,9).rand(1,9).rand(1,9);
        $user = User::create([
            'name' => $request->name,
            'username' => $request->phone,
            'phone' => $request->tele_code.$request->phone,
            'email' => $request->email,
            'gender' => $request->gender,
            'country' => $request->country,
            'states' => '1',
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'upazila_id' => $request->upazila_id,
            'union_id' => $request->union_id,
            'otp' => null,
            'email_verified_at' => now()->format('Y-m-d H:i:s'),
            'password' => Hash::make($request->password),
            'show_password' => $request->password,
            'status' => $request->status,
            'type' => $request->type,
            'pharmacy_type' => null,
        ]);

        if($user){
            ////////////////////////////////////////////////////////////////
            ////////////////////////   Send OTP   //////////////////////////
            ////////////////////////////////////////////////////////////////
            // $mailData = [
            //     'username' => $user->name,
            //     'otp' => $otp
            // ];
            // Mail::to($user->email)->send(new UserOTPMail($mailData));
            // flash()->addSuccess('User Create Successfull. Verify This User For Your Valid Email Address.');
            // return redirect()->route('admin.user.otp.index', $user->id);
            ////////////////////////////////////////////////////////////////
            ////////////////////////   Send OTP   //////////////////////////
            ////////////////////////////////////////////////////////////////


            if($user->status == Constant::USER_STATUS['active']) {
                $mailData = [
                    'name' => $user->name,
                    'username' => $user->username,
                    'show_pass' => $user->show_password,
                ];

                // Mail::to($user->email)->send(new UserApproveMail($mailData));
            }

            flash()->addSuccess('Customer Create Successfull.');
            return redirect()->route('admin.user.list', 'customer_list');

        }
        else{
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function edit($id){
        $pageTitle = 'Customer Edit';
        $countries = Country::all();
        $divisions = Division::all();
        $user = User::findOrFail($id);
        return view('admin.page.user.create', compact('pageTitle', 'user', 'countries', 'divisions'));
    }

    public function update(Request $request, $id){

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'numeric'],
            'email' => ['required', 'string', 'lowercase', 'email', new CheckEmailValidationRole],
            'gender' => ['required'],
            'country' => ['required'],
            'division_id' => ['required'],
            'district_id' => ['required'],
            'upazila_id' => ['nullable'],
            'union_id' => ['nullable'],
            'tele_code' => ['required'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'status' => ['required'],
        ]);

        $user = User::findOrFail($id);
        $user->name =  $request->name;
        $user->phone =  $request->phone;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->country =  $request->country;
        $user->division_id = $request->division_id;
        $user->district_id = $request->district_id;
        $user->upazila_id = $request->upazila_id;
        $user->union_id = $request->union_id;
        $user->password = Hash::make($request->password);
        $user->show_password = $request->password;
        $user->status = $request->status;
        $user->save();

        flash()->addSuccess('Customer Update Successfull.');
        return redirect()->route('admin.user.list', 'customer_list');
    }

    public function imageRemove(string $field_name, string $class_name,  $user_id){

        $data = User::findOrFail($user_id);

        if($data->$field_name != null){
            $old_img1 = public_path('uploads/'.$class_name.'/'.$data->$field_name);
            if (file_exists($old_img1)) {
                unlink($old_img1);
            }
        }

        $data->$field_name = null;
        $data->save();

        return response()->json($field_name);
    }

    public function changeStatus($user_id, $status) {
        $user = User::findOrFail($user_id);
        $user->status = $status;
        $user->save();

        if($status == Constant::USER_STATUS['active']) {
            $mailData = [
                'name' => $user->name,
                'username' => $user->username,
                'show_pass' => $user->show_password,
            ];

            // Mail::to($user->email)->send(new UserApproveMail($mailData));
        }

        return response()->json($user);
    }

    public function givePermission(Request $request){
        $user = User::findOrFail($request->user_idd);
        $user->with_trade_permission = $request->with_trade_permission;
        $user->without_trade_permission = $request->without_trade_permission;
        $user->user_approval_per = $request->user_approval_per;
        $user->save();
        return response()->json($user);
    }
}
