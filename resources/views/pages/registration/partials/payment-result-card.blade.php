@php
  $iconClass = $iconClass ?? 'success';
  $titleClass = $titleClass ?? 'success';
@endphp

<div class="payment-result-container">
  <div class="payment-result-card">
    <div class="payment-icon {{ $iconClass }}">
      @if ($iconClass === 'success')
        <i class="fa fa-check"></i>
      @elseif ($iconClass === 'cancel')
        <i class="fa fa-times"></i>
      @else
        <i class="fa fa-exclamation-triangle"></i>
      @endif
    </div>
    <h1 class="payment-title {{ $titleClass }}">{{ $title }}</h1>
    <div class="payment-message">
      {{ $slot }}
    </div>
    @isset($contact)
      <div class="payment-contact">
        {!! $contact !!}
      </div>
    @endisset
  </div>
</div>
