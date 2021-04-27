<?php

namespace App\Http\Controllers\Article;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Article\ImageDataTable;
use App\Http\Requests\Article\StoreImageRequest;
use App\Models\Article;
use App\Models\Media;
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
    public function store(StoreImageRequest $request,Action $action) {

        // insert or update
        $imageUploader = Media::find($request->get('id'));
        $action->image($imageUploader, $request, $request->get('article'), Article::class);

        return $this->getAction($request->get('button_action'));
    }

    // Delete
    public function delete(Action $action, $id) {
        return $action->deleteWithImage($id);
    }

    // Edit
    public function edit(Action $action,Request $request) {
        return $action->edit(Media::class,$request->get('id'));
    }
}
