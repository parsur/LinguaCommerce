<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreVideoRequest;
use App\DataTables\VideoDataTable;
use App\Providers\Action;
use App\Models\Media;
use App\Models\Category;
use App\Providers\SuccessMessages;

class VideoController extends Controller
{
    // DataTable to blade
    public function list() {
        $dataTable = new VideoDataTable;

        // Video Table
        $vars['videoTable'] = $dataTable->html();

        return view('videoList', $vars);
    }

    // Rendering DataTable
    public function videoTable(VideoDataTable $dataTable) {
        return $dataTable->render('videoList');
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
        return json_encode($output);

    }

    // Add Video
    public function add($request) {

        // If request did not have categories
        if($request->get('categories') == '') {
            $category = null;
        } else {
            $category = Category::class;
        }

        // Insert Course videos
        Media::updateOrCreate(
            ['id' => $request->get('id')],
            ['url' => $request->get('aparat_url'), 'media_id' => $request->get('categories'), 'media_type' => $category, 'type' => Media::VIDEO]
        );
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
