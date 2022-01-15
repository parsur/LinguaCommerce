<?php

namespace App\Http\Controllers\Course;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Course\ImageDataTable;
use App\Http\Requests\Course\StoreImageRequest;
use App\Models\Media;
use App\Models\Course;
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

        // CourseImage Table
        $vars['courseImageTable'] = $dataTable->html();

        return view('course.imageList', $vars);
    }

    // Get course image
    public function courseImageTable(ImageDataTable $dataTable) {
        return $dataTable->render('course.imageList');
    }

    // Store
    public function store(StoreImageRequest $request) {

        // insert or update
        $imageUploader = Media::find($request->get('id'));
        $this->action->image($imageUploader, $request, $request->get('course'), Course::class);
        
        return $this->getAction($request->get('button_action'));
    }

    // Edit
    public function edit(Request $request) {
        return $this->action->edit(Media::class,$request->get('id'));
    }
    
    // Delete
    public function delete($id) {
        return $this->action->deleteWithImage($id);
    }
}

