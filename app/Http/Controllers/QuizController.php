<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function submit(Request $request)
    {
        $skor = $request->q1 + $request->q2 + $request->q3 + $request->q4 + $request->q5
                + $request->q6 + $request->q7 + $request->q8 + $request->q9 + $request->q10;

        $hasil = '';

        if ($skor >= 0 && $skor <= 5) {
            $hasil = 'Anda memiliki kesehatan mental yang baik. Tetap jaga kesehatan mental Anda dengan melakukan aktivitas yang menyenangkan dan bermanfaat.';
        } elseif ($skor >= 6 && $skor <= 10) {
            $hasil = 'Anda mungkin mengalami gejala gangguan mental ringan. Disarankan untuk lebih memperhatikan kesehatan mental Anda dan melakukan aktivitas yang dapat mengurangi stres.';
        } elseif ($skor >= 11 && $skor <= 20) {
            $hasil = 'Anda mungkin mengalami gejala gangguan mental sedang. Disarankan untuk berkonsultasi dengan psikolog atau profesional kesehatan mental untuk mendapatkan dukungan dan penanganan yang tepat.';
        } elseif ($skor >= 21) {
            $hasil = 'Anda kemungkinan mengalami gejala gangguan mental yang signifikan. Sangat disarankan untuk segera mencari bantuan profesional dari psikolog atau profesional kesehatan mental untuk mendapatkan penanganan yang tepat.';
        }

        return view('home.hasil-kuis', compact('hasil'));
    }
}
