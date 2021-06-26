<?php

namespace App\DataTables;

use App\Models\Subcategory;
use App\Models\Status;
use App\Datatables\GeneralDataTable;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use DataTables;

class SubcategoryDataTable extends DataTable
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
            ->rawColumns(['action'])
            ->addColumn('status', function (Subcategory $subcategory) {
                return $this->dataTable->setStatusCol($subcategory->statuses->status);
            })
            ->filterColumn('status', function ($query, $keyword) {
                return $this->dataTable->filterStatusCol($query, $keyword);
            })
            ->editColumn('category_id', function (Subcategory $subcategory) {
                return $subcategory->category->name;
            })
            ->filterColumn('category_id', function($query, $keyword) {
                return $this->dataTable->filterCategoryCol($query, $keyword);
            })
            ->addColumn('action', function (Subcategory $subcategory) {
                return $this->dataTable->setAction($subcategory->id); 
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Subcategory $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Subcategory $model)
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
                $this->getColumns(), 'subcategory');
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
            Column::make('name')
            ->title('نام'),
            Column::make('status')
            ->title('وضعیت')
                ->orderable(false),
            Column::make('category_id')
            ->title('دسته بندی اول'),
            $this->dataTable->setActionCol('| ویرایش')
        ];
    }
}
