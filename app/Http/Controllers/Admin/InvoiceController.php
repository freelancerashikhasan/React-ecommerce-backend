<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Constant;
use App\Helpers\Traits\DistributeBonusTrait;
use App\Helpers\Traits\DistributeGenBonusTrait;
use App\Helpers\Traits\RankCalculationTrait;
use App\Helpers\Traits\RowIndex;
use App\Helpers\Traits\SetKeyTrait;
use App\Helpers\Traits\StockTrait;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class InvoiceController extends Controller
{
    use RowIndex, StockTrait, DistributeBonusTrait;
    public function index(){
        $pageTitle = '';
        if (request()->has('placed_orders')){
            $pageTitle = 'Customer Placed Orders';
        }
        else if (request()->has('logistic_orders')){
            $pageTitle = 'Customer Process Orders';
        }
        else if (request()->has('deliverd_orders')){
            $pageTitle = 'Customer Deliverd Orders';
        }
        else if (request()->has('rejected_orders')){
            $pageTitle = 'Customer Rejected Orders';
        }
        else{
            $pageTitle = 'Customer Requested Orders';
        }

        if (request()->ajax()) {
            $data = Invoice::whereIn('type', [Constant::ORDER_TYPE['customer'], Constant::ORDER_TYPE['customer_repurchase']]);

            if (request()->has('placed_orders')){
                $data = $data->where('status', Constant::STATUS['pending'])->where('order_status', Constant::ORDER_STATUS['placed']);
            }
            else if (request()->has('logistic_orders')){
                $data = $data->where('status', Constant::STATUS['pending'])->where('order_status', Constant::ORDER_STATUS['logistic']);
            }
            else if (request()->has('deliverd_orders')){
                $data = $data->where('status', Constant::STATUS['approved'])->where('order_status', Constant::ORDER_STATUS['deliverd']);
            }
            else if (request()->has('rejected_orders')){
                $data = $data->where('status', Constant::STATUS['rejected'])->where('order_status', Constant::ORDER_STATUS['rejected']);
            }
            else{
                $data = $data->where('status', Constant::STATUS['pending'])->where('order_status', Constant::ORDER_STATUS['pending']);
            }



            if(request()->form_date && request()->to_date){
                $form_date = strtotime(request()->form_date. ' 00:00:01');
                $to_date = strtotime(request()->to_date. ' 23:59:59');
                $data = $data->whereBetween('date',[$form_date, $to_date]);
            }
            else{
                if(request()->form_date){
                    $form_date = strtotime(request()->form_date. ' 00:00:01');
                    $to_date = strtotime(request()->form_date. ' 23:59:59');
                    $data = $data->whereBetween('date',[$form_date, $to_date]);
                }
                else if(request()->to_date){
                    $form_date = strtotime(request()->to_date. ' 00:00:01');
                    $to_date = strtotime(request()->to_date. ' 23:59:59');
                    $data = $data->whereBetween('date',[$form_date, $to_date]);
                }

            }

            if(request()->agent != ''){
                $data = $data->where('agent_id', request()->agent);
            }
            if(request()->user_name != ''){
                $userInfo = User::where('username', request()->user_name)->first();
                if($userInfo == true){
                    $data = $data->where('user_id', $userInfo->id);
                }
            }

            $dataCollection = $data->orderBy('id', 'desc');
            return DataTables::of($dataCollection)
                ->addColumn('sl', function ($row) {
                    return $this->dt_index($row);
                })

                ->addColumn('user', function ($row) {
                    return 'Name : '. $row->user->name.'<br> Username : '. $row->user->username.'<br> Phone : '. $row->user->phone;
                })
                ->addColumn('order_id', function ($row) {
                    return zero($row->id);
                })
                ->addColumn('status', function ($row) {
                    return ucwords(array_flip(Constant::ORDER_STATUS)[$row->order_status]);
                })
                ->addColumn('payment_method', function ($row) {
                    return getConstantIndex($row->payment_method, Constant::PAYMENT_METHOD);
                })
                ->addColumn('payment_status', function ($row) {
                    return getConstantIndex($row->payment_status, Constant::PAYMENT_STATUS);
                })
                ->addColumn('type', function ($row) {
                    return str_replace("_", " ", ucwords(array_flip(Constant::ORDER_TYPE)[$row->type]));
                })
                ->addColumn('date', function ($row) {
                    $date = date('d M Y', strtotime($row->created_at)).' </br>' .date('h:i:s a', strtotime($row->created_at));
                    return $date;
                })
                ->addColumn('approve_date', function ($row) {
                    if($row->updated_at != $row->created_at){
                        $update = date('d M Y', strtotime($row->updated_at)).' </br>' .date('h:i:s a', strtotime($row->updated_at));
                    }
                    else{
                        $update = 'N/A';
                    }
                    return $update;
                })
                ->addColumn('action', function ($row) {
                    $button1 = '<button onclick="status('.$row->id.', '.Constant::STATUS['pending'].', '.Constant::ORDER_STATUS['pending'].')" type="button" class="btn btn-sm btn-warning ml-2" style="padding: 2px 6px;">Pending</i></button>';

                    $button2 = '<button type="button" onclick="status('.$row->id.', '.Constant::STATUS['pending'].', '.Constant::ORDER_STATUS['placed'].')" class="btn btn-sm btn-success ml-2" style="padding: 2px 6px;">Placed</button>';

                    $button3 = '<button onclick="status('.$row->id.', '.Constant::STATUS['pending'].', '.Constant::ORDER_STATUS['logistic'].')" type="button" class="btn btn-sm btn-secondary ml-2" style="padding: 2px 6px;">Logistic</button>';

                    $button4 = '<button onclick="status('.$row->id.', '.Constant::STATUS['approved'].', '.Constant::ORDER_STATUS['deliverd'].')" type="button" class="btn btn-sm btn-primary ml-2" style="padding: 2px 6px;">Deliverd</button>';

                    $button5 = '<button onclick="status('.$row->id.', '.Constant::STATUS['rejected'].', '.Constant::ORDER_STATUS['rejected'].')" type="button" class="btn btn-sm btn-danger ml-2" style="padding: 2px 6px;">Reject</button>';

                    $button6 = '<button onclick="invoiceView('.$row->id.')" type="button" class="btn btn-sm btn-info ml-2" style="padding: 2px 6px;">View</button>';


                    if(($row->order_status != Constant::ORDER_STATUS['rejected']) && ($row->order_status != Constant::ORDER_STATUS['deliverd'])){
                        return $button6.$button1.$button2.'<br><br>'.$button3.$button4.$button5;
                    }
                    else{
                        return $button6.$button1.$button2.'<br><br>'.$button3.$button4.$button5;
                    }

                })
                ->rawColumns(['sl' ,'user', 'order_id' ,'status', 'date', 'approve_date', 'action', 'type', 'payment_method','payment_status'])
                ->make(true);
        }
        return view('admin.page.order.index', compact('pageTitle'));
    }

    public function invoice_view($id){
        $orderItems = InvoiceItem::where('invoice_id', $id)->get();
        return view('admin.page.order.modals.invoice_view_body', [
            'items' => $orderItems,
        ]);
    }

    public function status($id, $status, $order_status){
        $data = Invoice::findOrFail($id);
        $data->status = $status;
        $data->order_status = $order_status;

        // if($order_status == Constant::ORDER_STATUS['deliverd']){
        //     $usersData = User::with('rank')->whereIn('type', [Constant::USER_TYPE['user'], Constant::USER_TYPE['pharmacy'], Constant::USER_TYPE['customer']])->where('status', Constant::USER_STATUS['active'])->whereNotNull('email_verified_at')->get();

        //     // $this->giveDistributionBonus($data, $usersData);
        //     // $data->commission_status = Constant::INVOICE_COMMISSION_STATUS['yes'];
        // }

        // if(($order_status != Constant::ORDER_STATUS['deliverd'])){
        //     // User Data Remove
        //     $transections = Transaction::where('invoice_id', $data->id)->whereIn('transaction_type', [Constant::TRANSACTION_TYPE['customer_order_commission'], Constant::TRANSACTION_TYPE['pharmacy_order_commission']])->get();
        //     foreach($transections as $transection){
        //         $transection->forceDelete();
        //     }
        //     // $data->commission_status = Constant::INVOICE_COMMISSION_STATUS['no'];
        // }

        $data->save();
        return response()->json($data);
    }

    public function packageIndex(){
        $pageTitle = '';
        if (request()->has('placed_orders')){
            $pageTitle = 'User Package Placed Orders';
        }
        else if (request()->has('logistic_orders')){
            $pageTitle = 'User Package Process Orders';
        }
        else if (request()->has('deliverd_orders')){
            $pageTitle = 'User Package Deliverd Orders';
        }
        else if (request()->has('rejected_orders')){
            $pageTitle = 'User Package Rejected Orders';
        }
        else{
            $pageTitle = 'User Package Requested Orders';
        }

        if (request()->ajax()) {
            $data = Invoice::where('type', Constant::ORDER_TYPE['customer_packege']);;

            if (request()->has('placed_orders')){
                $data = $data->where('status', Constant::STATUS['pending'])->where('order_status', Constant::ORDER_STATUS['placed']);
            }
            else if (request()->has('logistic_orders')){
                $data = $data->where('status', Constant::STATUS['pending'])->where('order_status', Constant::ORDER_STATUS['logistic']);
            }
            else if (request()->has('deliverd_orders')){
                $data = $data->where('status', Constant::STATUS['approved'])->where('order_status', Constant::ORDER_STATUS['deliverd']);
            }
            else if (request()->has('rejected_orders')){
                $data = $data->where('status', Constant::STATUS['rejected'])->where('order_status', Constant::ORDER_STATUS['rejected']);
            }
            else{
                $data = $data->where('status', Constant::STATUS['pending'])->where('order_status', Constant::ORDER_STATUS['pending']);
            }



            if(request()->form_date && request()->to_date){
                $form_date = strtotime(request()->form_date. ' 00:00:01');
                $to_date = strtotime(request()->to_date. ' 23:59:59');
                $data = $data->whereBetween('date',[$form_date, $to_date]);
            }
            else{
                if(request()->form_date){
                    $form_date = strtotime(request()->form_date. ' 00:00:01');
                    $to_date = strtotime(request()->form_date. ' 23:59:59');
                    $data = $data->whereBetween('date',[$form_date, $to_date]);
                }
                else if(request()->to_date){
                    $form_date = strtotime(request()->to_date. ' 00:00:01');
                    $to_date = strtotime(request()->to_date. ' 23:59:59');
                    $data = $data->whereBetween('date',[$form_date, $to_date]);
                }

            }

            if(request()->agent != ''){
                $data = $data->where('agent_id', request()->agent);
            }
            if(request()->user_name != ''){
                $userInfo = User::where('username', request()->user_name)->first();
                if($userInfo == true){
                    $data = $data->where('user_id', $userInfo->id);
                }
            }

            $dataCollection = $data->orderBy('id', 'DESC');
            return DataTables::of($dataCollection)
                ->addColumn('sl', function ($row) {
                    return $this->dt_index($row);
                })
                ->addColumn('agent', function ($row) {
                    return 'Name : '. $row->agent->name.'<br> Username : '. $row->agent->username.'<br> Phone : '. $row->agent->phone;
                })
                ->addColumn('user', function ($row) {
                    return 'Name : '. $row->user->name.'<br> Username : '. $row->user->username.'<br> Phone : '. $row->user->phone;
                })
                ->addColumn('order_id', function ($row) {
                    return zero($row->id);
                })
                ->addColumn('status', function ($row) {
                    return ucwords(array_flip(Constant::ORDER_STATUS)[$row->order_status]);
                })
                ->addColumn('date', function ($row) {
                    $date = date('d M Y', strtotime($row->created_at)).' </br>' .date('h:i:s a', strtotime($row->created_at));
                    return $date;
                })
                ->addColumn('approve_date', function ($row) {
                    if($row->updated_at != $row->created_at){
                        $update = date('d M Y', strtotime($row->updated_at)).' </br>' .date('h:i:s a', strtotime($row->updated_at));
                    }
                    else{
                        $update = 'N/A';
                    }
                    return $update;
                })
                ->addColumn('action', function ($row) {
                    $button1 = '<button onclick="status('.$row->id.', '.Constant::STATUS['pending'].', '.Constant::ORDER_STATUS['pending'].')" type="button" class="btn btn-sm btn-warning ml-2" style="padding: 2px 6px;">Pending</i></button>';

                    $button2 = '<button type="button" onclick="status('.$row->id.', '.Constant::STATUS['pending'].', '.Constant::ORDER_STATUS['placed'].')" class="btn btn-sm btn-success ml-2" style="padding: 2px 6px;">Placed</button>';

                    $button3 = '<button onclick="status('.$row->id.', '.Constant::STATUS['pending'].', '.Constant::ORDER_STATUS['logistic'].')" type="button" class="btn btn-sm btn-secondary ml-2" style="padding: 2px 6px;">Logistic</button>';

                    $button4 = '<button onclick="status('.$row->id.', '.Constant::STATUS['approved'].', '.Constant::ORDER_STATUS['deliverd'].')" type="button" class="btn btn-sm btn-primary ml-2" style="padding: 2px 6px;">Deliverd</button>';

                    $button5 = '<button onclick="status('.$row->id.', '.Constant::STATUS['rejected'].', '.Constant::ORDER_STATUS['rejected'].')" type="button" class="btn btn-sm btn-danger ml-2" style="padding: 2px 6px;">Reject</button>';

                    $button6 = '<button onclick="invoiceView('.$row->id.')" type="button" class="btn btn-sm btn-info ml-2" style="padding: 2px 6px;">View</button>';

                    if(($row->order_status != Constant::ORDER_STATUS['rejected']) && ($row->order_status != Constant::ORDER_STATUS['deliverd'])){
                        return $button6.$button2.$button3.'<br><br>'.$button4.$button5;
                    }
                    else{
                        return $button6;
                    }

                })
                ->rawColumns(['sl', 'agent' ,'user', 'order_id' ,'status', 'date', 'approve_date', 'action'])
                ->make(true);
        }
        return view('admin.page.order.package.index', compact('pageTitle'));
    }

    public function packageStatus($id, $status, $order_status){
        $data = Invoice::findOrFail($id);
        $data->status = $status;
        $data->order_status = $order_status;

        $user = User::find($data->user_id);
        $agent = User::where('username', $data->agent_id)->first();

        // Insert Transection When Order has been deliverd
        if($order_status == Constant::ORDER_STATUS['deliverd']){
            $transection = Transaction::where('invoice_id', $data->id)->where('user_id', $data->user_id)->first();
            if($transection == false){
                // User Data Insart
                Transaction::create([
                    'user_id' => $data->user_id,
                    'invoice_id' => $data->id,
                    'wallet_type' => Constant::WALLET_TYPE['active_balance'],
                    'deb_amount' => $data->bill_amount,
                    'cred_amount' => 0,
                    'cred_point' => $data->total_point,
                    'deb_point' => 0,
                    'status' => Constant::STATUS['approved'],
                    'in_status' => Constant::IN_STATUS['active'],
                    'transaction_type' => Constant::TRANSACTION_TYPE['product_sell'],
                    'transaction_note' => 'Product Purchase '.$agent->username.' to '.$user->username,
                    'currency' => Constant::CURRENCY['name'],
                    'date' => time(),
                ]);

                $users = $this->setKey22(User::with('rank')->get());
                $result = $this->distribute($data->id ,$users, $data->user_id, $data->total_point);

            }
        }
        // Remove for this transection when order status not deliverd
        if(($order_status != Constant::ORDER_STATUS['deliverd'])){
            $transection = Transaction::where('invoice_id', $data->id)->where('user_id', $user->id)->first();
            if($transection == true){
                $transection->forceDelete();
            }
        }


        $data->save();
        return response()->json($data);
    }


}
