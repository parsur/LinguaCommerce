<?php

namespace App\Http\Controllers\Article;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Article\ImageDataTable;
use App\Http\Requests\Article\StoreImageRequest;
use App\Providers\SuccessMessages;
use App\Providers\Action;
use App\Models\Article;
use App\Models\Media;
use File;
use DB;

class ImageController extends Controller
{
    // DataTable to blade
    public function list() {
        // dataTable
        $dataTable = new ImageDataTable();

        // Article Image Table
        $vars['articleImageTable'] = $dataTable->html();
        // Articles
        $vars['articles'] = Article::select('id', 'title')->get();

        return view('article.imageList', $vars);
    }

    // Get Article Image
    public function articleImageTable(ImageDataTable $dataTable) {
        return $dataTable->render('article.imageList');
    }

    // Store
    public function store(StoreImageRequest $request,SuccessMessages $message) {

        // insert or update
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
        return response()->json($output);
    }

    // Add Image
    public function add($request) {

        if($request->hasFile('images')) {
            foreach($request->file('images') as $image) {
                // File
                $file = $image->getClientOriginalName();

                // Update
                $imageUpload = Media::find($request->get('id'));
                if(!$imageUpload) {
                    // Insert
                    $imageUpload = new Media();
                }
                $imageUpload->media_id = $request->get('article');
                $imageUpload->media_type = Article::class;
                // 0 = image / 1 = video
                $imageUpload->type = Media::IMAGE;

                if(isset($file)) {
                    File::delete(public_path("images/$imageUpload->url")); 
                    $imageUpload->url = $file;
                    $image->move(public_path('images'), $file);
                }
                $imageUpload->save();
            }
        }
    }

    // Delete
    public function delete(Action $action, $id) {
        return $action->deleteWithImage(Media::class,$id,'url');
    }

    // Edit
    public function edit(Action $action,Request $request) {
        return $action->edit(Media::class,$request->get('id'));
    }
}
