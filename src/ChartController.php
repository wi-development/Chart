<?php
namespace WI\Chart;
use App\Http\Controllers\Controller;
use Route;
use Response;
use Session;
use Illuminate\Http\Request;
use Datatables;
use DB;
use WI\Core\Entities\Company\Company;
use Carbon\Carbon;


#use WI\User\User;

class ChartController extends Controller {


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$charts = Chart::all();
		return view('chart::index',compact('charts'));
	}

	/*
   * INDEX CONTROLLERS
   */

	public function getAllIndex($sitemap_id = 0){
		//dc($sitemap_parent_id);
		$tableConfig = [];
		$tableConfig['allowSortable'] = false;
		$test = 'header test';
		$tableConfig['header'] = 'Verzuimvensters';
		//$tableConfig['header'] = 'Alle pagina\'s van \''.$sitemap->translation->name.'\'';
		//$allowed_child_templates = Template::where('parent_id',$sitemap->template->id)->get();
		$tableConfig['customSearchColumnValues'] = "['online','pending_review','concept']";



		/*
		if (Session::has('flash_notification')){
			Session::flash(
				'flash_notification', [
				'message'=>Session::get('flash_notification.message'),
				'level'=>Session::get('flash_notification.level')
			]);
		}

		Session::put(
			'previous_route', [
			'name'=>null,
			'url'=>(route(Route::currentRouteName(),['sitemap_parent_id'=>'1'])),
			//'url'=>(route(Route::currentRouteName(),['sitemap_parent_id'=>$sitemap_id])),
			//'url'=>(route('admin::locaties_sub.index',['sitemap_parent_id'=>$sitemap->id])),
			'anchorText'=> $tableConfig['header']
		]);
		*/



		//dc($tableConfig);
		if(request()->ajax()){

			/*
			//return response()->json(['name' => 'Abigail', 'state' => 'CA']);
			return Response::json([
				'sitemap'=>$sitemap->toArray(),
				'allowed_child_templates'=>$allowed_child_templates->toArray(),
				'allowed_child_templates_as_html'=>$allowed_child_templates_as_html,
				//'session_test'=> Session::all(),
				'breadcrumbAsHTML'=>$breadcrumbAsHTML,
				'tableConfig'=>$tableConfig
			]);
			*/
		}
		else{
			//$breadcrumbAsHTML = $this->sitemap->getBreadcrumbForMenuIndexTableAjax($breadcrumb,'alle pagina\'s');

		}

		//$test=(route('admin::sitemap.index.menu.data'));
		//return $test;

		$allowed_child_templates = [];//onzin
		$breadcrumbAsHTML = 'onzin';
		$sitemap = collect();
		$sitemap->id = 1;
		return view('chart::index',compact('sitemap','allowed_child_templates','breadcrumbAsHTML','tableConfig'));
		//dc($sitemap->template->id);
		$template = "TEMPLASTE";

		//Gz18jBTf9sSi8epjsVzZy1UlbR2RPJpBx6IxNTEc

	}



	/**
	 * Process datatables ajax request.
	 * Used by 'admin.sitemap.menuIndex' via 'this.getMenuIndex()'
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function allIndexData(Request $request,$sitemap_parent_id = 0)
	{
		/*
		 * get sitemap with urlpath etc
		 * */

		$charts = Chart::with('company','updated_by_user')->get();



		$datatable =  Datatables::of($charts);

		$datatable->addColumn('action', function ($charts) {
			if ($charts->id == 1) {
				//<input class="btn btn-cons btn-awesome btn btn-cons btn-awesome btn btn-danger" value="Delete" type="submit">
				$r = "<table><tr><td style='border:none'>";
				$r .= '<a class="btn btn-default btn-labeled fa fa-lock mar-rgt">Wijzigen</a>';
				$r .= "</td><td style='border:none'>";
				$r .= '<a class="btn btn-default btn-labeled fa fa-lock mar-rgt">Verwijderen</a>';
				$r .= '</td></td></table>';
				return $r;
			}
			//<input class="btn btn-cons btn-awesome btn btn-cons btn-awesome btn btn-danger" value="Delete" type="submit">
			$r = "<table><tr><td style='border:none'>";
			$r .= '<a href="'.route('admin::chart.edit',['id'=>$charts->id]).'" class="btn btn-success btn-labeled fa fa-pencil mar-rgt">Wijzigen</a>';
			$r .= "</td><td  style='border:none'>";
			$r .= "<a class=\"btn btn-danger btn-labeled fa fa-trash-o\" onclick=\"wiDeleteChart(".$charts->id.")\">Verwijderen</a>";
			$r .= '</td></td></table>';
			return $r;
		});

		$var = '';
		$datatable->editColumn('status', function ($test) use ($var) {

			$statusValue = $test->status;
			$labelValue = 'label-'.$test->status.'';

			//label-concept
			//label-pending_review
			if ($test->status == 'pending_review'){
				$statusValue = 'pending';
			}
			if ($test->status == 'public'){
				//$statusValue = 'pun';
				$labelValue = 'label-success';
			}
			if ($test->status == 'blueprint'){
				//$statusValue = 'pun';
				$labelValue = 'label-info';
			}
			return "<span class=\"labelx badge label-table ".$labelValue."\">".$statusValue."</span>";
		});

		$now = new Carbon();
		$datatable->editColumn('updated_at', function ($test) use ($now) {

			//$test->updated_at ? with(new Carbon($test->updated_at))->diffForHumans() : ''
			$updated_at = with(new Carbon($test->updated_at));
			if (($updated_at->isSameDay($now)) || $updated_at->isYesterday()){
				$retval = $updated_at->diffForHumans();
			}
			else{
				$retval = "".$test->updated_at->formatLocalized('%A %d %B');
			}
			return $retval;

			$retval .= " op ".$test->updated_at->formatLocalized('%A %d %B');
			$retval .= "<div class=\"extraDataUIT\" style='display:none;'>";
			$retval .= "<br><date><i class=\"fa fa-clock-o\" aria-hidden=\"true\"></i> ";
			$retval .= $test->updated_at->formatLocalized('%a %d %B');
			$retval .= $test->updated_at->format(', h:i');
			$retval .= "</date>";
			$retval .= "</div>";
			return $retval;
		});


		return $datatable->make(true);



		/*sitemap_category*/
		$sitemaps = Sitemap::leftJoin('sitemap_category as sc','sc.sitemap_id', '=', 'sitemaps.id')
			->leftJoin('sitemaps as sctest', 'sc.sitemap_category_id','=','sctest.id')
			->leftJoin('sitemaptranslations as sctest_st','sctest.id','=','sctest_st.sitemap_id')

			/*sitemap_relations*/
			->join('sitemaptranslations as st','st.sitemap_id','= ','sitemaps.id')
			->join('templates as t','t.id','=','sitemaps.template_id')
			->join('users as u','u.id','=','sitemaps.updated_by_user_id')

			/*sitemap_tree*/
			->leftJoin('sitemaps as down1','down1.id','=','sitemaps.parent_id')
			->leftJoin('sitemaptranslations as st1','st1.sitemap_id','=','down1.id')

			->leftJoin('sitemaps as down2','down2.id','=','down1.parent_id')
			->leftJoin('sitemaptranslations as st2','st2.sitemap_id','=','down2.id')

			->leftJoin('sitemaps as down3','down3.id','=','down2.parent_id')
			->leftJoin('sitemaptranslations as st3','st3.sitemap_id','=','down3.id');

		/**Locale*/
		$sitemaps->where('st.locale_id',1)
			->whereRaw('(st1.locale_id = 1 OR st1.locale_id IS NULL)')
			->whereRaw('(st2.locale_id = 1 OR st2.locale_id IS NULL)')
			->whereRaw('(st3.locale_id = 1 OR st3.locale_id IS NULL)')
			->whereRaw('(sctest_st.locale_id = 1  OR sctest_st.locale_id IS null)');
		#AND t.type != 'post'
		$sitemaps->groupBy('sitemaps.id');

		if ($sitemap_parent_id != 0){
			$sitemaps->where('sitemaps.parent_id',$sitemap_parent_id);
		}

		/*order by*/
		//$sitemaps->orderBy('path');

		//uit
		if ($path = $request->get('path')) {
			//app('debugbar')->warning($locaties);
			//$sitemaps->orderBy('ABS(path)'); // additional users.name search
		}


		$sitemaps->select([
			'sitemaps.id',
			DB::raw('CONCAT(\'{"id":\',sitemaps.id,\',\',\'"order_by_number":\',sitemaps.order_by_number,\'}\') as reorderData_id_AND_order_by_number'),
			'sitemaps.created_at',
			'sitemaps.updated_at',
			'sitemaps.status',
			'sitemaps.order_by_number',
			't.name as templateName',
			'u.name as usersname',
			'sitemaps.depth',
			DB::raw('GROUP_CONCAT(DISTINCT(`st`.`name`)) as `testname` ,
                    GROUP_CONCAT(`sctest_st`.`name`) as `tName` ,
                    GROUP_CONCAT(`sctest_st`.`slug`) as `tSlug`'),
			//'st.name as testname',
			//'sctest_st.name as tName',
			//'sctest_st.slug as tSlug',
			//1.2.4.5 for display, hmm..
			DB::raw('CONCAT(\'0\',
                IF (down3.order_by_number IS NULL,\'\',CONCAT(\'.\',down3.order_by_number)),
                IF (down2.order_by_number IS NULL,\'\',CONCAT(\'.\',down2.order_by_number)),
                IF (down1.order_by_number IS NULL,\'\',CONCAT(\'.\',down1.order_by_number)),
                IF (sitemaps.order_by_number IS NULL,\'\',CONCAT(\'.\',sitemaps.order_by_number))
                ) as path'
			),
			//1235 for sorting
			DB::raw("CONCAT('0',
                IF (down3.order_by_number IS NOT NULL AND down3.order_by_number < 10 ,CONCAT('.',down3.order_by_number),''),
                IF (down3.order_by_number IS NOT NULL AND down3.order_by_number > 9 ,CONCAT('.9.',down3.order_by_number),''),

                IF (down2.order_by_number IS NOT NULL AND down2.order_by_number < 10 ,CONCAT('.',down2.order_by_number),''),
                IF (down2.order_by_number IS NOT NULL AND down2.order_by_number > 9 ,CONCAT('.9.',down2.order_by_number),''),

                IF (down1.order_by_number IS NOT NULL AND down1.order_by_number < 10 ,CONCAT('.',down1.order_by_number),''),
                IF (down1.order_by_number IS NOT NULL AND down1.order_by_number > 9 ,CONCAT('.9.',down1.order_by_number),''),

                IF (sitemaps.order_by_number IS NOT NULL AND sitemaps.order_by_number < 10 ,CONCAT('.',sitemaps.order_by_number),''),
                IF (sitemaps.order_by_number IS NOT NULL AND sitemaps.order_by_number > 9 ,CONCAT('.9.',sitemaps.order_by_number),'')
                ) as path1
            "),
			//slug1/slug2/category!!/slug3
			DB::raw('CONCAT(
                IF (st3.slug IS NULL OR st3.slug = \'\' ,\'\',CONCAT(\'/\',st3.slug,\'\')),
                IF (st2.slug IS NULL OR st2.slug = \'\',\'\',CONCAT(\'/\',st2.slug,\'\')),
                IF (st1.slug IS NULL OR st1.slug = \'\',\'\',CONCAT(\'/\',st1.slug,\'\')),
                IF (t.name = \'Nieuwsbericht\',
	                IF (sitemaps.depth = 2 AND sctest_st.slug IS NOT NULL,CONCAT(\'/\',sctest_st.slug),\'\')
,               \'\'),
                IF (st.slug IS NULL OR st.slug = \'\',\'/\',CONCAT(\'/\',st.slug,\'\'))
                ) as urlPath'
			)
		]);

		//dc($sitemaps->get());
		//return "view";
		//dc($sitemaps->get());
		//dc($sitemaps->pluck('testname')->all());
		//return "view";



		$datatable =  Datatables::of($sitemaps);
		return $datatable->make(true);
		$datatable->setRowId('sortable_'.'{{$id}}');
		//$datatable->orderColumn('path');
		// $datatable->orderColumn('path', 'email $1');


		//kanweg
		$datatable->addColumn('action', function ($sitemap) {

			$r = "<a class=\"btn btn-success btn-labeled-x\" href=\"".route('admin::sitemap.edit',['id'=>$sitemap->id])."\" >
                    <i class=\"fa fa-pencil fa-1x\"></i> editxxx</a> <br>";


			$r .= "<a class=\"btn btn-primary btn-labeled-x setTable\" onclick=\"wiLoad(".$sitemap->id.")\">
                    <i class=\"fa fa-level-down fa-1x\"></i>  sub pagins's</a> <br>";

			$r .= "<a class=\"btn btn-warning btn-labeled-x setTable\" onclick=\"wiDuplicate(".$sitemap->id.")\">
                    <i class=\"fa fa-copy fa-1x\"></i> copy</a> <br>";

			$r .= "<a class=\"btn btn-danger btn-labeled-x setTable\" onclick=\"wiDelete(".$sitemap->id.")\">
                    <i class=\"fa fa-trash fa-1x\"></i> delete</a> <br>";

			$r .= "<a class=\"btn btn-default btn-md btn-labeled-x\" href=\"".$sitemap->urlPath."\" target=\"_blank\">
                    <i class=\"fa fa-search fa-1x\"></i> preview</a>";

			return $r;
		});



		/*$datatable->editColumn('path', function ($test) {
			return $test->path;
		});
	*/
		$datatable->editColumn('testname', function ($test) {



			$r = "<div class=\"extraData\" style='display:none;'>";

			//$r .= "<span class='pulxl-right'>".$test->urlPath."</span><br>";
			$r .= "<a class=\"btn btn-success btn-labeled-x\" href=\"".route('admin::sitemap.edit',['id'=>$test->id])."\" >
                    <i class=\"fa fa-pencil fa-1x\"></i> edit</a> ";


			$r .= "<a class=\"btn btn-primary btn-labeled-x setTable\" onclick=\"wiLoad(".$test->id.")\">
                    <i class=\"fa fa-level-down fa-1x\"></i>  sub pagins's</a> ";

			$r .= "<a class=\"btn btn-warning btn-labeled-x setTable\" onclick=\"wiDuplicate(".$test->id.")\">
                    <i class=\"fa fa-copy fa-1x\"></i> copy</a> ";

			$r .= "<a class=\"btn btn-danger btn-labeled-x setTable\" onclick=\"wiDeleteSitemap(".$test->id.")\">
                    <i class=\"fa fa-trash fa-1x\"></i> deleteX</a> ";

			$r .= "<a class=\"btn btn-default btn-md btn-labeled-x\" href=\"".$test->urlPath."\" target=\"_blank\">
                    <i class=\"fa fa-search fa-1x\"></i> preview</a> ";

			//$r .= "<a class=\"btn btn-default btn-md btn-labeled-x\" href=\"".$test->urlPath."\" target=\"_blank\"
			//        data-placement=\"right\" data-toggle=\"tooltip\" data-original-title=\"".$test->urlPath."\">
			//        <i class=\"fa fa-info fa-1x\"></i> info</a> ";

			$r .= "</div>";


			/*
						$urlString = str_replace('/',' » ',$test->urlPath);
						$urlString = htmlentities($urlString, ENT_QUOTES);

						$pos = strrpos($urlString, "»");
						if ($pos === false) { // note: three equal signs
							// not found...
							$pos1 = 'asdf';
						}
						else{
							$pos1 = ($pos+1);
							//$pos++;
							$urlString = substr_replace($urlString, '<strong>', ($pos1), 0);

						}
						//unset($pos);
			*/


			$urlStringStart = str_replace('/',' » ',(str_limit($test->urlPath, strrpos($test->urlPath, "/"),' » ')));

			return "".$urlStringStart."<strong>".$test->testname."</strong><br><br>".$r." ";
		});

		$datatable->editColumn('status', function ($test) use ($sitemap_parent_id) {

			$statusValue = $test->status;
			if ($test->status == 'pending_review'){
				$statusValue = 'pending';
			}
			return "<span class=\"labelx badge label-table label-".$test->status."\">".$statusValue."</span>";
		});


		$datatable->editColumn('created_at', function ($test) {

			//$retval .= $test->created_at ? with(new Carbon($test->created_at))->format('l jS \\of F Y h:i:s A') : '';
			//Carbon::setLocale('fr');
			//$retval .= $test->created_at->formatLocalized('%l %jS \\of %F %Y h:i:s %A')."<br>";


			$retval = $test->created_at ? with(new Carbon($test->created_at))->diffForHumans() : '';
			$retval .= "<div class=\"extraData\" style='display:none;'>";
			$retval .= "<br><date><i class=\"fa fa-clock-o\" aria-hidden=\"true\"></i> ";
			$retval .= $test->created_at->formatLocalized('%a %d %B');
			$retval .= $test->created_at->format(', h:i');
			$retval .= "</date>";
			$retval .= "</div>";
			return $retval;
		});

		$datatable->editColumn('updated_at', function ($test) {
			$retval = $test->updated_at ? with(new Carbon($test->updated_at))->diffForHumans() : '';
			$retval .= "<div class=\"extraData\" style='display:none;'>";
			$retval .= "<br><date><i class=\"fa fa-clock-o\" aria-hidden=\"true\"></i> ";
			$retval .= $test->updated_at->formatLocalized('%a %d %B');
			$retval .= $test->updated_at->format(', h:i');
			$retval .= "</date>";
			$retval .= "</div>";
			return $retval;
		});

		if ($status = $request->get('status')) {
			app('debugbar')->warning($status);
			//console.info('zoeke status');
			//$datatable->where('sitemaps.status', 'like', "%{$status}%"); // additional users.name search
		}


		if ($status = $request->get('pathxx')) {
			//app('debugbar')->warning($locaties);
			//$datatable->orderBy('ABS(path)'); // additional users.name search
		}


		$datatable->orderColumn('path', 'path1 $1');
		//$datatable->orderColumn();


		return $datatable->make(true);
	}




	public function edit($id)
	{
		//auth()->loginUsingId(1);
		//$user = User::findOrFail($id);
		try {
			$chart = Chart::with('company')->findOrFail($id);
			if (request()->ajax()) {
				$data = ['status' => 'success', 'statusText' => 'Ok', 'responseText' => 'Verzuimvenster is ingeladen!','chart'=>$chart];
				return response()->json($data, 200);
			}
			$company_charts = Chart::lists('name','id');
			return view('chart::edit',compact('chart','company_charts'));
		} catch (\Exception $e) {
			if (request()->ajax()){
				$data = ['status' => 'error', 'statusText' => 'Fail', 'responseText' => '' . $e->getMessage() . ''];
				return response()->json($data, 400);
			}
			Flash::error('edit is mislukt!<br>' . $e->getMessage() . ' ' . $id . '');
		}



		return view('chart::edit',compact('chart'));
		//if (\Gate::denies('editProfile',($user))){
		//  dc('edit denied');
		//abort('401include');
		//}
		//dc($user->roles->pluck('id')->all());
		$roles = Role::lists('name','id');
		//dc($roles);
		$locales = Locale::lists('name','id');
		$companies = Company::lists('name','id');
		//  dc($locales);
		return view('user::edit',compact('user','roles','locales','companies'));

	}

	public function update(Request $request,$id)
	{



//return $request->all();
		/*
				$user = User::findOrFail($userId);
				//dd($user);
				//if (\Gate::denies('editProfile',($user))){
				//dc('deniedd');
				//abort('401include');
				//}

				$user->roles()->sync($request->get('roles'));

				$user->update($request->all());
				Flash::success('[REDIRECT] <bR>User '.$request['name'].' has been updated!<br>'.request()['feedback'].'<br>');
				return redirect()->back();

		*/

//return $request->input('config');

		//return request()->input('chartData');

		$action = DB::transaction(function () use ($id,$request) {
			try {
				//Sitemap::destroy($id);
				$request->merge(array('updated_by_user_id' => auth()->user()->id));
				$chart = Chart::findOrFail($id);
				$chart->update($request->all());
				if (request()->ajax()) {
					$data = ['status' => 'success', 'statusText' => 'Ok', 'responseText' => 'Verzuimvenster is opgeslagen!'];
					return response()->json($data, 200);
				}
				Flash::success('Delete is geluktJAJA! ' . $id . '');
			} catch (\Exception $e) {
				if (request()->ajax()){
					$data = ['status' => 'error', 'statusText' => 'Fail', 'responseText' => '' . $e->getMessage() . ''];
					return response()->json($data, 400);
				}
				Flash::error('Delete is mislukt!<br>' . $e->getMessage() . ' ' . $id . '');
			}
		});

		if(request()->ajax()){
			return $action;
		}
		return redirect()->back();





		//
		dd($request);

		$user = User::findOrFail($userId);
		//dd($user);
		//if (\Gate::denies('editProfile',($user))){
		//dc('deniedd');
		//abort('401include');
		//}

		$user->roles()->sync($request->get('roles'));

		$user->update($request->all());
		Flash::success('[REDIRECT] <bR>User '.$request['name'].' has been updated!<br>'.request()['feedback'].'<br>');
		return redirect()->back();
	}

	private function getBlueprint(){
		$blueprint = Chart::findOrFail(1);
		return $blueprint;
	}


	public function beforeCreate(Request $request){

		$action = DB::transaction(function () use ($request) {
			try {


				//$company = Company::findOrFail($request->input('company_id'));
				$chart = $this->getBlueprint();
				$chart->company_id = $request->input('company_id');
				$chart->name = "Nieuw verzuimster";
				$chart->label = "label";
				$chart->status = "concept";
				$chart->description = "";
				$newChart = Chart::create($chart->attributesToArray());
				$newChart->name = "Nieuw verzuimster - ".$newChart->id."";
				$newChart->save();

				if (request()->ajax()) {
					$data = ['status' => 'success', 'statusText' => 'Ok', 'responseText' => 'Verzuimvenster is aangemaakt!','chart'=>$newChart];
					return response()->json($data, 200);
				}
				return $newChart;
				//Flash::success('AANGEMAMKLE is geluktJAJA! ');
			} catch (\Exception $e) {
				if (request()->ajax()){
					$data = ['status' => 'error', 'statusText' => 'Fail', 'responseText' => '' . $e->getMessage() . ''];
					return response()->json($data, 400);
				}
				Flash::error('beforeCreate is mislukt!<br>' . $e->getMessage() . ' ');
			}
		});

		if(request()->ajax()){
			return $action;
		}

		//dc($action->id);
		//return "view";
		return redirect()->route('admin::chart.edit',['id'=>$action->id]);


	}



	public function create(){
		dc('asdf');
		return "view";
		//$roles = Role::lists('name','id');
		//$locales = Locale::where('status','<>','disabled')->lists('name','id');
		//$companies = Company::lists('name','id');
		//return view('user::create',compact('roles','locales','companies'));
	}


	public function store(Request $request)
	{
		//$request->merge(['name' => 'Nieuw venster']);



		$action = DB::transaction(function () use ($request) {
			try
			{
				$request->merge(array('updated_by_user_id' => auth()->user()->id));
				$chart = Chart::create($request->all());
				//TODO
				//get blauwdruk
				$blauwdruk = Chart::findOrFail(1);

				$chart->name = 'Nieuw venster '.$chart->id.'';
				$chart->config = $blauwdruk->config;
				$chart->save();

				//$user->roles()->sync($request->get('roles'));
				if (request()->ajax()) {
					$data = ['status' => 'success', 'statusText' => 'Ok', 'responseText' => 'Verzuimvenster is aangemaakt!','chart'=>$chart];
					return response()->json($data, 200);
				}
				Flash::success('Gebruiker '.$request['name'].' is succesvol toegevoegd');
			}
			catch (\Exception $e)
			{
				if (request()->ajax()){
					$data = ['status' => 'error', 'statusText' => 'Fail', 'responseText' => '' . $e->getMessage() . ''];
					return response()->json($data, 400);
				}
				Flash::error('Niet gelukt: '.$e->getMessage());
				//send mail with subject "db import failed" and body of $e->getMessage()
			}
		});
		if(request()->ajax()){
			return $action;
		}
		return redirect()->route('admin::chart.all.index');
		//return redirect('user.index');
	}


	public function destroy($id)
	{
		//Auth::logout();
		$action = DB::transaction(function () use ($id) {
			try {
				$chart = Chart::findOrFail($id);
				Chart::destroy($id);
				if (request()->ajax()) {
					$data = ['status' => 'succes', 'statusText' => 'Ok', 'responseText' => 'Verzuimvenster \''.$chart->name.'\' is verwijderd'];
					return response()->json($data, 200);
				}
				Flash::success('Verzuimvenster \''.$chart->name.'\' is verwijderd');
			}
			catch (\Exception $e) {
				if (request()->ajax()){
					$data = ['status' => 'succes', 'statusText' => 'Fail', 'responseText' => '' . $e->getMessage() . ''];
					return response()->json($data, 400);
				}
				Flash::error('Verzuimvenster \''.$chart->name.'\' verwijderen is mislukt!<br>' . $e->getMessage() . ' ' . $id . '');
			}
		});

		if(request()->ajax()){
			return $action;
		}
		return redirect()->back();
	}


	public function getVerzuimvensters(){
		$company_charts = Chart::lists('name','id');

		$data = ['status' => 'success', 'statusText' => 'Ok', 'responseText' => 'Verzuimvensters opgevraafd','chart'=>$company_charts];
		return response()->json($data, 200);
	}
	public function chooseClient(){
		$companies = Company::lists('name','id');
		return view('chart::chooseClient',compact('companies'));

	}



	public function allIndexDataORG(Request $request,$sitemap_parent_id = 0)
	{
		/*
		 * get sitemap with urlpath etc
		 * */




		/*sitemap_category*/
		$sitemaps = Sitemap::leftJoin('sitemap_category as sc','sc.sitemap_id', '=', 'sitemaps.id')
			->leftJoin('sitemaps as sctest', 'sc.sitemap_category_id','=','sctest.id')
			->leftJoin('sitemaptranslations as sctest_st','sctest.id','=','sctest_st.sitemap_id')

			/*sitemap_relations*/
			->join('sitemaptranslations as st','st.sitemap_id','= ','sitemaps.id')
			->join('templates as t','t.id','=','sitemaps.template_id')
			->join('users as u','u.id','=','sitemaps.updated_by_user_id')

			/*sitemap_tree*/
			->leftJoin('sitemaps as down1','down1.id','=','sitemaps.parent_id')
			->leftJoin('sitemaptranslations as st1','st1.sitemap_id','=','down1.id')

			->leftJoin('sitemaps as down2','down2.id','=','down1.parent_id')
			->leftJoin('sitemaptranslations as st2','st2.sitemap_id','=','down2.id')

			->leftJoin('sitemaps as down3','down3.id','=','down2.parent_id')
			->leftJoin('sitemaptranslations as st3','st3.sitemap_id','=','down3.id');

		/**Locale*/
		$sitemaps->where('st.locale_id',1)
			->whereRaw('(st1.locale_id = 1 OR st1.locale_id IS NULL)')
			->whereRaw('(st2.locale_id = 1 OR st2.locale_id IS NULL)')
			->whereRaw('(st3.locale_id = 1 OR st3.locale_id IS NULL)')
			->whereRaw('(sctest_st.locale_id = 1  OR sctest_st.locale_id IS null)');
		#AND t.type != 'post'
		$sitemaps->groupBy('sitemaps.id');

		if ($sitemap_parent_id != 0){
			$sitemaps->where('sitemaps.parent_id',$sitemap_parent_id);
		}

		/*order by*/
		//$sitemaps->orderBy('path');

		//uit
		if ($path = $request->get('path')) {
			//app('debugbar')->warning($locaties);
			//$sitemaps->orderBy('ABS(path)'); // additional users.name search
		}


		$sitemaps->select([
			'sitemaps.id',
			DB::raw('CONCAT(\'{"id":\',sitemaps.id,\',\',\'"order_by_number":\',sitemaps.order_by_number,\'}\') as reorderData_id_AND_order_by_number'),
			'sitemaps.created_at',
			'sitemaps.updated_at',
			'sitemaps.status',
			'sitemaps.order_by_number',
			't.name as templateName',
			'u.name as usersname',
			'sitemaps.depth',
			DB::raw('GROUP_CONCAT(DISTINCT(`st`.`name`)) as `testname` ,
                    GROUP_CONCAT(`sctest_st`.`name`) as `tName` ,
                    GROUP_CONCAT(`sctest_st`.`slug`) as `tSlug`'),
			//'st.name as testname',
			//'sctest_st.name as tName',
			//'sctest_st.slug as tSlug',
			//1.2.4.5 for display, hmm..
			DB::raw('CONCAT(\'0\',
                IF (down3.order_by_number IS NULL,\'\',CONCAT(\'.\',down3.order_by_number)),
                IF (down2.order_by_number IS NULL,\'\',CONCAT(\'.\',down2.order_by_number)),
                IF (down1.order_by_number IS NULL,\'\',CONCAT(\'.\',down1.order_by_number)),
                IF (sitemaps.order_by_number IS NULL,\'\',CONCAT(\'.\',sitemaps.order_by_number))
                ) as path'
			),
			//1235 for sorting
			DB::raw("CONCAT('0',
                IF (down3.order_by_number IS NOT NULL AND down3.order_by_number < 10 ,CONCAT('.',down3.order_by_number),''),
                IF (down3.order_by_number IS NOT NULL AND down3.order_by_number > 9 ,CONCAT('.9.',down3.order_by_number),''),

                IF (down2.order_by_number IS NOT NULL AND down2.order_by_number < 10 ,CONCAT('.',down2.order_by_number),''),
                IF (down2.order_by_number IS NOT NULL AND down2.order_by_number > 9 ,CONCAT('.9.',down2.order_by_number),''),

                IF (down1.order_by_number IS NOT NULL AND down1.order_by_number < 10 ,CONCAT('.',down1.order_by_number),''),
                IF (down1.order_by_number IS NOT NULL AND down1.order_by_number > 9 ,CONCAT('.9.',down1.order_by_number),''),

                IF (sitemaps.order_by_number IS NOT NULL AND sitemaps.order_by_number < 10 ,CONCAT('.',sitemaps.order_by_number),''),
                IF (sitemaps.order_by_number IS NOT NULL AND sitemaps.order_by_number > 9 ,CONCAT('.9.',sitemaps.order_by_number),'')
                ) as path1
            "),
			//slug1/slug2/category!!/slug3
			DB::raw('CONCAT(
                IF (st3.slug IS NULL OR st3.slug = \'\' ,\'\',CONCAT(\'/\',st3.slug,\'\')),
                IF (st2.slug IS NULL OR st2.slug = \'\',\'\',CONCAT(\'/\',st2.slug,\'\')),
                IF (st1.slug IS NULL OR st1.slug = \'\',\'\',CONCAT(\'/\',st1.slug,\'\')),
                IF (t.name = \'Nieuwsbericht\',
	                IF (sitemaps.depth = 2 AND sctest_st.slug IS NOT NULL,CONCAT(\'/\',sctest_st.slug),\'\')
,               \'\'),
                IF (st.slug IS NULL OR st.slug = \'\',\'/\',CONCAT(\'/\',st.slug,\'\'))
                ) as urlPath'
			)
		]);

		//dc($sitemaps->get());
		//return "view";
		//dc($sitemaps->get());
		//dc($sitemaps->pluck('testname')->all());
		//return "view";



		$datatable =  Datatables::of($sitemaps);
		$datatable->setRowId('sortable_'.'{{$id}}');
		//$datatable->orderColumn('path');
		// $datatable->orderColumn('path', 'email $1');


		//kanweg
		$datatable->addColumn('action', function ($sitemap) {

			$r = "<a class=\"btn btn-success btn-labeled-x\" href=\"".route('admin::sitemap.edit',['id'=>$sitemap->id])."\" >
                    <i class=\"fa fa-pencil fa-1x\"></i> editxxx</a> <br>";


			$r .= "<a class=\"btn btn-primary btn-labeled-x setTable\" onclick=\"wiLoad(".$sitemap->id.")\">
                    <i class=\"fa fa-level-down fa-1x\"></i>  sub pagins's</a> <br>";

			$r .= "<a class=\"btn btn-warning btn-labeled-x setTable\" onclick=\"wiDuplicate(".$sitemap->id.")\">
                    <i class=\"fa fa-copy fa-1x\"></i> copy</a> <br>";

			$r .= "<a class=\"btn btn-danger btn-labeled-x setTable\" onclick=\"wiDelete(".$sitemap->id.")\">
                    <i class=\"fa fa-trash fa-1x\"></i> delete</a> <br>";

			$r .= "<a class=\"btn btn-default btn-md btn-labeled-x\" href=\"".$sitemap->urlPath."\" target=\"_blank\">
                    <i class=\"fa fa-search fa-1x\"></i> preview</a>";

			return $r;
		});



		/*$datatable->editColumn('path', function ($test) {
			return $test->path;
		});
	*/
		$datatable->editColumn('testname', function ($test) {



			$r = "<div class=\"extraData\" style='display:none;'>";

			//$r .= "<span class='pulxl-right'>".$test->urlPath."</span><br>";
			$r .= "<a class=\"btn btn-success btn-labeled-x\" href=\"".route('admin::sitemap.edit',['id'=>$test->id])."\" >
                    <i class=\"fa fa-pencil fa-1x\"></i> edit</a> ";


			$r .= "<a class=\"btn btn-primary btn-labeled-x setTable\" onclick=\"wiLoad(".$test->id.")\">
                    <i class=\"fa fa-level-down fa-1x\"></i>  sub pagins's</a> ";

			$r .= "<a class=\"btn btn-warning btn-labeled-x setTable\" onclick=\"wiDuplicate(".$test->id.")\">
                    <i class=\"fa fa-copy fa-1x\"></i> copy</a> ";

			$r .= "<a class=\"btn btn-danger btn-labeled-x setTable\" onclick=\"wiDeleteSitemap(".$test->id.")\">
                    <i class=\"fa fa-trash fa-1x\"></i> deleteX</a> ";

			$r .= "<a class=\"btn btn-default btn-md btn-labeled-x\" href=\"".$test->urlPath."\" target=\"_blank\">
                    <i class=\"fa fa-search fa-1x\"></i> preview</a> ";

			//$r .= "<a class=\"btn btn-default btn-md btn-labeled-x\" href=\"".$test->urlPath."\" target=\"_blank\"
			//        data-placement=\"right\" data-toggle=\"tooltip\" data-original-title=\"".$test->urlPath."\">
			//        <i class=\"fa fa-info fa-1x\"></i> info</a> ";

			$r .= "</div>";


			/*
						$urlString = str_replace('/',' » ',$test->urlPath);
						$urlString = htmlentities($urlString, ENT_QUOTES);

						$pos = strrpos($urlString, "»");
						if ($pos === false) { // note: three equal signs
							// not found...
							$pos1 = 'asdf';
						}
						else{
							$pos1 = ($pos+1);
							//$pos++;
							$urlString = substr_replace($urlString, '<strong>', ($pos1), 0);

						}
						//unset($pos);
			*/


			$urlStringStart = str_replace('/',' » ',(str_limit($test->urlPath, strrpos($test->urlPath, "/"),' » ')));

			return "".$urlStringStart."<strong>".$test->testname."</strong><br><br>".$r." ";
		});

		$datatable->editColumn('status', function ($test) use ($sitemap_parent_id) {

			$statusValue = $test->status;
			if ($test->status == 'pending_review'){
				$statusValue = 'pending';
			}
			return "<span class=\"labelx badge label-table label-".$test->status."\">".$statusValue."</span>";
		});


		$datatable->editColumn('created_at', function ($test) {

			//$retval .= $test->created_at ? with(new Carbon($test->created_at))->format('l jS \\of F Y h:i:s A') : '';
			//Carbon::setLocale('fr');
			//$retval .= $test->created_at->formatLocalized('%l %jS \\of %F %Y h:i:s %A')."<br>";


			$retval = $test->created_at ? with(new Carbon($test->created_at))->diffForHumans() : '';
			$retval .= "<div class=\"extraData\" style='display:none;'>";
			$retval .= "<br><date><i class=\"fa fa-clock-o\" aria-hidden=\"true\"></i> ";
			$retval .= $test->created_at->formatLocalized('%a %d %B');
			$retval .= $test->created_at->format(', h:i');
			$retval .= "</date>";
			$retval .= "</div>";
			return $retval;
		});

		$datatable->editColumn('updated_at', function ($test) {
			$retval = $test->updated_at ? with(new Carbon($test->updated_at))->diffForHumans() : '';
			$retval .= "<div class=\"extraData\" style='display:none;'>";
			$retval .= "<br><date><i class=\"fa fa-clock-o\" aria-hidden=\"true\"></i> ";
			$retval .= $test->updated_at->formatLocalized('%a %d %B');
			$retval .= $test->updated_at->format(', h:i');
			$retval .= "</date>";
			$retval .= "</div>";
			return $retval;
		});

		if ($status = $request->get('status')) {
			app('debugbar')->warning($status);
			//console.info('zoeke status');
			//$datatable->where('sitemaps.status', 'like', "%{$status}%"); // additional users.name search
		}


		if ($status = $request->get('pathxx')) {
			//app('debugbar')->warning($locaties);
			//$datatable->orderBy('ABS(path)'); // additional users.name search
		}


		$datatable->orderColumn('path', 'path1 $1');
		//$datatable->orderColumn();


		return $datatable->make(true);
	}
}