<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\ArticleImageDataTable;
use App\Http\Requests\StoreArticleImageRequest;
use App\Providers\SuccessMessages;
use App\Providers\Action;
use App\Models\Article;
use App\Models\Image;
use DB;

class ArticleImageController extends Controller
{
    // DataTable to blade
    public function list() {
        // dataTable
        $dataTable = new ArticleImageDataTable();

        // Article Image Table
        $vars['articleImageTable'] = $dataTable->html();
        // Articles
        $vars['articles'] = Article::select('id', 'title')->get();

        return view('article.imageList', $vars);
    }

    // Get Article Image
    public function articleImageTable(ArticleImageDataTable $dataTable) {
        return $dataTable->render('article.imageList');
    }

    // Store
    public function store(StoreArticleImageRequest $request,SuccessMessages $message) {

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
        return json_encode($output);
    }

    // Add Image
    public function add($request) {

        DB::beginTransaction();

        try {
            if($request->hasFile('image')) {
                $image = $request->file('image');
                $file = $image->getClientOriginalName();
                $image->move(public_path('images'), $file);
            }   

            foreach($request->get('articles') as $article_id) {
                // Update
                $imageUpload = Image::find($request->get('id'));
                if(!$imageUpload) {
                    // Insert
                    $imageUpload = new Image();
                }
                $imageUpload->image_id = $article_id;
                $imageUpload->image_type = Article::class;
    
                if(isset($file)) {
                    $imageUpload->image_url = $file;
                }
                $imageUpload->save();
            }

            DB::commit();

        } catch(Exception $e) {
            throw $e;
            DB::rollback();
        }
    }

    // Delete
    public function delete(Action $action, $id) {
        return $action->deleteWithImage(Image::class,$id,'image_url');
    }

    // Edit
    public function edit(Action $action,Request $request) {
        return $action->edit(Image::class,$request->get('id'));
    }
}
