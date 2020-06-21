<!DOCTYPE html>
<html lang="en">
<head>
	<title>Admin Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
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
</head>
<body>


  <div class="setpassword">
<div class="row">
		<div class="setpassword-contaier col-sm-12 col-md-4 col-xs-12">
			<div class="js-tilt" data-tilt>
				<img class="loginLogo" src="{{URL::asset('/images/69.png')}}" alt="IMG" >
			</div>

					<form class="col-sm-10 col-md-10 col-xs-12" method="post" action="{{route('staff.createpassword')}}">
						{{csrf_field()}}
						<h6 class="fs-40" style="text-align:center;">Complete Registration</h6>
						<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
								<label for="">Email:</label>
								<input type="text" name="staff_id" value="{{$staff_value['staff_id']}}" readonly>
								<input class="input100" type="text" name="email" value="{{$staff_value['email']}}" readonly>
							<span class="focus-input100"></span>

						</div>

						<div class="wrap-input100 validate-input" data-validate = "Password is required">
							<label for="">Password:</label>
							<input class="input100" type="password" name="password" placeholder="Password">

						</div>
						<div class="wrap-input100 validate-input" data-validate = "Password is required">
								<label for="">Re Password:</label>
							<input class="input100" type="password" name="repassword" placeholder="Password">
							<span class="focus-input100"></span>
						</div>
						@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

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

<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>
