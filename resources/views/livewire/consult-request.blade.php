{{-- File: resources/views/livewire/consult-request.blade.php --}}
<div>
    {{-- Modal (Tailwind) --}}
    <div id="consultModalLive" aria-hidden="{{ $sent ? 'true' : 'false' }}">
        <div class="fixed inset-0 z-60 flex items-center justify-center">
            <div class="absolute inset-0 bg-black/40"></div>

            <div class="relative max-w-2xl w-full p-6">
                <div class="bg-white rounded-xl p-6 shadow-lg">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="text-xl font-semibold">Form Permintaan Penawaran</h3>
                            <p class="text-sm text-slate-500 mt-1">Tim akan menghubungi via WhatsApp atau Email sesuai pilihan Anda.</p>
                        </div>
                        {{-- Tombol tutup modal (ditangani oleh JS di halaman) --}}
                        <button type="button" id="closeLiveModal" class="text-slate-600">×</button>
                    </div>

                    <form wire:submit.prevent="submit" class="mt-4 grid grid-cols-1 gap-3">
                        @csrf
                        <div>
                            <input wire:model.defer="name" type="text" id="c_name_live" placeholder="Nama lengkap / Perusahaan" class="p-3 rounded-md border border-slate-200 w-full" />
                            @error('name') <div class="text-sm text-red-600 mt-1">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <input wire:model.defer="contact" type="text" id="c_contact_live" placeholder="Email atau nomor telepon" class="p-3 rounded-md border border-slate-200 w-full" />
                            @error('contact') <div class="text-sm text-red-600 mt-1">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <select wire:model.defer="service" id="c_service_live" class="p-3 rounded-md border border-slate-200 w-full">
                                <option value="">Pilih layanan</option>
                                <option>UKL-UPL</option>
                                <option>AMDAL</option>
                                <option>ANDALALIN</option>
                                <option>SLF</option>
                                <option>PBG</option>
                                <option>SIPA</option>
                                <option>PIEL Banjir</option>
                            </select>
                            @error('service') <div class="text-sm text-red-600 mt-1">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <textarea wire:model.defer="message" id="c_message_live" placeholder="Ringkasan kebutuhan" class="p-3 rounded-md border border-slate-200 w-full" rows="4"></textarea>
                            @error('message') <div class="text-sm text-red-600 mt-1">{{ $message }}</div> @enderror
                        </div>

                        <div class="flex items-center justify-between mt-2">
                            <div class="text-sm text-slate-500">Notifikasi via:</div>
                            <div class="flex gap-3">
                                <label class="text-sm">
                                    <input wire:model="notify_way" type="radio" name="notify_way_live" value="whatsapp" /> WhatsApp
                                </label>
                                <label class="text-sm">
                                    <input wire:model="notify_way" type="radio" name="notify_way_live" value="email" /> Email
                                </label>
                            </div>
                        </div>

                        <div class="text-right mt-3">
                            <button type="submit" class="px-4 py-2 rounded-md btn-primary text-white" @if($sending) disabled @endif>
                                <span wire:loading.remove wire:target="submit">Kirim Permintaan</span>
                                <span wire:loading wire:target="submit">Mengirim…</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Toast kecil (akan muncul saat event) --}}
    <div id="liveToast" class="fixed left-1/2 transform -translate-x-1/2 bottom-10 z-70 hidden">
        <div class="bg-emerald-600 text-white px-4 py-2 rounded-md shadow" id="liveToastMessage"></div>
    </div>

    {{-- SCRIPT: dengarkan event browser 'consult-sent' yang dikirim class Livewire --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // buka modal ketika link #consult diklik
            document.querySelectorAll('a[href="#consult"]').forEach((el) => {
                el.addEventListener('click', function (e) {
                    e.preventDefault();
                    const modal = document.getElementById('consultModalLive');
                    if (modal) modal.classList.remove('hidden'); // in case it's hidden by default
                });
            });

            // close button
            const closeBtn = document.getElementById('closeLiveModal');
            if (closeBtn) {
                closeBtn.addEventListener('click', function () {
                    const modal = document.getElementById('consultModalLive');
                    if (modal) modal.classList.add('hidden');
                });
            }

            // listen event from Livewire
            window.addEventListener('consult-sent', function (ev) {
                // ev.detail contains notify_way, wa_url, message
                const detail = ev.detail || {};
                const toast = document.getElementById('liveToast');
                const toastMsg = document.getElementById('liveToastMessage');
                if (toast && toastMsg) {
                    toastMsg.textContent = detail.message || 'Permintaan terkirim.';
                    toast.classList.remove('hidden');
                    setTimeout(() => { toast.classList.add('hidden'); }, 3800);
                }

                // tutup modal bila masih terbuka
                const modal = document.getElementById('consultModalLive');
                if (modal) modal.classList.add('hidden');

                // jika user memilih WA, buka wa link baru (prefill)
                if (detail.notify_way === 'whatsapp' && detail.wa_url) {
                    // buka di tab baru agar user tidak kehilangan halaman
                    window.open(detail.wa_url, '_blank');
                }
            });
        });
    </script>
</div>
