<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
	<link type="text/css" rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
	<!--<link rel="stylesheet" href="{{asset('pdfstyle.css')}}"/>-->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
	<div class="container">
	<div class="col-md-12">
		<div class="invoice">
			<!-- begin invoice-company -->
			<div class="invoice-company text-inverse f-w-600 text-center mt-3">
				<span class="pull-right hidden-print text-center">
				<h5><strong>Employee Performance Review</strong></h5>
				</span>
			</div>
			<div class="invoice-from mt-3">
				Employee Name: {{ $employee }}<br/>
				Company: {{ $company }}<br/>
				Position: {{ $position }}<br/>
				Reviewer: {{ $reviewer }}<br/><br/>
				<small>Date:</small>
               	<div class="m-t-5 m-b-5">
                  <strong class="text-inverse">{{ $date }}</strong><br>
				</div>
            </div>
			<!-- begin invoice-content -->
			<div class="invoice-content">
				<!-- begin table-responsive -->
				<div class="table-responsive">
				<table cellspacing="0" cellpadding="0" width="100%" style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: 'Open Sans', sans-serif; background-color:#f2f3f8; border:0;" class="table table-invoice mt-5 border border-primary">
					<thead>
						<tr style="background-color:#5A21EB;" class="text-white">
							<th>Performance evaluation</th>
							<th class="text-center" width="10%">Excellent</th>
							<th class="text-center" width="10%">Good</th>
							<th class="text-center" width="20%">Fair</th>
							<th class="text-center" width="20%">Poor</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="border-right">
							<span class="text-inverse">Job knowledge</span><br>
							</td>
							<td class="text-center border-right">@if($job_knowledge == 1){{ "X" }}@endif</td>
							<td class="text-center border-right">@if($job_knowledge == 2){{ "X" }}@endif</td>
							<td class="text-center border-right">@if($job_knowledge == 3){{ "X" }}@endif</td>
							<td class="text-center">@if($job_knowledge == 4){{ "X" }}@endif</td>
						</tr>
						<tr>
							<td class="border-right">
							<span class="text-inverse">Productivity</span><br>
							</td>
							<td class="text-center border-right">@if($productivity == 1){{ "X" }}@endif</td>
							<td class="text-center border-right">@if($productivity == 2){{ "X" }}@endif</td>
							<td class="text-center border-right">@if($productivity == 3){{ "X" }}@endif</td>
							<td class="text-center">@if($productivity == 4){{ "X" }}@endif</td>
						</tr>
						<tr>
							<td class="border-right">
							<span class="text-inverse">Work quality</span><br>
							</td>
							<td class="text-center border-right">@if($work_quality == 1){{ "X" }}@endif</td>
							<td class="text-center border-right">@if($work_quality == 2){{ "X" }}@endif</td>
							<td class="text-center border-right">@if($work_quality == 3){{ "X" }}@endif</td>
							<td class="text-center">@if($work_quality == 4){{ "X" }}@endif</td>
						</tr>
						<tr>
							<td class="border-right">
							<span class="text-inverse">Technical skills</span><br>
							</td>
							<td class="text-center border-right">@if($technical_skills == 1){{ "X" }}@endif</td>
							<td class="text-center border-right">@if($technical_skills == 2){{ "X" }}@endif</td>
							<td class="text-center border-right">@if($technical_skills == 3){{ "X" }}@endif</td>
							<td class="text-center">@if($technical_skills == 4){{ "X" }}@endif</td>
						</tr>
						<tr>
							<td class="border-right">
							<span class="text-inverse">Work consistency</span><br>
							</td>
							<td class="text-center border-right">@if($work_consistency == 1){{ "X" }}@endif</td>
							<td class="text-center border-right">@if($work_consistency == 2){{ "X" }}@endif</td>
							<td class="text-center border-right">@if($work_consistency == 3){{ "X" }}@endif</td>
							<td class="text-center">@if($work_consistency == 4){{ "X" }}@endif</td>
						</tr>
						<tr>
							<td class="border-right">
							<span class="text-inverse">Enthusiasm</span><br>
							</td>
							<td class="text-center border-right">@if($enthusiasm == 1){{ "X" }}@endif</td>
							<td class="text-center border-right">@if($enthusiasm == 2){{ "X" }}@endif</td>
							<td class="text-center border-right">@if($enthusiasm == 3){{ "X" }}@endif</td>
							<td class="text-center">@if($enthusiasm == 4){{ "X" }}@endif</td>
						</tr>
						<tr>
							<td class="border-right">
							<span class="text-inverse">Cooperation</span><br>
							</td>
							<td class="text-center border-right">@if($cooperation == 1){{ "X" }}@endif</td>
							<td class="text-center border-right">@if($cooperation == 2){{ "X" }}@endif</td>
							<td class="text-center border-right">@if($cooperation == 3){{ "X" }}@endif</td>
							<td class="text-center">@if($cooperation == 4){{ "X" }}@endif</td>
						</tr>
						<tr>
							<td class="border-right">
							<span class="text-inverse">Attitude</span><br>
							</td>
							<td class="text-center border-right">@if($attitude == 1){{ "X" }}@endif</td>
							<td class="text-center border-right">@if($attitude == 2){{ "X" }}@endif</td>
							<td class="text-center border-right">@if($attitude == 3){{ "X" }}@endif</td>
							<td class="text-center">@if($attitude == 4){{ "X" }}@endif</td>
						</tr>
						<tr>
							<td class="border-right">
							<span class="text-inverse">Initiative</span><br>
							</td>
							<td class="text-center border-right">@if($initiative == 1){{ "X" }}@endif</td>
							<td class="text-center border-right">@if($initiative == 2){{ "X" }}@endif</td>
							<td class="text-center border-right">@if($initiative == 3){{ "X" }}@endif</td>
							<td class="text-center">@if($initiative == 4){{ "X" }}@endif</td>
						</tr>
						<tr>
							<td class="border-right">
							<span class="text-inverse">Work relations</span><br>
							</td>
							<td class="text-center border-right">@if($work_relations == 1){{ "X" }}@endif</td>
							<td class="text-center border-right">@if($work_relations == 2){{ "X" }}@endif</td>
							<td class="text-center border-right">@if($work_relations == 3){{ "X" }}@endif</td>
							<td class="text-center">@if($work_relations == 4){{ "X" }}@endif</td>
						</tr>
						<tr>
							<td class="border-right">
							<span class="text-inverse">Creativity</span><br>
							</td>
							<td class="text-center border-right">@if($creativity == 1){{ "X" }}@endif</td>
							<td class="text-center border-right">@if($creativity == 2){{ "X" }}@endif</td>
							<td class="text-center border-right">@if($creativity == 3){{ "X" }}@endif</td>
							<td class="text-center">@if($creativity == 4){{ "X" }}@endif</td>
						</tr>
						<tr>
							<td class="border-right">
							<span class="text-inverse">Punctuality</span><br>
							</td>
							<td class="text-center border-right">@if($punctuality == 1){{ "X" }}@endif</td>
							<td class="text-center border-right">@if($punctuality == 2){{ "X" }}@endif</td>
							<td class="text-center border-right">@if($punctuality == 3){{ "X" }}@endif</td>
							<td class="text-center">@if($punctuality == 4){{ "X" }}@endif</td>
						</tr>
						<tr>
							<td class="border-right">
							<span class="text-inverse">Attendance</span><br>
							</td>
							<td class="text-center border-right">@if($attendance == 1){{ "X" }}@endif</td>
							<td class="text-center border-right">@if($attendance == 2){{ "X" }}@endif</td>
							<td class="text-center border-right">@if($attendance == 3){{ "X" }}@endif</td>
							<td class="text-center">@if($attendance == 4){{ "X" }}@endif</td>
						</tr>
						<tr>
							<td class="border-right">
							<span class="text-inverse">Dependability</span><br>
							</td>
							<td class="text-center border-right">@if($dependability == 1){{ "X" }}@endif</td>
							<td class="text-center border-right">@if($dependability == 2){{ "X" }}@endif</td>
							<td class="text-center border-right">@if($dependability == 3){{ "X" }}@endif</td>
							<td class="text-center">@if($dependability == 4){{ "X" }}@endif</td>
						</tr>
						<tr>
							<td class="border-right">
							<span class="text-inverse">Communication skills</span><br>
							</td>
							<td class="text-center border-right">@if($communication_skills == 1){{ "X" }}@endif</td>
							<td class="text-center border-right">@if($communication_skills == 2){{ "X" }}@endif</td>
							<td class="text-center border-right">@if($communication_skills == 3){{ "X" }}@endif</td>
							<td class="text-center">@if($communication_skills == 4){{ "X" }}@endif</td>
						</tr>
						<tr class="bg-white">
							<td class="border-right">
							<span class="text-inverse"><strong>Overall rating</strong></span><br>
							</td>
							<td class="text-center border-right">@if($overall_rating == 1){{ "X" }}@endif</td>
							<td class="text-center border-right">@if($overall_rating == 2){{ "X" }}@endif</td>
							<td class="text-center border-right">@if($overall_rating == 3){{ "X" }}@endif</td>
							<td class="text-center">@if($overall_rating == 4){{ "X" }}@endif</td>
						</tr>
					</tbody>
				</table>
				<table cellspacing="0" cellpadding="0" width="100%" style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: 'Open Sans', sans-serif; background-color:#f2f3f8; border:0;" class="table table-invoice mt-5 border border-primary">
					<thead>
						<tr style="background-color:#5A21EB;" class="text-white">
							<th>Reviewer comment</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
							<span class="text-inverse">{{ $comment }}</span><br>
							</td>
						</tr>
					</tbody>
				</table>
				</div>
				<!-- end table-responsive -->
			<!-- begin invoice-footer -->
			<div class="invoice-footer mt-2">
				<p class="text-center">
                    <span class="m-r-10" style="font-size: 12px"><em>Generated using <b>Smart Manager</b></em></span>
				</p>
			</div>
			<!-- end invoice-footer -->
		</div>
	</div>
	</div>
</body>
</html>
