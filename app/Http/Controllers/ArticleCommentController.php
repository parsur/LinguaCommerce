<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\ArticleCommentDataTable;
use App\Http\Requests\StoreArticleCommentRequest;
use App\Providers\Action;

class ArticleCommentController extends Controller
{
    // Datatable To blade
    public function list() {
        // dataTable
        $dataTable = new ArticleCommentDataTable();

        // Article comment Table
        $vars['articleCommentTable'] = $dataTable->html();

        return view('article.commentList', $vars);
    }

    // Get article comment
    public function articleCommentTable(ArticleCommentDataTable $dataTable) {
        return $dataTable->render('article.commentList');
    }

    // Store
    public function store(StoreCourseCommentRequest $request,$course_id) {
        $comment = new Comment();
        $comment->comment = $request->get('comment');
        $comment->comment_id = $course_id;
        $comment->comment_type = Course::class;
    }

    // Edit
    public function edit($id) {
        $vars['courseComment'] = Comment::findOrFail($id);
        return response()->json($vars); 
    }

    // Update
    public function update($id, Request $request) {
        $comment = Comment::findOrFail($id);
        $comment->comment = $request->get('comment');
        $comment->comment_id = $request->get('course');
        $comment->comment_type = Course::class;
    }

    // Delete
    public function delete($id,Action $action) {
        return $action->delete(Comment::class, $id);
    }
}
