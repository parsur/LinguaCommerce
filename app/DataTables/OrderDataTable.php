<?php

namespace App\DataTables;

use App\Models\Order;
use App\Models\Status;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\URL;
use App\Datatables\GeneralDataTable;
use DataTables;


class OrderDataTable extends DataTable
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
            ->addColumn('user_name', function (Order $order) {
                return $order->user->name;
            })
            ->editColumn('total_price', function (Order $order) {
                if($order->total_price == 0) return 'رایگان';
                else return $order->total_price . ' تومان';
            })
            ->filterColumn('user_name', function($query, $keyword) {
                return $this->dataTable->filterUserCol($query, $keyword);
            })
            ->addColumn('phone_number', function (Order $order) {
                return $order->user->phone_number;
            })
            ->filterColumn('phone_number', function($query, $keyword) {
                $sql = 'user_id in (select id from users where phone_number like ?)';
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->addColumn('status', function (Order $order) {
                if ($order->statuses->status == Status::PAID) return 'پرداخت شده';
                else if ($order->statuses->status == Status::NOT_PAID) return 'پرداخت نشده';
            })
            ->addColumn('action',function(Order $order) {
                $details = URL::signedRoute('order.details', ['factor' => $order->factor, 'admin' => 'role']);

                return $this->dataTable->deleteDetailsAction($order->id, $details);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Order $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Order $model)
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
                $this->getColumns(), 'order');         
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
            Column::make('user_name')
            ->title('نام کاربر')    
                ->orderable(false),
            Column::make('phone_number')
            ->title('تلفن همراه')
                ->orderable(false),
            Column::make('factor')    
            ->title('فاکتور خرید'),
            Column::make('total_price')    
            ->title('هزینه کل'),
            Column::make('status')    
            ->title('وضعیت تراکنش')
                ->orderable(false),
            $this->dataTable->actionColumn('| ویرایش | جزئیات')
        ];
    }
}
