<?php

namespace App\DataTables;

use App\Models\Coupon;
use App\Models\Status;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Datatables\GeneralDataTable;

class CouponDataTable extends DataTable
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
            ->addColumn('status', function(Coupon $coupon) { 
                return $this->dataTable->setStatusCol($coupon->statuses->status);
            })  
            ->filterColumn('status', function ($query, $keyword) {
                return $this->dataTable->filterStatusCol($query, $keyword);
            })
            ->addColumn('type', function(Coupon $coupon) { 
                $type = $coupon->statuses->status;

                if($type == Coupon::PRICE) return 'هزینه';
                else if($type == Coupon::PERCENTAGE) return 'درصد';
            })  
            ->filterColumn('type', function ($query, $keyword) {

                switch($keyword) {
                    case 'هزینه': $keyword = 0; 
                    break;
                    case 'درصد': $keyword = 1;
                }

                return $this->dataTable->filterColumn($query, 
                    'id in (select status_id from status where status like ?)', $keyword);
            })
            ->addColumn('action', function (Coupon $coupon){
                return $this->dataTable->setAction($coupon->id);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Coupon $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Coupon $model)
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
                $this->getColumns(), 'coupon');
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
            Column::make('code')
            ->title('کد تخفیف'),
            Column::make('value')
            ->title('قیمت'),
            Column::make('type')
            ->title('نوع'),
            Column::make('status')
            ->title('وضعیت'),
            Column::make('course_id')    
            ->title('دوره مرتبط')
                ->orderable(false),
            $this->dataTable->setActionCol('| جزئیات')
        ];
    }
}
