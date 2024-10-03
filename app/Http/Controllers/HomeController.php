<?php

namespace App\Http\Controllers;

use App\Helpers\Constant;
use App\Models\Admin\PageBanner;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Share;

class HomeController extends Controller
{
    public function index()
    {
        return redirect()->route('admin.login');
    }
}
