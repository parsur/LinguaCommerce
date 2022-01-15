<?php

namespace App\Http\Controllers\Article;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Article\CommentDataTable;
use App\Http\Requests\StoreCommentRequest;
use App\Providers\CourseArticleAction;
use App\Providers\Action;
use App\Models\Comment;
use App\Models\Status;
use App\Models\Article;
use DB;

class CommentController extends Controller
{
    // Datatable To blade
    public function list() {
        
        $dataTable = new CommentDataTable();

        // Article comment table
        $vars['articleCommentTable'] = $dataTable->html();

        return view('article.comment.list', $vars);
    }

    // Get article comment
    public function articleCommentTable(CommentDataTable $dataTable) {
        return $dataTable->render('article.comment.list');
    }

    // Store
    public function store(StoreCommentRequest $request) {

        DB::transaction(function() use($request) {

            $comment = Comment::create(['name' => $request->get('name'), 'comment' => $request->get('comment'), 
                'commentable_id' => $request->get('article_id'), 'commentable_type' => Article::class]);

            // Set the course's comment inactive    
            $comment->statuses()->create(['status' => Status::INACTIVE]);
        });

        $this->successfulResponse('دیدگاه درباره مقاله با موفقیت ثبت شد');

    }

    // Edit
    public function edit(Request $request) {
        $action->edit(Comment::class, $request->get('id')); 
    }

    // Update
    public function update(Request $request) {

        $comment = Comment::where('commentable_id', $request->get('id'))->where('commentable_type', Article::class)
            ->update(['comment' => $request->get('comment')]);

        return $this->successfulResponse('دیدگاه درباره مقاله با موفقیت ویرایش شد');
    }

    // Delete
    public function delete($id, Action $action) {
        return $action->delete(Comment::class, $id);
    }

    // Comment submitted by admin to be shown for user
    public function submit(Request $request, CourseArticleAction $action) {
        // Set the course's comment active
        return $action->comment($request->get('submission'));
    }

    // Details
    public function details(Request $request) {
        $vars['comment'] = Comment::find($request->get('id'));
        return view('article.comment.details', $vars);
    }
}
