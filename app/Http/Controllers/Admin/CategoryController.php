<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\CreateCategoryRequest;

class CategoryController extends Controller
{
    private $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->middleware(['auth', 'admin']);
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->getCategory();

        return view('admin.categories.index', [
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        $categories = $this->categoryRepository->lists('name', 'id');
        $categories->prepend('--None--', '0');

        return view('admin.categories.create', ['categories' => $categories]);
    }

    public function store(CreateCategoryRequest $request)
    {
        if ($this->categoryRepository->store($request->all())) {
            return redirect()->route('categories.index')->with([
                'level' => 'success',
                'message' => trans('admin.message.category.create.success'),
            ]);
        }
    }

    public function show($id)
    {
        try {
            $category = $this->categoryRepository->getWith('products', $id);
            $options = $this->categoryRepository->lists('name', 'id');
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
        $category = $this->categoryRepository->find($id);
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
        $category = $this->categoryRepository->find($id);

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
