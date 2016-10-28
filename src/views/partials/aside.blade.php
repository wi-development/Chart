
    <div id="aside">
        <div class="nano">
            <div class="nano-content">

                <!--Nav tabs-->
                <!--================================-->
                <ul class="nav nav-tabs nav-justified">
                    <li class="active">
                        <a href="#chart-aside-tab-1" data-toggle="tab">
                            <i class="pli-speech-bubble-7 hidden"></i>
                            <span class="badge badge-purple fa-lg hidden"><i class="fa fa-cog  fa-fw"></i>afdeling</span>
                            <div class="panel-controlx">
                                <i class="fa fa-cog fa-lg fa-fw"></i>
                                <span class="badge badge-purple hidden">afdeling</span>
                            </div>
                        </a>
                    </li>
                    <li class="active-uit">
                        <a href="#chart-aside-tab-2" data-toggle="tab">
                            <i class="fa fa-cogs fa-lg fa-fw"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#chart-aside-tab-3" data-toggle="tab">
                            <i class="fa fa-info fa-lg fa-fw"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#chart-aside-tab-4" data-toggle="tab">
                            <i class="fa fa-file-text fa-lg fa-fw"></i>
                        </a>
                    </li>
                </ul>
                <!--================================-->
                <!--End nav tabs-->



                <!-- Tabs Content -->
                <!--================================-->
                <div class="tab-content">

                    <!--First tab (Contact list)-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div class="tab-pane fade in active" id="chart-aside-tab-1">
                        <h4 class="pad-hor">
                            @{{thisDataset.label}}

                            <span class="pull-right badge" style="background:@{{thisDataset.backgroundColor}}">&nbsp;</span>
                        </h4>

                        <!-- Afdeling -->
                        <div class="panel-default">
                            <div class="panel-body">
                                <div class="row pad-btm">
                                    <div class="col-xs-12">
                                        <input v-model="thisDataset.label" class="form-control" v-on:keyup="updateChart" type='text'>
                                    </div>
                                </div>
                                <div class="row pad-btm">
                                    <div class="col-xs-7">
                                        <label for="exampleInputEmail1">
                                            <small>periode</small><br> verzuimpercentage
                                        </label>
                                    </div>
                                    <div class="col-xs-5">
                                        <input v-model="thisDataset.data[0].y" class="form-control" v-on:keyup="updateChart" type='number' min="0" max="11" step="1">
                                    </div>
                                </div>

                                <div class="row pad-btm">
                                    <div class="col-xs-7">
                                        <label for="exampleInputEmail1">
                                            <small>periode</small><br>meldingsfrequentie
                                        </label>
                                    </div>
                                    <div class="col-xs-5">
                                        <input v-model="thisDataset.data[0].x" class="form-control" v-on:keyup="updateChart" type='number' min="0" max="3" step="0.2">
                                    </div>
                                </div>

                            </div>
                        </div>

                        <hr class="bg-info mar-hor">


                        <!-- VERWIJDEREM -->
                        <div class="panel-default pad-hor">

                            <h4 class="xpad-hor">Afdeling toevoegen</h4>
                            <p>Klik hier om een afdeling toe te voegen.</p>
                            <div class="panel-xbody pad-hor">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <button id="addDataset" type="button" class="btn btn-md btn-warning col-xs-5 pull-right pad-top form-control">Afdeling toevoegen</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="bg-info mar-hor">


                        <!-- VERWIJDEREM -->
                        <div class="panel-default pad-hor">

                            <h4 class="xpad-hor">Afdeling verwijderen</h4>
                            <p>Klik hier om de afdeling '@{{thisDataset.label}}' te verwijderen</p>
                            <div class="panel-xbody pad-hor">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <button id="removeDataset" type="button" class="btn btn-md btn-danger col-xs-5 pull-right pad-top form-control">Deze afdeling verwijderen</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="bg-info mar-hor">











                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End first tab (Contact list)-->


                    <!--Second tab (Custom layout)-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div class="tab-pane fade" id="chart-aside-tab-2">




                            <h4 class="pad-hor">Instellingen</h4>
                            <div class="panel-boxdy pad-hor">


                                <!-- DOELSTELLING -->
                                <div class="row pad-x-btm">
                                    <div class="col-xs-7">
                                        <label for="exampleInputEmail1">
                                            <small>doelstelling voor het</small> verzuimpercentage
                                        </label>
                                    </div>
                                    <div class="col-xs-5">
                                        <input v-model="config.target.crossIndex[1]" class="form-control" v-on:keyup="updateChart" type='number' min="0" max="11" step="1">

                                    </div>
                                </div>

                                <div class="row pad-xbtm">
                                    <div class="col-xs-7">
                                        <label for="exampleInputEmail1">
                                            <small>doelstelling voor het</small> meldingsfrequentie
                                        </label>
                                    </div>
                                    <div class="col-xs-5">
                                        <input v-model="config.target.crossIndex[0]" class="form-control" v-on:keyup="updateChart" type='number' min="0" max="3" step="0.2">
                                    </div>
                                </div>

                                <div class="row pad-bxtm">
                                    <div class="col-xs-12">
                                        <label for="exampleInputEmail1">
                                            <small>toon begeleidende</small> tekst
                                        </label>
                                    </div>
                                    <div class="col-xs-12 paxd-no">
                                        <input v-model="config.target.displayTextValue" class="form-control" v-on:keyup="updateChart" type='text'>
                                    </div>
                                </div>

                                <hr class="bg-info" style="xmargin-top: 6px;xmargin-bottom: 6px;">

                                <div class="row pad-x">
                                    <div class="col-xs-12">
                                        <div class="checkbox" style="margin-top:0px">
                                            <label>
                                                <input v-model="config.beleid" type="checkbox"> toon beleid
                                            </label>
                                        </div>
                                        <hr class="bg-info" style="xmargin-top: 0px;xmargin-bottom: 0px;">
                                        <div class="checkbox" style="xmargin-bottom:0px">
                                            <label>
                                                <input v-model="config.tooltips" type="checkbox"> toon tooltips
                                            </label>
                                        </div>
                                        <hr class="bg-info" style="xmargin-top: 0px;xmargin-bottom: 0px;">
                                        <div class="checkbox" style="xmargin-bottom:0px">
                                            <label>
                                                <input v-model="config.brancheAverage.display" type="checkbox"> toon bedrijfsgemiddelde
                                            </label>
                                        </div>
                                    </div>
                                </div>


                                <div class="row pad-btm">
                                    <div class="col-xs-7">
                                        <label for="exampleInputEmail1">
                                            <small>branchegemiddelde voor het</small> verzuimpercentage
                                        </label>
                                    </div>
                                    <div class="col-xs-5">
                                        <input v-model="config.brancheAverage.crossIndex[1]" class="form-control" v-on:keyup="updateChart" type='number' min="0" max="11" step="1">
                                    </div>
                                </div>
                                <div class="row pad-bxtm">
                                    <div class="col-xs-7">
                                        <label for="exampleInputEmail1">
                                            <small>branchegemiddelde voor het</small> meldingsfrequentie
                                        </label>
                                    </div>
                                    <div class="col-xs-5">
                                        <input v-model="config.brancheAverage.crossIndex[0]" class="form-control" v-on:keyup="updateChart" type='number' max="3" step="0.2">
                                    </div>
                                </div>


                                <div class="row pad-bxtm">
                                    <div class="col-xs-12">
                                        <label for="exampleInputEmail1">
                                            <small>toon begeleidende</small> tekst
                                        </label>
                                    </div>
                                    <div class="col-xs-12 paxd-no">
                                        <input v-model="config.brancheAverage.displayTextValue" class="form-control" v-on:keyup="updateChart" type='text'>
                                    </div>
                                </div>

                                <hr class="bg-info" style="xmargin-top: 6px;xmargin-bottom: 6px;">


                                <div class="row pad-bxtm">
                                    <div class="col-xs-7">
                                        <label for="exampleInputEmail1">
                                            <smallx>Verzuimpercentage</smallx> Y-as
                                        </label>
                                    </div>
                                    <div class="col-xs-5">
                                        <input v-model="config.options.scales.yAxes.ticks.max" class="form-control" v-on:keyup="updateScale" type='number' min="0" max="30" step="1">
                                    </div>
                                </div>


                                <div class="row pad-bxtm">
                                    <div class="col-xs-7">
                                        <label for="exampleInputEmail1">
                                            <smallx>Meldingfrequentie</smallx> X-as
                                        </label>
                                    </div>
                                    <div class="col-xs-5">
                                        <input v-model="config.options.scales.xAxes.ticks.max" class="form-control" v-on:keyup="updateScale" type='number' min="0" max="10" step="0.2">
                                    </div>
                                </div>


                                <hr class="bg-info" style="xmargin-top: 6px;xmargin-bottom: 6px;">



                                <div class="row pad-bxtm">
                                    <div class="col-xs-7">
                                        <label for="exampleInputEmail1">
                                            <small>bolletjes</small> pointer grootte
                                        </label>
                                    </div>
                                    <div class="col-xs-5">
                                        <input v-model="config.options.elements.point.radius" class="form-control" v-on:keyup="updateScale" type='number'  min="0" max="16" step="1">
                                    </div>
                                </div>

                                <hr class="bg-info" style="xmargin-top: 6px;xmargin-bottom: 6px;">


                                <div class="row pad-bxtm">



                                    <div class="col-xs-12">
                                        <div class="checkbox" style="margin-top:0px">
                                            <label>
                                                <input v-model="config.chartbackground.text.display" type="checkbox"> toon achtergrond tekst
                                            </label>
                                        </div>
                                    </div>
                                </div>


                                <div class="row pad-bxtm">
                                    <div class="col-xs-12">
                                        <label for="exampleInputEmail1">
                                            achtergrond tekst:
                                        </label>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="radio">
                                            <label><input type="radio" id="t-left" value="left" v-model="config.chartbackground.text.align">links</label>
                                        </div>
                                        <div class="radio">
                                            <label><input type="radio" id="t-center" value="center" v-model="config.chartbackground.text.align">centreren</label>
                                        </div>
                                    </div>
                                </div>




                                <hr class="bg-info" style="xmargin-top: 6px;xmargin-bottom: 6px;">

                            </div>





                        <span class="hidden">
                        <!--Monthly billing-->
                        <div class="pad-all">
                            <h4>Billing &amp; reports</h4>
                            <p class="text-muted">Get <strong>$5.00</strong> off your next bill by making sure your full payment reaches us before August 5, 2016.</p>
                            <hr>
                            <span class="text-semibold">Amount Due On</span>
                            <p>August 17, 2016</p>
                            <p class="text-2x text-thin">$83.09</p>
                            <button class="btn btn-block btn-success mar-top">Pay Now</button>
                        </div>


                        <hr>

                        <h4 class="pad-hor">Additional Actions</h4>

                        <!--Simple Menu-->
                        <div class="list-group bg-trans">
                            <a href="#" class="list-group-item"><i class="pli-information icon-lg icon-fw"></i> Service Information</a>
                            <a href="#" class="list-group-item"><i class="pli-mine icon-lg icon-fw"></i> Usage Profile</a>
                            <a href="#" class="list-group-item"><span class="label label-info pull-right">New</span><i class="pli-credit-card-2 icon-lg icon-fw"></i> Payment Options</a>
                            <a href="#" class="list-group-item"><i class="pli-support icon-lg icon-fw"></i> Message Center</a>
                        </div>


                        <hr>

                        <div class="text-center">
                            <div><i class="pli-old-telephone icon-3x"></i></div>
                            Questions?
                            <p class="text-lg text-semibold"> (415) 234-53454 </p>
                            <small><em>We are here 24/7</em></small>
                        </div>
                        </span>
                    </div>
                    <!--End second tab (Custom layout)-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->


                    <!--Third tab (Settings)-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div class="tab-pane fade" id="chart-aside-tab-3">



                        <div class="panel-default">

                            <h4 class="pad-hor">Bestand <span class="badge pull-right"

                                                              v-bind:class="[chart.status == 'online' ? 'bg-success ' : '',chart.status == 'pending_review' ? 'bg-warning' : '',,chart.status == 'blueprint' ? 'bg-info' : '']"
                                >@{{chart.status}}</span></h4>

                            <div class="panel-xbody pad-hor">
                                <div class="row pad-hor">

                                    <div class="col-xs-12">

                                        <div class="form-group">
                                            <label for="name" class="control-label">Naam:</label>
                                            <input v-model="chart.name" id="name" name="name" class="form-control" v-on:keyup="updateChart" type='text'>
                                        </div>
                                        <div class="form-group" v-bind:class="[chart.status == 'blueprint' ? 'hidden' : '']">
                                            <label for="status" class="control-label">Status: @{{chart.status}}</label>


                                            <div class="pad-ver">
                                                <!--Radio buttons using the Font Awesome's icon -->
                                                <!--===================================================-->
                                                <label class="form-radio form-icon form-success form-text" v-bind:class="[chart.status == 'online' ? 'active' : '']">
                                                    <input id="status" name="status" type="radio" v-model="chart.status"
                                                           value="online"
                                                    > Online</label>
                                                <label class="form-radio form-icon form-silver form-text" v-bind:class="[chart.status == 'concept' ? 'active' : '']">
                                                    <input id="status" name="status" type="radio" v-model="chart.status"
                                                           value="concept"
                                                    > Concept</label>
                                                <label class="form-radio form-icon form-warning form-text" v-bind:class="[chart.status == 'pending_review' ? 'active' : '']">
                                                    <input id="status" name="status" type="radio" v-model="chart.status"
                                                           value="pending_review"
                                                    > Wacht op review</label>
                                                <!--===================================================-->

                                            </div>


                                        </div>

                                        <div class="form-group" style="margin-bottom:0px">
                                        <h4 class="form-group pad-no mar-no">Extra info</h4>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="control-label">Label: (?)</label>
                                            <input v-model="chart.label" id="label" name="label" class="form-control" v-on:keyup="updateChart" type='text'>
                                        </div>


                                        <div class="form-group">
                                            <label for="name" class="control-label">Omschrijving: (?)</label>
                                            <input v-model="chart.description" id="description" name="description" class="form-control" v-on:keyup="updateChart" type='text'>
                                        </div>

                                    </div>
                                    <div class="col-xs-5">

                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--Third tab (Settings)-->



                    <!--Fourth tab (Settings)-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div class="tab-pane fade" id="chart-aside-tab-4">



                        <!-- Nieuw venster -->
                        <div class="panel-default pad-hor">
                            <span class="label pull-right bg-danger">BETA!</span>
                            <h4 class="xpad-hor">Nieuw verzuimvenster</h4>
                            <p>Klik hier om de nieuw verzuimvenster toe te voegen</p>
                            <div class="panel-xbody pad-hor">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <input type="hidden" name="store_route" id="store_route" value="{{route('admin::chart.store')}}">
                                        <input type="hidden" name="company_id" id="company_id" value="{{$chart->company->id}}">
                                        <button id="newData" type="button" class="btn btn-md btn-warning col-xs-5 pull-right pad-top form-control">Verzuimvenster toevoegen</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="bg-info mar-hor">

                        <!-- OPVRAGEN -->
                        <div class="panel-default">

                            <h4 class="pad-hor">Verzuimvenster opvragen<small>
                                    <span class="label pull-right bg-danger mar-left">BETA!</span>
                                    <div id="getVerzuimvensters" txype="button" class="demo-panel-ref-btn bxtn pull-right btxn-default"><i class="fa fa-refresh" style="color:white"></i></div>

                                </small></h4>
                            <div class="panel-xbody pad-hor">
                                <div class="row pad-hor">






                                    <div class="form-group pad-hor">
                                        {!! Form::label('chart_id', 'Verzuimvensters:',['class'=>'hidden']) !!}
                                        {!! Form::select('chart_id',$company_charts , $chart->id,['class' => 'form-control pad-hor']) !!}
                                    </div>
                                    <div class="col-xs-12">
                                        <button id="getData" type="button" class="btn btn-md btn-success col-xs-5 pull-right pad-top form-control">Opvragen</button>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <hr class="bg-info mar-hor">








                        <ul class="list-group bg-trans">
                            <li class="pad-top list-header">
                                <h4>Demo</h4>
                            </li>
                            <li class="list-group-item">
                                <div class="pull-right">
                                    <input class="demo-switch" type="checkbox" checked>
                                </div>
                                <p>Show my personal status</p>
                                <small class="text-muted">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</small>
                            </li>
                            <li class="list-group-item">
                                <div class="pull-right">
                                    <input class="demo-switch" type="checkbox" checked>
                                </div>
                                <p>Show offline contact</p>
                                <small class="text-muted">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</small>
                            </li>
                            <li class="list-group-item">
                                <div class="pull-right">
                                    <input class="demo-switch" type="checkbox">
                                </div>
                                <p>Invisible mode </p>
                                <small class="text-muted">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</small>
                            </li>
                        </ul>


                        <hr>

                        <ul class="list-group pad-btm bg-trans">
                            <li class="list-header"><h4>Public Settings</h4></li>
                            <li class="list-group-item">
                                <div class="pull-right">
                                    <input class="demo-switch" type="checkbox" checked>
                                </div>
                                Online status
                            </li>
                            <li class="list-group-item">
                                <div class="pull-right">
                                    <input class="demo-switch" type="checkbox" checked>
                                </div>
                                Show offline contact
                            </li>
                            <li class="list-group-item">
                                <div class="pull-right">
                                    <input class="demo-switch" type="checkbox">
                                </div>
                                Show my device icon
                            </li>
                        </ul>



                        <hr>

                        <h4 class="pad-hor">Task Progress</h4>
                        <div class="pad-all">
                            <p>Upgrade Progress</p>
                            <div class="progress progress-sm">
                                <div class="progress-bar progress-bar-success" style="width: 15%;"><span class="sr-only">15%</span></div>
                            </div>
                            <small class="text-muted">15% Completed</small>
                        </div>
                        <div class="pad-hor">
                            <p>Database</p>
                            <div class="progress progress-sm">
                                <div class="progress-bar progress-bar-danger" style="width: 75%;"><span class="sr-only">75%</span></div>
                            </div>
                            <small class="text-muted">17/23 Database</small>
                        </div>


                        <span class="hidxxden">
                        <!--Family-->
                        <div class="list-group bg-trans">
                            <a href="#" class="list-group-item">
                                <div class="media-left">
                                    <img class="img-circle img-xs" src="{{config('wi.dashboard.theme_path')}}/img/av2.png" alt="Profile Picture">
                                </div>
                                <div class="media-body">
                                    <p class="mar-no">Stephen Tran</p>
                                    <small class="text-muted">Availabe</small>
                                </div>
                            </a>
                            <a href="#" class="list-group-item">
                                <div class="media-left">
                                    <img class="img-circle img-xs" src="{{config('wi.dashboard.theme_path')}}/img/av4.png" alt="Profile Picture">
                                </div>
                                <div class="media-body">
                                    <p class="mar-no">Brittany Meyer</p>
                                    <small class="text-muted">I think so</small>
                                </div>
                            </a>
                            <a href="#" class="list-group-item">
                                <div class="media-left">
                                    <img class="img-circle img-xs" src="{{config('wi.dashboard.theme_path')}}/img/av3.png" alt="Profile Picture">
                                </div>
                                <div class="media-body">
                                    <p class="mar-no">Donald Brown</p>
                                    <small class="text-muted">Lorem ipsum dolor sit amet.</small>
                                </div>
                            </a>
                            <a href="#" class="list-group-item">
                                <div class="media-left">
                                    <img class="img-circle img-xs" src="{{config('wi.dashboard.theme_path')}}/img/av5.png" alt="Profile Picture">
                                </div>
                                <div class="media-body">
                                    <p class="mar-no">Betty Murphy</p>
                                    <small class="text-muted">Bye</small>
                                </div>
                            </a>
                        </div>

                        <hr>
                        <h4 class="pad-hor">
                            <span class="pull-right badge badge-success">Offline</span> Friends
                        </h4>

                            <!--Works-->
                        <div class="list-group bg-trans">
                            <a href="#" class="list-group-item">
                                <span class="badge badge-purple badge-icon badge-fw pull-left"></span> Joey K. Greyson
                            </a>
                            <a href="#" class="list-group-item">
                                <span class="badge badge-info badge-icon badge-fw pull-left"></span> Andrea Branden
                            </a>
                            <a href="#" class="list-group-item">
                                <span class="badge badge-success badge-icon badge-fw pull-left"></span> Johny Juan
                            </a>
                            <a href="#" class="list-group-item">
                                <span class="badge badge-danger badge-icon badge-fw pull-left"></span> Susan Sun
                            </a>
                        </div>


                        <hr>
                        <h4 class="pad-hor">News</h4>

                        <div class="pad-hor">
                            <p class="text-muted">Lorem ipsum dolor sit amet, consectetuer
                                <a data-title="45%" class="add-tooltip text-semibold" href="#">adipiscing elit</a>, sed diam nonummy nibh. Lorem ipsum dolor sit amet.
                            </p>
                            <small class="text-muted"><em>Last Update : Okt 08, 2016</em></small>
                        </div>
                        </span>

                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--Fourth tab (Settings)-->



                </div>
            </div>
        </div>
    </div>
