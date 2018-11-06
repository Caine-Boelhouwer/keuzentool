@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => 'https://offshoreindependents.com/'])
<img width="250px" src="{{ asset('images/oi_logo.png') }}" alt="Logo Offshore Independents" />
@endcomponent
@endslot

{{-- Body --}}
# Hallo {{ $email }},

You are receiving this email because we received a password reset request for your account.

<table class="action" align="center" width="100%" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center">
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td align="center">
            <table border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td>
                  <a href="{{ $url }}" class="button button-blue" target="_blank">Reset password</a>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>

If you did not request a password reset, no further action is required.

Greetings,

Offshore Independents

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
© {{ date('Y') }} Offshore Independents. all rights reserved.

@endcomponent
@endslot
@endcomponent
