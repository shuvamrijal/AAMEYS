@extends('layout')

@section('userdefineImports')
  <!-- Custom CSS -->
	  <link rel="stylesheet" type="text/css" href="/css/header.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <link rel="stylesheet" type="text/css" href="/css/tutor/leftSideBar.css">
    <link rel="stylesheet" type="text/css" href="/css/tutor/dashboardTutor.css">
    <link rel="stylesheet" type="text/css" href="/css/tutor/question.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Custom js -->
  <script src="/js/header.js"></script>
  <script src="/js/tutor/leftSideBar.js"></script>

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
        @if($val=='Reading')
        <div class="title">
          <h2>{{$val}}</h2>
        </div>
        <ul class="readingItem">
          @foreach($cat as $cat)
          @foreach($sub as $subcat)
          @if($cat['category_name']==$val)
          @if($cat['category_id']==$subcat['category_id'])
          <a href="/teacher/readingQuestion/reading/{{$subcat['subcategory_id']}}">
            <li class="com-sm-11">{{$subcat['subcategory_name']}}
              <i class="fas fa-angle-double-right"></i>
            </li>
          </a>
          @endif
          @endif
          @endforeach
          @endforeach
        </ul>
        @endif
        @if($val=='Writing')
        <div class="title">
          <h2>{{$val}}</h2>
        </div>
        <ul class="readingItem">
          @foreach($cat as $cat)
          @foreach($sub as $subcat)
          @if($cat['category_name']==$val)
          @if($cat['category_id']==$subcat['category_id'])
          <a href="/teacher/writingquestion/writing/{{$subcat['subcategory_id']}}">
            <li class="com-sm-11">{{$subcat['subcategory_name']}}
              <i class="fas fa-angle-double-right"></i>
            </li>
          </a>
          @endif
          @endif
          @endforeach
          @endforeach
        </ul>
        @endif
        @if($val=='Listening')
        <div class="title">
          <h2>{{$val}}</h2>
        </div>
        <ul class="readingItem">
          @foreach($cat as $cat)
          @foreach($sub as $subcat)
          @if($cat['category_name']==$val)
          @if($cat['category_id']==$subcat['category_id'])
          <a href="/teacher/listeningquestion/listening/{{$subcat['subcategory_id']}}">
            <li class="com-sm-11">{{$subcat['subcategory_name']}}
              <i class="fas fa-angle-double-right"></i>
            </li>
          </a>
          @endif
          @endif
          @endforeach
          @endforeach
        </ul>
        @endif
        @if($val=='Speaking')
        <div class="title">
          <h2>{{$val}}</h2>
        </div>
        <ul class="readingItem">
          @foreach($cat as $cat)
          @foreach($sub as $subcat)
          @if($cat['category_name']==$val)
          @if($cat['category_id']==$subcat['category_id'])
        <a href="/teacher/speakingquestion/speaking/{{$subcat['subcategory_id']}}">
            <li class="com-sm-11">{{$subcat['subcategory_name']}}
              <i class="fas fa-angle-double-right"></i>
            </li>
          </a>
          @endif
          @endif
          @endforeach
          @endforeach
        </ul>
        @endif
      </div>
    </div>
  </div>

  @endsection
