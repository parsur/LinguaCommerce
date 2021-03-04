<?php

namespace App\DataTables;

use App\Models\Poster;
use App\Models\Article;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ArticleImageDataTable extends DataTable
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
            ->rawColumns(['action','image_url']) 
            ->editColumn('image_url', function(Poster $poster) {
                return "<img src=/images/" . $poster->url . " height='auto' width='80%' />";
            })
            ->editColumn('poster_id', function (Poster $image) {
                return $poster->poster->name;
            })
            ->filterColumn('poster_id', function ($query, $keyword) {
                $articles = Poster::where('type', Poster::IMAGE)->whereHas('image', function($subquery) use ($keyword) {
                    $subquery->where('name', 'LIKE', '%'.$keyword.'%');
                })->get()->pluck('id')->toArray();

                $query->whereIn('id', $articles);
            })
            ->addColumn('action', function(Poster $poster){
                return <<<ATAG
                            <a onclick="showConfirmationModal('{$poster->id}')">
                                <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                            </a>
                            &nbsp;
                            <a onclick="showEditModal('{$poster->id}')">
                                <i class="fa fa-edit text-danger" aria-hidden="true"></i>
                            </a>
                        ATAG;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Poster $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Poster $model)
    {
        return $model->where('poster_type', Article::class)->where('type', $model::IMAGE);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('articleImageTable')
            ->columns($this->getColumns())
            ->minifiedAjax(route('articleImage.list.table'))
            ->columnDefs(
                [
                    ["className" => 'dt-center text-center', "target" => '_all'],
                ]
            )
            ->searching(false)
            ->info(false)
            ->responsive(true)
            ->dom('PBCfrtip')
            ->orderBy(1)
            ->language(asset('js/Persian.json'));
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
                ->addClass('column-title')
                ->searchable(false)
                ->orderable(false),
            Column::make('image_url')
            ->title('رسانه')
                ->addClass('column-title'),
            Column::make('poster_id')
            ->title('مقاله مرتبط')
                ->addClass('column-title'),
            Column::computed('action') // This column is not in database
                ->exportable(false)
                ->searchable(false)
                ->printable(false)
                ->orderable(false)
                ->title('حذف،ویرایش')
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
        return 'ArticleImage_' . date('YmdHis');
    }
}
