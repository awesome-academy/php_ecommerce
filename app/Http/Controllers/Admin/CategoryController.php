<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\CreateCategoryRequest;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $categories = Category::with('products')->where('parent_id', 0)->get();

        return view('admin.categories.index', [
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        $categories = Category::pluck('name', 'id');
        $categories->prepend('--None--', '0');

        return view('admin.categories.create', ['categories' => $categories]);
    }

    public function store(CreateCategoryRequest $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->slug = str_slug($category->name, '-');
        if ($request->parent_id != 0) {
            $category->parent_id = $request->parent_id;
        } else {
            $category->parent_id = 0;
        }
        $category->save();

        return redirect()->route('categories.index')->with([
            'level' => 'success',
            'message' => trans('admin.message.category.create.success'),
        ]);
    }

    public function show($id)
    {
        try {
            $category = Category::with('products')->findOrFail($id);
            $options = Category::pluck('name', 'id');
            $options->prepend('--None--', '0');

            return view('admin.categories.show', [
                'category' => $category,
                'options' => $options,
            ]);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('categories.index')->with([
                    'level' => 'danger',
                    'message' => trans('admin.message.category.find.fail'),
                ]);
        }
    }

    public function update(CreateCategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        if ($category) {
            $category->update($request->all());

            return redirect()->route('categories.index')->with([
                'level' => 'success',
                'message' => trans('admin.message.category.update.success'),
            ]);
        }
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if ($category->children()->count() == 0 && $category->products()->count() == 0) {
            $category->delete();

            return redirect()->route('categories.index')->with([
                'level' => 'success',
                'message' => trans('admin.message.category.delete.success'),
            ]);
        } else {
            return redirect()->route('categories.index')->with([
                'level' => 'danger',
                'message' => trans('admin.message.category.delete.fail'),
            ]);
        }
    }
}
