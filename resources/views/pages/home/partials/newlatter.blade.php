  <!-- Newslatter Section Begin -->
  <section class="newslatter-section" id="contact-form-section">
    <div class="container">
      <div class="newslatter-inner set-bg" data-setbg="{{ Storage::url('img/newslatter-bg.jpg') }}">
        <div class="ni-text">
          <h3>Liên hệ với chúng tôi</h3>
          <p>Contact with us</p>
        </div>
        <form action="{{ route('contact-lead.store') }}" method="POST" class="ni-form" id="contact-lead-form">
          @csrf
          <input type="text" name="email" value="{{ old('email') }}" placeholder="Your email" required>
          <textarea name="message" rows="4" placeholder="Nội dung cần liên hệ" required>{{ old('message') }}</textarea>
          <div class="captcha-wrap">
            <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
          </div>
          @error('email')
            <div class="captcha-message">{{ $message }}</div>
          @enderror
          @error('message')
            <div class="captcha-message">{{ $message }}</div>
          @enderror
          @error('recaptcha')
            <div class="captcha-message">{{ $message }}</div>
          @enderror
          <button type="submit">Contact</button>
        </form>
      </div>
    </div>
  </section>
  <div id="contact-status-toast" style="position:fixed;top:24px;right:24px;z-index:9999;display:none;max-width:360px;padding:12px 16px;border-radius:6px;color:#fff;font-size:14px;box-shadow:0 8px 24px rgba(0,0,0,.2);"></div>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const hasSuccess = @json(session()->has('contact_success'));
      const firstError = @json($errors->first('email') ?: $errors->first('message') ?: $errors->first('recaptcha'));

      if (!hasSuccess && !firstError) {
        return;
      }

      const section = document.getElementById('contact-form-section');
      if (section) {
        section.scrollIntoView({ behavior: 'smooth', block: 'center' });
      }

      const toast = document.getElementById('contact-status-toast');
      if (!toast) {
        return;
      }

      const message = hasSuccess ? @json(session('contact_success')) : firstError;
      const isSuccess = Boolean(hasSuccess);

      toast.textContent = message;
      toast.style.backgroundColor = isSuccess ? '#2e7d32' : '#c62828';
      toast.style.display = 'block';

      setTimeout(function () {
        toast.style.display = 'none';
      }, 3500);
    });
  </script>
  <!-- Newslatter Section End -->
