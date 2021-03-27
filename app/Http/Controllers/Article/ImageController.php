<?php

namespace App\Http\Controllers\Article;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Article\ImageDataTable;
use App\Http\Requests\Article\StoreImageRequest;
use App\Models\Article;
use App\Models\Media;
use App\Providers\SuccessMessages;
use App\Providers\Action;
use App\Providers\CourseArticleAction;
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
    public function store(StoreImageRequest $request,SuccessMessages $message,CourseArticleAction $action) {

        // insert or update
        $action->image($request, $request->get('article'), Article::class);

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

    // Delete
    public function delete(Action $action, $id) {
        return $action->deleteWithImage(Media::class,$id,'url');
    }

    // Edit
    public function edit(Action $action,Request $request) {
        return $action->edit(Media::class,$request->get('id'));
    }
}
