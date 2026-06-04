@props([
    'layout' => 'default',
])

@if ($layout === 'banner')
  <div {{ $attributes->class(['contact-info', 'contact-info--banner']) }}>
    <div x-show="lang === 'vi'" x-cloak>
      <p class="contact-info-intro">Vui lòng liên hệ với chúng tôi theo thông tin:</p>
      <p class="contact-info-name">Mr. Lê Quang Nhật Tú</p>
      <div class="contact-info-rows">
        <a href="tel:+84772649011" class="contact-info-row">
          <span class="contact-info-icon"><i class="fa fa-phone"></i></span>
          <span class="contact-info-row-text">
            <small>Số điện thoại</small>
            +84 772 649 011
          </span>
        </a>
        <a href="mailto:sirhcm2024@gmail.com" class="contact-info-row">
          <span class="contact-info-icon"><i class="fa fa-envelope"></i></span>
          <span class="contact-info-row-text">
            <small>Email</small>
            sirhcm2024@gmail.com
          </span>
        </a>
      </div>
    </div>
    <div x-show="lang === 'en'" x-cloak>
      <p class="contact-info-intro">For any feedback, please send it to:</p>
      <p class="contact-info-name">Mr. Andy Le</p>
      <div class="contact-info-rows">
        <a href="https://wa.me/84772649011" target="_blank" rel="noopener noreferrer" class="contact-info-row">
          <span class="contact-info-icon"><i class="fa fa-whatsapp"></i></span>
          <span class="contact-info-row-text">
            <small>Whatsapp</small>
            +84 772 649 011
          </span>
        </a>
        <a href="mailto:sirhcm2024@gmail.com" class="contact-info-row">
          <span class="contact-info-icon"><i class="fa fa-envelope"></i></span>
          <span class="contact-info-row-text">
            <small>Email</small>
            sirhcm2024@gmail.com
          </span>
        </a>
      </div>
    </div>
  </div>
@else
  <div {{ $attributes->class(['contact-info']) }}>
    <div x-show="lang === 'vi'" x-cloak>
      <p class="contact-info-intro">Vui lòng liên hệ với chúng tôi theo thông tin:</p>
      <p class="contact-info-name">Mr. Lê Quang Nhật Tú</p>
      <ul class="contact-info-list">
        <li>
          <span>Số điện thoại:</span>
          <a href="tel:+84772649011">+84 772 649 011</a>
        </li>
        <li>
          <span>Email:</span>
          <a href="mailto:sirhcm2024@gmail.com">sirhcm2024@gmail.com</a>
        </li>
      </ul>
    </div>
    <div x-show="lang === 'en'" x-cloak>
      <p class="contact-info-intro">For any feedback, please send it to:</p>
      <p class="contact-info-name">Mr. Andy Le</p>
      <ul class="contact-info-list">
        <li>
          <span>Whatsapp:</span>
          <a href="https://wa.me/84772649011" target="_blank" rel="noopener noreferrer">+84 772 649 011</a>
        </li>
        <li>
          <span>Email:</span>
          <a href="mailto:sirhcm2024@gmail.com">sirhcm2024@gmail.com</a>
        </li>
      </ul>
    </div>
  </div>
@endif
