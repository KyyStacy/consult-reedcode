<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminPsychologistApplicationMail;
use App\Mail\ApplicantConfirmationMail;
use Illuminate\Support\Facades\Log;

class PsychologistApplicationController extends Controller
{
    public function submit(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'cv' => 'required|file|mimes:pdf|max:5120',
                'cover_letter' => 'required|string',
            ]);

            $messages = [
                'cv.max' => 'Ukuran file CV tidak boleh lebih dari 5MB.',
                'cv.mimes' => 'File CV harus dalam format PDF.',
            ];

            $details = [
                'name' => $request->name,
                'email' => $request->email,
                'cover_letter' => $request->cover_letter,
                'cv' => $request->file('cv'),
            ];

            Log::info('Mencoba mengirim email ke admin');
            Mail::to('mind.mender24@gmail.com')
                ->send(new AdminPsychologistApplicationMail($details));

            Log::info('Email admin terkirim, mencoba mengirim ke pelamar');
            Mail::to($request->email)
                ->send(new ApplicantConfirmationMail($details));

            Log::info('Kedua email berhasil terkirim');

            return redirect()->back()->with('success', 'Lamaran Anda telah berhasil dikirim. Silakan periksa email Anda untuk konfirmasi.');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error: ' . json_encode($e->errors()));
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Exception $e) {
            Log::error('Error saat mengirim email: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat mengirim lamaran. Silakan coba lagi.')
                ->withInput();
        }
    }
} 