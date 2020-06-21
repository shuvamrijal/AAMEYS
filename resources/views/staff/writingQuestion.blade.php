@extends('layout')

@section('userdefineImports')
  <!-- Custom CSS -->
	  <link rel="stylesheet" type="text/css" href="/css/header.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <link rel="stylesheet" type="text/css" href="/css/tutor/leftSideBar.css">
    <link rel="stylesheet" type="text/css" href="/css/tutor/dashboardTutor.css">
    <link rel="stylesheet" type="text/css" href="/css/tutor/question.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <!-- Custom js -->
  <script src="/js/header.js"></script>
  <script src="/js/tutor/leftSideBar.js"></script>
	<script type="text/javascript">
	$(document).ready(function() {
	$('#readingQuestion').DataTable();
} );
	</script>
@endsection
@section('header')
  @include('tutor.afterSigninHeaderTutor')
@endsection
@section('content')
<div id="bodyWrapper">
<div id="leftSideBar">
      @include('tutor.leftSideBar')
</div>
    <div id="rightSideBar" class="reading">
			<div class="row">
				<div class="col-md-12">
				<table id="readingQuestion" class="table table-striped table-bordered" style="width:100%">
				<thead>
            <tr>
                <th style="text-align:center;"><h2>	{{$subcat->subcategory_name}}</h2></th>
            </tr>
        </thead>
				<tbody class="tablebody">
					@foreach ($pquestion as $row)
					<tr>
						<td>
							<p>
								{!! nl2br($row->question) !!}

							</p>
							<div class="options">

									<?
									$value=$row->options;
									if(!empty($value)){
										$option=explode(",",$value);
										foreach ($option as $value) {
												?>
												<ul class="optionList">
													<li>{{$value}}</li>
												</ul>

												<?
										}

									}
?>
							</div>
							<div class="suggestion">
								<ul>
									<li><i class="fas fa-comment">
										<span class="tooltiptext">Make a Suggestion</span>
									</i>

									</li>
								</ul>
							</div>
						</td>
					</tr>

					@endforeach

				</tbody>
					</table>
				</div>
      </div>
    </div>
  </div>

  @endsection
