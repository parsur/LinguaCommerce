<?php

namespace App\Http\Controllers\Article;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticleVideoRequest;
use App\DataTables\Article\VideoDataTable;
use App\Providers\SuccessMessages;
use App\Providers\Action;
use App\Models\Video;
use App\Models\Article;

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

    public function store(StoreArticleVideoRequest $request,SuccessMessages $message) {

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

    // Add Video
    public function add($request) {

        // Article videos
        foreach($request->get('articles') as $article) {
            Video::updateOrCreate(
                ['id' => $request->get('id')],
                ['video_url' => $request->get('aparat_url'), 'video_id' => $article, 'video_type' => Article::class, 'type' => Poster::VIDEO]
            );
        }
    }

    // Delete
    public function delete(Action $action, $id) {
        return $action->delete(Poster::class,$id);
    }

    // Edit
    public function edit(Action $action,Request $request) {
        return $action->edit(Poster::class,$request->get('id'));
    }
}
