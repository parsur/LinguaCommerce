<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\CourseCommentDataTable;

class CourseCommentController extends Controller
{
    // Datatable To blade
    public function list() {
        // dataTable
        $dataTable = new CourseDataTable();

        // Course Table
        $vars['courseCommentTable'] = $dataTable->html();

        return view('courseComment.list', $vars);
    }

    // Get Course
    public function courseTable(CourseDataTable $dataTable) {
        return $dataTable->render('course.list');
    }
}
