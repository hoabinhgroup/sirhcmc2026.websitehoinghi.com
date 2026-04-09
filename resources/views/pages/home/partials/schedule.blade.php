  <!-- Schedule Section Begin -->
  <section class="schedule-section spad" x-data="{ lang: 'vi' }">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-title">
            <h2>Chương trình dự kiến </h2>
            <p>Expected Program </p>
          </div>
          <div class="switch-language">
            <button @click="lang = 'vi'" :class="{ 'active': lang === 'vi' }" class="button-vietnam">Tiếng Việt</button>
            <button @click="lang = 'en'" :class="{ 'active': lang === 'en' }" class="button-english">English</button>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12" x-show="lang === 'vi'">
          <div class="schedule-tab">
            <ul class="nav nav-tabs" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">
                  <h5>Ngày thứ nhất</h5>
                  <p>16 tháng 10 năm 2026</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">
                  <h5>Ngày thứ hai</h5>
                  <p>17 tháng 10 năm 2026</p>
                </a>
              </li>
            </ul><!-- Tab panes -->
            <div class="tab-content">
              <div class="tab-pane active" id="tabs-1" role="tabpanel">
                <div class="st-content">
                  <div class="container">
                    <div class="row">
                      <div class="col-lg-3">
                        <div class="sc-pic">
                          <img src="https://placehold.co/200x200" alt="">
                        </div>
                      </div>
                      <div class="col-lg-9">
                        <div class="sc-text">
                          <x-content-updating text="Nội dung program sẽ được cập nhật sau." />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="tabs-2" role="tabpanel">
                <div class="st-content">
                  <div class="container">
                    <div class="row">
                      <div class="col-lg-3">
                        <div class="sc-pic">
                          <img src="https://placehold.co/200x200" alt="">
                        </div>
                      </div>
                      <div class="col-lg-9">
                        <div class="sc-text">
                          <x-content-updating text="Nội dung program sẽ được cập nhật sau." />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-12" x-show="lang === 'en'">
          <div class="schedule-tab">
            <ul class="nav nav-tabs" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">
                  <h5>Day 1</h5>
                  <p>October 16, 2026</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">
                  <h5>Day 2</h5>
                  <p>October 17, 2026</p>
                </a>
              </li>
            </ul><!-- Tab panes -->
            <div class="tab-content">
              <div class="tab-pane active" id="tabs-1" role="tabpanel">
                <div class="st-content">
                  <div class="container">
                    <div class="row">
                      <div class="col-lg-3">
                        <div class="sc-pic">
                          <img src="https://placehold.co/200x200" alt="">
                        </div>
                      </div>
                      <div class="col-lg-9">
                        <div class="sc-text">
                          <x-content-updating text="The content of the program will be updated later." />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="tabs-2" role="tabpanel">
                <div class="st-content">
                  <div class="container">
                    <div class="row">
                      <div class="col-lg-3">
                        <div class="sc-pic">
                          <img src="https://placehold.co/200x200" alt="">
                        </div>
                      </div>
                      <div class="col-lg-9">
                        <div class="sc-text">
                          <x-content-updating text="The content of the program will be updated later." />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Schedule Section End -->
