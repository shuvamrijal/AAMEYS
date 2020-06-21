<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>AAMEYS - Learning</title>
        @include('layouts.head')
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body id="main-wrapper">
      <div class="">
        @include('layouts.navbar')
      </div>
    <div class="container">
      <div class="info" style="padding: 100px;">
        <h1>Welcome to AAMEYS family.</h1>
        <h6>You are Sucessfully Register.<br> We will email your login credentials shortly</h6>
      </div>
      </div>

      <div class="footer">
        <div class="container">
          <div class="row">
          <div class="col-lg-4">
            <div class="footer_logo">
              <img src="{{URL::asset('/images/69.png')}}" alt="">
            </div>
          </div>
          <div class="col-lg-5 contact">
          <h1>Contact Us</h1></br>
          <span>Call Us: 03 9042 1604</span></br></br>
          <span>  Email Us: harmony@aameys.com.au</span></br></br>
          <span>Address: Suite 108, 144-148 Nicholson St Footscray Vic 3011</span></br></br>
          <span>Postal: ​PO BOX 2126, Hotham Hill, VIC 3051</span></br></br>
          </div>
        </div>
        </div>
      </div>
    </div>

    </body>
</html>
