<?php

namespace App\Http\Controllers\Course;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Course\StoreVideoRequest;
use App\DataTables\Course\VideoDataTable;
use App\Providers\SuccessMessages;
use App\Providers\Action;
use App\Models\Media;
use App\Models\Course;
use DB;

class VideoController extends Controller
{
    // DataTable to blade
    public function list() {
        $dataTable = new VideoDataTable;

        // Video Table
        $vars['courseVideoTable'] = $dataTable->html();

        return view('course.videoList', $vars);
    }

    // Rendering DataTable
    public function courseVideoTable(VideoDataTable $dataTable) {
        return $dataTable->render('course.videoList');
    }

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
        return response()->json($output);

    }

    // Add Video
    public function add($request) {
        foreach($request->get('courses') as $course) {
            // Insert Course videos
            Media::updateOrCreate(
                ['id' => $request->get('id')],
                ['url' => $request->get('aparat_url'), 'media_id' => $course, 'media_type' => Course::class, 'type' => Media::VIDEO]
            );

        }
    }
    
    // Edit
    public function edit(Action $action,Request $request) {
        return $action->edit(Media::class,$request->get('id'));
    }
    
    // Delete
    public function delete(Action $action, $id) {
        return $action->delete(Media::class,$id);
    }
}
