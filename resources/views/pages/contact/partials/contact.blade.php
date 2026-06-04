  <!-- Contact Top Content Section Begin -->
  <section class="contact-content-section" x-data="{ lang: 'vi' }">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-6">
          <div class="cc-text set-bg" data-setbg="{{ Storage::url('img/contact-content-bg.jpg') }}">
            <div class="row">
              <div class="col-lg-8 offset-lg-4">
                <div class="section-title">
                  <h2 x-show="lang === 'vi'" x-cloak>THÔNG TIN LIÊN HỆ</h2>
                  <h2 x-show="lang === 'en'" x-cloak>CONTACT INFORMATION</h2>
                  <p x-show="lang === 'vi'" x-cloak>Liên hệ Ban tổ chức</p>
                  <p x-show="lang === 'en'" x-cloak>Contact the Organizing Committee</p>
                </div>
                <div class="switch-language cc-switch-language">
                  <button @click="lang = 'vi'" :class="{ 'active': lang === 'vi' }" class="button-vietnam" type="button">Tiếng Việt</button>
                  <button @click="lang = 'en'" :class="{ 'active': lang === 'en' }" class="button-english" type="button">English</button>
                </div>
                <div class="cs-text cc-contact-info">
                  <x-contact-info />
                </div>
                <div class="cs-text cc-venue-info">
                  <div class="ct-address">
                    <span>Địa chỉ / Address:</span>
                    <p>Pullman Vũng tàu<br />Việt Nam</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="cc-map">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3924.917063588401!2d107.0919911758353!3d10.34851656693918!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31756fe46b053f7d%3A0x16415f3ab82dbf99!2sPullman%20Vung%20Tau!5e0!3m2!1sen!2s!4v1775700221325!5m2!1sen!2s"
              height="580" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <div class="map-hover">
              <i class="fa fa-map-marker"></i>
              <div class="map-hover-inner">
                <h5>Pullman Vũng Tàu</h5>
                <p>Việt Nam</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Contact Top Content Section End -->

  <!-- Contact Form Section Begin -->
  <section class="contact-from-section spad">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-title">
            <h2>Liên hệ qua email</h2>
            <p>Contact Us By Email</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <form action="{{ route('contact-lead.store') }}" method="POST" class="comment-form contact-form">
            @csrf
            <div class="row">
              <div class="col-lg-12">
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" required>
              </div>
              <div class="col-lg-12">
                <textarea name="message" placeholder="Nội dung cần liên hệ / Your message" required>{{ old('message') }}</textarea>
              </div>
              <div class="col-lg-12 text-center">
                <button type="submit" class="site-btn">Gửi / Send</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
  <!-- Contact Form Section End -->
