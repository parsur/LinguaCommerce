<?php

namespace App\DataTables;

use App\Models\Consultation;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use \Illuminate\Support\Str;
use URL;

class ConsultationDataTable extends DataTable
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
            ->addColumn('user_name', function(Consultation $consultation) {
                return optional($consultation->user)->name;
            })
            ->filterColumn('user_name', function($query, $keyword) {
                $sql = 'user_id in (select id from users where name like ?)';
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->addColumn('description', function(Consultation $consultation) {
                return Str::limit(optional($consultation->description)->description, 30, '(جزئیات)');
            })
            ->filterColumn('description', function($query, $keyword) {
                $sql = 'id in (select description_id from descriptions where description like ?)';
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->addColumn('action',function(Consultation $consultation) {
                $details = '';

                if($consultation->descriptions)
                    $details = URL::signedRoute('consultation.details', ['id' => $consultation->id]);

                return '<a onclick="showConfirmationModal('.$consultation->id.')">
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
     * @param \App\Models\Consultation $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Consultation $model)
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
            ->setTableId('consultationTable')
            ->columns($this->getColumns())
            ->minifiedAjax(route('consultation.list.table'))
            ->columnDefs(
                [
                    ["className" => 'dt-center text-center', "target" => '_all'],
                ]
            )
            ->searching(true)
            ->info(false)
            ->responsive(true)
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
            Column::make('user_name')
            ->title('نام کاربر')
                ->addClass("column-title")
                ->orderable(false),
            Column::make('phone_number')
            ->title('شماره تلفن')
                ->addClass("column-title"),
            Column::make('description')
            ->title('توضیحات')
                ->addClass("column-title")
                ->orderable(false),
            Column::computed('action') // This Column is not in database
                ->exportable(false)
                ->searchable(false)
                ->printable(false)
                ->orderable(false)
                ->title('حذف | جزئیات')
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
        return 'Consultation_' . date('YmdHis');
    }
}
