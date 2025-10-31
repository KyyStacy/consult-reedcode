<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-cyan-50 via-white to-blue-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex items-center space-x-4 mb-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-history text-white text-xl"></i>
                    </div>
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900">Riwayat Konsultasi</h2>
                        <p class="text-gray-600 mt-1">Daftar lengkap konsultasi Anda</p>
                    </div>
                </div>
            </div>

            <!-- Table Card -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                <!-- Table Header -->
                <div class="bg-gradient-to-r from-cyan-600 via-blue-600 to-cyan-700 px-6 py-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white/20 backdrop-blur-lg rounded-lg flex items-center justify-center">
                            <i class="fas fa-list text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-white">Daftar Transaksi</h3>
                            <p class="text-cyan-100 text-sm">Total: {{ $transactions->total() }} transaksi</p>
                        </div>
                    </div>
                </div>

                <!-- Table Content -->
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    <i class="fas fa-hashtag mr-2 text-cyan-600"></i>ID Transaksi
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    <i class="fas fa-user mr-2 text-cyan-600"></i>{{ Auth::user()->hasRole('user') ? 'Nama Psikolog' : 'Nama Pasien' }}
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    <i class="fas fa-calendar mr-2 text-cyan-600"></i>Pesanan Dibuat
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    <i class="fas fa-money-bill-wave mr-2 text-cyan-600"></i>Harga
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    <i class="fas fa-info-circle mr-2 text-cyan-600"></i>Status
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($transactions as $transaction)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-cyan-100 text-cyan-800">
                                            #{{ $transaction->id_transaksi }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 bg-gradient-to-br from-cyan-400 to-blue-500 rounded-lg flex items-center justify-center">
                                                <span class="text-white font-semibold text-sm">
                                                    {{ substr(Auth::user()->hasRole('user') ? $transaction->psikolog->name : $transaction->pasien->name, 0, 1) }}
                                                </span>
                                            </div>
                                            <span class="text-gray-900 font-medium">
                                                {{ Auth::user()->hasRole('user') ? $transaction->psikolog->name : $transaction->pasien->name }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{ $transaction->created_at ? $transaction->created_at->format('d M Y') : '-' }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            {{ $transaction->created_at ? $transaction->created_at->format('H:i') : '' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-base font-bold text-gray-900">
                                            Rp. {{ number_format($transaction->harga, 0, ',', '.') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($transaction->status === 'Dibayar')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                                <i class="fas fa-check-circle mr-1"></i>
                                                {{ $transaction->status }}
                                            </span>
                                        @elseif($transaction->status === 'Belum dibayar')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
                                                <i class="fas fa-clock mr-1"></i>
                                                {{ $transaction->status }}
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                                <i class="fas fa-times-circle mr-1"></i>
                                                {{ $transaction->status }}
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                                <i class="fas fa-inbox text-gray-400 text-2xl"></i>
                                            </div>
                                            <h3 class="text-lg font-semibold text-gray-700 mb-2">Belum Ada Riwayat</h3>
                                            <p class="text-gray-500 text-sm">Anda belum memiliki riwayat konsultasi.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($transactions->hasPages())
                    <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-700">
                                Menampilkan {{ $transactions->firstItem() ?? 0 }} sampai {{ $transactions->lastItem() ?? 0 }} dari {{ $transactions->total() }} transaksi
                            </div>
                            <div>
                                {{ $transactions->links('vendor.pagination.tailwind') }}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>