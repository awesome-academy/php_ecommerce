<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Models\Product;
use App\Models\Category;
use File;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function model()
    {
        return Product::class;
    }

    public function getAll()
    {
        $products = $this->model->with('category')->latest()
                    ->simplePaginate(config('setting.product.number_pagination'));

        return $products;
    }

    public function getMightLikeProduct($categoryId, $exceptProductId)
    {
        $products = $this->model->where('category_id', $categoryId)
                    ->where('id', '!=', $exceptProductId)->inRandomOrder()
                    ->take(config('setting.product.number_recommendation'))->get();

        return $products;
    }

    public function storeProductsInSession($product, $id)
    {
        $products = session('viewedProducts', null);
        $storedProduct = $product;

        if ($products && array_key_exists($id, $products)) {
            $storedProduct = $products[$id];
        }
        $products[$id] = $storedProduct;
        session(['viewedProducts' => $products]);

        return $products;
    }

    public function filterByCategory($slug)
    {
        $productsByCategories = $this->findBy('category_id', $category->id);

        return $productsByCategories;
    }

    public function filterByPrice($data)
    {
        $priceRange = explode(';', $data);
        $productByPrice = $this->model->price($priceRange[0], $priceRange[1])->get();

        return $productByPrice;
    }

    public function getAllWithoutPaginate()
    {
        $products = $this->model->with('category')->get();

        return $products;
    }

    public function storeProduct(array $request)
    {
        $name = $request['name'];

        if ($request['image']) {
            $path = public_path(config('setting.product.image_path'));
            $fileUpload = $request['image'];
            $nameFileUpload = uniqid();
            $fileUpload->move($path, $nameFileUpload . '.' . 'jpg');
            $productImage = config('setting.product.image_path') . $nameFileUpload;
        }

        $product = $this->model->create([
            'name' => $name,
            'slug' => str_slug($name, '-'),
            'description' => $request['description'],
            'category_id' => $request['category_id'],
            'stock_quantity' => $request['stock_quantity'],
            'price' => $request['price'],
            'image' => $productImage,
        ]);

        if ($product->save()) {
            return true;
        } else {
            return false;
        }
    }

    public function importProduct($request)
    {
        $extension = File::extension($request->product_file->getClientOriginalName());
        if ($extension == 'csv') {
            $file = $request->file('product_file');
            $data = file_get_contents($file);
            $rows = array_map('str_getcsv', explode("\n", $data));
            $header =  array_shift($rows);
            foreach ($rows as $row) {
                if (count($row) == count($header)) {
                    $row = array_combine($header, $row);
                    $category = Category::name($row['category'])->first();
                    $this->model->create([
                        'name' => $row['name'],
                        'slug' => str_slug($row['name'], '-'),
                        'description' => $row['description'],
                        'category_id' => $category->id,
                        'stock_quantity' => $row['stock_quantity'],
                        'price' => $row['price'],
                    ]);
                }
            }

            return true;
        } else {
            return false;
        }
    }
}
