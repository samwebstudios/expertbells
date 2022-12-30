<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::post('expert-login', [App\Http\Controllers\Auth\LoginController::class, 'expertlogin'])->name('expertlogin');
Route::post('expert-login-otp-check', [App\Http\Controllers\Auth\LoginController::class, 'expertloginotpcheck'])->name('expertloginotpcheck');
Route::get('expert-register', [App\Http\Controllers\Auth\RegisterController::class, 'expertregister'])->name('expertregister');
Route::post('expert-register', [App\Http\Controllers\Auth\RegisterController::class, 'saveexpertregister'])->name('saveexpertregister');


Route::post('user-login', [App\Http\Controllers\Auth\LoginController::class, 'userlogin'])->name('userlogin');
Route::post('user-login-otp-check', [App\Http\Controllers\Auth\LoginController::class, 'userloginotpcheck'])->name('userloginotpcheck');

Route::get('user-register', [App\Http\Controllers\Auth\RegisterController::class, 'userregister'])->name('userregister');
Route::post('user-step-first', [App\Http\Controllers\Auth\RegisterController::class, 'usersavestep1'])->name('user.savestep1');
Route::post('sendemailotp', [App\Http\Controllers\Auth\RegisterController::class, 'sendemailotp'])->name('sendemailotp');
Route::post('sendmobileotp', [App\Http\Controllers\Auth\RegisterController::class, 'sendmobileotp'])->name('sendmobileotp');

Route::post('checkbookingemail', [App\Http\Controllers\OtherController::class, 'checkbookingemail'])->name('checkbookingemail');
Route::post('checkbookingmobile', [App\Http\Controllers\OtherController::class, 'checkbookingmobile'])->name('checkbookingmobile');
Route::post('bookingloginprocess', [App\Http\Controllers\OtherController::class, 'bookingloginprocess'])->name('bookingloginprocess');
Route::post('couponapply', [App\Http\Controllers\OtherController::class, 'couponapply'])->name('couponapply');
Route::get('couponcancel/{booking}', [App\Http\Controllers\OtherController::class, 'couponcancel'])->name('couponcancel');
Route::get('paymentresponse/{booking}', [App\Http\Controllers\OtherController::class, 'paymentresponse'])->name('paymentresponse');
Route::post('bookingquery', [App\Http\Controllers\OtherController::class, 'bookingquery'])->name('bookingquery');
Route::post('posthelpquery', [App\Http\Controllers\OtherController::class, 'posthelpquery'])->name('posthelpquery');
Route::post('expertsearch', [App\Http\Controllers\OtherController::class, 'expertsearch'])->name('expertsearch');


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('experts/{alias?}/{type?}', [App\Http\Controllers\HomeController::class, 'experts'])->name('experts');

Route::post('expertslottimes', [App\Http\Controllers\HomeController::class, 'expertslottimes'])->name('expertslottimes');
Route::post('bookingprocess', [App\Http\Controllers\HomeController::class, 'bookingprocess'])->name('bookingprocess');
Route::get('payment/{booking}', [App\Http\Controllers\HomeController::class, 'payment'])->name('payment');
Route::get('expert-booking/{booking}', [App\Http\Controllers\HomeController::class, 'bookinglogin'])->name('expertbooking');
Route::get('expert-booking-step2/{booking}', [App\Http\Controllers\HomeController::class, 'bookingstep2'])->name('expertbooking2');
Route::get('paymentquery/{booking}', [App\Http\Controllers\HomeController::class, 'paymentquery'])->name('paymentquery');

Route::middleware('auth')->name('user.')->prefix('user')->group(function(){
    Route::controller(App\Http\Controllers\User\UserController::class)->group(function(){
        Route::get('user-logout','userlogout')->name('userlogout');
        Route::middleware('userprofilepending')->group(function(){
            Route::get('user-register-second','userregister2')->name('userregister2'); 
            Route::post('user-step-second','savestep2')->name('saveusersetp2');  
            
            Route::get('user-register-third','userregister3')->name('userregister3'); 
            Route::post('user-step-third','savestep3')->name('saveusersetp3'); 
            
            Route::get('user-register-fourth','userregister4')->name('userregister4'); 
            Route::post('user-step-fourth','savestep4')->name('saveusersetp4'); 
            
            Route::get('user-register-fifth','userregister5')->name('userregister5'); 
            Route::post('user-step-fifth','savestep5')->name('saveusersetp5'); 

            Route::get('user-register-sixth','userregister6')->name('userregister6'); 
            Route::post('user-step-sixth','savestep6')->name('saveusersetp6'); 
        });   
        Route::post('bookingrescheduleprocess','bookingrescheduleprocess')->name('bookingrescheduleprocess');
        Route::post('emailnotification','emailnotification')->name('emailnotification');
        Route::post('mobilenotification','mobilenotification')->name('mobilenotification');
        Route::post('deleteaccount','deleteaccount')->name('deleteaccount');
        Route::post('updateprofile','updateprofile')->name('updateprofile');
        Route::post('otherinformation','updateotherinformation')->name('updateotherinformation');
        
        Route::post('countrystates','countrystates')->name('countrystates');        
        Route::post('statecities','statecities')->name('statecities');
        Route::post('reviews','reviews')->name('savereviews');
    });
    Route::controller(App\Http\Controllers\User\HomeController::class)->group(function(){
        // Route::middleware('userprofilecomplete')->group(function(){
            Route::get('dashboard','dashboard')->name('dashboard');

            Route::get('account','account')->name('account');
            Route::get('otherinformation','otherinformation')->name('otherinformation');      
            Route::get('editprofile','editprofile')->name('editprofile');

            Route::get('schedules','schedules')->name('schedules');
            Route::get('reschedules','reschedules')->name('reschedules');
            Route::get('bookinginformation/{bookingid}/','bookinginformation')->name('bookinginformation');
        
            Route::get('reviews','reviews')->name('reviews');
            Route::get('removereviews/{id}','removereviews')->name('removereviews');
            Route::get('editreviews','editreviews')->name('editreviews');

            Route::get('help','help')->name('help');

        // });
    });
});

Route::middleware('expert')->name('expert.')->prefix('expert')->group(function(){
    Route::controller(App\Http\Controllers\Expert\ExpertController::class)->group(function(){
        Route::get('expert-logout','expertlogout')->name('expertlogout');
        Route::post('otherinformation','updateotherinformation')->name('updateotherinformation');
        Route::post('emailnotification','emailnotification')->name('emailnotification');
        Route::post('mobilenotification','mobilenotification')->name('mobilenotification');
        Route::post('profilevisibility','profilevisibility')->name('profilevisibility');
        Route::post('videovisibility','videovisibility')->name('videovisibility');
        Route::post('deleteaccount','deleteaccount')->name('deleteaccount');
        Route::post('getwhatexpect','getwhatexpect')->name('getwhatexpect');
        Route::post('savewhatexpect','savewhatexpect')->name('savewhatexpect');
        Route::post('removewhatexpect','removewhatexpect')->name('removewhatexpect');
        Route::post('updateprofile','updateprofile')->name('updateprofile');

        Route::post('countrystates','countrystates')->name('countrystates');        
        Route::post('statecities','statecities')->name('statecities');

        Route::post('savevideo','savevideo')->name('savevideo');
        Route::post('updatevideo','updatevideo')->name('updatevideo');

        Route::post('addexpertslotprice','addexpertslotprice')->name('addexpertslotprice');
        Route::post('expertslotavailability','expertslotavailability')->name('expertslotavailability');
        Route::post('bookingrescheduleprocess','bookingrescheduleprocess')->name('bookingrescheduleprocess');
        
    });
    Route::controller(App\Http\Controllers\Expert\HomeController::class)->group(function(){
        Route::get('dashboard','dashboard')->name('dashboard');

        Route::get('account','account')->name('account');
        Route::get('otherinformation','otherinformation')->name('otherinformation');        
        Route::get('addwhatexpect','addwhatexpect')->name('addwhatexpect');        
        Route::get('editprofile','editprofile')->name('editprofile');

        Route::get('videos','videos')->name('videos');
        Route::get('editvideo','editvideo')->name('editvideo');
        Route::get('addvideo','addvideo')->name('addvideo');  
        Route::get('removevideo/{id}','removevideo')->name('removevideo'); 
        
        Route::get('slots','slots')->name('slots');
        Route::get('removeavailability/{id}','removeavailability')->name('removeavailability'); 

        Route::get('schedules','schedules')->name('schedules');
        Route::get('reschedules','reschedules')->name('reschedules');
        Route::get('scheduleconfirm/{confirm}/{schedule}','scheduleconfirm')->name('scheduleconfirm');
        Route::get('bookinginformation/{bookingid}/','bookinginformation')->name('bookinginformation');
                
        Route::get('help','help')->name('help');
    });
});

Route::namespace('Admin')->name('admin.')->prefix('control-panel')->group(function(){
    Route::namespace('Auth')->group(function(){
        Route::get('login',[App\Http\Controllers\Admin\Auth\LoginController::class, 'create'])->name('login');
        Route::post('login',[App\Http\Controllers\Admin\Auth\LoginController::class, 'store'])->name('adminlogin');
    });

    Route::middleware('admin')->group(function(){
        Route::post('logout',[App\Http\Controllers\Admin\Auth\LoginController::class, 'destroy'])->name('logout');
        
        Route::get('/',[App\Http\Controllers\Admin\HomeController::class, 'create'])->name('index');
        Route::get('/dashboard',[App\Http\Controllers\Admin\HomeController::class, 'create'])->name('dashboard');
        
        Route::get('/qualifications',[App\Http\Controllers\Admin\QualificationController::class, 'index'])->name('qualifications');
        Route::post('/qualifications',[App\Http\Controllers\Admin\QualificationController::class, 'store'])->name('savequalifications');
        Route::post('/updatequalifications',[App\Http\Controllers\Admin\QualificationController::class, 'update'])->name('updatequalifications');
        Route::get('/editqualification',[App\Http\Controllers\Admin\QualificationController::class, 'edit'])->name('editqualification');
        Route::post('/qualificationsequence',[App\Http\Controllers\Admin\QualificationController::class, 'sequence'])->name('qualificationsequence');
        Route::post('/bulkremovequalification',[App\Http\Controllers\Admin\QualificationController::class, 'bulkremove'])->name('bulkremovequalification');
        Route::get('/remove-qualifications/{id}',[App\Http\Controllers\Admin\QualificationController::class, 'destroy'])->name('removequalifications');
        Route::get('/changequalificationstatus',[App\Http\Controllers\Admin\QualificationController::class, 'status'])->name('changequalificationstatus');

        Route::get('/expertise',[App\Http\Controllers\Admin\ExpertiseController::class, 'index'])->name('expertise');
        Route::post('/expertise-save',[App\Http\Controllers\Admin\ExpertiseController::class, 'store'])->name('expertise.save');
        Route::post('/expertise-update',[App\Http\Controllers\Admin\ExpertiseController::class, 'update'])->name('expertise.update');
        Route::get('/expertise-edit',[App\Http\Controllers\Admin\ExpertiseController::class, 'edit'])->name('expertise.edit');
        Route::post('/expertise-sequence',[App\Http\Controllers\Admin\ExpertiseController::class, 'sequence'])->name('expertise.sequence');
        Route::post('/expertise-bulkremove',[App\Http\Controllers\Admin\ExpertiseController::class, 'bulkremove'])->name('expertise.bulkremove');
        Route::get('/expertise-remove/{id}',[App\Http\Controllers\Admin\ExpertiseController::class, 'destroy'])->name('expertise.remove');
        Route::get('/expertise-status',[App\Http\Controllers\Admin\ExpertiseController::class, 'status'])->name('expertise.status');

        Route::get('/language',[App\Http\Controllers\Admin\LanguageController::class, 'index'])->name('language');
        Route::post('/language-save',[App\Http\Controllers\Admin\LanguageController::class, 'store'])->name('language.save');
        Route::post('/language-update',[App\Http\Controllers\Admin\LanguageController::class, 'update'])->name('language.update');
        Route::get('/language-edit',[App\Http\Controllers\Admin\LanguageController::class, 'edit'])->name('language.edit');
        Route::post('/language-sequence',[App\Http\Controllers\Admin\LanguageController::class, 'sequence'])->name('language.sequence');
        Route::post('/language-bulkremove',[App\Http\Controllers\Admin\LanguageController::class, 'bulkremove'])->name('language.bulkremove');
        Route::get('/language-remove/{id}',[App\Http\Controllers\Admin\LanguageController::class, 'destroy'])->name('language.remove');
        Route::get('/language-status',[App\Http\Controllers\Admin\LanguageController::class, 'status'])->name('language.status');

        Route::get('/role',[App\Http\Controllers\Admin\RoleController::class, 'index'])->name('role');
        Route::post('/role-save',[App\Http\Controllers\Admin\RoleController::class, 'store'])->name('role.save');
        Route::post('/role-update',[App\Http\Controllers\Admin\RoleController::class, 'update'])->name('role.update');
        Route::get('/role-edit',[App\Http\Controllers\Admin\RoleController::class, 'edit'])->name('role.edit');
        Route::post('/role-sequence',[App\Http\Controllers\Admin\RoleController::class, 'sequence'])->name('role.sequence');
        Route::post('/role-bulkremove',[App\Http\Controllers\Admin\RoleController::class, 'bulkremove'])->name('role.bulkremove');
        Route::get('/role-remove/{id}',[App\Http\Controllers\Admin\RoleController::class, 'destroy'])->name('role.remove');
        Route::get('/role-status',[App\Http\Controllers\Admin\RoleController::class, 'status'])->name('role.status');

        Route::get('/industry',[App\Http\Controllers\Admin\IndustryController::class, 'index'])->name('industry');
        Route::post('/industry-save',[App\Http\Controllers\Admin\IndustryController::class, 'store'])->name('industry.save');
        Route::post('/industry-update',[App\Http\Controllers\Admin\IndustryController::class, 'update'])->name('industry.update');
        Route::get('/industry-edit',[App\Http\Controllers\Admin\IndustryController::class, 'edit'])->name('industry.edit');
        Route::post('/industry-sequence',[App\Http\Controllers\Admin\IndustryController::class, 'sequence'])->name('industry.sequence');
        Route::post('/industry-bulkremove',[App\Http\Controllers\Admin\IndustryController::class, 'bulkremove'])->name('industry.bulkremove');
        Route::get('/industry-remove/{id}',[App\Http\Controllers\Admin\IndustryController::class, 'destroy'])->name('industry.remove');
        Route::get('/industry-status',[App\Http\Controllers\Admin\IndustryController::class, 'status'])->name('industry.status');

        Route::get('/working',[App\Http\Controllers\Admin\WorkingController::class, 'index'])->name('working');
        Route::post('/working-save',[App\Http\Controllers\Admin\WorkingController::class, 'store'])->name('working.save');
        Route::post('/working-update',[App\Http\Controllers\Admin\WorkingController::class, 'update'])->name('working.update');
        Route::get('/working-edit',[App\Http\Controllers\Admin\WorkingController::class, 'edit'])->name('working.edit');
        Route::post('/working-sequence',[App\Http\Controllers\Admin\WorkingController::class, 'sequence'])->name('working.sequence');
        Route::post('/working-bulkremove',[App\Http\Controllers\Admin\WorkingController::class, 'bulkremove'])->name('working.bulkremove');
        Route::get('/working-remove/{id}',[App\Http\Controllers\Admin\WorkingController::class, 'destroy'])->name('working.remove');
        Route::get('/working-status',[App\Http\Controllers\Admin\WorkingController::class, 'status'])->name('working.status');

        Route::get('/getbetter',[App\Http\Controllers\Admin\GetBetterController::class, 'index'])->name('getbetter');
        Route::post('/getbetter-save',[App\Http\Controllers\Admin\GetBetterController::class, 'store'])->name('getbetter.save');
        Route::post('/getbetter-update',[App\Http\Controllers\Admin\GetBetterController::class, 'update'])->name('getbetter.update');
        Route::get('/getbetter-edit',[App\Http\Controllers\Admin\GetBetterController::class, 'edit'])->name('getbetter.edit');
        Route::post('/getbetter-sequence',[App\Http\Controllers\Admin\GetBetterController::class, 'sequence'])->name('getbetter.sequence');
        Route::post('/getbetter-bulkremove',[App\Http\Controllers\Admin\GetBetterController::class, 'bulkremove'])->name('getbetter.bulkremove');
        Route::get('/getbetter-remove/{id}',[App\Http\Controllers\Admin\GetBetterController::class, 'destroy'])->name('getbetter.remove');
        Route::get('/getbetter-status',[App\Http\Controllers\Admin\GetBetterController::class, 'status'])->name('getbetter.status');

        Route::get('/hearabout',[App\Http\Controllers\Admin\HearAboutController::class, 'index'])->name('hearabout');
        Route::post('/hearabout-save',[App\Http\Controllers\Admin\HearAboutController::class, 'store'])->name('hearabout.save');
        Route::post('/hearabout-update',[App\Http\Controllers\Admin\HearAboutController::class, 'update'])->name('hearabout.update');
        Route::get('/hearabout-edit',[App\Http\Controllers\Admin\HearAboutController::class, 'edit'])->name('hearabout.edit');
        Route::post('/hearabout-sequence',[App\Http\Controllers\Admin\HearAboutController::class, 'sequence'])->name('hearabout.sequence');
        Route::post('/hearabout-bulkremove',[App\Http\Controllers\Admin\HearAboutController::class, 'bulkremove'])->name('hearabout.bulkremove');
        Route::get('/hearabout-remove/{id}',[App\Http\Controllers\Admin\HearAboutController::class, 'destroy'])->name('hearabout.remove');
        Route::get('/hearabout-status',[App\Http\Controllers\Admin\HearAboutController::class, 'status'])->name('hearabout.status');

        Route::get('/expert-category',[App\Http\Controllers\Admin\ExpertCategoryController::class, 'index'])->name('expertcategory');
        Route::post('/expertcategory-save',[App\Http\Controllers\Admin\ExpertCategoryController::class, 'store'])->name('expertcategory.save');
        Route::post('/expertcategory-update',[App\Http\Controllers\Admin\ExpertCategoryController::class, 'update'])->name('expertcategory.update');
        Route::get('/expertcategory-edit',[App\Http\Controllers\Admin\ExpertCategoryController::class, 'edit'])->name('expertcategory.edit');
        Route::post('/expertcategory-sequence',[App\Http\Controllers\Admin\ExpertCategoryController::class, 'sequence'])->name('expertcategory.sequence');
        Route::post('/expertcategory-bulkremove',[App\Http\Controllers\Admin\ExpertCategoryController::class, 'bulkremove'])->name('expertcategory.bulkremove');
        Route::get('/expertcategory-remove/{id}',[App\Http\Controllers\Admin\ExpertCategoryController::class, 'destroy'])->name('expertcategory.remove');
        Route::get('/expertcategory-status',[App\Http\Controllers\Admin\ExpertCategoryController::class, 'status'])->name('expertcategory.status');

        Route::get('/experts',[App\Http\Controllers\Admin\ExpertController::class, 'index'])->name('experts');
        Route::post('/experts-save',[App\Http\Controllers\Admin\ExpertController::class, 'store'])->name('experts.save');
        Route::post('/experts-update',[App\Http\Controllers\Admin\ExpertController::class, 'update'])->name('experts.update');
        Route::get('/experts-edit',[App\Http\Controllers\Admin\ExpertController::class, 'edit'])->name('experts.edit');
        Route::post('/experts-sequence',[App\Http\Controllers\Admin\ExpertController::class, 'sequence'])->name('experts.sequence');
        Route::post('/experts-bulkremove',[App\Http\Controllers\Admin\ExpertController::class, 'bulkremove'])->name('experts.bulkremove');
        Route::get('/experts-remove/{id}',[App\Http\Controllers\Admin\ExpertController::class, 'destroy'])->name('experts.remove');
        Route::get('/experts-status',[App\Http\Controllers\Admin\ExpertController::class, 'status'])->name('experts.status');
        Route::get('/experts-topstatus',[App\Http\Controllers\Admin\ExpertController::class, 'topstatus'])->name('experts.topstatus');

        Route::get('/users',[App\Http\Controllers\Admin\UserController::class, 'index'])->name('users');
        Route::post('/users-save',[App\Http\Controllers\Admin\UserController::class, 'store'])->name('users.save');
        Route::post('/users-update',[App\Http\Controllers\Admin\UserController::class, 'update'])->name('users.update');
        Route::get('/users-edit',[App\Http\Controllers\Admin\UserController::class, 'edit'])->name('users.edit');
        Route::post('/users-sequence',[App\Http\Controllers\Admin\UserController::class, 'sequence'])->name('users.sequence');
        Route::post('/users-bulkremove',[App\Http\Controllers\Admin\UserController::class, 'bulkremove'])->name('users.bulkremove');
        Route::get('/users-remove/{id}',[App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('users.remove');
        Route::get('/users-status',[App\Http\Controllers\Admin\UserController::class, 'status'])->name('users.status');

        Route::get('/schedules/{booked}',[App\Http\Controllers\Admin\ScheduleController::class, 'index'])->name('schedules.booked');
        Route::get('/assignexpert',[App\Http\Controllers\Admin\ScheduleController::class, 'assignexpert'])->name('schedules.assignexpert');
        Route::post('/assignexpert',[App\Http\Controllers\Admin\ScheduleController::class, 'reassignexpert'])->name('schedules.reassignexpert');
        Route::post('/assignexpertinfo',[App\Http\Controllers\Admin\ScheduleController::class, 'assignexpertinfo'])->name('schedules.assignexpertinfo');
        Route::get('/information',[App\Http\Controllers\Admin\ScheduleController::class, 'information'])->name('schedules.information');
        
        Route::get('/help-center',[App\Http\Controllers\Admin\HelpCenterController::class, 'index'])->name('helpcenter.list');
        Route::get('/add-help-center',[App\Http\Controllers\Admin\HelpCenterController::class, 'create'])->name('helpcenter.add');
        Route::get('/edit-help-center/{id}',[App\Http\Controllers\Admin\HelpCenterController::class, 'edit'])->name('helpcenter.edit');
        Route::get('/remove-help-center/{id}',[App\Http\Controllers\Admin\HelpCenterController::class, 'destroy'])->name('helpcenter.remove');
        Route::post('/save-help-center',[App\Http\Controllers\Admin\HelpCenterController::class, 'store'])->name('helpcenter.save');
        Route::post('/update-help-center',[App\Http\Controllers\Admin\HelpCenterController::class, 'update'])->name('helpcenter.update');
        Route::post('/help-center-sequence',[App\Http\Controllers\Admin\HelpCenterController::class, 'sequence'])->name('helpcenter.sequence');
        Route::post('/help-center-bulkremove',[App\Http\Controllers\Admin\HelpCenterController::class, 'bulkremove'])->name('helpcenter.bulkremove');
        Route::get('/help-center-status',[App\Http\Controllers\Admin\HelpCenterController::class, 'status'])->name('helpcenter.status');
        
        Route::get('/help-center-query',[App\Http\Controllers\Admin\HelpCenterController::class, 'query'])->name('helpcenterquery.list');
        Route::get('/remove-help-center-query/{id}',[App\Http\Controllers\Admin\HelpCenterController::class, 'querydestroy'])->name('helpcenterquery.remove');
        Route::post('/help-center-query-bulkremove',[App\Http\Controllers\Admin\HelpCenterController::class, 'querybulkremove'])->name('helpcenterquery.bulkremove');
        
        Route::get('/teams',[App\Http\Controllers\Admin\TeamController::class, 'index'])->name('teams');
        Route::get('/teamslist',[App\Http\Controllers\Admin\TeamController::class, 'teamslist'])->name('teamslist');
        Route::get('/addteams',[App\Http\Controllers\Admin\TeamController::class, 'create'])->name('addteams');
        Route::get('/editteams/{id}',[App\Http\Controllers\Admin\TeamController::class, 'edit'])->name('editteams');
        Route::post('/saveteams',[App\Http\Controllers\Admin\TeamController::class, 'store'])->name('saveteams');
        Route::post('/updateteams',[App\Http\Controllers\Admin\TeamController::class, 'update'])->name('updateteams');
        Route::any('/teamspublish',[App\Http\Controllers\Admin\TeamController::class, 'status'])->name('teamspublish');
        Route::post('/teamssequence',[App\Http\Controllers\Admin\TeamController::class, 'sequence'])->name('teamssequence');
        Route::post('/bulkdestory',[App\Http\Controllers\Admin\TeamController::class, 'bulkdestory'])->name('bulkdestoryteams');
        Route::get('/removeteams/{removeid}',[App\Http\Controllers\Admin\TeamController::class, 'destory'])->name('removeteams');

        Route::get('/career',[App\Http\Controllers\Admin\CareerController::class, 'create'])->name('career');
        Route::get('/addcareer',[App\Http\Controllers\Admin\CareerController::class, 'add'])->name('addcareer');
        Route::get('/editcareer/{id}',[App\Http\Controllers\Admin\CareerController::class, 'edit'])->name('editcareer');
        Route::post('/savecareer',[App\Http\Controllers\Admin\CareerController::class, 'store'])->name('savecareer');
        Route::post('/updatecareer',[App\Http\Controllers\Admin\CareerController::class, 'update'])->name('updatecareer');
        Route::any('/careerpublish',[App\Http\Controllers\Admin\CareerController::class, 'status'])->name('careerpublish');
        Route::post('/careersequence',[App\Http\Controllers\Admin\CareerController::class, 'sequence'])->name('careersequence');
        Route::post('/bulkcareerdestory',[App\Http\Controllers\Admin\CareerController::class, 'bulkdestory'])->name('bulkcareerdestory');
        Route::get('/removecareer/{removeid}',[App\Http\Controllers\Admin\CareerController::class, 'destory'])->name('removecareer');
      
        Route::get('/blog-category', [App\Http\Controllers\Admin\BlogCategoryController::class, 'index'])->name('blogcategory');
        Route::get('/new-blog-category', [App\Http\Controllers\Admin\BlogCategoryController::class, 'New'])->name('newblogcategory');
        Route::post('/save-blog-category', [App\Http\Controllers\Admin\BlogCategoryController::class, 'Save'])->name('saveblogcategory');
        Route::get('/edit-blog-category/{id}', [App\Http\Controllers\Admin\BlogCategoryController::class, 'Edit'])->name('editblogcategory');
        Route::post('/update-blog-category', [App\Http\Controllers\Admin\BlogCategoryController::class, 'Update'])->name('updateblogcategory');
        Route::any('/blog-category-publish',[App\Http\Controllers\Admin\BlogCategoryController::class, 'status'])->name('blogcategorypublish');
        Route::post('/blog-category-sequence',[App\Http\Controllers\Admin\BlogCategoryController::class, 'sequence'])->name('blogcategorysequence');
        Route::post('/bulk-blog-category-destory',[App\Http\Controllers\Admin\BlogCategoryController::class, 'bulkdestory'])->name('bulkblogcategorydestory');
        Route::get('/remove-blog-category/{removeid}', [App\Http\Controllers\Admin\BlogCategoryController::class, 'Remove'])->name('blogcategoryremove');

        Route::get('/blog-management', [App\Http\Controllers\Admin\BlogController::class, 'index'])->name('blogs');
        Route::get('/new-blog', [App\Http\Controllers\Admin\BlogController::class, 'New'])->name('newblog');
        Route::post('/save-blog', [App\Http\Controllers\Admin\BlogController::class, 'Save'])->name('saveblog');
        Route::get('/edit-blog/{id}', [App\Http\Controllers\Admin\BlogController::class, 'Edit'])->name('editblog');
        Route::post('/update-blog', [App\Http\Controllers\Admin\BlogController::class, 'Update'])->name('updateblog');
        Route::get('/blog-popular/{status}/{id}', [App\Http\Controllers\Admin\BlogController::class, 'Popular'])->name('blogpopular');
        Route::any('/blogpublish',[App\Http\Controllers\Admin\BlogController::class, 'status'])->name('blogpublish');
        Route::post('/blogsequence',[App\Http\Controllers\Admin\BlogController::class, 'sequence'])->name('blogsequence');
        Route::post('/bulkblogdestory',[App\Http\Controllers\Admin\BlogController::class, 'bulkdestory'])->name('bulkblogdestory');
        Route::get('/remove-blog/{removeid}', [App\Http\Controllers\Admin\BlogController::class, 'Remove'])->name('blogremove');

        Route::get('/faqs-category/{id?}', [App\Http\Controllers\Admin\FaqCategoryController::class, 'index'])->name('faqscategory');
        Route::get('/new-faqs-category/{id?}', [App\Http\Controllers\Admin\FaqCategoryController::class, 'New'])->name('newfaqscategory');
        Route::post('/save-faqs-category', [App\Http\Controllers\Admin\FaqCategoryController::class, 'Save'])->name('savefaqscategory');
        Route::get('/edit-faqs-category/{id}', [App\Http\Controllers\Admin\FaqCategoryController::class, 'Edit'])->name('editfaqscategory');
        Route::post('/update-faqs-category', [App\Http\Controllers\Admin\FaqCategoryController::class, 'Update'])->name('updatefaqscategory');
        Route::any('/faqs-category-publish',[App\Http\Controllers\Admin\FaqCategoryController::class, 'status'])->name('faqscategorypublish');
        Route::post('/faqs-category-sequence',[App\Http\Controllers\Admin\FaqCategoryController::class, 'sequence'])->name('faqscategorysequence');
        Route::post('/bulk-faqs-category-destory',[App\Http\Controllers\Admin\FaqCategoryController::class, 'bulkdestory'])->name('bulkfaqscategorydestory');
        Route::get('/remove-faqs-category/{removeid}', [App\Http\Controllers\Admin\FaqCategoryController::class, 'Remove'])->name('faqscategoryremove');

        Route::get('/faqs', [App\Http\Controllers\Admin\FaqController::class, 'index'])->name('faqs');
        Route::get('/new-faqs/{id?}', [App\Http\Controllers\Admin\FaqController::class, 'New'])->name('newfaqs');
        Route::post('/save-faqs', [App\Http\Controllers\Admin\FaqController::class, 'Save'])->name('savefaqs');
        Route::get('/edit-faqs/{id}', [App\Http\Controllers\Admin\FaqController::class, 'Edit'])->name('editfaqs');
        Route::post('/update-faqs', [App\Http\Controllers\Admin\FaqController::class, 'Update'])->name('updatefaqs');
        Route::any('/faqs-publish',[App\Http\Controllers\Admin\FaqController::class, 'status'])->name('faqspublish');
        Route::post('/faqs-sequence',[App\Http\Controllers\Admin\FaqController::class, 'sequence'])->name('faqssequence');
        Route::post('/bulk-faqs-destory',[App\Http\Controllers\Admin\FaqController::class, 'bulkdestory'])->name('bulkfaqsdestory');
        Route::get('/remove-faqs/{removeid}', [App\Http\Controllers\Admin\FaqController::class, 'Remove'])->name('faqsremove');

        Route::get('/cmsmodal/{id}',[App\Http\Controllers\Admin\CmsController::class, 'cmsmodal'])->name('cmsmodal');
        Route::get('/about',[App\Http\Controllers\Admin\CmsController::class, 'about'])->name('about');
        Route::get('/mission',[App\Http\Controllers\Admin\CmsController::class, 'mission'])->name('mission');
        Route::get('/vission',[App\Http\Controllers\Admin\CmsController::class, 'vission'])->name('vission');
        Route::get('/teamcms',[App\Http\Controllers\Admin\CmsController::class, 'teamcms'])->name('teamcms');
        Route::get('/blogcms',[App\Http\Controllers\Admin\CmsController::class, 'blogcms'])->name('blogcms');
        Route::get('/privacy-policy',[App\Http\Controllers\Admin\CmsController::class, 'privacypolicy'])->name('privacypolicy');
        Route::get('/terms-condition',[App\Http\Controllers\Admin\CmsController::class, 'termscondition'])->name('termscondition');
        Route::post('/updatecmsmodal',[App\Http\Controllers\Admin\CmsController::class, 'updatecmsmodal'])->name('updatecmsmodal');
        Route::post('/updatecms',[App\Http\Controllers\Admin\CmsController::class, 'updatecms'])->name('updatecms');
        Route::post('/editorimage',[App\Http\Controllers\Admin\CmsController::class, 'editorimage'])->name('editorimage');
    });
});