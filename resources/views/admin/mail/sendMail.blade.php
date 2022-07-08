@component('mail::message')
Halo {{ $data['nama'] }}

Terima kasih telah menghubungi Helpdesk Politeknik Hasnur.

{{ $data['pesan'] }}

Salam hangat,<br>
Tim PMB Politeknik Hasnur
@endcomponent