<?php

namespace App\DataTables;

use App\Models\Order;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\URL;
use DataTables;


class OrderDataTable extends DataTable
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
            ->addColumn('user_name', function (Order $order) {
                return $order->user->name;
            })
            ->editColumn('total_price', function (Order $order) {
                if($order->total_price == 0) 
                    return 'رایگان';
            })
            ->filterColumn('user_name', function($query, $keyword) {
                $sql = 'user_id in (select id from users where name like ?)';
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->addColumn('phone_number', function (Order $order) {
                return $order->user->phone_number;
            })
            ->filterColumn('phone_number', function($query, $keyword) {
                $sql = 'user_id in (select id from users where phone_number like ?)';
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->addColumn('action',function(Order $order) {
                $details = URL::signedRoute('order.details', ['factor' => $order->factor, 'role' => 'admin']);

                return '<a onclick="showConfirmationModal('.$order->id.')">
                            <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                        </a>
                        &nbsp;
                        <a href="'.$details.'">
                            <i class="fa fa-info-circle text-danger" aria-hidden="true"></i>
                        </a>';
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
        return $this->builder()
            ->setTableId('orderTable')
            ->columns($this->getColumns())
            ->minifiedAjax(route('order.list.table'))
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
            Column::make('user_name')
            ->title('نام کاربر')
                ->addCLass("column-title")
                ->orderable(false),
            Column::make('phone_number')
            ->title('تلفن همراه')
                ->addCLass("column-title")
                ->orderable(false),
            Column::make('factor')    
            ->title('فاکتور خرید')
                ->addClass("column-title"),
            Column::make('total_price')    
            ->title('هزینه کل')
                ->addCLass("column-title"),
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
        return 'Order_' . date('YmdHis');
    }
}
