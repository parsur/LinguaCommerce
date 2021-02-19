<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreArticleVideoRequest;
use App\DataTables\ArticleVideoDataTable;
use App\Providers\SuccessMessages;
use App\Providers\Action;
use App\Models\Video;
use App\Models\Article;

class ArticleVideoController extends Controller
{
    // DataTable to blade
    public function list() {
        $dataTable = new ArticleVideoDataTable;

        // Video Table
        $vars['articleVideoTable'] = $dataTable->html();
        // Articles
        $vars['articles'] = Article::select('id', 'title')->get();

        return view('article.videoList', $vars);
    }

    // Rendering DataTable
    public function articleVideoTable(ArticleVideoDataTable $dataTable) {
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
                ['video_url' => $request->get('aparat_url'), 'video_id' => $article, 'video_type' => Article::class]
            );
        }
    }

    // Delete
    public function delete(Action $action, $id) {
        return $action->delete(Video::class,$id);
    }

    // Edit
    public function edit(Action $action,Request $request) {
        return $action->edit(Video::class,$request->get('id'));
    }
}
