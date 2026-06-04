<!-- Contact Section Begin -->
<section id="venue" class="contact-section spad" x-data="{ lang: 'vi' }">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <div class="section-title">
          <h2 x-show="lang === 'vi'" x-cloak>THÔNG TIN LIÊN HỆ</h2>
          <h2 x-show="lang === 'en'" x-cloak>CONTACT INFORMATION</h2>
          <p x-show="lang === 'vi'" x-cloak>Liên hệ Ban tổ chức</p>
          <p x-show="lang === 'en'" x-cloak>Contact the Organizing Committee</p>
        </div>
        <div class="switch-language">
          <button @click="lang = 'vi'" :class="{ 'active': lang === 'vi' }" class="button-vietnam" type="button">Tiếng Việt</button>
          <button @click="lang = 'en'" :class="{ 'active': lang === 'en' }" class="button-english" type="button">English</button>
        </div>
        <div class="cs-text">
          <x-contact-info />
        </div>
      </div>
      <div class="col-lg-6">
        <div class="section-title">
          <h2>Địa điểm tổ chức</h2>
          <p>Venue</p>
        </div>
        <div class="cs-text">
          <div class="ct-address">
            <span>Địa chỉ:</span>
            <p>Pullman Vũng tàu, Đà Nẵng<br />Việt Nam</p>
          </div>
        </div>
        <div class="cs-map">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3924.917063588401!2d107.0919911758353!3d10.34851656693918!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31756fe46b053f7d%3A0x16415f3ab82dbf99!2sPullman%20Vung%20Tau!5e0!3m2!1sen!2s!4v1775700221325!5m2!1sen!2s"
            height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Contact Section End -->
