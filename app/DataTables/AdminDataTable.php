<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Datatables\GeneralDataTable;
use Carbon\Carbon;


class AdminDataTable extends DataTable
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
            ->editColumn('created_at', function(User $user){
                return $this->dataTable->showJalaliTime($user->created_at); 
            })
            ->editColumn('updated_at', function(User $user){
                return $this->dataTable->showJalaliTime($user->updated_at);

            })->addColumn('action', function (User $user){
                return $this->dataTable->setAction($user->id);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->where('role', $model::ADMIN);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->dataTable->tableSetting($this->builder(), 
                $this->getColumns(), 'admin');
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
            Column::make('email')
            ->title('ایمیل'),
            Column::make('created_at')
            ->title('ساخته شده در'),
            Column::make('updated_at')
            ->title('بروز شده در'),
            $this->dataTable->setActionCol('| ویرایش')
        ];
    }
}
