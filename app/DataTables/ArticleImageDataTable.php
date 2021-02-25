<?php

namespace App\DataTables;

use App\Models\Image;
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
            ->editColumn('image_url', function(Image $image) {
                return "<img src=/images/" . $image->image_url . " height='auto' width='80%' />";
            })
            ->addColumn('image', function (Image $image) {
                return $image->image->name;
            })
            ->filterColumn('image', function ($query, $keyword) {
                $articles = Image::whereHas('image', function($subquery) use ($keyword) {
                    $subquery->where('name', 'LIKE', '%'.$keyword.'%');
                })->get()->pluck('id')->toArray();

                $query->whereIn('id', $articles);
            })
            ->addColumn('action', function(Image $image){
                return <<<ATAG
                            <a onclick="showConfirmationModal('{$image->id}')">
                                <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                            </a>
                            &nbsp;
                            <a onclick="showEditModal('{$image->id}')">
                                <i class="fa fa-edit text-danger" aria-hidden="true"></i>
                            </a>
                        ATAG;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Article $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Image $model)
    {
        return $model->where('image_type', Article::class);
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
            Column::make('image')
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
