<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['middleware' => ['cors']], function () {
    Route::post('/', function (Request $request) {
        return $request->get('name');
    });
});
Route::group(['middleware' => ['cors']], function () {
    Route::get('academic_subject_cities', 'api\AcademicYearController@get_all_data');
    Route::post('login', 'Auth\ApiAuthStreamerController@authenticate');
    Route::group(['middleware' => ['jwt.verify']], function () {
        Route::get('me', 'Auth\ApiAuthStreamerController@getAuthenticatedUser');
    });
    Route::group(['prefix' => 'follower'], function () {
        Route::group(['middleware' => ['jwt.verify']], function () {
            Route::post('update-profile-image', 'Auth\ApiAuthFollowerController@updateProfileImage');
            Route::put('update-profile', 'Auth\ApiAuthFollowerController@updateProfile');
            Route::put('update-profile-password', 'Auth\ApiAuthFollowerController@updateProfilePassword');

        });
    });
    Route::group(['prefix' => 'streamer'], function () {
        Route::post('register', 'Auth\ApiAuthStreamerController@register');
        Route::group(['middleware' => ['jwt.verify']], function () {
            Route::post('update-profile-image', 'Auth\ApiAuthStreamerController@updateProfileImage');
            Route::put('update-profile', 'Auth\ApiAuthStreamerController@updateProfile');
            Route::put('update-profile-password', 'Auth\ApiAuthStreamerController@updateProfilePassword');
            //===========================Start=Quiz====================================
            Route::get('quiz', 'api\QuizController@quizes');
            Route::post('create_quiz', 'api\QuizController@createQuiz');
            Route::get('quiz/{slug}', 'api\QuizController@Detail_quiz');
            Route::put('quiz/{slug}', 'api\QuizController@Update_quiz');
            Route::delete('quiz/{slug}', 'api\QuizController@Delete_quiz');
            //===========================End=Quiz=======================================
            //===========================Start=Question=================================
            Route::get('{quiz}/question', 'api\QuestionController@question');
            Route::post('{quiz}/create_question', 'api\QuestionController@createQuestion');
            Route::get('question/{question}', 'api\QuestionController@Detail_question');
            Route::put('question/{question}', 'api\QuestionController@Update_question');
            Route::delete('question/{question}', 'api\QuestionController@Delete_question');
            //===========================End=Question===================================
            //===========================Start=AcademicYears============================
            Route::post('create_academic', 'api\AcademicYearController@store_academic_years_streamer');
            Route::get('academicYears', 'api\AcademicYearController@get_academic_years_streamer');
            //===========================End=AcademicYears==============================
            //===========================Start=Subjects=================================
            Route::post('create_subjects', 'api\SubjectController@store_subjects_streamer');
            Route::get('subjects', 'api\SubjectController@get_subjects_streamer');
            //===========================End=Subjects====================================
            //===========================Start=Group=====================================
            Route::get('group', 'api\GroupController@groups');
            Route::post('create_group', 'api\GroupController@createGroup');
            Route::get('group/{slug}', 'api\GroupController@Detail_group');
            Route::put('group/{slug}', 'api\GroupController@Update_group');
            Route::delete('group/{slug}', 'api\GroupController@Delete_group');
            //===========================End=Group========================================
            //===========================Start=lesson=====================================
            Route::get('{group}/lesson', 'api\LessonController@lesson');
            Route::post('{group}/create_lesson', 'api\LessonController@createLesson');
            Route::get('lesson/{lesson}', 'api\LessonController@Detail_lesson');
            Route::put('lesson/{lesson}', 'api\LessonController@Update_lesson');
            Route::delete('lesson/{lesson}', 'api\LessonController@Delete_lesson');
            //===========================End=lesson========================================
            //============================Start==Follower==================================
            Route::post('follower_register', 'Auth\ApiAuthStreamerController@followers_register');
            Route::get('streamer_followers', 'Auth\ApiAuthStreamerController@followers');
            //============================End==Follower====================================
        });
    });

    //===========================Start=AcademicYears=====================================
    Route::get('academicYears', 'api\AcademicYearController@index');
    //===========================End=AcademicYears=======================================
    //===========================Start=AcademicYears=====================================
    Route::get('subjects', 'api\SubjectController@index');
    //===========================End=AcademicYears=======================================
    //===========================Start=Governorate=======================================
    Route::get('governorate', 'api\GovernorateController@index');
    //===========================End=Governorate=========================================
});
