<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $pemasukan = Transaction::income()->sum('amount');
        $pengeluaran = Transaction::expenses()->sum('amount');


        return [
            Stat::make('Total Pengeluaran', $pengeluaran),
            Stat::make('Total Pemasukan', $pemasukan),
            Stat::make('Selisih', $pemasukan - $pengeluaran),
        ];
    }
}
