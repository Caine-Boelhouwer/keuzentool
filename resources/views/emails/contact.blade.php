@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => 'https://cini.nl/'])
<img width="70" src="{{ asset('images/logo.png') }}" alt="Logo Cini" />
@endcomponent
@endslot

{{-- Body --}}
# Hallo Cini,

Het contactformulier is ingevuld door <strong>{{ $request['contact_name'] }}</strong>

E-mail: {{ $request['contact_mail'] }} <br>
Telefoonnummer: {{ $request['contact_phone'] }}

Het bericht: <br>
{{ $request['contact_message'] }}

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
© {{ date('Y') }} Cini.

@endcomponent
@endslot
@endcomponent
