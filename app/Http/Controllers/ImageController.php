<?php

namespace App\Http\Controllers;

use App\DataTables\ImageDataTable;
use App\Models\Course;
use App\Models\Article;
use App\Models\Image;
use App\Models\Video;
use Illuminate\Support\Facades\Validator;
use App\Providers\SuccessMessages;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreImageRequest;
use Illuminate\Http\Request;
use App\Providers\Action;
use App\Models\Product;
use Response;
use DB;

class ImageController extends Controller
{
    // DataTable To Blade
    public function list(Request $request) {
        $dataTable = new ImageDataTable;

        // DataTable
        $vars['imageTable'] = $dataTable->html();
        // Articles
        $vars['articles'] = Article::select('title','id')->get();

        return view('media.imageList', $vars);
    }

    // Rendering DataTable
    public function imageTable(ImageDataTable $dataTable) {
        return $dataTable->render('media.imageList');
    }

    // Store
    public function store(StoreImageRequest $request,SuccessMessages $message) {

        // Insert or update
        $this->add($request);

        // Insert
        if($request->get('button_action') == 'insert') {
            $success_output = $message->getInsert();
        }
        // Update
        else if($request->get('button_action') == 'update') {
            $success_output = $message->getUpdate();
        }
        
        $output = array('success' => $success_output);
        return json_encode($output);
    }

    // Add Image
    public function add($request) {

        DB::beginTransaction();

        // Image
        $image = Image::find($request->get('id'));
        if(!$image) {
            $image = new Image();
        }

        try {
            if($request->hasFile('image')) {
                $image = $request->file('image');
                $file = $image->getClientOriginalName();
                $image->move(public_path('images'), $file);
            }   
            // Course images
            if($request->get('courses')) {
                foreach($request->get('courses') as $course) {
                    $image->image_id = $course;
                    $image->image->image_type = Course::class;
                    if(!empty($file))
                        $image->image_url = $file;
                    
                    $image->save();
                }
            }
            // Article images
            if($request->get('articles')) {
                foreach($request->get('articles') as $article) {
                    $image->image_id = $course;
                    $image->image->image_type = Course::class;
                    if(!empty($file))
                        $image->image_url = $file;
                    
                    $image->save();
                }
            }
            DB::commit();
        } catch(Exception $e) {
            throw $e;
            DB::rollback();
        }
    }

    // Edit
    public function delete(Action $action, $id) {
        return $action->deleteWithImage(Image::class,$id,'image_url');
    }

    public function edit(Action $action,Request $request) {
        return $action->edit(Image::class,$request->get('id'));
    }


}
