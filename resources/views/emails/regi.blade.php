@component('mail::message')

  @slot('header')
       @component('mail::header', ['url' => config('app.url')])
           <img src="{{ asset('/images/display.jpg') }}" alt="{{ config('app.name') }} Logo">
       @endcomponent
   @endslot
   <h3>Welcome to AAMEYS Family</h3>
   <h5>You are Sucessfully registred </h5>
   <p>To finish you registration process, please click the link below <p>
     <form class="" action="{{$name}}" method="post">
       {{ csrf_field() }} <!-- from your framework -->
       <input type="hidden" name="field1" value="value1" />
     </form>
     <a href="{{$name}}"
     onclick="event.preventDefault();
     document.getElementById('magic-form').submit();">
   Click here to finsh
   </a>
@component('mail::button', ['url' => ''])
Button Text
@endcomponent

{{ config('app.name') }}
@endcomponent
