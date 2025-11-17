<?php

namespace App\Http\Controllers\Editor;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use App\Services\MessageReplyService;

/**
 * ContactMessageController untuk Editor.
 * Mengelola pesan kontak (view, delete) — tidak dapat create/edit.
 */
class ContactMessageController extends Controller
{
    /**
     * Daftar pesan untuk editor
     */
    public function index()
    {
        $messages = ContactMessage::orderBy('created_at', 'desc')->paginate(15);
        return view('editor.contact-messages.index', compact('messages'));
    }

    /**
     * Tampilkan detail pesan dan riwayat balasan
     */
    public function show(ContactMessage $contactMessage)
    {
        // Eager load replies agar riwayat balasan tersedia di view
        $contactMessage->load('replies');
        return view('editor.contact-messages.show', compact('contactMessage'));
    }

    /**
     * Hapus pesan
     */
    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();

        return redirect()->route('editor.contact-messages.index')
            ->with('success', 'Contact message berhasil dihapus.');
    }

    /**
     * Mengirim balasan (editor) — mengandalkan MessageReplyService.
     */
    public function reply(Request $request, ContactMessage $contactMessage, MessageReplyService $replyService)
    {
        // Validasi input balasan
        $request->validate([
            'reply' => 'required|string|min:3',
        ]);

        $replyText = $request->input('reply');

        // Panggil service untuk mengirim balasan (email + whatsapp)
        $replyRecord = $replyService->sendReply($contactMessage, $replyText, auth()->user());

        // Tandai pesan sebagai sudah ditangani
        $contactMessage->is_handled = true;
        $contactMessage->save();

        return redirect()->route('editor.contact-messages.show', $contactMessage)
            ->with('success', 'Balasan terkirim. Status WhatsApp: ' . $replyRecord->whatsapp_status);
    }
}
