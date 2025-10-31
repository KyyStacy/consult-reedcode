<?php

namespace Database\Seeders;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get users and psychologists
        $users = User::role('user')->get();
        $psikologs = User::role('psikolog')->get();

        if ($users->isEmpty() || $psikologs->isEmpty()) {
            $this->command->warn('User atau Psikolog tidak ditemukan. Pastikan RoleUserSeeder telah dijalankan terlebih dahulu.');
            return;
        }

        // Transaction statuses
        $statuses = ['Dibayar', 'Belum dibayar', 'Dibatalkan'];

        // Generate transactions
        $transactionCount = 0;
        
        // Create 2-3 transactions per user
        foreach ($users as $user) {
            $numTransactions = rand(2, 3);
            
            for ($i = 0; $i < $numTransactions; $i++) {
                // Random psychologist
                $psikolog = $psikologs->random();
                
                // Get psychologist price from detail_psikolog
                $detailPsikolog = $psikolog->detailPsikolog;
                if (!$detailPsikolog) {
                    continue; // Skip if psychologist doesn't have detail
                }
                
                $harga = $detailPsikolog->harga;
                
                // Random status with weighted probability
                // 40% Dibayar, 35% Belum dibayar, 25% Dibatalkan
                $rand = rand(1, 100);
                if ($rand <= 40) {
                    $status = 'Dibayar';
                } elseif ($rand <= 75) {
                    $status = 'Belum dibayar';
                } else {
                    $status = 'Dibatalkan';
                }
                
                // Generate unique transaction ID (format: TXNYYYYMMDDXXXXXX - max 20 chars)
                do {
                    $date = Carbon::now()->subDays(rand(0, 30))->format('Ymd');
                    $random = strtoupper(Str::random(6));
                    $idTransaksi = "TXN{$date}{$random}";
                } while (Transaction::where('id_transaksi', $idTransaksi)->exists());
                
                // Random snap token (nullable, only for pending/unpaid transactions)
                $snapToken = null;
                if ($status === 'Belum dibayar') {
                    $snapToken = 'snap_' . Str::random(32);
                }
                
                // Create transaction with random date within last 30 days
                $createdAt = Carbon::now()->subDays(rand(0, 30))->subHours(rand(0, 23))->subMinutes(rand(0, 59));
                $updatedAt = $status === 'Dibayar' 
                    ? $createdAt->copy()->addHours(rand(1, 24)) 
                    : $createdAt;
                
                Transaction::firstOrCreate(
                    ['id_transaksi' => $idTransaksi],
                    [
                        'id_pasien' => $user->id,
                        'id_psikolog' => $psikolog->id,
                        'harga' => $harga,
                        'status' => $status,
                        'snap_token' => $snapToken,
                        'created_at' => $createdAt,
                        'updated_at' => $updatedAt,
                    ]
                );
                
                $transactionCount++;
            }
        }
        
        $this->command->info("Created {$transactionCount} transactions.");
    }
}

