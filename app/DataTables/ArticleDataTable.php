<?php

namespace App\DataTables;

use App\Models\Article;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

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
            ->addColumn('action', 'articledatatable.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ArticleDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ArticleDataTable $model)
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
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
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
            Column::computed('media_id')
            ->title('پستر یا ویدئو')
                ->addClass('column-title'),
            Column::computed('description_id')
            ->title('توضیحات')
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
            Column::make('created_at')
                ->title('تاریخ ویرایش شده')
                    ->addClass('column-title'),

            Column::computed('action') // This Column is not in database
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
        return 'Article_' . date('YmdHis');
    }
}
