<?php


    function companyInfo(){
        return App\Models\ComapanyInfo::findOrFail(1);
    }

    function categories(){
        return App\Models\Category::all();
    }
    function subcategories($id){
        return App\Models\SubCategory::where('category_id', $id)->get();
    }
    function category($id){
        return App\Models\Category::findOrFail($id);
    }

    function product_count_for_cat_id($cat_id){
        return App\Models\Product::where('category_id', $cat_id)->get()->count();
    }

    function currency(){
        $user = auth()->user()->countryInfo;
        $data = [
            'name' => $user->currency_name,
            'symble' => $user->currency_symbol
        ];
        return $data;
    }

    function available_balance(){
        return App\Helpers\Traits\Balance::available_balance();
    }
    function self_commission(){
        return App\Helpers\Traits\Balance::self_commission();
    }
    function customerPurchaseCommission(){
        return App\Helpers\Traits\Balance::customerPurchaseCommission();
    }
    function pharmacyPurchaseCommission(){
        return App\Helpers\Traits\Balance::pharmacyPurchaseCommission();
    }
    function team_commission(){
        return App\Helpers\Traits\Balance::team_commission();
    }
    function available_point(){
        return App\Helpers\Traits\Balance::available_point();
    }

    function deposit_balance(){
        return App\Helpers\Traits\Balance::deposit_balance();
    }
    function total_purchase_amount(){
        return App\Helpers\Traits\Balance::total_purchase_amount();
    }
    function withdraw_amount($transaction_type){
        return App\Helpers\Traits\Balance::withdraw_amount($transaction_type);
    }
    function company_total_sell_point(){
        return App\Helpers\Traits\Balance::company_total_sell_point();
    }

    function agent_package_stock($package_id, $username, $user_id){
        return App\Helpers\Traits\StockTrait::agent_package_stock($package_id, $username, $user_id);
    }
    function agent_product_stock($product_id, $username, $user_id){
        return App\Helpers\Traits\StockTrait::agent_product_stock($product_id, $username, $user_id);
    }

    function zero($zero){
        $value = 7 - strlen($zero);

        if($value == 7){
            return '0000000'.$zero;
        }
        elseif($value == 6){
            return '000000'.$zero;
        }
        elseif($value == 5){
            return '00000'.$zero;
        }
        elseif($value == 4){
            return '0000'.$zero;
        }
        elseif($value == 3){
            return '000'.$zero;
        }
        elseif($value == 2){
            return '00'.$zero;
        }
        elseif($value == 1){
            return '0'.$zero;
        }
    }


    function dateFormat($date){
        return date('d M Y', $date);
    }
    function timeFormat($date){
        return date('h:i:s A', $date);
    }

    function product($id){
        return App\Models\Product::find($id);
    }

    function defaultImg($gender){
        $image = "https://www.shutterstock.com/image-vector/vector-flat-illustration-grayscale-avatar-600nw-2281862025.jpg";

        if($gender == App\Helpers\Constant::GENDER['male']){
            $image = "https://cdn-icons-png.freepik.com/512/4086/4086679.png";
        }
        if($gender == App\Helpers\Constant::GENDER['female']){
            $image = "https://cdn-icons-png.freepik.com/512/6997/6997570.png?ga=GA1.1.1028499885.1706785679&";
        }
        if($gender == App\Helpers\Constant::GENDER['others']){
            $image = "https://w7.pngwing.com/pngs/82/985/png-transparent-emoji-lack-of-gender-identities-gender-neutrality-third-gender-emoji-face-head-smiley-thumbnail.png";
        }
        return $image;

    }


    function branch_district($id){
        return Devfaysal\BangladeshGeocode\Models\District::find($id);
    }
    function branch_upazila($id){
        return Devfaysal\BangladeshGeocode\Models\Upazila::find($id);
    }


    function socials(){
        return App\Models\Socials::findOrFail(1);
    }
    function ganarelsetting(){
        return App\Models\genarelSetting::findOrFail(1);
    }
    function notice(){
        return App\Models\notice::where('status', '1')->orderBy('id', 'DESC')->first();
    }

    function productStock($product_id){
        return App\Helpers\Traits\StockTrait::ProductStock($product_id);
    }

    function getConstantIndex($value, $data) {
        return array_search($value, $data);
    }




