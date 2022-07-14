<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style type="text/css">
        table {
            border-collapse: collapse;
        }

        h2 h3 {
            margin: 0;
            padding: 0;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }

        .table tbody+tbody {
            border-top: 2px solid #dee2e6;
        }

        .table .table {
            background-color: #fff;
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
        }

        table tr td {
            padding: 5px;
        }

        .table-bordered thead th,
        .table-bordered td,
        .table-bordered th {
            border: 1px solid black !important;
        }

        .table-bordered thead th {
            background-color: #cacaca;
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
                            <img src="{{public_path('/uploads/').$institution->username.'/'.$institution->logo }}"
                                style="width: 100px; height: 100px;">
                        </td>
                        <td class="text-center" width="85%">
                            <h2 style="text-transform: uppercase;"><strong>{{ $institution->name }}</strong></h2>
                            @php
                                $session = App\Models\Session::where('id', $session_id)->first()->name;
                            @endphp
                            <h4 style="text-transform: uppercase; margin-top: -15px;"><strong>Department of {{ $students[0]['student']['department']['name']}}</strong></h4>
                            <p style="text-transform: uppercase; margin-top: -15px;">Submission to the Senate through
                                SBC through the Faculty Board (Results Summary)</p>
                        </td>

                    </tr>
                </table>
                <div style="margin-top: -25px;">
                    <p style="text-transform: uppercase; text-align: center; border-bottom: 2px solid black; border-top: 2px solid black; padding:5px;">
                        <strong>Session: </strong>{{ $session }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <strong>Semester: </strong>First &nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;<strong>Level: </strong>100L
                    </p>
                </div>
            </div>

            <div style="width: 100%; overflow: auto; clear:both; margin-top: 30px;">
                <div class="col-md-12">
                    <table border="1" width="100%" cellpadding="1" cellspacing="2">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 5%;">S/N</th>
                                <th class="tex-center" style="width: 15%;">Name</th>
                                <th class="text-center" style="width: 10%;">Reg. Number</th>
                                <th class="text-center" style="width: 5%;">TCR</th>
                                <th class="text-center" style="width: 5%;">TCE</th>
                                <th class="text-center" style="width: 5%;">GPA</th>
                                <th class="text-center" style="width: 15%;">Courses to Carry-over</th>
                                <th class="text-center" style="width: 10%;">Remarks</th>
                            </tr>
                        </thead>

                        @php
                            $total_pe = 0;
                            $total_credits = 0;
                            $total_co = 0;
                            $cos = [];
                            $absents = [];
                            $co_students = [];
                            $withhold_check = App\Models\ResultSettings::where('institution_id', $institution->id)->first();
                        @endphp

                        <tbody>
                            @if($withhold_check->withhold == 1)

                                    @foreach ($students as $key => $student)

                                    @php
                                    $payment_check = App\Models\StudentProgress::where('institution_id', $institution->id)
                                                                            ->where('session_id', $session_id)
                                                                            ->where('user_id', $student->user_id)
                                                                            ->first();
                                    @endphp

                                    @if( @$payment_check->payment != 1)
                                    
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td class="text-left">{{ $student['student']['first_name'] }} {{ $student['student']['middle_name'] }} {{ $student['student']['last_name'] }}</td>
                                        <td class="text-left">{{ $student['student']['reg_number'] }} </td>
                                        <td colspan="5" style="background-color: #d89d9d9f; color:#fff; text-align:center">Result Witheld Due to Non-payment of Fees</td>
                                    </tr>

                                    @else
                                    @php
                                        $courses = App\Models\CRF::where('institution_id', $institution->id)
                                                                ->where('user_id', $student->user_id)
                                                                ->where('level_order', 1)
                                                                ->where('semester', 'first')
                                                                ->get();
                                    @endphp

                                    @foreach($courses as $course)
                                    
                                        @php
                                            $exam = App\Models\Mark::where('institution_id',$institution->id)
                                                                ->where('course_id',$course->course_id)
                                                                ->where('user_id', $student->user_id)
                                                                ->where('type','exam')
                                                                ->first();
                                            $ca = App\Models\Mark::where('institution_id',$institution->id)
                                                                ->where('course_id', $course->course_id)
                                                                ->where('user_id', $student->user_id)
                                                                ->where('type','!=','exam')
                                                                ->sum('marks');
                                            
                                            
                                            if($exam->absent == 'absent')
                                            {
                                                array_push($absents, $exam->course_id);
                                            }

                                            $total_score = $exam->marks + $ca;
                                            if($total_score <= 39){
                                                $total_co += $course['course']['credit_unit'];
                                                array_push($cos, $course['course']['course_code']);
                                                array_push($co_students, $student->user_id);

                                                $data = App\Models\StoredCO::where('institution_id',$institution->id)
                                                                            ->where('level_order',1)
                                                                            ->where('semester','first')
                                                                            ->where('user_id', $student->user_id)
                                                                            ->where('course_id', $course->course_id)
                                                                            ->first();
                                                if(!$data)
                                                {
                                                    $data = new App\Models\StoredCO();
                                                    $data->institution_id = $institution->id;
                                                    $data->level_order = 1;
                                                    $data->semester = 'first';
                                                    $data->user_id = $student->user_id;
                                                    $data->course_id = $course->course_id;
                                                    $data->save();
                                
                                                }
                                            
                                            }

                                            $grade_marks = App\Models\Grade::where([['start_mark','<=',(int)$total_score],['end_mark','>=',(int)$total_score]])->first();
                                            $numerical_grade = @$grade_marks->numerical_grade;
                                            $pe = (float)$numerical_grade*(float)$course['course']['credit_unit'];
                                            $total_credits = $total_credits+$course['course']['credit_unit'];
                                            $total_pe = (float)$total_pe+(float)$pe;
                                        @endphp
                                    @endforeach

                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td class="text-left">{{ $student['student']['first_name'] }} {{ $student['student']['middle_name'] }} {{ $student['student']['last_name'] }}</td>
                                        <td class="text-left">{{ $student['student']['reg_number'] }} </td>
                                        <td class="text-center">{{ $total_credits }}</td>
                                        <td class="text-center">{{ $total_pe }}</td>
                                            @php
                                            $gpa = number_format($total_pe/$total_credits, 2);
                                            @endphp
                                        <td class="text-center">{{ $gpa }}</td>
                                        <td>
                                        @if (!empty($cos))
                                            @foreach ($cos as $co)
                                                {{$co}}@if(!$loop->last), @endif
                                            @endforeach
                                        @endif
                                        </td>
                                        <td>
                                            @foreach ($absents as $absent)
                                            @if($loop->first)Absent in @endif  @php $code = App\Models\Course::find($absent)->course_code @endphp {{ $code }} @if(!$loop->last), @endif
                                            @endforeach
                                        </td>
                                    </tr>

                                    @php
                                    $data = App\Models\StoredPoints::where('institution_id',$institution->id)->where('level_order',1)->where('semester','first')->where('user_id', $student->user_id)->first();
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
                                        $data->user_id = $student->user_id;
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

                                    @php
                                        $total_pe = 0;
                                        $total_credits = 0;
                                        $total_co = 0;
                                        $cos = [];
                                        $absents = [];
                                        // $co_students = [];
                                    @endphp
                                    @endif
                                @endforeach
                            @else
                                @foreach ($students as $key => $student)


                                    @php
                                        $courses = App\Models\CRF::where('institution_id', $institution->id)
                                                                ->where('user_id', $student->user_id)
                                                                ->where('level_order', 1)
                                                                ->where('semester', 'first')
                                                                ->get();
                                    @endphp

                                    @foreach($courses as $course)
                                    
                                        @php
                                            $exam = App\Models\Mark::where('institution_id',$institution->id)
                                                                ->where('course_id',$course->course_id)
                                                                ->where('user_id', $student->user_id)
                                                                ->where('type','exam')
                                                                ->first();
                                            $ca = App\Models\Mark::where('institution_id',$institution->id)
                                                                ->where('course_id', $course->course_id)
                                                                ->where('user_id', $student->user_id)
                                                                ->where('type','!=','exam')
                                                                ->sum('marks');
                                            
                                            
                                            if($exam->absent == 'absent')
                                            {
                                                array_push($absents, $exam->course_id);
                                            }

                                            $total_score = $exam->marks + $ca;
                                            if($total_score <= 39){
                                                $total_co += $course['course']['credit_unit'];
                                                array_push($cos, $course['course']['course_code']);
                                                array_push($co_students, $student->user_id);

                                                $data = App\Models\StoredCO::where('institution_id',$institution->id)
                                                                            ->where('level_order',1)
                                                                            ->where('semester','first')
                                                                            ->where('user_id', $student->user_id)
                                                                            ->where('course_id', $course->course_id)
                                                                            ->first();
                                                if(!$data)
                                                {
                                                    $data = new App\Models\StoredCO();
                                                    $data->institution_id = $institution->id;
                                                    $data->level_order = 1;
                                                    $data->semester = 'first';
                                                    $data->user_id = $student->user_id;
                                                    $data->course_id = $course->course_id;
                                                    $data->save();
                                
                                                }
                                            
                                            }

                                            $grade_marks = App\Models\Grade::where([['start_mark','<=',(int)$total_score],['end_mark','>=',(int)$total_score]])->first();
                                            $numerical_grade = @$grade_marks->numerical_grade;
                                            $pe = (float)$numerical_grade*(float)$course['course']['credit_unit'];
                                            $total_credits = $total_credits+$course['course']['credit_unit'];
                                            $total_pe = (float)$total_pe+(float)$pe;
                                        @endphp
                                    @endforeach

                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td class="text-left">{{ $student['student']['first_name'] }} {{ $student['student']['middle_name'] }} {{ $student['student']['last_name'] }}</td>
                                        <td class="text-left">{{ $student['student']['reg_number'] }} </td>
                                        <td class="text-center">{{ $total_credits }}</td>
                                        <td class="text-center">{{ $total_pe }}</td>
                                            @php
                                            $gpa = number_format($total_pe/$total_credits, 2);
                                            @endphp
                                        <td class="text-center">{{ $gpa }}</td>
                                        <td>
                                        @if (!empty($cos))
                                            @foreach ($cos as $co)
                                                {{$co}}@if(!$loop->last), @endif
                                            @endforeach
                                        @endif
                                        </td>
                                        <td>
                                            @foreach ($absents as $absent)
                                            @if($loop->first)Absent in @endif  @php $code = App\Models\Course::find($absent)->course_code @endphp {{ $code }} @if(!$loop->last), @endif
                                            @endforeach
                                        </td>
                                    </tr>

                                    @php
                                    $data = App\Models\StoredPoints::where('institution_id',$institution->id)->where('level_order',1)->where('semester','first')->where('user_id', $student->user_id)->first();
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
                                        $data->user_id = $student->user_id;
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

                                    @php
                                        $total_pe = 0;
                                        $total_credits = 0;
                                        $total_co = 0;
                                        $cos = [];
                                        $absents = [];
                                        // $co_students = [];
                                    @endphp
                                
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <div style="width: 45%; overflow: auto; clear:both; margin-top: 30px;">
                <div class="col-md-12">
                    <h4 class="text-center">Summary of The Result</h4>
                    <table border="1" width="100%" cellpadding="1" cellspacing="2" style="padding-left: 10px;">
                        <tbody>
                            <tr>
                                <th class="text-left">Total No. of Registered Students</th>
                                <td>{{ $students->count() }}</td>
                            </tr>
                            @php
                                $co_students_unique = array_unique($co_students);
                                $co_students_count = count($co_students_unique);
                            @endphp
                            <tr>
                                <th class="text-left">No. of Students with Clear Passes</th>
                                <td>{{ $students->count() - $co_students_count }}</td>
                            </tr>
                            <tr>
                                <th class="text-left">No. of Students with Carry Over</th>
                                <td>{{ $co_students_count }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div style="width: 100%">
                <div style="width: 33%; float: left;">
                    <p style="text-align: center; width: 35%; margin-left: 20%; margin-top: 12%; border-top: 1px solid black; padding: 5px;">Level Coordinator</p>
                </div>

                <div style="width: 33%; float: left; margin-left: 0px;">
                    <p style="text-align: center; width: 35%; margin-left: 30%; margin-top: 12%; border-top: 1px solid black; padding: 5px;">Exam Officer</p>
                </div>

                <div style="width:33%; float: right;">
                    <p style="text-align: center; width: 35%; margin-left: 20%; margin-top: 12%; border-top: 1px solid black; padding: 5px;"> HOD</p>
                </div>
            </div>
            <div style=" width: 100%; margin-top: 50px;">
                <p style="font-size: 13px; text-align: center">Generated on {{ date('l, jS \of F Y ') }} @
                    {{ date('h:i A') }}</p>
            </div>
        </div>
</body>
</html>
