  <!-- Welcome Letter Section Begin -->
  <section class="welcome-letter-section spad" x-data="{ lang: 'vi' }">
    <div class="container">
      <div class="row align-items-start">
        <div class="col-lg-4 wl-pic-col">
          <div class="wl-pic">
            <img src="{{ Storage::url('img/organizing-committee/nguyen-dinh-luan.jpg') }}" alt="TS.BS. Nguyễn Đình Luân">
          </div>
          <div class="wl-profile">
            <div x-show="lang === 'vi'" x-cloak>
              <h5 class="wl-profile-name">TS.BS. NGUYỄN ĐÌNH LUÂN</h5>
              <p class="wl-profile-role">CHỦ TỊCH SIRHCM</p>
            </div>
            <div x-show="lang === 'en'" x-cloak>
              <h5 class="wl-profile-name">DR. NGUYEN DINH LUAN</h5>
              <p class="wl-profile-role">PRESIDENT OF SIRHCM</p>
            </div>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="wl-text">
            <div class="about-section-title">
              <h2 class="main">THƯ CHÀO MỪNG</h2>
              <div class="sub">WELCOME MESSAGE</div>
            </div>
            <div class="switch-language">
              <button @click="lang = 'vi'" :class="{ 'active': lang === 'vi' }" class="button-vietnam" type="button">Tiếng Việt</button>
              <button @click="lang = 'en'" :class="{ 'active': lang === 'en' }" class="button-english" type="button">English</button>
            </div>
            <div x-show="lang === 'vi'" x-cloak class="text-justify">
              <p class="f-para wl-signature-name">Kính gửi Quý Đại biểu tham dự,</p>
              <p class="f-para">
                Hội Điện quang Can thiệp Hồ Chí Minh (SIRHCM) xin trân trọng gửi lời chào mừng nồng nhiệt đến Quý Đại biểu tham dự Hội nghị khoa học Điện Quang Can Thiệp Hồ Chí Minh lần thứ 2 (SIRHCM 2026).
              </p>
              <p class="f-para">
                Hội nghị này là dịp để các chuyên gia, bác sĩ, nhà khoa học và đồng nghiệp trong lĩnh vực Điện quang Can thiệp trên cả nước cùng gặp gỡ, chia sẻ kinh nghiệm, cập nhật kiến thức, cũng như thảo luận về những tiến bộ mới nhất trong chuyên ngành. Chúng tôi tin rằng sự góp mặt của Quý vị sẽ đóng vai trò quan trọng trong việc tạo nên một diễn đàn khoa học chất lượng và giàu giá trị thực tiễn.
              </p>
              <p class="f-para">
                Ban tổ chức xin chân thành cảm ơn sự quan tâm, đồng hành và ủng hộ của Quý vị. Kính chúc Quý Đại biểu có những trải nghiệm ý nghĩa, nhiều kết nối chuyên môn và một kỳ hội nghị thành công tốt đẹp.
              </p>
              <p class="f-para wl-signature">
                Trân trọng,<br>
                <strong>Hội Điện quang Can thiệp Hồ Chí Minh (SIRHCM)</strong>
              </p>
            </div>
            <div x-show="lang === 'en'" x-cloak>
              <p class="f-para wl-signature-name">Dear Esteemed participants,</p>
              <p class="f-para">
                The Society of Interventional Radiology of Ho Chi Minh City (SIRHCM) is honored to extend our warmest welcome to all delegates attending The Society of Interventional Radiology Annual Scientific Meeting 2nd.
              </p>
              <p class="f-para">
                This conference is an important occasion for experts, physicians, scientists, and colleagues in the field of Interventional Radiology across the country to gather, share experiences, update knowledge, and discuss the latest advancements in the specialty. We firmly believe that your presence will play a vital role in creating a high-quality scientific forum rich in practical value.
              </p>
              <p class="f-para">
                The organizing committee sincerely appreciates your interest, support, and companionship. We wish all delegates a meaningful experience, fruitful professional connections, and a successful and inspiring conference.
              </p>
              <p class="f-para wl-signature">
                Sincerely,<br>
                <strong>The Society of Interventional Radiology of Ho Chi Minh City (SIRHCM)</strong>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Welcome Letter Section End -->
