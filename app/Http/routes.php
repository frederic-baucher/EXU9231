<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

use App\Task;
use App\Course; // TODO
// use App\Http\UserController; // TODO
use Illuminate\Http\Request;

Route::group(['middleware' => ['web']], function () {

     /**
     * Show User Dashboard by using a controller
     */
    // Route::get('/admin', 'UserController@index');

    Route::any('adminer', '\Miroc\LaravelAdminer\AdminerController@index');
     
    /**
     * Show Task Dashboard
     */
    Route::get('/', function () {
        return view('tasks', [
            'tasks' => Task::orderBy('created_at', 'asc')->get()
        ]);
    });
     
     
     /**
     * Add New Course
     */
    Route::post('/course', function (Request $request) {

        $task = new Course;
        $task->name = $request->name;
        $task->save();

        return redirect('/');
    });
     
     
    /**
     * Add New Task
     */
    Route::post('/task', function (Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }

        $task = new Task;
        $task->name = $request->name;
        $task->save();

        return redirect('/');
    });

    /**
     * Delete Task
     */
    Route::delete('/task/{id}', function ($id) {
        Task::findOrFail($id)->delete();

        return redirect('/');
    });

    /**
     * Delete Course
     */
    Route::delete('/course/{id}', function ($id) {
        Task::findOrFail($id)->delete();

        return redirect('/');
    });

    /**
     * Show Course Dashboard
     */
    Route::get('/courses', function () {
        return view('courses', [
            'courses' => Course::orderBy('created_at', 'asc')->get()
        ]);
    });
     
   
     

});
