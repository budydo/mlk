<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Tampilkan formulir kontak.
     */
    public function index()
    {
        return view('contact');
    }

    /**
     * Proses pengiriman pesan kontak: simpan ke DB dan kirim email ke perusahaan.
     */
    public function send(Request $request)
    {
        // Validasi input
        $data = $request->validate([
            'name' => 'required|string|max:191',
            'email' => 'nullable|email|max:191',
            'phone' => 'nullable|string|max:50',
            'message' => 'required|string|max:5000',
        ]);

        // Simpan ke database
        $msg = ContactMessage::create([
            'name' => $data['name'],
            'email' => $data['email'] ?? null,
            'phone' => $data['phone'] ?? null,
            'message' => $data['message'],
            'source' => 'contact-page',
        ]);

        // Kirim email notifikasi ke alamat perusahaan (sesuaikan env MAIL_TO)
        try {
            $to = config('mail.contact_address', env('MAIL_CONTACT_ADDRESS', 'info@example.com'));
            Mail::raw("Pesan kontak baru dari {$msg->name}:\n\n{$msg->message}\n\nEmail: {$msg->email}\nTelepon: {$msg->phone}", function ($m) use ($to) {
                $m->to($to)->subject('Pesan Kontak Baru');
            });
        } catch (\Throwable $e) {
            // Jangan gagalkan permintaan; hanya log bila perlu.
            report($e);
        }

        return back()->with('success', 'Pesan Anda telah terkirim. Terima kasih.');
    }
}
