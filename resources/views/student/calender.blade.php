<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    @include('student.includes.head')
    <title>Dashboard</title>
  </head>
  <body>
    <div  id="wrapper" class="toggled">
      @include('student.includes.navbar')
      @include('student.includes.sidebar')
      <div class="container-fluid" id="body-section" style="">
        <div class="row">
            <ul class="breadcrumb">
              <li><a href="{{route('student.dashboard')}}">Dashboard</a></li>
                <li><a href="#">Calender</a></li>
            </ul>
        </div>
            <div class="row">
              <div class="my-cources col-lg-12 col-sm-12 com-xs-12" style="display:inline">
                <div class="sidebar-wrapper col-lg-12" style="margin:0px;padding:0px;">
                      <div class="" id="sidebar">
                        <div class="event-btn">
                            <button type="submit" name="button" class="btn btn-primary" data-toggle="modal" data-target="#eventmodal">New Event</button>
                            <div class="modal fade" id="eventmodal" role="dialog"  aria-hidden="true">
                        <form class="" action="" method="post">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Add new event</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  {{csrf_field()}}
                                   <div class="form-group row">
                                      <label for="staticEmail" class="col-sm-3 col-form-label">Event Title:</label>
                                      <div class="col-sm-9">
                                        <input type="text"  class="form-control" name="event_title" value>
                                      </div>
                                    </div>
                                  <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-3 col-form-label">Date:</label>
                                    <div class="col-sm-9">
                                      <input type="datetime-local"  class="form-control" id="event_date" value>
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-3 col-form-label">Description</label>
                                    <div class="col-sm-9">
                                      <div id="toolbar">
                                        <span class="ql-formats">
                                    			<select class="ql-font">
                                    				<option value="sans-serif">Sans Serif</option>
                                    				<option value="serif">Serif</option>
                                    				<option value="monospace">Monospace</option>
                                    			</select>
                                    		</span>
                                        <span class="ql-formats">
                                  			<select class="ql-size">
                                  				<option value="small">Small</option>
                                  				<option selected>Normal</option>
                                  				<option value="large">Large</option>
                                  			</select>
                                      	</span>
                                  		<span class="ql-formats">
                                  			<select class="ql-color" title="Colour">
                                  				<option value="rgb(255,0,0)" />
                                  				<option value="rgb(0,255,0)" selected />
                                  				<option value="rgb(0,0,255)" />
                                  			</select>
                                  		</span>
                                  		<span class="ql-formats">
                                  			<button class="ql-bold" >
                                  				<span class="fa fa-bold"></span>
                                  		</button>
                                  		<button class="ql-italic" >
                                  				<span class="fa fa-italic"></span>
                                  			</button>
                                  		<button class="ql-underline">
                                  				<span class="fa fa-underline"></span>
                                  			</button>
                                  		<button class="ql-strike" id="strike" >
                                  				<span class="fa fa-strikethrough"></span>
                                  			</button>
                                  		</span>
                                  		<span class="ql-formats">
                                  			<button type="button" class="ql-list" value="bullet">
                                  				<span class="fa fa-list"></span>
                                  			</button>
                                  			<button type="button" class="ql-list" value="ordered">
                                  				<span class="fa fa-list-ol"></span>
                                  			</button>
                                  		</span>

                                  		<span class="ql-formats">
                                  			<button type="button" class="ql-blockquote" value="blockquote">
                                  				<span class="fa fa-quote-right"></span>
                                  			</button>
                                		</span>
                                        </div>

                                        <div name="name" id="editor" class="form-control"></div>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="button" id="add_event" class="btn btn-primary">Add</button>
                                </div>
                              </div>
                            </div>
                          </form>
                          </div>
                        </div>
                    <div class="sidebar-title">
                      <h4>Events</h4>
                      <h5 id="eventDayName">Date</h5>
                    </div>

                      </div>
                </div>
                <div class="sidebar-events" id="sidebarEvents">
                  <div id="message">
                  </div>
                  <ol id="event_details" >

                  </ol>

                </div>
      <div class="col-lg-12" style="margin:0px;padding:0px;">
         <div class="calendar-wrapper">
           <div class="header-background">
             <div class="calendar-header">
               <a class="prev-button" id="prev">
                <i class="fas fa-caret-left" style="font-size:120px;"></i>
               </a>
               <a class="next-button" id="next">
                 <i class="fas fa-caret-right" style="font-size:120px;"></i>
               </a>

               <div class="row header-title">

                 <div class="header-text">
                   <h3 id="month-name" style="background:none;">February</h3>
                   <h5 id="todayDayName">Today is Friday 7 Feb</h5>
                 </div>

               </div>
             </div>
           </div>

           <div class="calendar-content">
             <div id="calendar-table" class="calendar-cells">

               <div id="table-header">
                 <div class="row">
                   <div class="col">Mon</div>
                   <div class="col">Tue</div>
                   <div class="col">Wed</div>
                   <div class="col">Thu</div>
                   <div class="col">Fri</div>
                   <div class="col">Sat</div>
                   <div class="col">Sun</div>
                 </div>
               </div>

               <div id="table-body" class="">

               </div>

             </div>
           </div>

           <div class="calendar-footer">

           </div>
     </div>
      </div>
  </div>


            </div>
      </div>
    </div>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh"
           crossorigin="anonymous"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ"
           crossorigin="anonymous"></script>
  <script src="https://cdn.quilljs.com/1.0.0/quill.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
   <script>
     $(".button-collapse").sideNav();
   </script>


<!-- Initialize Quill editor -->
<script>
  var editor = new Quill('#editor', {
    modules: { toolbar: '#toolbar' },
    theme: 'snow'
  });
</script>
<script type="text/javascript" src="{{ URL::asset('js/staff.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/studentcalendar.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#add_event").click(function(e){
        e.preventDefault();
        var event_title = $('input[name="event_title"]').val();
        var event_desc = $(".ql-editor").html();
        var event_date = $("#event_date").val();
        var category = "Student";
        $.ajax({
           type:'get',
           url:'/student/createvent',
           data:{event_title:event_title, event_desc:event_desc, event_date:event_date,category:category},
           success:function(data){
             if(data.success == true){ // if true (1)
               setTimeout(function(){// wait for 5 secs(2)
          location.reload(); // then reload the page.(3)
        }, 1000);
  }
           }
        });
	});
</script>
</body>
</html>
