<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;

class PsychologistController extends Controller
{
    /**
     * Display a listing of the psychologists.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $psychologistUsers = User::with(['roles', 'detailPsikolog'])
                                ->whereHas('roles', function($query) {
                                    $query->where('name', 'psikolog');
                                })
                                ->whereHas('detailPsikolog', function($query) {
                                    $query->where('harga', '>', 0);
                                })
                                ->get();

        $sortedPsychologists = $psychologistUsers->map(function ($user) {
            $lastSeen = $user->last_seen ? Carbon::parse($user->last_seen) : null;
            $user->is_online = $lastSeen && $lastSeen->diffInMinutes(now()) < 2;
            return $user;
        })->sort(function ($a, $b) {
            if ($a->is_online == $b->is_online) {
                return strcmp($a->name, $b->name);
            }

            return $a->is_online ? -1 : 1;
        });

        return $sortedPsychologists;
    }

}