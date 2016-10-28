@extends('dashboard::layouts.master')


@section('content')






		<!--Page Title-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<div id="page-title">
			<h1 class="page-header text-overflow">Verzuimvenster toevoegen</h1>

			<!--Searchbox-->
			<div class="searchbox">
				<div class="input-group custom-search-form">
					<input type="text" class="form-control" placeholder="Search..">
					<span class="input-group-btn">
								<button class="text-muted" type="button"><i class="fa fa-search"></i></button>
							</span>
				</div>
			</div>
		</div>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End page title-->


		<!--Breadcrumb-->
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<ol class="breadcrumb">
			<li><a href="#">Dashboard</a></li>
			<li><a href="{{route('admin::chart.all.index')}}">Alle verzuimvensters</a></li>
			<li class="active">Kies een klant</li>
		</ol>
		<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		<!--End breadcrumb-->




		<!--Page content-->
		<!--===================================================-->
		<div id="page-content">







			<div class="panel-body demo-nifty-modal">

				<!--Static Examplel-->
				<div class="modal-uit">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" data-dismiss="modal" class="close hidden"><span>×</span><span class="sr-only">Close</span></button>
								<h4 class="modal-title">Selecteer een klant</h4>
							</div>
							{!! Form::open(['method'=>'POST','action'=>'\WI\Chart\ChartController@beforeCreate']) !!}
							<div class="modal-body">


								<div class="form-group">
									{!! Form::label('company_id', 'Alle klanten:') !!}
									{!! Form::select('company_id', $companies,null, ['class' => 'form-control']) !!}
								</div>

							</div>

							<div class="modal-footer">
								{!! Form::submit('Maak verzuimvenster', ['class' => 'btn btn-primary']) !!}
							</div>
							{!! Form::close() !!}
						</div>
					</div>
				</div>

			</div>



		</div>
		<!--===================================================-->
		<!--End page content-->





@endsection


