<?php

namespace App\Livewire;

use App\Models\Message;
use App\Models\Transaction;
use App\Models\User;
use Livewire\Component;

class Chat extends Component
{
    public $user;
    public $from_user_id;
    public $message = '';
    public $conversations;
    public $canSendMessage = true;
    public $polling = true;
    public $chatEnded = false;
    public $showPreview = true;

    public function mount($from_user_id = null, $user = null)
    {
        if ($user) {
            $this->from_user_id = $from_user_id;
            $this->user = User::findOrFail($user);
            $this->showPreview = false;

            if ($this->from_user_id != auth()->id() && $this->user->id != auth()->id()) {
                return back()->with('unauthacc', 'You are not authorized to access this page.');
            }

            $this->checkTransaction();
            $this->createAutomaticMessageIfNeeded();
        }

        $this->loadConversations();
    }

    public function loadConversations()
    {
        $users = User::all();
        $conversations = [];

        foreach ($users as $user) {
            $lastMessage = Message::where(function($query) use ($user) {
                                $query->where('from_user_id', auth()->id())
                                      ->where('to_user_id', $user->id);
                            })
                            ->orWhere(function($query) use ($user) {
                                $query->where('from_user_id', $user->id)
                                      ->where('to_user_id', auth()->id());
                            })
                            ->latest()
                            ->first();

            if ($lastMessage) {
                $conversations[] = [
                    'user' => $user,
                    'lastMessage' => $lastMessage
                ];
            }
        }

        $this->conversations = $conversations;
        $this->sortConversations();
    }

    public function render()
    {
        if ($this->showPreview) {
            return view('livewire.preview-chat');
        } else {
            $messages = Message::where(function ($query) {
                    $query->where('from_user_id', auth()->id())
                        ->where('to_user_id', $this->user->id);
                })
                ->orWhere(function ($query) {
                    $query->where('from_user_id', $this->user->id)
                        ->where('to_user_id', auth()->id());
                })
                ->get();

            return view('livewire.chat', ['messages' => $messages]);
        }
    }

    public function pollConversations()
    {
        $this->loadConversations();
    }

    public function endChat()
    {
        if (auth()->user()->hasRole('psikolog')) {
            $transaction = Transaction::where(function ($query) {
                    $query->where('id_pasien', $this->user->id)
                        ->where('id_psikolog', auth()->id());
                })
                ->where('status', 'Dibayar')
                ->first();

            if ($transaction) {
                $transaction->status = 'Selesai';
                $transaction->save();
                $this->chatEnded = true;

                $message = new Message();
                $message->from_user_id = $transaction->id_psikolog;
                $message->to_user_id = $transaction->id_pasien;
                $message->message = 'Terima kasih telah menggunakan layanan konsultasi kami! Jangan ragu untuk menghubungi kami lagi di lain waktu. Sampai jumpa!';
                $message->save();
            }

            return redirect()->route('preview-chat');
        }

        abort(403, 'Unauthorized action.');
    }

    public function pollChatStatus()
    {
        $this->checkTransaction();
    }

    public function sendMessage()
    {
        if (!$this->canSendMessage) {
            return;
        }

        Message::create([
            'from_user_id' => auth()->id(),
            'to_user_id' => $this->user->id,
            'message' => $this->message,
        ]);
        $this->reset('message');
    }

    private function checkTransaction()
    {
        $transaction = Transaction::where(function ($query) {
                $query->where('id_pasien', auth()->id())
                    ->orWhere('id_psikolog', auth()->id());
            })
            ->where(function ($query) {
                $query->where('id_pasien', $this->user->id)
                    ->orWhere('id_psikolog', $this->user->id);
            })
            ->where('status', 'Dibayar')
            ->first();

        $this->canSendMessage = $transaction ? true : false;
        $this->chatEnded = $transaction ? false : true;
    }

    private function createAutomaticMessageIfNeeded()
    {
        $transaction = Transaction::where(function ($query) {
                $query->where('id_pasien', auth()->id())
                    ->where('id_psikolog', $this->user->id);
            })
            ->where('status', 'Dibayar')
            ->first();

        if ($transaction) {
            $existingMessage = Message::where('from_user_id', $this->user->id)
                                      ->where('to_user_id', auth()->id())
                                      ->first();

            if (!$existingMessage) {
                Message::create([
                    'from_user_id' => $this->user->id,
                    'to_user_id' => auth()->id(),
                    'message' => 'Halo, Saya ' . $this->user->name . '. Saya akan segera membantu Anda.',
                ]);
            }
        }
    }

    private function sortConversations()
    {
        $this->conversations = collect($this->conversations)->sortByDesc(function ($conversation) {
            return $conversation['lastMessage']->created_at;
        })->values()->all();
    }
}