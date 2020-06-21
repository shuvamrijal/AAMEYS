<!DOCTYPE html>
<html lang="en">
<head>
	<title>Register</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->

<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/admin/font.css">
  <link rel="stylesheet" href="{{ URL::asset('css/admin/main.css') }}">
<!--===============================================================================================-->
<style media="screen">
.symbol-input100 {
  font-size: 15px;

  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
  align-items: center;
  position: absolute;
  border-radius: 25px;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 100%;
  padding-left: 25px;
  pointer-events: none;
  color: #666666;

  -webkit-transition: all 0.4s;
  -o-transition: all 0.4s;
  -moz-transition: all 0.4s;
  transition: all 0.4s;
}

.input100:focus + .focus-input100 + .symbol-input100 {
  color: #57b846;
  padding-left: 28px;
}
.dob-input{
  padding-left: 90px;
}
.address-input{
padding-left: 85px;
}
.wrap-login100{
  overflow: scroll;
}
.male-symbol{
  padding-left: 40px;
  margin: 10px;
}
.male-symbol input{
  height: 17px;
  width: 17px;
}
.female-symbol input{
  height: 17px;
  width: 17px;
}
</style>
</head>
<body>

	<div class="limiter">
		<div class="left-container">
				<img class="display-image" src="{{URL::asset('/images/display.jpg')}}" alt="">
		</div>
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img class="loginLogo" src="{{URL::asset('/images/69.png')}}" alt="IMG" >
				</div>
				<form class="login100-form validate-form" method="post" action="{{route('register')}}">
					{{csrf_field()}}
					<span class="login100-form-title fs-12">
						      <h4>Register Now </h4><br>
                  Already resgister, <a href='#'> click here<a> to login
					</span>
          <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="name">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							Name:
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							Email:&nbsp;
						</span>
					</div>

          <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
            <input class="input100" type="text" name="phoneno" placeholder="">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              Phone:
            </span>
          </div>

          <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
            <input class="input100 address-input" type="text" name="address">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              Address:
            </span>
          </div>

                    <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                      <div class="input100" style="padding:14px;padding-left:50px;">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                          Gender:
                        </span>
                      <span class="male-symbol">
                       <input type="radio" name="gender" value="male">  Male:
                      </span>

                      <span class="female-symbol">
                       <input type="radio" name="gender" value="female">  Female:
                      </span>
                    </div>
                    </div>

          <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
            <input class="input100 dob-input" type="date" name="dob" >
            <span class="focus-input100"></span>
            <span class="symbol-input100 symbol-dob">
                DOB:
            </span>
          </div>
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Register
						</button>
					</div>

				</form>
			</div>
		</div>
	</div>




<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>
