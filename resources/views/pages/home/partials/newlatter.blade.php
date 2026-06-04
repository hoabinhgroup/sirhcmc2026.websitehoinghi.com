<!-- Newslatter Section Begin -->
<section class="newslatter-section" id="contact-form-section" x-data="{ lang: 'vi' }">
  <div class="container">
    <div class="newslatter-inner set-bg" data-setbg="{{ Storage::url('img/newslatter-bg.jpg') }}">
      <div class="ni-layout">
        <div class="ni-info-panel">
          <div class="ni-header">
            <div class="ni-heading">
              <h3 x-show="lang === 'vi'" x-cloak>THÔNG TIN LIÊN HỆ</h3>
              <h3 x-show="lang === 'en'" x-cloak>CONTACT INFORMATION</h3>
            </div>
            <div class="switch-language switch-language--light">
              <button @click="lang = 'vi'" :class="{ 'active': lang === 'vi' }" class="button-vietnam"
                type="button">Tiếng Việt</button>
              <button @click="lang = 'en'" :class="{ 'active': lang === 'en' }" class="button-english"
                type="button">English</button>
            </div>
          </div>
          <x-contact-info layout="banner" />
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Newslatter Section End -->