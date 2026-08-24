@extends('layout.index')
@section('title', 'Travel Support - Accommodation')
@section('content')
  @include('pages.travel-support.partials.breadcrumb', ['breadcrumbCurrent' => 'Accommodation'])
  <section id="accommodation" class="about-section spad">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-title">
            <h2>Lưu trú / Accommodation</h2>
          </div>

          <div class="accommodation-page">

            {{-- THE MALIBU HOTEL VUNG TAU --}}
            <div class="hotel-block">
              <div class="hotel-block-header">
                <h3>THE MALIBU HOTEL VUNG TAU</h3>
              </div>
              <div class="hotel-table-wrap">
                <table class="hotel-rate-table">
                  <thead>
                    <tr>
                      <th>Room Type</th>
                      <th>Sunday - Friday</th>
                      <th>Saturday</th>
                      <th>Conference<br><span class="hotel-th-note">(Check-in 16/10 - Check-out 18/10)</span></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="hotel-room-type">Double Room (ROH)</td>
                      <td>
                        <div class="hotel-rate">2.000.000++ VND</div>
                        <a class="hotel-book-btn" href="https://vi.bookandpay.vn/book-hotels/108?num=1" target="_blank" rel="noopener noreferrer">Book now</a>
                      </td>
                      <td>
                        <div class="hotel-rate">2.500.000++ VND</div>
                        <a class="hotel-book-btn" href="https://vi.bookandpay.vn/book-hotels/108?num=2" target="_blank" rel="noopener noreferrer">Book now</a>
                      </td>
                      <td>
                        <div class="hotel-rate">4.400.000++ VND</div>
                        <a class="hotel-book-btn" href="https://vi.bookandpay.vn/book-hotels/108?num=3" target="_blank" rel="noopener noreferrer">Book now</a>
                      </td>
                    </tr>
                    <tr>
                      <td class="hotel-room-type">Twin Room (ROH)</td>
                      <td>
                        <div class="hotel-rate">2.000.000++ VND</div>
                        <a class="hotel-book-btn" href="https://vi.bookandpay.vn/book-hotels/108?num=4" target="_blank" rel="noopener noreferrer">Book now</a>
                      </td>
                      <td>
                        <div class="hotel-rate">2.500.000++ VND</div>
                        <a class="hotel-book-btn" href="https://vi.bookandpay.vn/book-hotels/108?num=5" target="_blank" rel="noopener noreferrer">Book now</a>
                      </td>
                      <td>
                        <div class="hotel-rate">4.400.000++ VND</div>
                        <a class="hotel-book-btn" href="https://vi.bookandpay.vn/book-hotels/108?num=6" target="_blank" rel="noopener noreferrer">Book now</a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            {{-- PULLMAN VUNG TAU HOTEL --}}
            <div class="hotel-block">
              <div class="hotel-block-header">
                <h3>PULLMAN VUNG TAU HOTEL</h3>
              </div>
              <div class="hotel-table-wrap">
                <table class="hotel-rate-table">
                  <thead>
                    <tr>
                      <th>Room Type</th>
                      <th>Sunday - Friday</th>
                      <th>Saturday</th>
                      <th>Conference<br><span class="hotel-th-note">(Check-in 16/10 - Check-out 18/10)</span></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="hotel-room-type">Double Room (ROH)</td>
                      <td>
                        <div class="hotel-rate">2.800.000++ VND</div>
                        <a class="hotel-book-btn" href="https://vi.bookandpay.vn/book-hotels/109?num=1" target="_blank" rel="noopener noreferrer">Book now</a>
                      </td>
                      <td>
                        <div class="hotel-rate">3.300.000++ VND</div>
                        <a class="hotel-book-btn" href="https://vi.bookandpay.vn/book-hotels/109?num=2" target="_blank" rel="noopener noreferrer">Book now</a>
                      </td>
                      <td>
                        <div class="hotel-rate">6.000.000++ VND</div>
                        <a class="hotel-book-btn" href="https://vi.bookandpay.vn/book-hotels/109?num=3" target="_blank" rel="noopener noreferrer">Book now</a>
                      </td>
                    </tr>
                    <tr>
                      <td class="hotel-room-type">Twin Room (ROH)</td>
                      <td>
                        <div class="hotel-rate">2.800.000++ VND</div>
                        <a class="hotel-book-btn" href="https://vi.bookandpay.vn/book-hotels/109?num=4" target="_blank" rel="noopener noreferrer">Book now</a>
                      </td>
                      <td>
                        <div class="hotel-rate">3.300.000++ VND</div>
                        <a class="hotel-book-btn" href="https://vi.bookandpay.vn/book-hotels/109?num=5" target="_blank" rel="noopener noreferrer">Book now</a>
                      </td>
                      <td>
                        <div class="hotel-rate">6.000.000++ VND</div>
                        <a class="hotel-book-btn" href="https://vi.bookandpay.vn/book-hotels/109?num=6" target="_blank" rel="noopener noreferrer">Book now</a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <p class="hotel-note">* Rates are quoted in VND per room per night, exclusive of taxes and service charges (++).</p>

          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
