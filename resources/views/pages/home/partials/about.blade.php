  <!-- Home About Section Begin -->
  <section class="home-about-section spad" x-data="{ lang: 'vi' }">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="ha-pic">
            <iframe src="https://www.youtube.com/embed/bB_mm7cI-6k?autoplay=1&mute=1&loop=1&playlist=bB_mm7cI-6k&vq=hd1080&rel=0" title="YouTube video player" frameborder="0"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin"
              allowfullscreen></iframe>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="ha-text">
            <div class="about-section-title">
              <h2 class="main">Về Vũng Tàu</h2>
              <div class="sub">About Vung Tau</div>
            </div>
            <div class="switch-language">
              <button @click="lang = 'vi'" :class="{ 'active': lang === 'vi' }" class="button-vietnam">Tiếng Việt</button>
              <button @click="lang = 'en'" :class="{ 'active': lang === 'en' }" class="button-english">English</button>
            </div>
            <div x-show="lang === 'vi'">
              <x-content-updating text="Nội dung trang About sẽ được cập nhật sau." />
            </div>
            <div x-show="lang === 'en'">
              <x-content-updating text="The content of the About page will be updated later." />
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Home About Section End -->
