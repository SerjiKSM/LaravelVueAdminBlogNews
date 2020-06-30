<?php

namespace App\Services;

use App\Models\News;
use Image;

class NewsService
{
    public function saveNews($request) {
        $strpos = strpos($request->image,';');
        $sub = substr($request->image,0,$strpos);
        $ex = explode('/',$sub)[1];
        $name = time().".".$ex;
        $img = Image::make($request->image)->resize(200, 200);
        $upload_path = public_path()."/uploadImage/";
        $img->save($upload_path.$name);

        $news = new News();
        $news->title = $request->title;
        $news->description = $request->description;
        $news->image = $name;
        $news->date = date('Y-m-d', strtotime($request->date));
        $news->category_id = $request->categoryId;
        $news->save();
    }

    public function updateNews($request, $id) {
        $news = News::find($id);

        if($request->image != $news->image){
            $strpos = strpos($request->image,';');
            $sub = substr($request->image,0,$strpos);
            $ex = explode('/',$sub)[1];
            $name = time().".".$ex;
            $img = Image::make($request->image)->resize(200, 200);
            $upload_path = public_path()."/uploadImage/";
            $image = $upload_path. $news->image;
            $img->save($upload_path.$name);

            if(file_exists($image)){
                @unlink($image);
            }
        }else{
            $name = $news->image;
        }

        $news->title = $request->title;
        $news->description = $request->description;
        $news->category_id = $request->category_id;
        $news->date = date('Y-m-d', strtotime($request->date));
        $news->image = $name;
        $news->save();
    }

    public function findNewsByCategory($id) {
        return News::where('category_id', $id)->get();
    }

    public function findNewsById($id) {
        return News::with("newsCategory")->find($id);
    }
}
