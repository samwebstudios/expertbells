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


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('experts/{alias?}/{type?}', [App\Http\Controllers\HomeController::class, 'experts'])->name('experts');

Route::post('expertslottimes', [App\Http\Controllers\HomeController::class, 'expertslottimes'])->name('expertslottimes');
Route::post('bookingprocess', [App\Http\Controllers\HomeController::class, 'bookingprocess'])->name('bookingprocess');
Route::get('payment/{booking}', [App\Http\Controllers\HomeController::class, 'payment'])->name('payment');
Route::get('expert-booking/{booking}', [App\Http\Controllers\HomeController::class, 'bookinglogin'])->name('expertbooking');
Route::get('expert-booking-step2/{booking}', [App\Http\Controllers\HomeController::class, 'bookingstep2'])->name('expertbooking2');
Route::get('paymentquery/{booking}', [App\Http\Controllers\HomeController::class, 'paymentquery'])->name('paymentquery');

Route::name('user.')->prefix('user')->group(function(){
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
        
        Route::get('/cmsmodal/{id}',[App\Http\Controllers\Admin\CmsController::class, 'cmsmodal'])->name('cmsmodal');
        Route::post('/updatecmsmodal',[App\Http\Controllers\Admin\CmsController::class, 'updatecmsmodal'])->name('updatecmsmodal');
        
    });
});