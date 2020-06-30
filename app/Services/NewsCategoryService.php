<?php
namespace App\Services;

use App\Models\NewsCategory;

class NewsCategoryService
{
    public function saveCategory($request) {
        $category = new NewsCategory();
        $category->title = $request->title;
        $category->description = $request->description;
        $category->save();
    }

    public function updateCategory($request, $id) {
        $category = NewsCategory::find($id);
        $category->title = $request->title;
        $category->description = $request->description;
        $category->save();
    }
}
