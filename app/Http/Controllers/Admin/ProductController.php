<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\RequestProduct;
use App\Http\Requests\CreateProductRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $products = Product::with('category')->get();
        $requests = RequestProduct::with('user')->get();

        return view('admin.products.index', [
            'products' => $products,
            'requests' => $requests,
        ]);
    }

    public function create()
    {
        $categories = Category::pluck('name', 'id');

        return view('admin.products.create', [
            'categories' => $categories,
        ]);
    }

    public function store(CreateProductRequest $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->slug = str_slug($product->name);
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->stock_quantity = $request->stock_quantity;
        $product->price = $request->price;

        if ($request->image) {
            $path = public_path(config('setting.product.image_path'));
            $fileUpload = $request->image;
            $nameFileUpload = uniqid();
            $fileUpload->move($path, $nameFileUpload . '.' . 'jpg');
            $product->image = config('setting.product.image_path') . $nameFileUpload;
        }
        $product->save();

        return redirect()->route('products.index')
                ->with([
                    'level' => 'success',
                    'message' => trans('admin.message.product.create.success'),
                ]);
    }

    public function edit($id)
    {
        $product = Product::with('category')->findOrFail($id);
        $categories = Category::pluck('name', 'id');

        return view('admin.products.edit', [
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    public function update(CreateProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());

        return redirect()->route('products.index')
                ->with([
                    'level' => 'success',
                    'message' => trans('admin.message.product.update.success'),
                ]);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json([
            'message' => trans('admin.message.product.delete.success'),
            'level' => 'success',
        ]);
    }

    public function requestProductStore(Request $request)
    {
        $requestProduct = RequestProduct::findOrFail($request->id);
        $requestProduct->status = $request->status;
        $requestProduct->save();
        if ($requestProduct->status['status']) {
            return redirect()->route('products.create')->with([
                'name' => $requestProduct->product_name,
                'description' => $requestProduct->description,
            ]);
        }

        return redirect()->route('products.index');
    }

    public function requestProductShow($id)
    {
        try {
            $request = RequestProduct::findOrFail($id);
            $optionStatus = trans('admin.option.status');

            return view('admin.products.edit-request', [
                'request' => $request,
                'optionStatus' => $optionStatus,
            ]);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('products.index')
                ->with([
                    'level' => 'danger',
                    'message' => trans('admin.message.product.find.fail'),
                ]);
        }
    }
}
