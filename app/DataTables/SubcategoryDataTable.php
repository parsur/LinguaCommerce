<?php

namespace App\DataTables;

use App\Models\Subcategory;
use App\Models\Status;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Datatables\GeneralDataTable;
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
            ->rawColumns(['action','status'])
            ->addColumn('status', function (Subcategory $subcategory) {
                if($subcategory->statuses->status == Status::ACTIVE) return "موجود";
                else if($subcategory->statuses->status == Status::INACTIVE) return 'ناموجود';
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
            ->editColumn('category_id', function (Subcategory $subcategory) {
                return $subcategory->category->name;
            })
            ->filterColumn('category_id', function($query, $keyword) {
                $sql = 'category_id in (select id from categories where name like ?)';
                $query->whereRaw($sql, ["%{$keyword}%"]);
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
        return $dataTable->tableSetting($this->builder(), 
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
            Column::make('DT_RowIndex')
            ->title('#')
                ->searchable(false)
                ->orderable(false),
            Column::make('name')
            ->title('نام'),
            Column::make('status')
            ->title('وضعیت')
                ->orderable(false),
            Column::make('category_id')
            ->title('دسته بندی اول'),
            Column::computed('action') // This column is not in database
            ->title('حذف | ویرایش')
                ->exportable(false)
                ->searchable(false)
                ->printable(false)
                ->orderable(false)
        ];
    }
}
