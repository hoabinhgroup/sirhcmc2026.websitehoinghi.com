  <!-- Footer Section Begin -->
  <footer class="footer-section">
    <div class="container">
      {{-- <div class="partner-logo owl-carousel">
        @foreach ($footerPartners as $partner)
          <a href="{{ $partner['href'] }}" class="pl-table">
            <div class="pl-tablecell">
              <img src="{{ asset($partner['img']) }}" alt="">
            </div>
          </a>
        @endforeach
      </div> --}}
      <div class="row">
        <div class="col-lg-12">
          <div class="footer-text">
            {{-- <div class="ft-logo">
              <a href="{{ route('home') }}" class="footer-logo"><img src="{{ Storage::url('img/footer-logo.png') }}" alt=""></a>
            </div> --}}
            <ul>
              @foreach ($footerMenu as $item)
                <li><a href="{{ route($item['route']) }}">{{ $item['label'] }}</a></li>
              @endforeach
            </ul>
            <div class="copyright-text">
              <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright &copy; SIR HCM
                <script>
                  document.write(new Date().getFullYear());
                </script> | All rights reserved
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
              </p>
            </div>
            {{-- <div class="ft-social">
              <a href="#"><i class="fa fa-facebook"></i></a>
              <a href="#"><i class="fa fa-twitter"></i></a>
              <a href="#"><i class="fa fa-linkedin"></i></a>
              <a href="#"><i class="fa fa-instagram"></i></a>
              <a href="#"><i class="fa fa-youtube-play"></i></a>
            </div> --}}
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- Footer Section End -->
