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
     * Daftar pesan masuk (baru ke lama).
     */
    public function index()
    {
        $messages = ContactMessage::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.contact-messages.index', compact('messages'));
    }

    /**
     * Tampilkan detail pesan dan form balas.
     */
    public function show(ContactMessage $contactMessage)
    {
        return view('admin.contact-messages.show', compact('contactMessage'));
    }

    /**
     * Proses balasan: kirim email + whatsapp, catat hasil, dan simpan catatan reply pada DB jika perlu.
     */
    public function reply(Request $request, ContactMessage $contactMessage)
    {
        $request->validate([
            'reply' => 'required|string',
        ]);

        $replyText = $request->input('reply');

        // Panggil service untuk mengirim
        $result = $this->replyService->sendReply($contactMessage, $replyText);

        // Simpan flag bahwa pesan sudah dibalas
        $contactMessage->is_handled = true;
        $contactMessage->save();

        return redirect()->route('admin.contact-messages.show', $contactMessage)
                         ->with('success', 'Balasan terkirim. Status: ' . json_encode($result));
    }

    /**
     * Hapus pesan.
     */
    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();
        return redirect()->route('admin.contact-messages.index')->with('success','Pesan berhasil dihapus.');
    }
}
