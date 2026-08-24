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
              <button @click="lang = 'vi'" :class="{ 'active': lang === 'vi' }" class="button-vietnam" type="button">Tiếng Việt</button>
              <button @click="lang = 'en'" :class="{ 'active': lang === 'en' }" class="button-english" type="button">English</button>
            </div>
            <div class="ha-about-body" x-show="lang === 'vi'" x-cloak>
              <p>Vũng Tàu là một thành phố biển xinh đẹp ở miền Nam Việt Nam, nằm cách Thành phố Hồ Chí Minh khoảng 90 km về phía Đông Nam. Nổi tiếng với những bãi biển đẹp, hải sản tươi ngon và không khí thư giãn, Vũng Tàu là điểm đến được yêu thích của cả du khách trong nước và quốc tế.</p>
              <p>Thành phố là sự kết hợp hài hòa giữa vẻ đẹp thiên nhiên, các điểm tham quan văn hóa và hệ thống dịch vụ du lịch hiện đại. Du khách có thể tận hưởng khung cảnh biển tuyệt đẹp, khám phá các địa danh nổi tiếng như Tượng Chúa Kitô Vua và Hải đăng Vũng Tàu, hoặc thư giãn tại những bãi biển của thành phố.</p>
              <p>Với vị trí thuận tiện, không gian biển thoáng đãng cùng hệ thống khách sạn, nhà hàng và cơ sở hội nghị đa dạng, Vũng Tàu là điểm đến lý tưởng cho du lịch, các sự kiện doanh nghiệp, hội nghị và những chương trình quốc tế.</p>
            </div>
            <div class="ha-about-body" x-show="lang === 'en'" x-cloak>
              <p>Vung Tau is a beautiful coastal city in southern Vietnam, located approximately 90 kilometers southeast of Ho Chi Minh City. Famous for its stunning beaches, fresh seafood, and relaxed atmosphere, Vung Tau is a popular destination for both domestic and international visitors.</p>
              <p>The city offers a combination of natural beauty, cultural attractions, and modern tourism facilities. Visitors can enjoy scenic coastal views, explore landmarks such as the Jesus Christ Statue and the Lighthouse, or simply relax along the city's beautiful beaches.</p>
              <p>With its convenient location, pleasant seaside environment, and a wide range of hotels, restaurants, and conference facilities, Vung Tau is an ideal destination for leisure, business events, conferences, and international gatherings.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Home About Section End -->