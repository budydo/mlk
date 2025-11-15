<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class ConsultRequest extends Component
{
    // Properti yang terikat ke form
    public $name = '';
    public $contact = '';
    public $service = '';
    public $message = '';
    public $notify_way = 'whatsapp';

    // state untuk UI
    public $sending = false;
    public $sent = false;

    // aturan validasi
    protected $rules = [
        'name' => 'required|string|min:3|max:191',
        'contact' => 'required|string|min:3|max:191',
        'service' => 'nullable|string|max:191',
        'message' => 'nullable|string|max:2000',
        'notify_way' => 'required|in:whatsapp,email',
    ];

    // custom messages
    protected $messages = [
        'name.required' => 'Nama wajib diisi.',
        'contact.required' => 'Email atau nomor telepon wajib diisi.',
        'notify_way.in' => 'Metode notifikasi tidak valid.',
    ];

    /**
     * Render view Livewire.
     */
    public function render()
    {
        return view('livewire.consult-request');
    }

    /**
     * Submit form konsultasi.
     */
    public function submit()
    {
        $this->sending = true;

        // validasi
        $data = $this->validate();

        // optional: simpan ke DB apabila model Contact tersedia
        if (class_exists(\App\Models\Contact::class)) {
            try {
                \App\Models\Contact::create([
                    'name' => $data['name'],
                    'email' => Str::contains($data['contact'], '@') ? $data['contact'] : null,
                    'phone' => !Str::contains($data['contact'], '@') ? $data['contact'] : null,
                    'message' => $data['message'] ?? null,
                    'is_read' => false,
                ]);
            } catch (\Throwable $e) {
                Log::error('Gagal menyimpan contact: '.$e->getMessage());
            }
        }

        // siapkan pesan WA yang diprefill bila user memilih whatsapp
        $waUrl = null;
        if ($this->notify_way === 'whatsapp') {
            $text = "Permintaan%20Konsultasi%20dari%20{$this->name}%0A";
            if ($this->service) {
                $text .= "Layanan:%20{$this->service}%0A";
            }
            if ($this->message) {
                $text .= "Pesan:%20" . urlencode(mb_substr($this->message, 0, 300));
            }
            $recipient = '6281340699907';
            $waUrl = "https://wa.me/{$recipient}?text={$text}";
        }

        // reset form
        $this->reset(['name','contact','service','message']);
        $this->sending = false;
        $this->sent = true;

        // emit browser event
        $this->dispatchBrowserEvent('consult-sent', [
            'notify_way' => $this->notify_way,
            'wa_url' => $waUrl,
            'message' => 'Permintaan Anda terkirim. Tim akan menghubungi sesuai pilihan notifikasi.'
        ]);
    }
}

