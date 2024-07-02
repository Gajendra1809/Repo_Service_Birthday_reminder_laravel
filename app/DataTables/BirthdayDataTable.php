<?php

namespace App\DataTables;

use App\Models\Birthday;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Services\BirthdayService;

class BirthdayDataTable extends DataTable
{
    public $birthdayService;

    public function __consatruct(BirthdayService $birthdayService){

        $this->birthdayService = $birthdayService;

    }
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($raw){
                return '<a href="' . route('date.delete', $raw->id) . '" onclick="return confirm(\'Are you sure you want to delete this birthdate?\');" class="btn btn-danger">Delete</a>';
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(): QueryBuilder
    {
        return $this->birthdayService->query()->where('user_id',auth()->user()->id);
        // return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('birthday-table')
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
            Column::make('name'),
            Column::make('birthdate'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Birthday_' . date('YmdHis');
    }
}
