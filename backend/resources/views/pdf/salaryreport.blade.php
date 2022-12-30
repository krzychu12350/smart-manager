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
				<h5><strong>{{ $company }} Salary Report</strong></h5>
				</span>
			</div>
			<div class="invoice-from mt-3">
				For a period:<br/><br/>
				<small>From:</small>
               	<div class="m-t-5 m-b-5">
                  <strong class="text-inverse">{{ $dateFrom }}</strong><br>
				</div>
				<small>To:</small>
               	<div class="m-t-5 m-b-5">
                  <strong class="text-inverse">{{ $dateTo }}</strong><br>
				</div>
            </div>
			<!-- begin invoice-content -->
			<div class="invoice-content">
				<!-- begin table-responsive -->
				<div class="table-responsive">
				<table cellspacing="0" cellpadding="0" width="100%" style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: 'Open Sans', sans-serif; background-color:#f2f3f8; border:0;" class="table table-invoice mt-5 border border-primary">
					<thead>
						<tr style="background-color:#5A21EB;" class="text-white">
							<th>Occupation</th>
							<th class="text-center" width="10%">Minimum</th>
							<th class="text-center" width="10%">Maximum</th>
							<th class="text-right" width="20%">Average</th>
							<th class="text-right" width="20%">Mediana</th>
						</tr>
					</thead>
					<tbody>
						@foreach($salaries as $salary)
						<tr>
							<td>
							<span class="text-inverse">{{ $salary['position'] }}</span><br>
							</td>
							<td class="text-center">{{ $salary['min'] }}</td>
							<td class="text-center">{{ $salary['max'] }}</td>
							<td class="text-right">{{ $salary['avg'] }}</td>
							<td class="text-right">{{ $salary['mediana'] }}</td>
						</tr>
						@endforeach
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