<?php

namespace App\DataTables\Article;

use App\Models\Article;
use App\Models\Comment;
use App\DataTables\GeneralDataTable;
use App\DataTables\CourseDataTable;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Morilog\Jalali\Jalalian;
use \Illuminate\Support\Str;
use URL;

class CommentDataTable extends DataTable
{
    public $dataTable;

    public function __construct() {
        $this->dataTable = new GeneralDataTable();
    }
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->editColumn('created_at', function(Comment $comment){
                return $this->dataTable->showJalaliTime($comment->created_at); 
            })
            ->editColumn('comment', function(Comment $comment) {
                return Str::limit(optional($comment)->comment, 30, '(جزئیات)');
            })
            ->addColumn('commentable_id', function (Comment $comment) {
                return $comment->commentable->title;
            })
            ->filterColumn('commentable_id', function ($query, $keyword) {
                return $this->dataTable->filterCommentCol($query, $keyword);
            })
            ->addColumn('action', function(Comment $comment){
                $id = $comment->id;
                $details = '';
                
                if($comment->comment)
                    $details = URL::signedRoute('articleComment.details', ['id' => $id]);

                // Course comment
                $courseComment = new \App\DataTables\Course\CommentDataTable();
                return $courseComment->action($id, $details); 
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Article $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Comment $model)
    {
        return $model::where('commentable_type',Article::class);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->dataTable->tableSetting($this->builder(), 
                $this->getColumns(), 'articleComment');
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('DT_RowIndex') // connect to 226 line columns
            ->title('#')
                ->searchable(false)
                ->orderable(false),
            Column::make('name')
            ->title('نام کاربر'),
            Column::make('comment')
            ->title('دیدگاه'),
            Column::make('created_at')
            ->title('ساخته شده در'),
            Column::make('commentable_id')
            ->title('مقاله مرتبط')
                ->orderable(false),
            $this->dataTable->setActionCol('| جزئیات | تایید دیدگاه')
        ];
    }
}
