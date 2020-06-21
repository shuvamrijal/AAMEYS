<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    @include('student.includes.head')
    <title>Dashboard</title>
    <style media="screen">
      .mycources-box{
        border: 2px solid #E8E8E8;
        margin: 0px;
        padding: 15px;
        background-color: whitesmoke;
      }

    </style>
  </head>
  <body>
    <div  id="wrapper" class="toggled">
      @include('student.includes.navbar')
      @include('student.includes.sidebar')
      <div class="container-fluid" id="body-section" style="">
        <div class="row">
            <ul class="breadcrumb">
              <li><a href="{{route('student.dashboard')}}">Dashboard</a></li>
            </ul>
        </div>
            <div class="row">
              <div class="my-cources col-lg-12 col-sm-12 com-xs-12">
                  <div class="cource-content">

                        @foreach($courses as $row)
                            <h3>{{$row['CourseName']}}</h3>
                        @endforeach
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th scope="col">Grade Item</th>
                          <th scope="col">Grade</th>
                          <th scope="col">Percentage</th>
                          <th scope="col">Result</th>
                        </tr>
                      </thead>
                      <tbody>
                              @foreach($assignment_grade as $value)
                              <tr>

                                <th scope="row">{{$value['title']}}</th>
                                <td>{{$value['grade']}}</td>
                                <td><?php
                                $result=(($value['grade']/$value['max_grade'])*100);
                                echo ($result).'%';
                                ?>
                              </td>
                                <td>
                                  <?php
                                  if($result<=40){
                                    echo "fail";
                                  }else{
                                    echo "Pass";
                                  }
                                   ?>

                                </td>
                              </tr>
                                @endforeach

                                @foreach($quiz_grade as $value)
                                <tr>

                                  <th scope="row">{{$value['Quiz_title']}}</th>
                                  <td>{{$value['marks']}}</td>
                                  <td><?php
                                  $quiz_result=(($value['marks']/$value['no_of_question'])*100);
                                  echo ($quiz_result).'%';
                                  ?>
                                </td>
                                  <td>
                                    <?php
                                    if($quiz_result<=40){
                                      echo "fail";
                                    }else{
                                      echo "Pass";
                                    }
                                     ?>

                                  </td>
                                </tr>
                                  @endforeach

                      </tbody>
                    </table>
                      @foreach($courses as $row)

                      @endforeach

                </div>
              </div>
            </div>
      </div>
    </div>
  </body>
</html>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('js/staff.js') }}"></script>
