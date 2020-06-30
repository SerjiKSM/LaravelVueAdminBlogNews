<?php

namespace App\Http\Controllers;

use App\Models\NewsCategory;
use Illuminate\Http\Request;
use App\Services\NewsCategoryService;

class NewsCategoryController extends Controller
{
    protected $newsCategoryService;

    public function __construct(NewsCategoryService $newsCategoryService)
    {
        $this->newsCategoryService = $newsCategoryService;
    }

    public function addCategory(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:2|max:50'
        ]);

        $this->newsCategoryService->saveCategory($request);

        return response()->json([
            'message' => 'OK'
        ], 200);
    }

    public function allCategory()
    {
        $categories = NewsCategory::all();
        return response()->json([
            'categories' => $categories
        ], 200);
    }

    public function editCategory($id)
    {
        $category = NewsCategory::find($id);
        if ($category) {
            return response()->json([
                'category' => $category
            ], 200);
        } else {
            return response()->json([
                'message' => 'News category with id ' . $id . ' not found!',
            ], 404);
        }
    }

    public function updateCategory(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|min:2|max:50'
        ]);

        $this->newsCategoryService->updateCategory($request, $id);
    }
}
