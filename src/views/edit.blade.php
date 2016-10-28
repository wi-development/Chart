@extends('dashboard::layouts.master-aside')
<?php
$frmHeader = "Verzuimvenster '".$chart->name."' wijzigen van '".$chart->company->name."'";
?>

@section('content')
    {{ Form::model($chart,['method'=>'PATCH', 'route'=>array('admin::chart.update',$chart->id), 'class'=>'form-horizontal xxpull-left foxrm-padding',
    'id'=>'chartjs','data-remote'=>'true']) }}

    <div id="content-container">


        <!--Page Title-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <div id="page-title">
            <h1 class="page-header text-overflow">Verzuimvenster beheer</h1>

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
            <li><a href="{{route('admin::dashboard')}}">Dashboard</a></li>
            <li><a href="{{route('admin::chart.all.index')}}">Alle verzuimvensters</a></li>
            <li class="active">Wijzigen</li>
        </ol>

        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End breadcrumb-->


        <!--Page content-->
        <!--===================================================-->
        <div id="page-content">
            <div class="row">
                    @include('errors.list')
                    <!-- BASIC FORM ELEMENTS -->
                    {{--@include('errors.sitemap')--}}
                    @include('chart::partials.form', ['submitButtonText' => 'Aanpassen','frmHeader' => ''.$frmHeader.''])
                    <!-- END BASIC FORM ELEMENTS -->
            </div>
        </div>

    </div>
        <!--===================================================-->
        <!--End page content-->

    <aside id="aside-container" class="aside-iot-fixed">
        @include('chart::partials.aside')
    </aside>
    {{ Form::close() }}
@endsection

@section('asidex')

@endsection



