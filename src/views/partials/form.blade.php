


@section('css.head')
    <script src="/js/charts/assets/js/test.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.26/vue.min.js"></script>
    <link rel="stylesheet" href="/js/charts/assets/style.css" media="screen" title="no title">
    <script type="text/javascript" src="/js/charts/canvas2svg.js"></script>
@endsection

@section('scripts.footer')

    <script type="text/javascript" src="/js/charts/assets/js/chart.js"></script>
    <script type="text/javascript" src="/js/charts/assets/js/chartGridElements.js"></script>
    <script src="/js/wi-chart-form.js"></script>
    <script>
        getConfig({{$chart->id}})
    </script>

@endsection






<div class="col-lg-12 pull-left">
    <div class="panel">
        <div class="panel-heading">
            <div class="panel-control">

                <button class="dropdown-toggle btn btn-primary submit-sitemap" formnovalidate type="submit">
                    <i class="fa fa-spinner fa-spin fa-fw" style="display: none;"></i> Verzuimvenster opslaan
                </button>
                <div class="btn-group hidden">
                    <button data-toggle="dropdown" class="dropdown-toggle btn btn-info">
                        <i class="fa fa-gear fa-lg"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                    </ul>
                </div>
            </div>




            <h3 class="panel-title" >
                <?php
                $frmHeader = "Verzuimvenster '{{chart.name}}' wijzigen van '{{chart.company.name}}'";
                ?>{{$frmHeader}}
            </h3>
        </div>
        <div class="panel-body">

            @include('chart::partials.charts')





            @include('flash::message')



        </div>
        <div class="panel-footer">
            <small>info</small>
        </div>
    </div>

</div>