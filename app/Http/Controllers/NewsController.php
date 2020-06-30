<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Str;
use App\Services\NewsService;

class NewsController extends Controller
{
    protected $newsService;

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    public function addNews(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:2|max:50',
            'description'=>'required|min:2|max:1000',
            'image'     =>  'required|max:1048576',
            'date'     =>  'required',
            'categoryId'     =>  'required',
        ]);

        $this->newsService->saveNews($request);

        return response()->json([
            'message' => 'OK'
        ], 200);
    }

    public function allNews()
    {
        $news = News::with("newsCategory")->get();
        return response()->json([
            'news' => $news
        ], 200);
    }

    public function editNews($id){
        $news = News::find($id);
        if ($news) {
            return response()->json([
                'news' => $news
            ],200);
        } else {
            return response()->json([
                'message' => 'News with id ' . $id . ' not found!',
            ], 404);
        }
    }

    public function updateNews(Request $request, $id){
        $this->validate($request,[
            'title'=>'required|min:2|max:50',
            'description'=>'required|min:2|max:1000',
            'image'     =>  'required|max:1048576',
            'date'     =>  'required',
            'category_id'     =>  'required',
        ]);

        $this->newsService->updateNews($request, $id);
    }

    public function newsByCategory($id) {
        $news = $this->newsService->findNewsByCategory($id);
        return response()->json([
            'news' => $news
        ], 200);
    }

    public function newsById($id) {
        $news = $this->newsService->findNewsById($id);
        if ($news) {
            return response()->json([
                'news' => $news
            ],200);
        } else {
            return response()->json([
                'message' => 'News with id ' . $id . ' not found!',
            ], 404);
        }
    }

    public function updateNumberViews($id) {
        $news = News::find($id);
        if ($news) {
            $news->number_views++;
            $news->save();

            return response()->json([
                'news' => $news,
                'message' => "Number views is updated"
            ],200);
        } else {
            return response()->json([
                'message' => 'News with id ' . $id . ' not found!',
            ], 404);
        }
    }
}
