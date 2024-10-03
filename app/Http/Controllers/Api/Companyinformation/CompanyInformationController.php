<?php

namespace App\Http\Controllers\Api\Companyinformation;

use App\Http\Controllers\Controller;
use App\Models\ComapanyInfo;
use Illuminate\Http\Request;

class CompanyInformationController extends Controller
{
    public function companyinfo()
    {
        try {
            $data = ComapanyInfo::where('deleted_at', null)->first();
            $data['website_logo'] = asset('uploads/system/' . $data->website_logo);
            return response()->json($data);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => true,
                'message' => 'An error occurred while fetching the information.',
                'details' => $th->getMessage(),
            ], 500);
        }
    }
}
