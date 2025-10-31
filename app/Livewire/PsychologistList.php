<?php

namespace App\Livewire;

use App\Http\Controllers\PsychologistController;
use App\Models\Transaction;
use Livewire\Component;

class PsychologistList extends Component
{
    public $transactions;

    public function mount()
    {
        $this->checkAndCancelExpiredTransactions();
        $this->loadTransactions();
    }

    public function render()
    {
        $psychologistController = new PsychologistController();
        $psychologistUsers = $psychologistController->index();

        return view('livewire.psychologist-list', [
            'psychologistUsers' => $psychologistUsers,
        ])->layout('layouts.guest');
    }

    public function loadTransactions()
    {
        if (auth()->check()) {
            $this->transactions = Transaction::where('id_pasien', auth()->id())
                ->whereIn('status', ['Belum dibayar', 'Dibayar'])
                ->get()
                ->keyBy('id_psikolog');
        }
    }

    public function checkAndCancelExpiredTransactions()
    {
        $expiredTransactions = Transaction::where('id_pasien', auth()->id())
            ->where('status', 'Belum dibayar')
            ->where('created_at', '<', now()->subMinutes(15))
            ->get();

        foreach ($expiredTransactions as $transaction) {
            $transaction->status = 'Dibatalkan';
            $transaction->save();
        }
    }
}
