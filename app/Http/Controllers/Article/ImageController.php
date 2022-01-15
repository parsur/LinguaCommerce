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

class ImageController extends Controller
{
    public $action; 

    public function __construct() {
        $this->action = new Action();
    }

    // DataTable to blade
    public function list() {
      
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
    public function store(StoreImageRequest $request) {

        // insert or update
        $imageUploader = Media::find($request->get('id'));
        $this->action->image($imageUploader, $request, $request->get('article'), Article::class);

        return $this->getAction($request->get('button_action'));
    }

    // Delete
    public function delete($id) {
        return $this->action->deleteWithImage($id);
    }

    // Edit
    public function edit(Request $request) {
        return $this->action->edit(Media::class,$request->get('id'));
    }
}
