<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use App\Models\Transaction;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\Concerns\InteractsWithPageFilters;

class StatsOverview extends BaseWidget
{

    use InteractsWithPageFilters;

    protected function getStats(): array
    {

        $startDate = ! is_null($this->filters['startDate'] ?? null) ?
            Carbon::parse($this->filters['startDate']) :
            null;

        $endDate = ! is_null($this->filters['endDate'] ?? null) ?
            Carbon::parse($this->filters['endDate']) :
            null;

        $pemasukan = Transaction::income()->get()->whereBetween('transaction_date', [$startDate, $endDate])->sum('amount');
        $pengeluaran = Transaction::expenses()->get()->whereBetween('transaction_date', [$startDate, $endDate])->sum('amount');


        return [
            Stat::make('Total Pengeluaran', 'Rp '.$pengeluaran),
            Stat::make('Total Pemasukan', 'Rp '.$pemasukan),
            Stat::make('Selisih', 'Rp '.$pemasukan - $pengeluaran),
        ];
    }
}
