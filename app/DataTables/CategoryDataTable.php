<?php

namespace App\DataTables;

use App\Models\Category;
use App\Models\Status;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CategoryDataTable extends DataTable
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
            ->rawColumns(['action'])
            ->addColumn('status', function (Category $category) {
                if($category->statuses->status == Status::ACTIVE) return "موجود";
                else if($category->statuses->status == Status::INACTIVE) return 'ناموجود';
            })
            ->filterColumn('status', function ($query, $keyword) {
                switch($keyword) {
                    case 'موجود': $keyword = 0; 
                        break;
                    case 'ناموجود': $keyword = 1;
                }
                $sql = 'id in (select status_id from status where status like ?)';
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->addColumn('action', function (Category $category){
                return <<<ATAG
                            <a onclick="showConfirmationModal('{$category->id}')">
                                <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                            </a>
                            &nbsp;
                            <a onclick="showEditModal('{$category->id}')">
                                <i class="fa fa-edit text-danger" aria-hidden="true"></i>
                            </a>
                        ATAG;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Category $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Category $model)
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
                ->setTableId('categoryTable')
                ->minifiedAjax(route('category.list.table'))
                ->columns($this->getColumns())
                ->columnDefs([["className" => 'dt-center text-center', "target" => '_all']])
                ->searching(true)
                // ->lengthMenu([10,25,40])
                ->info(false)
                ->ordering(true)
                ->responsive(true)
                ->pageLength(8)
                ->dom('PBCfrtip')
                ->buttons(
                    Button::make('print'),
                    Button::make('copy')
                )
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
            Column::make('name')
            ->title('نام')
                ->addClass('column-title'),
            Column::make('status')
            ->title('وضعیت')
                ->addClass('column-title')
                ->orderable(false),
            Column::computed('action') // This Column is not in database
                ->exportable(false)
                ->searchable(false)
                ->printable(false)
                ->orderable(false)
                ->title('حذف | ویرایش')
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
        return 'Category_' . date('YmdHis');
    }
}
