<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use App\Services\MessageReplyService;

/**
 * Controller admin untuk mengelola pesan masuk.
 * Menyediakan: index (daftar), show (lihat), reply (kirim balasan), destroy (hapus).
 */
class ContactMessageController extends Controller
{
    protected MessageReplyService $replyService;

    public function __construct(MessageReplyService $replyService)
    {
        // Middleware di-route group (role:admin) sudah mengamankan akses
        $this->replyService = $replyService;
    }

    /**
     * Daftar pesan masuk (terbaru dulu).
     * 
     * Menampilkan:
     * - Nama pengirim
     * - Email pengirim
     * - Nomor telepon pengirim (untuk WhatsApp)
     * - Subject pesan
     * - Kapan pesan diterima
     * - Status (ditangani atau belum)
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ambil pesan kontak terbaru dulu, paginate 20 per halaman
        $messages = ContactMessage::orderBy('created_at', 'desc')->paginate(20);

        return view('admin.contact-messages.index', compact('messages'));
    }

    /**
     * Tampilkan detail pesan dan form untuk balas.
     * 
     * Menampilkan:
     * - Detail pesan lengkap (nama, email, phone, pesan, dll)
     * - Riwayat balasan yang sudah dikirim (jika ada)
     * - Form untuk mengirim balasan baru
     *
     * @param ContactMessage $contactMessage
     * @return \Illuminate\View\View
     */
    public function show(ContactMessage $contactMessage)
    {
        // Eager load replies agar tidak ada N+1 query
        $contactMessage->load('replies');

        return view('admin.contact-messages.show', compact('contactMessage'));
    }

    /**
     * Proses balasan: kirim email + WhatsApp ke nomor pengirim pesan.
     * 
     * Alur:
     * 1. Validasi input (reply text harus ada)
     * 2. Panggil MessageReplyService untuk kirim email + WhatsApp
     * 3. Catat bahwa pesan sudah ditangani (is_handled = true)
     * 4. Redirect kembali dengan pesan sukses
     *
     * @param Request $request
     * @param ContactMessage $contactMessage
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reply(Request $request, ContactMessage $contactMessage)
    {
        // Validasi: reply text harus ada dan minimal 3 karakter
        $request->validate([
            'reply' => 'required|string|min:3',
        ]);

        // Ambil teks balasan dari request
        $replyText = $request->input('reply');

        // Panggil service untuk mengirim email + WhatsApp ke pengirim pesan
        // Kirim user ID agar bisa tracking siapa yang mengirim balasan
        $result = $this->replyService->sendReply(
            $contactMessage,
            $replyText,
            auth()->user()  // User admin yang sedang login
        );

        // Update status pesan kontak menjadi "sudah ditangani"
        $contactMessage->is_handled = true;
        $contactMessage->save();

        // Redirect ke halaman detail pesan dengan notifikasi sukses
        return redirect()->route('admin.contact-messages.show', $contactMessage)
                         ->with('success', sprintf(
                             'Balasan terkirim! Email: %s, WhatsApp: %s',
                             $result->email_status,
                             $result->whatsapp_status
                         ));
    }

    /**
     * Hapus pesan kontak dan semua balasan terkaitnya.
     * 
     * Catatan: Karena foreign key dengan cascade delete,
     * menghapus pesan kontak akan otomatis menghapus semua replies.
     *
     * @param ContactMessage $contactMessage
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(ContactMessage $contactMessage)
    {
        // Hapus pesan beserta semua replies-nya (cascade)
        $contactMessage->delete();

        // Redirect ke daftar pesan dengan notifikasi sukses
        return redirect()->route('admin.contact-messages.index')
                         ->with('success', 'Pesan beserta balasan telah dihapus.');
    }
}
