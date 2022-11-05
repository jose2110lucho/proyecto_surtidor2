<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Vehiculo;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;


class DatatableVehiculos extends DataTableComponent
{
    protected $model = Vehiculo::class;


    public function configure(): void
    {
        $this->setPrimaryKey('id')->setFilterLayoutSlideDown();
        $this->setSearchDebounce(700);

        $this->setTableAttributes([
            'class' => 'table-hover table-head-fixed',
        ]);
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Active')
                ->options([
                    '' => 'All',
                    'yes' => 'Yes',
                    'no' => 'No',
                ]),
        ];
    }

    public function columns(): array
    {
        return [
            Column::make("Placa", "placa")
                ->sortable()
                ->searchable(),
            Column::make("Tipo", "tipo")
                ->sortable(),
            Column::make("Marca", "marca")
                ->sortable(),
            Column::make("B-Sisa", "b_sisa"),
        ];
    }
}
