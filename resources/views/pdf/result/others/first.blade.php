
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
       .styled-table {
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            font-family: sans-serif;
            /* min-width: 400px; */
            width: 100%;
            margin: 0 auto;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }
        .styled-table thead tr {
            background-color: #009879;
            color: #ffffff;
            text-align: left;
        }
        .styled-table th,
        .styled-table td {
            padding: 5px 5px;
        }
        .styled-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .styled-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .styled-table tbody tr:last-of-type {
            border-bottom: 2px solid #009879;
        }
        
        .text-center{
            text-align: center;
        }
        .text-right{
            text-align: right;
        }
        .text-left{
            text-align: left;
        }
    </style>
</head>
<body>
<div class="container" style="margin-top: -30px;">
<div class="row">
    <div class="col-md-12">
       <table width="100%">
           <tr>
               <td class="text-center" width="15%">
                   <img  src="{{public_path('/uploads/intelpoly/1657359232.png')}}" style="width: 100px; height: 100px;">
               </td>
               <td class="text-center" width="85%">
                <h1 style="text-transform: uppercase; color: #009879; "><strong>{{$institution->name}}</strong></h1>
                <h5 style="margin-top: -10px;"><strong>Tel: {{$institution->phone_first}} | website: {{$institution->website}} | Email: {{$institution->email}}</strong></h5>
                <h5 style="margin-top: -20px;"><strong>{{$institution->address}}</strong></h5>
            </td>

           </tr>
       </table>
       <div style="margin-top: -30px;">
        <h4 style="text-transform: uppercase; color: #009879; text-align: center; border-bottom: 2px solid #009879;  padding:5px;"><strong>Student's End of Semester Report Form</strong></h4>
       </div>
    </div>


    <div style="width: 100%">
        <div style="width: 60%; float: left;">

               <p style="margin-top: -15px;"><strong>Reg. Number:</strong> {{$user->reg_number}}</p>
               <p style="margin-top: -15px;"><strong>Full Name:</strong> {{$user->first_name}} {{$user->middle_name}} {{$user->last_name}}</p>
               <p style="margin-top: -15px;"><strong>Faculty: </strong></p>
               <p style="margin-top: -15px;"><strong>Department:</strong> </p>
        </div>

        <div style="width: 25%; float: left; margin-left: 0px;">
                <p style="margin-top: -15px;"><strong>Level:</strong> 100L</p>
                <p style="margin-top: -15px;"><strong>Semester:</strong> First</p>
                <p style="margin-top: -15px;"><strong>Session:</strong> {{$registered[0]['session']['name']}}</p>
        </div>

        <div style="width:15%; float: right;">
              <p style="margin-top: -10px; margin-left: 0px;"><img @if($user->image == 'default.png') src="{{ public_path('/uploads/default.png') }}" @else src="{{public_path('/uploads/users/').$user->image}}" @endif style="width: 100px; height: 100px;"></p>
        </div>
    </div>

    <div style="width: 100%; overflow: auto; clear:both; margin-top: 30px;">
        <div class="col-md-12">
            <table class="styled-table">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 7%;">S/N</th>
                        <th class="text-center"  style="width: 12%;">Code</th>
                        <th style="width: 50%;">Course Title</th>
                        <th class="text-center" style="width: 7%;" >Credits</th>
                        @php
                            $showMarks = App\Models\ResultSettings::where('institution_id', $institution->id)->first();
                        @endphp
                        @if($showMarks->show_marks == 1)
                        <th class="text-center"  style="width: 7%;">Marks</th>
                        @endif
                        <th class="text-center"  style="width: 7%;">Grade</th>
                        <th class="text-center"  style="width: 7%;">GP</th>
                        <th class="text-center"  style="width: 7%;">PE</th>
                        <th class="text-center"  style="width: 13%;">Remarks</th>
                    </tr>
                </thead>
                @php
                    $total_pe = 0;
                    $total_credits = 0;
                    $total_co = 0;
                    $cos = [];
                @endphp

                <tbody>
                    @foreach($registered as $key => $course)
                        @php
                            $exam = App\Models\Mark::where('institution_id',$institution->id)
                                                ->where('course_id',$course->course_id)
                                                ->where('user_id', $user->id)
                                                ->where('type','exam')
                                                ->first()->marks;
                            $ca = App\Models\Mark::where('institution_id',$institution->id)
                                                ->where('course_id', $course->course_id)
                                                ->where('user_id', $user->id)
                                                ->where('type','!=','exam')
                                                ->sum('marks');
                            
                            

                            $total_score = $exam + $ca;
                            if($total_score <= 39){
                                $total_co += $course['course']['credit_unit'];
                                array_push($cos, $course['course']['course_code']);
                            }
                        @endphp
                        <tr>
                            <td class="text-center">{{$key+1}}</td>
                            <td class="text-center">{{$course['course']['course_code']}}</td>
                            <td class="text-left">{{$course['course']['course_title']}}</td>
                            <td class="text-center">{{$course['course']['credit_unit']}}</td>
                            @if($showMarks->show_marks == 1)
                                <td class="text-center">{{ $total_score }}</td>
                            @endif
                            @php
                                $grade_marks = App\Models\Grade::where([['start_mark','<=',(int)$total_score],['end_mark','>=',(int)$total_score]])->first();
                                $letter_grade = $grade_marks->letter_grade;
                                $remark = $grade_marks->remarks;
                                $numerical_grade = $grade_marks->numerical_grade;
                                $pe = (float)$numerical_grade*(float)$course['course']['credit_unit'];
                                $total_credits = $total_credits+$course['course']['credit_unit'];
                                $total_pe = (float)$total_pe+(float)$pe;
                                $gpa = $total_pe/$total_credits;
                            @endphp
                             <td class="text-center">{{$letter_grade}}</td>
                             <td class="text-center">{{$numerical_grade}}</td>
                             <td class="text-center">{{$pe}}</td>
                             <td class="text-left">{{$remark}}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3"></td>
                        <td colspan="{{ $showMarks->show_marks == 1? 6:5}}" class="text-center"><strong>GPA  &nbsp;=&nbsp; {{number_format((float)$gpa,2)}}</strong></td>
                    </tr>

                    <tr>
                        <td colspan="3"></td>
                        <td colspan="{{ $showMarks->show_marks == 1? 6:5}}" class="text-center"><strong>TPE = {{number_format((float)$total_pe,2)}} | TCR = {{number_format((float)$total_credits,2)}} | TCE = {{number_format(($total_credits-$total_co),2)}} </strong></td>
                    </tr>
                </tbody>
            </table>
            {{-- store points --}}
            @php
                $data = App\Models\StoredPoints::where('institution_id',$institution->id)->where('level_order',1)->where('semester','first')->where('user_id',$user->id)->first();
                if($data)
                {
                    $data->tcr = $total_credits;
                    $data->tce = $total_credits-$total_co;
                    $data->tpe = $total_pe;
                    $data->gpa = $gpa;
                    if($cos == []){
                        $data->cos = '';
                    }else{
                        $data->cos = implode(',', $cos);
                    }
                    $data->update();

                }else
                {
                    $data = new App\Models\StoredPoints();
                    $data->institution_id = $institution->id;
                    $data->level_order = 1;
                    $data->semester = 'first';
                    $data->user_id = $user->id;
                    $data->tcr = $total_credits;
                    $data->tce = $total_credits-$total_co;
                    $data->tpe = $total_pe;
                    $data->gpa = $gpa;
                    if($cos == []){
                        $data->cos = '';
                    }else{
                        $data->cos = implode(',', $cos);
                    }
                    $data->save();
                }
               
            @endphp

            {{-- display cos --}}
            @if (!empty($cos))
            <div style="margin-top: 10px;">
            <strong>Remarks:</strong> Courses To Carry Over:
            @foreach ($cos as $co)
              {{$co}}
              @if (!$loop->last)
              ,
              @endif
            @endforeach
            </div>
            @endif

            {{-- <p style="text-align: center; text-transform: uppercase; width: 100%; border-bottom: 2px solid black; padding: 5px;">Certification by Head of Department</p>
            <p style="text-align: center; width: 35%; margin-left: 30%; margin-top: 7%; border-top: 1px solid black; padding: 5px;">Head of Department</p> --}}

        </div>
    </div>
    <div style=" width: 100%; overflow: auto; clear:both; margin-top: 20px;">
        <div style="width: 20%; float: left; text-align: center;">
            <img src="{{ public_path('/uploads/qr-code.png')}}" style="width: 100px; height: 100px;">
        </div>

        <div style="width: 80%; float: right;">
            <p style="font-size: 12px;">GP = Grade point, PE = Points Earned (Credits X GP), TCR = Total Credits Registered, TCE = Total Credits Earned, TPE = Total Points Earned, CCR = Cummulative Credits Registered, CCE = Cummulative Credits Earned, CPE = Cummulative Points Earned, CGPA = Cummulative Grade Point Average, GPA = Grade Point Average</p>
        </div>
    </div>

    <div style=" width: 100%; margin-top: -100px; clear: both;">
            <p style="font-size: 14px; text-align: center; margin-top: -5px;">THIS REPORT DOES NOT REQUIRE SIGNATURE</p>
    </div>
    <div style=" width: 100%; margin-top: -20px;">
        <p style="font-size: 13px; text-align: center">Generated on {{date("l, jS \of F Y ")}} @ {{date("h:i A")}}</p>
    </div>

</div>
</body>
</html>

