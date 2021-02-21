<?php

namespace App\DataTables;

use App\Models\Article;
use App\Models\Status;
use App\Models\Image;
use App\Models\Video;
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
                foreach($article->image as $image) {
                    return "<img src=/images/" . optional($image)->image_url . " height='auto' width='100%' />";
                }
            })
            ->editColumn('category_id', function(Article $article) {
                return optional($article->category)->name;
            })
            ->editColumn('subCategory_id', function(Article $article) {
                return optional($article->subCategory)->name;
            })
            ->editColumn('created_at', function(Article $article) {
                date_default_timezone_set('Asia/Tehran');
                return Jalalian::forge($article->created_at)->format('%A, %d %B %y');
            })
            ->editColumn('updated_at', function(Article $article){
                return Jalalian::forge($article->updated_at)->format('%A, %d %B %y');
            })
            ->addColumn('status', function(Article $article) {
                if($article->statuses->status === Status::VISIBLE) return 'فعال';
                else if($article->statuses->status === Status::INVISIBLE) return 'غیر فعال';
                else return '-';
            })
            ->addColumn('action',function(Article $article) {
                $editArticle = URL::signedRoute('article.newArticle', ['id' => $article->id]);
                $articleDetails = URL::signedRoute('article.adminDetails', ['id' => $article->id]);

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
            Column::computed('image_url')
            ->title('تصویر')
                ->addClass('column-title'),
            Column::computed('status')
            ->title('وضعیت')
                ->addClass('column-title'),
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
