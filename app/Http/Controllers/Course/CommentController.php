<?php

namespace App\Http\Controllers\Course;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Course\CommentDataTable;
use App\Http\Requests\StoreCommentRequest;
use App\Providers\Action;
use App\Providers\CourseArticleAction;
use App\Models\Comment;
use App\Models\Course;
use App\Models\Status;
use DB;

class CommentController extends Controller
{
    public $action;

    public function __construct() {
        $this->action = new Action();
    }

    // Datatable To blade
    public function list() {
        
        $dataTable = new CommentDataTable();

        // Course comment Table
        $vars['courseCommentTable'] = $dataTable->html();

        return view('course.comment.list', $vars);
    }

    // Get course comment
    public function courseCommentTable(CommentDataTable $dataTable) {
        return $dataTable->render('course.comment.list');
    }

    // Store
    public function store(StoreCommentRequest $request) {

        DB::transaction(function() use($request) {

            $comment = Comment::create(['name' => $request->get('name'), 'comment' => $request->get('comment'), 
                'commentable_id' => $request->get('course_id'), 'commentable_type' => Course::class]);

            // Set the course's comment inactive
            $comment->statuses()->create(['status' => Status::INACTIVE]);

        });

        return $this->successfulResponse('دیدگاه مرتبط با دوره با موفقیت ثبت شد');
    }

    // Edit
    public function edit(Request $request) {
        $this->action->edit(Comment::class, $request->get('id')); 
    }

    // Update
    public function update(StoreCommentRequest $request) {

        $comment = Comment::where('id', $request->get('id'))->where('commentable_type', Course::class)
            ->update(['comment' => $request->get('comment')]);

        return $this->successfulResponse('دیدگاه مرتبط با دوره با موفقیت ویرایش شد');
    }

    // Delete
    public function delete($id) {
        return $this->action->delete(Comment::class, $id);
    }

    // Comment submitted by admin to be shown for user
    public function submit(Request $request, CourseArticleAction $action) {
        // Set the course's comment visible
        return $action->comment($request->get('submission'));
    }

    // Details
    public function details(Request $request) {
        $vars['comment'] = Comment::find($request->get('id'));
        return view('course.comment.details', $vars);
    }

}
