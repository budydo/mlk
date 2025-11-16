{{-- Email template untuk balasan kontak --}}
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
</head>
<body style="font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;">
  <p>Yth. {{ $name }},</p>

  <p>Terima kasih atas pesan Anda kepada {{ config('app.name') }}. Berikut adalah balasan dari tim kami:</p>

  <blockquote style="border-left:4px solid #eee;padding-left:12px;color:#333">{{ $reply }}</blockquote>

  <p>Salinan dari pesan Anda:</p>
  <blockquote style="border-left:4px solid #f3f4f6;padding-left:12px;color:#666">{{ $message }}</blockquote>

  <p>Jika Anda memerlukan bantuan lebih lanjut, silakan balas email ini atau hubungi kami melalui website.</p>

  <p>Hormat kami,<br>{{ config('app.name') }}</p>
</body>
</html>
