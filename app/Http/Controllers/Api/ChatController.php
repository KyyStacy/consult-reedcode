<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function getConversations($userId)
    {
        try {
            // Ambil ID user lain yang pernah berinteraksi
            $otherUserIds = Message::select(
                DB::raw('CASE 
                    WHEN from_user_id = ' . $userId . ' THEN to_user_id 
                    ELSE from_user_id 
                END as other_user_id')
            )
            ->where('from_user_id', $userId)
            ->orWhere('to_user_id', $userId)
            ->groupBy('other_user_id')
            ->get()
            ->pluck('other_user_id');

            $conversations = [];
            $currentUser = User::find($userId);

            foreach ($otherUserIds as $otherUserId) {
                // Ambil data user lain
                $otherUser = User::find($otherUserId);
                if (!$otherUser) continue;

                // Ambil pesan terakhir
                $lastMessage = Message::where(function ($query) use ($userId, $otherUserId) {
                    $query->where(function ($q) use ($userId, $otherUserId) {
                        $q->where('from_user_id', $userId)
                          ->where('to_user_id', $otherUserId);
                    })->orWhere(function ($q) use ($userId, $otherUserId) {
                        $q->where('from_user_id', $otherUserId)
                          ->where('to_user_id', $userId);
                    });
                })
                ->orderBy('created_at', 'desc')
                ->first();

                if ($lastMessage) {
                    // Cek status transaksi
                    $transaction = Transaction::where(function ($query) use ($userId, $otherUserId) {
                        $query->where(function ($q) use ($userId, $otherUserId) {
                            $q->where('id_pasien', $userId)
                              ->where('id_psikolog', $otherUserId);
                        })->orWhere(function ($q) use ($userId, $otherUserId) {
                            $q->where('id_pasien', $otherUserId)
                              ->where('id_psikolog', $userId);
                        });
                    })
                    ->where('status', 'Dibayar')
                    ->orderBy('created_at', 'desc')
                    ->first();

                    // Tentukan role berdasarkan user saat ini
                    $currentUserRole = $currentUser->role;
                    $otherUserRole = $otherUser->role;

                    $conversations[] = [
                        'last_message' => $lastMessage->message,
                        'created_at' => $lastMessage->created_at,
                        'status' => $transaction ? 'Dibayar' : 'Selesai',
                        'patient' => $currentUserRole === 'patient' ? [
                            'id' => $currentUser->id,
                            'name' => $currentUser->name,
                            'email' => $currentUser->email,
                            'photo' => $currentUser->photo,
                            'role' => 'patient'
                        ] : [
                            'id' => $otherUser->id,
                            'name' => $otherUser->name,
                            'email' => $otherUser->email,
                            'photo' => $otherUser->photo,
                            'role' => 'patient'
                        ],
                        'psychologist' => $currentUserRole === 'psychologist' ? [
                            'id' => $currentUser->id,
                            'name' => $currentUser->name,
                            'email' => $currentUser->email,
                            'photo' => $currentUser->photo,
                            'role' => 'psychologist'
                        ] : [
                            'id' => $otherUser->id,
                            'name' => $otherUser->name,
                            'email' => $otherUser->email,
                            'photo' => $otherUser->photo,
                            'role' => 'psychologist'
                        ],
                    ];
                }
            }

            // Urutkan berdasarkan pesan terakhir
            usort($conversations, function($a, $b) {
                return strtotime($b['created_at']) - strtotime($a['created_at']);
            });

            return response()->json([
                'success' => true,
                'conversations' => $conversations
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data percakapan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function checkTransactionStatus($toUserId)
    {
        try {
            $user = Auth::user();
            
            // Cek apakah ada transaksi dengan status "Dibayar"
            $hasActiveTransaction = Transaction::where(function ($query) use ($user, $toUserId) {
                $query->where(function ($q) use ($user, $toUserId) {
                    $q->where('id_pasien', $user->id)
                      ->where('id_psikolog', $toUserId);
                })->orWhere(function ($q) use ($user, $toUserId) {
                    $q->where('id_pasien', $toUserId)
                      ->where('id_psikolog', $user->id);
                });
            })
            ->where('status', 'Dibayar')
            ->exists();

            return response()->json([
                'success' => true,
                'can_send' => $hasActiveTransaction,
                'message' => $hasActiveTransaction ? 'Dapat mengirim pesan' : 'Chat telah diakhiri. Silakan buat transaksi baru untuk melanjutkan konsultasi.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'can_send' => false,
                'message' => 'Gagal memeriksa status transaksi: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getMessages($fromUserId, $toUserId)
    {
        try {
            $messages = Message::where(function ($query) use ($fromUserId, $toUserId) {
                $query->where(function ($q) use ($fromUserId, $toUserId) {
                    $q->where('from_user_id', $fromUserId)
                      ->where('to_user_id', $toUserId);
                })->orWhere(function ($q) use ($fromUserId, $toUserId) {
                    $q->where('from_user_id', $toUserId)
                      ->where('to_user_id', $fromUserId);
                });
            })
            ->orderBy('created_at', 'asc')
            ->get();

            return response()->json([
                'success' => true,
                'messages' => $messages
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil pesan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function sendMessage(Request $request)
    {
        try {
            // Cek status transaksi terlebih dahulu
            $hasActiveTransaction = Transaction::where(function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('id_pasien', $request->from_user_id)
                      ->where('id_psikolog', $request->to_user_id);
                })->orWhere(function ($q) use ($request) {
                    $q->where('id_pasien', $request->to_user_id)
                      ->where('id_psikolog', $request->from_user_id);
                });
            })
            ->where('status', 'Dibayar')
            ->exists();

            if (!$hasActiveTransaction) {
                return response()->json([
                    'success' => false,
                    'message' => 'Chat telah diakhiri. Silakan buat transaksi baru untuk melanjutkan konsultasi.'
                ], 403);
            }

            $message = Message::create([
                'from_user_id' => $request->from_user_id,
                'to_user_id' => $request->to_user_id,
                'message' => $request->message
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Pesan berhasil dikirim',
                'message_data' => $message
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengirim pesan: ' . $e->getMessage()
            ], 500);
        }
    }
} 