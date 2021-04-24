<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Media;
use App\Models\Comment;
use App\Models\Status;
use File;

class CourseArticleAction {

    /**
     * Action of course and article. (GET,POST)
     * @return Json 
     */
    
    // Details
    public function details($request, $model) {

        $id = $request->get('id');
        // Role
        $role = $request->get('role');

        switch($model) {
            case 'App\Models\Course':
                $name = 'course';
                break;
            case 'App\Models\Article':
                $name = 'article';
        }
        
        $vars["$name"] = $model::where('id', $id)->with(['statuses:status_id,status',
            'description:description_id,description','category:id,name','subCategory:id,name', 
                'comments' => function($query) {
                $query->whereHas('statuses', function ($query) {
                    $query->active();
                });
            }])->first();
        

        if($role != 'admin') {

            $images = []; // Image
            $videos = []; // Video

            $media_urls = Media::where('media_id', $id)->where('media_type', $model)->get();
            foreach($media_urls as $media_url) {
                switch($media_url->type) {
                    case Media::IMAGE:
                        $images[] = ['url' => '/images/' . $media_url->url];
                        break;
                    case MEDIA::VIDEO:
                        $videos[] = ['url' => $media_url->url];
                }
            }

            // Images
            $vars['images'] = $images;
            // Videos
            $vars['videos'] = $videos;

            return response()->json($vars);
        }

        return view("$name.details", $vars);
    }

    // Edit
    public function edit($model, $id) {
        $values = $model::where('id', $id)->with('statuses:status_id,status',
            'description:description_id,description','category:id,name','subCategory:id,name')->first();

        return response()->json($values);
    }

    // Category and subCategory SubSet
    public function subSet($request) {
        // Category or Subcategory
        switch($request) {
            case '':
                return null;
                break;
            default:
                return $request;
        }
    }


    // Add Video
    public function video($request, $id, $type) {
        // Insert course videos
        Media::updateOrCreate(
            ['id' => $request->get('id')],
            ['url' => $request->get('aparat_url'), 'media_id' => $id, 'media_type' => $type, 'type' => Media::VIDEO]
        );
    }

    // Comment submitted by admin to be shown for user.
    public function comment($request) {
        // Set the course's comment visible
        $comment = Comment::find($request);
        $comment->statuses()->update(['status' => Status::ACTIVE]);
        
        return response()->json(['success' => '<div class="alert alert-success">دیدگاه کاربر با موفقیت تایید شد</div>']);
    }

    /**
     * Search.
     */
    public function search($request, $model) {

        $query = $model::query()->with('media');

        // If name is requested
        if(!empty($request->get('search')) and !empty($request->get('column'))) {
            
            $query->where($request->column, 'LIKE', "%{$request->search}%");
        }
        // If category is requested | 0 = null
        if($request->get('category_id') != 0) {

            $query->where('category_id', $request->category_id)->whereNotNull('category_id');
        }
        // If subcategory is requested | 0 = null
        if($request->get('sub_category_id') != 0) {
            
            $query->where('subCategory_id', $request->sub_category_id)->whereNotNull('subCategory_id');
        }

        // Results
        $results = $query->get();

        if(count($results) > 0)
            return response()->json($results); // Ok.
        else 
            return response()->json(null); // No result.
    }
}