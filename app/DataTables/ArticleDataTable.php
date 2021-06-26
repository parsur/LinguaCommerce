<?php

namespace App\DataTables;

use App\Models\Article;
use App\Models\Status;
use App\Datatables\GeneralDataTable;
use App\DataTables\CourseDataTable;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Morilog\Jalali\Jalalian;
use Carbon\Carbon;
use URL;

class ArticleDataTable extends DataTable
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
            ->rawColumns(['action', 'image_url'])
            ->addColumn('image_url', function(Article $article) {
                foreach($article->media as $media) {
                    return "<img src=/images/" . optional($media)->url . " classs='dataTableImage' />";
                }
            })
            ->editColumn('category_id', function(Article $article) {
                return optional($article->category)->name;
            })
            ->filterColumn('category_id', function($query, $keyword) {
                return $this->dataTable->filterCategoryCol($query, $keyword); 
            })
            ->editColumn('subcategory_id', function(Article $article) {
                return optional($article->subcategory)->name;
            })
            ->filterColumn('subcategory_id', function($query, $keyword) {
                return $this->dataTable->filterSubcategoryCol($query, $keyword);
            })
            ->editColumn('created_at', function(Article $article) {
                return $this->dataTable->showJalaliTime($article->created_at);
            })
            ->editColumn('updated_at', function(Article $article){
                return $this->dataTable->showJalaliTime($article->updated_at);
            })
            ->addColumn('status', function(Article $article) {
                return $this->dataTable->setStatusCol($article->statuses->status);
            })
            ->filterColumn('status', function ($query, $keyword) {
                return $this->dataTable->filterStatusCol($query, $keyword);
            })
            ->addColumn('action',function(Article $article) {
                $id = $article->id;

                $edit = URL::signedRoute('article.newArticle', ['id' => $id]);
                $details = URL::signedRoute('article.details', ['id' => $id, 'role' => 'admin']);

                // Course dataTable
                $courseDataTable = new CourseDataTable();
                return $courseDataTable->setAction($id, $edit, $details);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Article $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Article $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->dataTable->tableSetting($this->builder(), 
                $this->getColumns(), 'article');
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            $this->dataTable->getIndexCol(),
            Column::make('title')
            ->title('تیتر'),
            Column::make('image_url')
            ->title('تصویر')
                ->orderable(false),
            Column::make('status')
            ->title('وضعیت')
                ->orderable(false),
            Column::make('category_id')
            ->title('دسته بندی اول'),
            Column::make('subcategory_id')
            ->title('دسته بندی دوم'),
            Column::make('created_at')
            ->title('تاریخ انتشار'),
            Column::make('updated_at')
            ->title('تاریخ ویرایش شده'),
            $this->dataTable->setActionCol('| ویرایش | جزئیات')
        ];
    }
}
