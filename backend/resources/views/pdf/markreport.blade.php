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
				Job: {{ $position }}<br/>
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
							<td class="text-center border-right">@if($job_knowledge == "excellent"){{ "X" }}@endif</td>
							<td class="text-center border-right">@if($job_knowledge == "good"){{ "X" }}@endif</td>
							<td class="text-right border-right">@if($job_knowledge == "fair"){{ "X" }}@endif</td>
							<td class="text-right">@if($job_knowledge == "poor"){{ "X" }}@endif</td>
						</tr>
						<tr>
							<td class="border-right">
							<span class="text-inverse">Productivity</span><br>
							</td>
							<td class="text-center border-right">@if($productivity == "excellent"){{ "X" }}@endif</td>
							<td class="text-center border-right">@if($productivity == "good"){{ "X" }}@endif</td>
							<td class="text-right border-right">@if($productivity == "fair"){{ "X" }}@endif</td>
							<td class="text-right">@if($productivity == "poor"){{ "X" }}@endif</td>
						</tr>
						<tr>
							<td class="border-right">
							<span class="text-inverse">Work quality</span><br>
							</td>
							<td class="text-center border-right">@if($work_quality == "excellent"){{ "X" }}@endif</td>
							<td class="text-center border-right">@if($work_quality == "good"){{ "X" }}@endif</td>
							<td class="text-right border-right">@if($work_quality == "fair"){{ "X" }}@endif</td>
							<td class="text-right">@if($work_quality == "poor"){{ "X" }}@endif</td>
						</tr>
						<tr>
							<td class="border-right">
							<span class="text-inverse">Technical skills</span><br>
							</td>
							<td class="text-center border-right">@if($technical_skills == "excellent"){{ "X" }}@endif</td>
							<td class="text-center border-right">@if($technical_skills == "good"){{ "X" }}@endif</td>
							<td class="text-right border-right">@if($technical_skills == "fair"){{ "X" }}@endif</td>
							<td class="text-right">@if($technical_skills == "poor"){{ "X" }}@endif</td>
						</tr>
						<tr>
							<td class="border-right">
							<span class="text-inverse">Work consistency</span><br>
							</td>
							<td class="text-center border-right">@if($work_consistency == "excellent"){{ "X" }}@endif</td>
							<td class="text-center border-right">@if($work_consistency == "good"){{ "X" }}@endif</td>
							<td class="text-right border-right">@if($work_consistency == "fair"){{ "X" }}@endif</td>
							<td class="text-right">@if($work_consistency == "poor"){{ "X" }}@endif</td>
						</tr>
						<tr>
							<td class="border-right">
							<span class="text-inverse">Enthusiasm</span><br>
							</td>
							<td class="text-center border-right">@if($enthusiasm == "excellent"){{ "X" }}@endif</td>
							<td class="text-center border-right">@if($enthusiasm == "good"){{ "X" }}@endif</td>
							<td class="text-right border-right">@if($enthusiasm == "fair"){{ "X" }}@endif</td>
							<td class="text-right">@if($enthusiasm == "poor"){{ "X" }}@endif</td>
						</tr>
						<tr>
							<td class="border-right">
							<span class="text-inverse">Cooperation</span><br>
							</td>
							<td class="text-center border-right">@if($cooperation == "excellent"){{ "X" }}@endif</td>
							<td class="text-center border-right">@if($cooperation == "good"){{ "X" }}@endif</td>
							<td class="text-right border-right">@if($cooperation == "fair"){{ "X" }}@endif</td>
							<td class="text-right">@if($cooperation == "poor"){{ "X" }}@endif</td>
						</tr>
						<tr>
							<td class="border-right">
							<span class="text-inverse">Attitude</span><br>
							</td>
							<td class="text-center border-right">@if($attitude == "excellent"){{ "X" }}@endif</td>
							<td class="text-center border-right">@if($attitude == "good"){{ "X" }}@endif</td>
							<td class="text-right border-right">@if($attitude == "fair"){{ "X" }}@endif</td>
							<td class="text-right">@if($attitude == "poor"){{ "X" }}@endif</td>
						</tr>
						<tr>
							<td class="border-right">
							<span class="text-inverse">Initiative</span><br>
							</td>
							<td class="text-center border-right">@if($initiative == "excellent"){{ "X" }}@endif</td>
							<td class="text-center border-right">@if($initiative == "good"){{ "X" }}@endif</td>
							<td class="text-right border-right">@if($initiative == "fair"){{ "X" }}@endif</td>
							<td class="text-right">@if($initiative == "poor"){{ "X" }}@endif</td>
						</tr>
						<tr>
							<td class="border-right">
							<span class="text-inverse">Work relations</span><br>
							</td>
							<td class="text-center border-right">@if($work_relations == "excellent"){{ "X" }}@endif</td>
							<td class="text-center border-right">@if($work_relations == "good"){{ "X" }}@endif</td>
							<td class="text-right border-right">@if($work_relations == "fair"){{ "X" }}@endif</td>
							<td class="text-right">@if($work_relations == "poor"){{ "X" }}@endif</td>
						</tr>
						<tr>
							<td class="border-right">
							<span class="text-inverse">Creativity</span><br>
							</td>
							<td class="text-center border-right">@if($creativity == "excellent"){{ "X" }}@endif</td>
							<td class="text-center border-right">@if($creativity == "good"){{ "X" }}@endif</td>
							<td class="text-right border-right">@if($creativity == "fair"){{ "X" }}@endif</td>
							<td class="text-right">@if($creativity == "poor"){{ "X" }}@endif</td>
						</tr>
						<tr>
							<td class="border-right">
							<span class="text-inverse">Punctuality</span><br>
							</td>
							<td class="text-center border-right">@if($punctuality == "excellent"){{ "X" }}@endif</td>
							<td class="text-center border-right">@if($punctuality == "good"){{ "X" }}@endif</td>
							<td class="text-right border-right">@if($punctuality == "fair"){{ "X" }}@endif</td>
							<td class="text-right">@if($punctuality == "poor"){{ "X" }}@endif</td>
						</tr>
						<tr>
							<td class="border-right">
							<span class="text-inverse">Attendance</span><br>
							</td>
							<td class="text-center border-right">@if($attendance == "excellent"){{ "X" }}@endif</td>
							<td class="text-center border-right">@if($attendance == "good"){{ "X" }}@endif</td>
							<td class="text-right border-right">@if($attendance == "fair"){{ "X" }}@endif</td>
							<td class="text-right">@if($attendance == "poor"){{ "X" }}@endif</td>
						</tr>
						<tr>
							<td class="border-right">
							<span class="text-inverse">Dependability</span><br>
							</td>
							<td class="text-center border-right">@if($dependability == "excellent"){{ "X" }}@endif</td>
							<td class="text-center border-right">@if($dependability == "good"){{ "X" }}@endif</td>
							<td class="text-right border-right">@if($dependability == "fair"){{ "X" }}@endif</td>
							<td class="text-right">@if($dependability == "poor"){{ "X" }}@endif</td>
						</tr>
						<tr>
							<td class="border-right">
							<span class="text-inverse">Communication skills</span><br>
							</td>
							<td class="text-center border-right">@if($communication_skills == "excellent"){{ "X" }}@endif</td>
							<td class="text-center border-right">@if($communication_skills == "good"){{ "X" }}@endif</td>
							<td class="text-right border-right">@if($communication_skills == "fair"){{ "X" }}@endif</td>
							<td class="text-right">@if($communication_skills == "poor"){{ "X" }}@endif</td>
						</tr>
						<tr class="bg-white">
							<td class="border-right">
							<span class="text-inverse"><strong>Overall rating</strong></span><br>
							</td>
							<td class="text-center border-right">@if($overall_rating == "excellent"){{ "X" }}@endif</td>
							<td class="text-center border-right">@if($overall_rating == "good"){{ "X" }}@endif</td>
							<td class="text-right border-right">@if($overall_rating == "fair"){{ "X" }}@endif</td>
							<td class="text-right">@if($overall_rating == "poor"){{ "X" }}@endif</td>
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
			<div class="invoice-footer mt-5">
				<p class="text-center">
				<span class="m-r-10"><i class="fa fa-fw fa-lg fa-globe"></i> {{ $company }}.com </span>
				</p>
			</div>
			<!-- end invoice-footer -->
		</div>
	</div>
	</div>
</body>
</html>