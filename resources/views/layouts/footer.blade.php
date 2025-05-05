  <!-- footer -->
  <section class="mt-5 footer">
      <div class="container">
          <div class="row">
              <div class="col-lg-3 col-md-6 col-sm-6">
                  <p class="footer-title">تابعنا</p>
                  <div class="d-flex">
                      <a href=""> <img src="{{ asset('build/assets/images/icon-04.png') }}" alt="img"
                              class="footer-icon">
                      </a>
                      <a href=""> <img src="{{ asset('build/assets/images/icon-03.png') }}" alt="img"
                              class="footer-icon"></a>
                      <a href=""> <img src="{{ asset('build/assets/images/icon-02.png') }}" alt="img"
                              class="footer-icon">

                          <a href=""> </a> <img src="{{ asset('build/assets/images/icon-01.png') }}"
                              alt="img" class="footer-icon">
                      </a>
                  </div>
              </div>
              <div class="col-lg-3 col-md-6 col-sm-6 ">
                  <a href="{{ route('questions') }}" class="footer-title">أسئلة شائعة</a>
              </div>
              <div class="col-lg-3 col-md-6 col-sm-6">
                  <a href="#" class="footer-title">روابط سريعة</a>
                  <ul class="footer-list"
                      style="list-style: none; padding: 0; margin: 0; line-height: 2; text-align: right; font-size: 16px; ">
                      <li><a href="{{ route('home') }}" class="text-decoration-none text-white">الرئيسية</a></li>
                      <li><a href="{{ route('about.us') }}" class="text-decoration-none text-white">من نحن</a></li>
                      <li><a href="{{ route('contact.us') }}" class="text-decoration-none text-white">تواصل معنا</a></li>
                      {{-- <li><a href="#" class="text-decoration-none text-white">عن الموقع</a></li> --}}
                  </ul>

              </div>
              <div class="col-lg-3 col-md-6 col-sm-6 align-img-center">
                  <a href="#">
                      <img src="{{ asset('build/assets/images/footer.png') }}" alt="img" class="footer-logo">
                  </a>
              </div>
          </div>
      </div>
  </section>
