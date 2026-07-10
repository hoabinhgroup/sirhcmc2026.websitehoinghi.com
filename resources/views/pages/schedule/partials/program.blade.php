  <!-- Program Schedule Section Begin -->
  <section class="schedule-table-section spad program-schedule-section" x-data="{ day: '1' }">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          @if (route('schedule') !== request()->url())
            <div class="section-title">
              <h2>CHƯƠNG TRÌNH DỰ KIẾN</h2>
              <p>TENTATIVE PROGRAM</p>
            </div>
          @endif
          <div class="schedule-table-tab program-schedule-tab">
            <div class="switch-language program-day-switch">
              <button @click="day = '1'" :class="{ 'active': day === '1' }" class="button-day1" type="button">
                <strong>Day 1</strong>
                <span>16th October</span>
              </button>
              <button @click="day = '2'" :class="{ 'active': day === '2' }" class="button-day2" type="button">
                <strong>Day 2</strong>
                <span>17th October</span>
              </button>
            </div>
            <div class="program-top-image">
              <img src="{{ Storage::url('img/banner web-01.jpg') }}" alt="Program Top">
            </div>
            <div class="program-tab-panels">
              <div x-show="day === '1'" x-cloak>
                <div class="schedule-table-content program-table-wrap">
                  <table class="program-table">
                    <thead>
                      <tr>
                        <th class="program-th program-th--time">Time</th>
                        <th class="program-th program-th--ballroom1">Ballroom 1</th>
                        <th class="program-th program-th--ballroom2">Ballroom 2</th>
                        <th class="program-th program-th--ballroom3">Ballroom 3</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="event-time">08.00 - 11.30</td>
                        <td class="program-cell program-cell--ballroom1">
                          <h5>PRE-CONFERENCE CME: VASCULAR MALFORMATIONS</h5>
                        </td>
                        <td class="program-cell program-cell--ballroom2">
                          <h5>PRE-CONFERENCE CME: ABLATION</h5>
                        </td>
                        <td class="program-cell program-cell--empty"></td>
                      </tr>
                      <tr>
                        <td class="event-time">11.30 - 12.30</td>
                        <td colspan="3" class="program-cell program-cell--lunch">
                          <h5>LUNCH SYMPOSIUM</h5>
                        </td>
                      </tr>
                      <tr>
                        <td class="event-time">13.00 - 14.30</td>
                        <td class="program-cell program-cell--ballroom1">
                          <h5>NON-VASCULAR INTERVENTION</h5>
                        </td>
                        <td class="program-cell program-cell--ballroom2">
                          <h5>HCC</h5>
                        </td>
                        <td class="program-cell program-cell--ballroom3">
                          <h5>ORAL PRESENTATION</h5>
                        </td>
                      </tr>
                      <tr>
                        <td class="event-time">14.30 - 15.00</td>
                        <td colspan="3" class="program-cell program-cell--shared">
                          <h5>TEA BREAKS</h5>
                        </td>
                      </tr>
                      <tr>
                        <td class="event-time">15.00 - 17.00</td>
                        <td class="program-cell program-cell--ballroom1">
                          <h5>EMBOLIZATION</h5>
                        </td>
                        <td class="program-cell program-cell--ballroom2">
                          <h5>PELVIC INTERVENTION</h5>
                        </td>
                        <td class="program-cell program-cell--ballroom3">
                          <h5>STROKE</h5>
                        </td>
                      </tr>
                      <tr>
                        <td class="event-time">18.30 - 21.30</td>
                        <td colspan="3" class="program-cell program-cell--dinner">
                          <h5>WELCOME DINNER</h5>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div x-show="day === '2'" x-cloak>
                <div class="schedule-table-content program-table-wrap">
                  <table class="program-table">
                    <thead>
                      <tr>
                        <th class="program-th program-th--time">Time</th>
                        <th class="program-th program-th--ballroom1">Ballroom 1</th>
                        <th class="program-th program-th--ballroom2">Ballroom 2</th>
                        <th class="program-th program-th--ballroom3">Ballroom 3</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="event-time">08.00 - 09.30</td>
                        <td class="program-cell program-cell--ballroom1">
                          <h5>AVF/ PAD</h5>
                        </td>
                        <td class="program-cell program-cell--ballroom2">
                          <h5>ABLATION</h5>
                        </td>
                        <td class="program-cell program-cell--ballroom3">
                          <h5>DAVF/ AVM</h5>
                        </td>
                      </tr>
                      <tr>
                        <td class="event-time">09.30 - 10.00</td>
                        <td colspan="3" class="program-cell program-cell--shared">
                          <h5>TEA BREAKS</h5>
                        </td>
                      </tr>
                      <tr>
                        <td class="event-time">10.00 - 10.30</td>
                        <td colspan="3" class="program-cell program-cell--shared">
                          <h5>OPENING CEREMONY</h5>
                        </td>
                      </tr>
                      <tr>
                        <td class="event-time">10.30 - 11.30</td>
                        <td colspan="3" class="program-cell program-cell--shared">
                          <h5>PLENARY SESSION</h5>
                        </td>
                      </tr>
                      <tr>
                        <td class="event-time">11.30 - 12.30</td>
                        <td colspan="3" class="program-cell program-cell--lunch">
                          <h5>LUNCH SYMPOSIUM</h5>
                        </td>
                      </tr>
                      <tr>
                        <td class="event-time">13.00 - 14.30</td>
                        <td class="program-cell program-cell--ballroom1">
                          <h5>PORTAL HYPERTENSION - CONSENSUS</h5>
                        </td>
                        <td class="program-cell program-cell--ballroom2">
                          <h5>M&amp;M</h5>
                        </td>
                        <td class="program-cell program-cell--ballroom3">
                          <h5>ANEURYSM/ FDS</h5>
                        </td>
                      </tr>
                      <tr>
                        <td class="event-time">14.30 - 15.00</td>
                        <td colspan="3" class="program-cell program-cell--shared">
                          <h5>TEA BREAKS</h5>
                        </td>
                      </tr>
                      <tr>
                        <td class="event-time">15.00 - 16.30</td>
                        <td class="program-cell program-cell--ballroom1">
                          <h5>INNOVATION</h5>
                        </td>
                        <td class="program-cell program-cell--ballroom2">
                          <h5>PAIN MANAGEMENT</h5>
                        </td>
                        <td class="program-cell program-cell--ballroom3">
                          <h5>TECHNICIAN-NURSE</h5>
                        </td>
                      </tr>
                      <tr>
                        <td class="event-time">16.30 - 17.30</td>
                        <td class="program-cell program-cell--ballroom1">
                          <h5>CONCENSUS FOR IR MANAGEMANT <br> OF PORTAL HYPERTENSION</h5>
                        </td>
                        <td class="program-cell program-cell--ballroom2">
                          <h5>VASCULAR MALFORMATION</h5>
                        </td>
                        <td class="program-cell program-cell--ballroom3">
                          <h5>MSK</h5>
                        </td>
                      </tr>
                      <tr>
                        <td class="event-time">18.30 - 21.30</td>
                        <td colspan="3" class="program-cell program-cell--dinner">
                          <h5>GALA DINNER</h5>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Program Schedule Section End -->
