<footer class="footer pt-5 mt-5">
    <div class="container">
      <div class=" row">
        <div class="col-md-3 mb-4 ms-auto">
          <div>
            <a href="{{ url('/') }}">
              <img src="{{ route('imagecache', [ 'template'=>'original','filename' => $websiteParameter->logo() ]) }}" class="rounded-circle m-0 p-0">
            </a>
            <h6 class="font-weight-bolder mb-4">Bisesoggo</h6>
          </div>
          <div>
            <ul class="d-flex flex-row ms-n3 nav">
              <li class="nav-item">
                <a class="nav-link pe-1" href="{{ $websiteParameter->fb_url }}" target="_blank">
                  <i class="fab fa-facebook text-lg opacity-8"></i>
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link pe-1" href="{{ $websiteParameter->twitter_url }}" target="_blank">
                  <i class="fab fa-twitter text-lg opacity-8"></i>
                </a>
              </li>


              <li class="nav-item">
                <a class="nav-link pe-1" href="{{ $websiteParameter->youtube_url }}" target="_blank">
                  <i class="fab fa-youtube text-lg opacity-8"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>



        <div class="col-md-2 col-sm-6 col-6 mb-4">
          <div>
            <h6 class="text-sm">{{ __('Resources') }}</h6>
            <ul class="flex-column ms-n3 nav">
                @foreach ($bisesoggoCategories as $category)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('category-details',['id' => $category->id]) }}">
                      {{ $category->name }}
                    </a>
                  </li>
                @endforeach
            </ul>
          </div>
        </div>

        <div class="col-md-2 col-sm-6 col-6 mb-4">
          <div>
            <h6 class="text-sm">{{ __('Help & Support') }}</h6>
            <ul class="flex-column ms-n3 nav">
              <li class="nav-item">
                <a class="nav-link" href="http://bisesoggo.com/page/12/contact-us">
                {{ __('Contact Us') }}
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="http://bisesoggo.com/page/21/knowledge-center">
                 {{ __('Knowledge Center') }}
                </a>
              </li>

            </ul>
          </div>
        </div>

        <div class="col-md-2 col-sm-6 col-6 mb-4 me-auto">
          <div>
            <h6 class="text-sm">{{ __('Legal') }}</h6>
            <ul class="flex-column ms-n3 nav">
              <li class="nav-item">
                <a class="nav-link" href="http://bisesoggo.com/page/20/terms-&-conditions">
                 {{ __('Terms & Conditions') }}
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="http://bisesoggo.com/page/22/privacy-policy">
                    {{ __('Privacy Policy') }}
                </a>
              </li>

            </ul>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="text-center">
            <p class="text-dark my-4 text-sm font-weight-normal">
              All rights reserved. Copyright © <script>document.write(new Date().getFullYear())</script> Bisesoggo. Developed By:<a href="https://a2sys.co/" target="_blank">&nbsp;a2sys</a>.
            </p>
          </div>
        </div>
{{--
          <div class="col-lg-6 me-lg-auto my-lg-auto text-lg-end mt-5">
          <a href="https://twitter.com/intent/tweet?text=Check%20Material%20UI%20Kit%20made%20by%20%40CreativeTim%20%23webdesign%20%23designsystem%20%23bootstrap5&url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fmaterial-kit" class="btn btn-twitter mb-0 me-2" target="_blank">
            <i class="fab fa-twitter me-1"></i> Tweet
          </a>
          <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/material-kit" class="btn btn-facebook mb-0 me-2" target="_blank">
            <i class="fab fa-facebook-square me-1"></i> Share
          </a> --}}
        </div>
      </div>
    </div>
  </footer>
