<?php

namespace App\DataTables;

use App\Models\MedicalVisit;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MedicalVisitDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'medicalvisit.action')
            ->setRowId('id')
            ->editColumn('is_approved', function ($visit) {
                return $visit->is_approved ? 'Approved' : 'Pending';
            })
            ->editColumn('visit_date', function ($visit) {
                return \Carbon\Carbon::parse($visit->visit_date)->format('d-m-Y');
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(MedicalVisit $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('medicalvisit-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('id'),
            Column::make('patient.pat_unique_id')->title('Patient Unique ID'),
            Column::make('patient.full_name')->title('Patient Name'),
            Column::make('visit_date')->title('Visit Date'),
            Column::make('doctor.name')->title('Doctor'),
            Column::make('nurse.name')->title('Nurse'),
            Column::make('is_approved')->title('Appointment Status'),
            Column::make('medical_status')->title('Medical Status'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'MedicalVisit_' . date('YmdHis');
    }
}
