<?php
#Route::get('/backStages', 'DashboardController@index');

//Route::get('/charts/all/data/{company_id?}',        ['as' => 'chart.index.all.data',      'uses' => 'ChartController@chartAllData']);
//Route::get('/charts',                               ['as' => 'chart.index'               ,'uses' => 'ChartController@getIndexAll']);


Route::get('/charts',                                   ['as' => 'chart.all.index',          'uses' => 'ChartController@getAllIndex']);
Route::get('/chart/all/data',                           ['as' => 'chart.all.data',           'uses' => 'ChartController@allIndexData']);

//Route::get('/charts/all/{sitemap_parent_id?}',             ['as' => 'sitemap.index.all',           'uses' => 'SitemapController@getIndexAll']);

//edit form
Route::post('chart/beforeCreate',                               ['as' => 'chart.beforeCreate',                  'uses' => 'ChartController@beforeCreate']);
Route::get('/chart/create',                             ['as' => 'chart.create'              ,'uses' => 'ChartController@create']);
Route::get('/chart/{id}/edit',                          ['as' => 'chart.edit'                 ,'uses' => 'ChartController@edit']);


Route::patch('/chart/update/{chartid}',                  ['as' => 'chart.update',                'uses' => 'ChartController@update']);

Route::post('/chart/store',                              ['as' => 'chart.store',                  'uses' => 'ChartController@store']);

//user delete ONLY ROOT
Route::delete('chart/{id?}',                         ['as' => 'chart.destroy',                'uses' => 'ChartController@destroy',
	//'middleware' => ['roles'],
	//'roles' => ['root']                   // Only an root can delete from database
]);




Route::get('/chart/getVerzuimvensters',                                   ['as' => 'chart.verzuimvensters',          'uses' => 'ChartController@getVerzuimvensters']);

Route::get('/chart/chooseClient',                                   ['as' => 'chart.chooseClient',          'uses' => 'ChartController@chooseClient']);



#

/*Route::get('/', ['as' => 'backStage', 'uses' => 'DashboardController@index'
    , function () {
        // Route named "admin::dashboard"
        //$url = route('admin::dashboard');
        //return "dashboard: ".$url."";
        $user = Auth::user();

        //return view('admin.dashboard',$user);
    }]);
*/



