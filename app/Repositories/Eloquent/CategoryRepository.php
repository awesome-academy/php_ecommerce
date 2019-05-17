<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Models\Category;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function model()
    {
        return Category::class;
    }

    public function getCategory()
    {
        $categories = $this->model->with('products')->where('parent_id', 0)->get();

        return $categories;
    }

    public function store(array $request)
    {
        $category = new Category();
        $category->name = $request['name'];
        $category->slug = str_slug($category->name, '-');
        if ($request['parent_id'] != 0) {
            $category->parent_id = $request['parent_id'];
        } else {
            $category->parent_id = 0;
        }

        if ($category->save()) {
            return true;
        }
    }
}
