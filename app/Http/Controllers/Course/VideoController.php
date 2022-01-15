<?php

namespace App\Http\Controllers\Course;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Course\StoreVideoRequest;
use App\DataTables\Course\VideoDataTable;
use App\Models\Media;
use App\Models\Course;
use App\Providers\Action;
use App\Providers\CourseArticleAction;
use DB;

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
        $vars['courseVideoTable'] = $dataTable->html();

        return view('course.videoList', $vars);
    }

    // Rendering DataTable
    public function courseVideoTable(VideoDataTable $dataTable) {
        return $dataTable->render('course.videoList');
    }

    public function store(StoreVideoRequest $request, CourseArticleAction $action) {
        // Insert or update
        $action->video($request, $request->get('course'), Course::class);

        return $this->getAction($request->get('button_action'));
    }
    
    // Edit
    public function edit(Request $request) {
        return $this->action->edit(Media::class,$request->get('id'));
    }
    
    // Delete
    public function delete($id) {
        return $this->action->delete(Media::class,$id);
    }
}
