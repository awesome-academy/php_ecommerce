<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\RequestProductRepositoryInterface;
use App\Http\Requests\CreateProductRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use File;

class ProductController extends Controller
{
    private $categoryRepository;
    private $productRepository;
    private $requestRepository;

    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
        ProductRepositoryInterface $productRepository,
        RequestProductRepositoryInterface $requestRepository
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
        $this->requestRepository = $requestRepository;
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $products = $this->productRepository->getAllWithoutPaginate();
        $requests = $this->requestRepository->getWithUser();

        return view('admin.products.index', [
            'products' => $products,
            'requests' => $requests,
        ]);
    }

    public function create()
    {
        $categories = $this->categoryRepository->lists('name', 'id');

        return view('admin.products.create', [
            'categories' => $categories,
        ]);
    }

    public function store(CreateProductRequest $request)
    {
        if ($this->productRepository->storeProduct($request->all())) {
            return redirect()->route('products.index')
                ->with([
                    'level' => 'success',
                    'message' => trans('admin.message.product.create.success'),
                ]);
        }
    }

    public function edit($id)
    {
        $product = $this->productRepository->find($id);
        $categories = $this->categoryRepository->lists('name', 'id');

        return view('admin.products.edit', [
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    public function update(CreateProductRequest $request, $id)
    {
        if ($this->productRepository->update($request->all(), $id)) {
            return redirect()->route('products.index')
                ->with([
                    'level' => 'success',
                    'message' => trans('admin.message.product.update.success'),
                ]);
        }
    }

    public function destroy($id)
    {
        if ($this->productRepository->delete($id)) {
            return response()->json([
                'message' => trans('admin.message.product.delete.success'),
                'level' => 'success',
            ]);
        }
    }

    public function requestProductStore(Request $request)
    {
        $requestProduct = $this->requestRepository->storeRequest($request->all());
        if ($requestProduct['status'] == config('setting.status.accepted')) {
            return redirect()->route('products.create')->with([
                'name' => $requestProduct['name'],
                'description' => $requestProduct['description'],
            ]);
        }

        return redirect()->route('products.index');
    }

    public function requestProductShow($id)
    {
        try {
            $request = $this->requestRepository->find($id);
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

    public function importProduct(Request $request)
    {
        if ($request->hasFile('product_file')) {
            if ($this->productRepository->importProduct($request)) {
                return redirect()->route('products.index')->with([
                    'message' => trans('admin.message.product.import.success'),
                    'level' => 'success',
                ]);
            } else {
                return redirect()->route('products.index')->with([
                    'message' => trans('admin.message.product.import.fail'),
                    'level' => 'danger'
                ]);
            }
        }
    }
}
