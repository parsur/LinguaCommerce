<?php

namespace App\Http\Controllers\Article;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Article\StoreVideoRequest;
use App\DataTables\Article\VideoDataTable;
use App\Models\Video;
use App\Models\Article;
use App\Models\Media;
use App\Providers\Action;
use App\Providers\CourseArticleAction;

class VideoController extends Controller
{
    public $action;

    public function __construct() {
        $this->action = new Action();
    }

    // DataTable to blade
    public function list() {

        $dataTable = new VideoDataTable;

        // Video Table
        $vars['articleVideoTable'] = $dataTable->html();

        return view('article.videoList', $vars);
    }

    // Rendering DataTable
    public function articleVideoTable(VideoDataTable $dataTable) {
        return $dataTable->render('article.videoList');
    }

    public function store(StoreVideoRequest $request, CourseArticleAction $action) {

        // Insert or update
        $action->video($request, $request->get('article'), Article::class);
        
        return $this->getAction($request->get('button_action'));

    }

    // Edit
    public function edit(Request $request) {
        return $this->action->edit(Media::class, $request->get('id'));
    }
    
    // Delete
    public function delete($id) {
        return $this->action->delete(Media::class,$id);
    }
}
