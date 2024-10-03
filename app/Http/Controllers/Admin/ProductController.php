<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Constant;
use App\Helpers\Traits\RowIndex;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductExtaInfo;
use App\Models\ProductFeaturedImage;
use App\Models\ProductStock;
// use App\Models\ProductExtaInfo;
// use App\Models\ProductFeaturedImage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    use RowIndex;
    public function index()
    {
        $pageTitle = 'Product List';

        if (request()->ajax()) {
            $data = Product::orderBy('id', 'DESC');

            $dataCollection = $data;
            return DataTables::of($dataCollection)
                ->addColumn('sl', function ($row) {
                    return $this->dt_index($row);
                })
                ->addColumn('product', function ($row) {
                    $cat = $row->category->category_name ?? 'N/A';
                    $subcat = $row->subcategory->subcategory ?? 'N/A';
                    $info = <<<HTML
                        <div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <table class="table table-sm table-bordered mb-0">
                                        <tr class="bg-transparent">
                                            <td class="font-weight-bolder">Title</td>
                                            <td>$row->title</td>
                                        </tr>
                                        <tr class="bg-transparent">
                                            <td class="font-weight-bolder">Sub Title</td>
                                            <td>$row->sub_title</td>
                                        </tr>
                                        <tr class="bg-transparent">
                                            <td class="font-weight-bolder">Category</td>
                                            <td>$cat</td>
                                        </tr>
                                        <tr class="bg-transparent">
                                            <td class="font-weight-bolder">Sub Category</td>
                                            <td>$subcat</td>
                                        </tr>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-lg-4">
                                    <table class="table table-sm table-bordered mb-0">
                                        <tr class="bg-transparent">
                                            <td class="font-weight-bolder">Original Price</td>
                                            <td>$row->price</td>
                                        </tr>
                                        <tr class="bg-transparent">
                                            <td class="font-weight-bolder">Offer Price</td>
                                            <td>$row->offer_price</td>
                                        </tr>
                                        <tr class="bg-transparent d-none">
                                            <td class="font-weight-bolder">Point</td>
                                            <td>$row->point</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                    HTML;
                    return $info;
                })
                ->addColumn('image', function ($row) {
                    if ($row->thumbnail != null) {
                        $img = asset('uploads/product/' . $row->thumbnail);
                    } else {
                        $img = asset('uploads/product/' . $row->thumbnail);
                    }
                    $html = '<div class="text-center" uk-lightbox><a href="' . $img . '">
                        <img style="width: 70px; border: 1px solid #ddd; border-radius: 4px; padding: 1px;" src="' . $img . '" alt="">
                    </a></div>';
                    return $html;
                })
                ->addColumn('action', function ($row) {
                    $btn1 = '<a href="' . route('admin.product.edit', $row->id) . '"  class="btn btn-sm btn-primary mr-2"><i class="fas fa-edit"></i></a>';
                    $btn2 = '<button onclick="destroy(' . $row->id . ')" type="button" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>';
                    // $btn3 = '<a target="_blank" href="'.route('product', ['id' => $row->id, 'slug' => $row->slug]).'" class="btn btn-sm btn-success mr-2"><i class="fas fa-eye"></i></a>';
                    return $btn1 . $btn2;
                })
                ->rawColumns(['action', 'image', 'sl', 'product'])
                ->make(true);
        }

        return view('admin.page.products.products', compact('pageTitle'));
    }
    public function create()
    {
        $pageTitle = 'Create Product';
        return view('admin.page.products.create', compact('pageTitle'));
    }

    public function store(Request $request)
    {

        $data = $request->validate([
            'category_id' => ['required'],
            'subcategory_id' => ['nullable'],
            'title' => ['required'],
            'sub_title' => ['required'],
            'slug' => ['required', 'unique:products'],
            'point' => ['nullable'],
            'price' => ['required'],
            'offer_price' => ['nullable'],
            'thumbnail' => ['required', 'mimes:jpg,png,jpeg,gif,svg'],
        ]);

        $slug = Str::slug($request->slug, '-') . '-' . rand(1, 500);

        $data = new Product;
        $data->category_id = $request->category_id;
        $data->subcategory_id = $request->subcategory_id;
        $data->point = $request->point;
        $data->price = $request->price;
        $data->offer_price = $request->offer_price ?? 0;
        $data->title = $request->title;
        $data->sub_title = $request->sub_title;
        $data->slug = $slug;
        $data->description = $request->description;
        $data->featured_product = $request->featured_product;
        $data->new_arrival = $request->new_arrival;
        $data->today_deals = $request->today_deals;
        if ($request->policy) {
            $data->policy = Constant::POLICY_STATUS['active'];
        }
        if ($request->terms) {
            $data->terms = Constant::TERMS_STATUS['active'];
        }
        $data->status = Constant::PRODUCT_STATUS['active'];

        if ($request->hasFIle('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $thumbnail_name = $slug . '.' . $thumbnail->getclientoriginalextension();
            Image::make($thumbnail)->save(public_path('uploads/product/' . $thumbnail_name));
            $data->thumbnail = $thumbnail_name;
        }
        $data->save();

        if ($request->hasFile('featured_image')) {
            $featured_image = $request->file('featured_image');
            foreach ($featured_image as $value) {
                $ga_image_name = $slug . '-featured-image-product-id-' . rand(100, 900) . '-' . $data->id . '.' . $value->getclientoriginalextension();
                Image::make($value)->save(public_path('uploads/product/' . $ga_image_name));
                $gallery = new ProductFeaturedImage;

                $gallery->product_id = $data->id;
                $gallery->image = $ga_image_name;
                $gallery->save();
            }
        }

        if ($request->row_id) {
            foreach ($request->row_id as $key => $value) {
                $extra_info = new ProductExtaInfo;
                $extra_info->product_id = $data->id;
                $extra_info->info_title = $request->info_title[$key];
                $extra_info->info_details = $request->info_details[$key];
                $extra_info->save();
            }
        }

        flash()->addSuccess('Product Added Successfully!');
        return redirect()->route('admin.product.index');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $stock = ProductStock::where('product_id', $id)->first();
        if ($product == true) {

            if ($stock != null) {
                return response()->json([
                    'type' => 'have_data'
                ]);
            } else {
                $product->featuredImages()->get();
                $product->product_info()->delete();

                $product->delete();
                return response()->json($product);
            }
        }
        return response()->json($product);
    }

    public function edit($id)
    {
        $pageTitle = 'Product Edit';
        $product = Product::findOrFail($id);
        return view('admin.page.products.edit', compact('pageTitle', 'product'));
    }

    public function infoItem($id)
    {
        $item = ProductExtaInfo::findOrFail($id);
        $item->delete();
        return response()->json($item);
    }
    public function feature_remove($id)
    {
        $item = ProductFeaturedImage::findOrFail($id);
        $item->delete();
        return response()->json($item);
    }
    public function thumbnail_remove($id)
    {
        $item = Product::findOrFail($id);
        if ($item->thumbnail != null) {
            $old_img = public_path('uploads/product/' . $item->thumbnail);
            if (file_exists($old_img)) {
                unlink($old_img);
            }
        }
        $item->thumbnail = null;
        $item->save();
        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'category_id' => ['required'],
            'subcategory_id' => ['nullable'],
            'title' => ['required'],
            'sub_title' => ['required'],
            'point' => ['nullable'],
            'price' => ['required'],
            'offer_price' => ['nullable'],
            'thumbnail' => ['nullable', 'mimes:jpg,png,jpeg,gif,svg'],
        ]);


        $data = Product::findOrFail($id);
        $data->category_id = $request->category_id;
        $data->subcategory_id = $request->subcategory_id;
        $data->title = $request->title;
        $data->sub_title = $request->sub_title;
        $data->point = $request->point;
        $data->price = $request->price;
        $data->offer_price = $request->offer_price ?? 0;
        $data->description = $request->description;
        $data->featured_product = $request->featured_product;
        $data->new_arrival = $request->new_arrival;
        $data->today_deals = $request->today_deals;
        if ($request->policy) {
            $data->policy = Constant::POLICY_STATUS['active'];
        }
        if ($request->terms) {
            $data->terms = Constant::TERMS_STATUS['active'];
        }
        $data->status = Constant::PRODUCT_STATUS['active'];

        if ($request->hasFIle('thumbnail')) {
            if ($data->thumbnail != null) {
                $old_img = public_path('uploads/product/' . $data->thumbnail);
                if (file_exists($old_img)) {
                    unlink($old_img);
                }
            }

            $thumbnail = $request->file('thumbnail');
            $thumbnail_name = $data->slug . time() . '.' . $thumbnail->getclientoriginalextension();
            Image::make($thumbnail)->save(public_path('uploads/product/' . $thumbnail_name));
            $data->thumbnail = $thumbnail_name;
        }

        if ($request->hasFile('featured_image')) {
            $featured_image = $request->file('featured_image');
            foreach ($featured_image as $value) {
                $ga_image_name = $data->slug . time() . '-featured-image-product-id-' . rand(100, 900) . '-' . $data->id . '.' . $value->getclientoriginalextension();
                Image::make($value)->save(public_path('uploads/product/' . $ga_image_name));
                $gallery = new ProductFeaturedImage;

                $gallery->product_id = $data->id;
                $gallery->image = $ga_image_name;
                $gallery->save();
            }
        }

        if ($request->row_id) {
            ProductExtaInfo::where('product_id', $data->id)->delete();
            foreach ($request->row_id as $key => $value) {
                $extra_info = new ProductExtaInfo;
                $extra_info->product_id = $data->id;
                $extra_info->info_title = $request->info_title[$key];
                $extra_info->info_details = $request->info_details[$key];
                $extra_info->save();
            }
        }

        $data->save();

        flash()->addSuccess('Product Update Successfully!');
        return redirect()->route('admin.product.index');
    }
}
