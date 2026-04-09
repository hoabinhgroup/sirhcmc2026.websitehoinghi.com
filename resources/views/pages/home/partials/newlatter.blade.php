  <!-- Newslatter Section Begin -->
  <section class="newslatter-section">
    <div class="container">
      <div class="newslatter-inner set-bg" data-setbg="https://placehold.co/1400x200">
        <div class="ni-text">
          <h3>Liên hệ với chúng tôi</h3>
          <p>Contact with us</p>
        </div>
        <form action="{{ route('contact-lead.store') }}" method="POST" class="ni-form">
          @csrf
          <input type="text" name="email" value="{{ old('email') }}" placeholder="Your email" required>
          <textarea name="message" rows="4" placeholder="Nội dung cần liên hệ" required>{{ old('message') }}</textarea>
          <div class="captcha-wrap">
            <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
          </div>
          @if (session('contact_success'))
            <div class="captcha-message success">{{ session('contact_success') }}</div>
          @endif
          @error('email')
            <div class="captcha-message">{{ $message }}</div>
          @enderror
          @error('message')
            <div class="captcha-message">{{ $message }}</div>
          @enderror
          <button type="submit">Contact</button>
        </form>
      </div>
    </div>
  </section>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <!-- Newslatter Section End -->
