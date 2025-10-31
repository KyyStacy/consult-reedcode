<?php

namespace Database\Seeders;

use App\Models\DetailPsikolog;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DetailPsikologSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $psikologRole = Role::where('name', 'psikolog')->first();
        
        if (!$psikologRole) {
            $this->command->warn('Role psikolog tidak ditemukan. Pastikan RoleUserSeeder telah dijalankan terlebih dahulu.');
            return;
        }

        // Get all users with psikolog role
        $psikologs = User::role('psikolog')->get();

        if ($psikologs->isEmpty()) {
            $this->command->warn('Tidak ada psikolog yang ditemukan. Pastikan RoleUserSeeder telah dijalankan terlebih dahulu.');
            return;
        }

        // Sample bios for psychologists
        $bios = [
            'Psikolog berpengalaman dengan spesialisasi dalam terapi kognitif dan manajemen stres. Memiliki pengalaman lebih dari 10 tahun membantu individu mengatasi berbagai masalah mental.',
            'Ahli dalam bidang psikologi klinis dengan fokus pada depresi, kecemasan, dan gangguan mood. Berkomitmen memberikan dukungan terbaik untuk kesehatan mental Anda.',
            'Spesialis dalam konseling remaja dan dewasa muda. Menggunakan pendekatan humanistik dan terapi berbasis kekuatan untuk membantu klien mencapai potensi penuh mereka.',
        ];

        // Sample prices (in thousands)
        $prices = [150000, 200000, 175000];

        foreach ($psikologs as $index => $psikolog) {
            DetailPsikolog::firstOrCreate(
                ['id_psikolog' => $psikolog->id],
                [
                    'bio' => $bios[$index % count($bios)] ?? $bios[0],
                    'harga' => $prices[$index % count($prices)] ?? 150000,
                ]
            );
        }
    }
}

