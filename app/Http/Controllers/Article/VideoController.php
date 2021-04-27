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

    // Delete
    public function delete(Action $action, $id) {
        return $action->delete(Media::class,$id);
    }

    // Edit
    public function edit(Action $action,Request $request) {
        return $action->edit(Media::class,$request->get('id'));
    }
}
