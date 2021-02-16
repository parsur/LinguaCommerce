<?php

namespace App\Http\Controllers;
use App\DataTables\VideoDataTable;
use App\Providers\SuccessMessages;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreVideoRequest;
use App\Providers\Action;
use App\Models\Video;
use App\Models\Article;
use Illuminate\Http\Request;
use DB;

class VideoController extends Controller
{

    // DataTable to blade
    public function list() {
        $dataTable = new VideoDataTable;

        //  Video Table
        $vars['videoTable'] = $dataTable->html();
        // Articles
        $vars['articles'] = Article::select('title', 'id')->get();

        return view('media.videoList', $vars);
    }

    // Rendering DataTable
    public function videoTable(VideoDataTable $dataTable) {
        return $dataTable->render('media.videoList');
    }

    // Insert
    public function store(StoreVideoRequest $request,SuccessMessages $message) {

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
    public function add(Request $request) {

        DB::beginTransaction();

        try {
            // Course images
            if($request->get('courses')) {
                foreach($request->get('courses') as $course) {
                    Video::updateOrCreate(
                        ['id' => $request->get('id')],
                        ['video_url' => $request->get('aparat_url'), 'video_id' => $course, 'video_type' => Course::class]
                    );
                }
            }
            // Article images
            if($request->get('articles')) {
                foreach($request->get('articles') as $article) {
                    // If there were any picture
                    Video::updateOrCreate(
                        ['id' => $request->get('id')],
                        ['video_url' => $request->get('aparat_url'), 'video_id' => $article, 'video_type' => Article::class]
                    );
                }
            }
            DB::commit();
        } catch(Exception $e) {
            throw $e;
            DB::rollback();
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
