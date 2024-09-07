<!DOCTYPE html>

<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

<html lang="en">
<head>
  <head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>Mono - Responsive Admin & Dashboard Template</title>

  <!-- GOOGLE FONTS -->
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700|Roboto" rel="stylesheet">
  <link href="{{ asset('plugins/material/css/materialdesignicons.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('plugins/simplebar/simplebar.css') }}" rel="stylesheet" />

  <!-- PLUGINS CSS STYLE -->
  <link href="{{ asset('plugins/nprogress/nprogress.css') }}" rel="stylesheet" />

  <!-- MONO CSS -->
  <link id="main-css-href" rel="stylesheet" href="{{ asset('css/style.css') }}" />




  <!-- FAVICON -->
  <link href="{{ asset('images/favicon.png') }}" rel="shortcut icon" />

  <!--
    HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries
  -->
  <!-- WARNING: Respond.js doesnt work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script src="{{ asset('plugins/nprogress/nprogress.js') }}"></script>
</head>

  <body class="bg-light-gray" id="body">
          <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh">
          <div class="d-flex flex-column justify-content-between">
            <div class="row justify-content-center">
              <div class="col-lg-6 col-xl-5 col-md-10 ">
                <div class="card card-default mb-0">
                  <div class="card-header pb-0">
                    <div class="app-brand w-100 d-flex justify-content-center border-bottom-0">
                      <a class="w-auto pl-0" href="/index.html">
                        <img src="{{ asset('images/logo.png') }}" alt="Mono">
                        <span class="brand-name text-dark">MONO</span>
                      </a>
                    </div>
                  </div>
                  <div class="card-body px-5 pb-5 pt-0">
                    <h4 class="text-dark text-center mb-5">Profile</h4>
                    
                      <div class="row">
                        <div class="form-group col-md-12 mb-4">
                          <input type="text" class="form-control input-lg" id="name" name="name" value="{{ Auth::guard('member')->user()->name }}" aria-describedby="nameHelp" placeholder="Name">
                        </div>
                        @error('name')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror
                        <div class="form-group col-md-12 mb-4">
                          <input type="email" class="form-control input-lg" id="email" name="email" value="{{ Auth::guard('member')->user()->email }}"  aria-describedby="emailHelp" placeholder="email">
                        </div>
                        @error('email')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror
                        <div class="form-group col-md-12 ">
                            <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                                <input type="radio" id="customRadio1" name="type" class="custom-control-input"  value="male" @if(Auth::guard('member')->user()->type == 'male') checked @endif >
                                <label class="custom-control-label" for="customRadio1">Male</label>
                              </div>

                              <div class="custom-control custom-radio d-inline-block mr-3 mb-3">
                                <input type="radio" id="customRadio2" name="type" class="custom-control-input" value="female" @if(Auth::guard('member')->user()->type == 'female') checked @endif >
                                <label class="custom-control-label" for="customRadio2">Female</label>
                              </div>


                        </div>
                        @error('type')
                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                      @enderror

                      <div class="form-group col-md-12 mb-4">
                        <input type="text" class="form-control input-lg" id="phone" name="phone" value="{{ Auth::guard('member')->user()->phone }}" aria-describedby="nameHelp" placeholder="Phone">
                      </div>
                      @error('phone')
                          <div class="alert alert-danger" role="alert">{{ $message }}</div>
                      @enderror

                      <div class="form-group col-md-12 mb-4">
                        <input type="date" class="form-control input-lg" id="birthday_date" name="birthday_date" value="{{ Auth::guard('member')->user()->birthday_date }}" aria-describedby="nameHelp" placeholder="birthday_date">
                      </div>
                      @error('birthday_date')
                          <div class="alert alert-danger" role="alert">{{ $message }}</div>
                      @enderror


                        
                        
                        


                          
                        </div>
                      </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

</body>
</html>
