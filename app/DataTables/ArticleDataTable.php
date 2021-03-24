<?php

namespace App\DataTables;

use App\Models\Article;
use App\Models\Status;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;
use Carbon\Carbon;
use URL;

class ArticleDataTable extends DataTable
{
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
                    return "<img src=/images/" . optional($media)->url . " height='auto' width='100%' />";
                }
            })
            ->editColumn('category_id', function(Article $article) {
                return optional($article->category)->name;
            })
            ->filterColumn('category_id', function($query, $keyword) {
                $sql = 'category_id in (select id from categories where name like ?)';
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->editColumn('subCategory_id', function(Article $article) {
                return optional($article->subCategory)->name;
            })
            ->filterColumn('subCategory_id', function($query, $keyword) {
                $sql = 'subCategory_id in (select id from subCategories where name like ?)';
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->editColumn('created_at', function(Article $article) {
                date_default_timezone_set('Asia/Tehran');
                return Jalalian::forge($article->created_at);
            })
            ->editColumn('updated_at', function(Article $article){
                return Jalalian::forge($article->updated_at);
            })
            ->addColumn('status', function(Article $article) {
                if($article->statuses->status === Status::VISIBLE) return 'موجود';
                else if($article->statuses->status === Status::INVISIBLE) return 'ناموجود';
                else '-';
            })
            ->filterColumn('status', function ($query, $keyword) {
                switch($keyword) {
                    case 'موجود': $keyword = 0; 
                    break;
                    case 'ناموجود': $keyword = 1;
                }
                // $statuses = Article::whereHas('statuses',function ($subquery) use ($keyword) {
                //     $subquery->where('status', 'LIKE', '%'.$keyword.'%');
                // })->get()->pluck('id')->toArray();
                // $query->whereIn('id', $statuses);
                $sql = 'id in (select status_id from status where status like ?)';
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->addColumn('action',function(Article $article) {
                $editArticle = URL::signedRoute('article.newArticle', ['id' => $article->id]);
                $articleDetails = URL::signedRoute('article.details', ['id' => $article->id, 'role' => 'admin']);

                return '<a onclick="showConfirmationModal('.$article->id.')">
                            <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                        </a>
                        &nbsp;
                        <a href="'.$editArticle.'">
                            <i class="fa fa-edit text-danger" aria-hidden="true"></i>
                        </a>
                        &nbsp;
                        <a href="'.$articleDetails.'">
                            <i class="fa fa-info-circle text-danger" aria-hidden="true"></i>
                        </a>';
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
        return $this->builder()
            ->setTableId('articleTable')
            ->columns($this->getColumns())
            ->minifiedAjax(route('article.list.table'))
            ->columnDefs(
                [
                    ["className" => 'dt-center text-center', "target" => '_all'],
                ]
            )
            ->searching(true)
            ->info(false)
            ->responsive(true)
            ->dom('PBCfrtip')
            ->orderBy(1)
            ->language(asset('js/persian.json'));
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('DT_RowIndex')
            ->title('#')
                ->addClass('column-title')
                ->searchable(false)
                ->orderable(false),
            Column::make('title')
            ->title('تیتر')
                ->addClass('column-title'),
            Column::make('image_url')
            ->title('تصویر')
                ->addClass('column-title')
                ->orderable(false),
            Column::make('status')
            ->title('وضعیت')
                ->addClass('column-title')
                ->orderable(false),
            Column::make('category_id')
            ->title('دسته بندی اول')
                ->addClass('column-title'),
            Column::make('subCategory_id')
            ->title('دسته بندی دوم')
                ->addClass('column-title'),
            Column::make('created_at')
            ->title('تاریخ انتشار')
                ->addClass('column-title'),
            Column::make('updated_at')
            ->title('تاریخ ویرایش شده')
                ->addClass('column-title'),
            Column::computed('action') // This Column is not in database
                ->exportable(false)
                ->searchable(false)
                ->printable(false)
                ->orderable(false)
                ->title('حذف،ویرایش،جزئیات(توضیحات،رسانه)')
                ->addClass('column-title')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Article_' . date('YmdHis');
    }
}
