<?php

use App\Http\Controllers\Api\customer\ReviewController;
use App\Services\passengers\AddPassengerServices;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GenerateTicket;

use App\Http\Controllers\Api\ListController;
use App\Http\Controllers\Api\ShowController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\admin\BusController;
use App\Http\Controllers\Api\admin\PathController;
use App\Http\Controllers\Api\Auth\AdminController;
use App\Http\Controllers\Api\Auth\AgentController;
use App\Http\Controllers\Api\admin\ImageController;
use App\Http\Controllers\Api\admin\UsersController;
use App\Http\Controllers\Api\admin\AgencyController;
use App\Http\Controllers\Api\admin\BrandAmbassadorController;
use App\Http\Controllers\Api\admin\TravelController;
use App\Http\Controllers\Api\test\TestOtpController;
use App\Http\Controllers\Api\Auth\CustomerController;
use App\Http\Controllers\Api\admin\ScheduleController;
use App\Http\Controllers\Api\GenerateTravelController;
use App\Http\Controllers\Api\admin\DetailsAppsResource;
use App\Http\Controllers\Api\admin\DetailAdminController;
use App\Http\Controllers\Api\agent\AddPassengerController;
use App\Http\Controllers\Api\customer\CodeCheckController;
use App\Http\Controllers\Api\customer\PassengerController;
use App\Http\Controllers\Api\test\TestCodePromoController;
use App\Http\Controllers\Api\customer\ResetPasswordController;
use App\Http\Controllers\Api\customer\ForgotPasswordController;
use App\Http\Controllers\Api\customer\DetailUserLoginController;
use App\Http\Controllers\Api\notifications\NotificationController;
use App\Http\Controllers\Api\test\payment\stripe\StripeController;
use App\Http\Controllers\Api\agent\BusController as AgentBusController;
use App\Http\Controllers\Api\agent\PathController as AgentPathController;
use App\Http\Controllers\Api\agent\AgencyController as AgentAgencyController;
use App\Http\Controllers\Api\agent\DetailAgentController;
use App\Http\Controllers\Api\agent\DetailsAppsResourceController;
use App\Http\Controllers\Api\agent\ListTravelController;
use App\Http\Controllers\Api\agent\TravelController as AgentTravelController;
use App\Http\Controllers\Api\agent\ScheduleController as AgentScheduleController;
use App\Http\Controllers\Api\agent\subagency\DetailSubAgencyController;
use App\Http\Controllers\Api\agent\TicketController;
use App\Http\Controllers\Api\customer\Ticket\TicketController as TicketTicketController;
use App\Http\Controllers\Api\Payment\OrangeMoneyController;

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
    //All endpoints for unauth user

    Route::post('login',[CustomerController::class,'login']);
    Route::post('login/admin',[AdminController::class,'login']);
    Route::post('login/personnal/agent',[AgentController::class,'loginAgent']);
    Route::post('login/agent',[AgentController::class,'login']);
    Route::post('register',[CustomerController::class,'register']);
    Route::post('testOtp',[TestOtpController::class,'testOtp']);
    Route::post('verify/Otp',[CustomerController::class,'verifyOtp']);
    Route::post('sendCode',ForgotPasswordController::class);
    Route::post('password/code/check', [CodeCheckController::class,'check']);
    Route::post('password/reset', [ResetPasswordController::class,'reset']);
    Route::post('resend/otp/{mobile}',[CustomerController::class,'sendOtp']);
    Route::post('send/notifications',[NotificationController::class,'sendNotification']);
    Route::post('generate/travels/{path_id}',[GenerateTravelController::class,'generateTravelToThwoMonth']);
    Route::get('updatePrice/{classe}/{price}/{agency_id}',[GenerateTravelController::class,'updatePrice']);
    Route::post('searchFull/travel',[SearchController::class,'searchFull']);
    Route::post('search/byAgency/{id}',[SearchController::class,'searchByAgency']);
    Route::get('list/hours',[ListController::class,'listHours']);
    Route::get('list/departures',[ListController::class,'listDeparture']);
    Route::get('list/arrival',[ListController::class,'listArrival']);
    Route::get('generate',[GenerateTravelController::class,'generateTravelToThreeMonth']);
    Route::get('list/notifications',[NotificationController::class,'getNotifications']);
    Route::get('show/agency/{id}',[ShowController::class,'detailAgency']);
    Route::get('show/bus/{id}',[ShowController::class,'detailBus']);
    Route::get('show/path/{id}',[ShowController::class,'detailPath']);
    Route::get('show/schedules/{id}',[ShowController::class,'detailSchedule']);
    Route::get('show/travel/{id}',[ShowController::class,'detailTravel']);
    Route::get('list/town',[ListController::class,'listTown']);
    Route::get('placesOfTravel/{travel_id}',[ListController::class,'listPlaces']);
    Route::get('list/travel/schedules',[ListController::class,'listTime']);
    Route::get('list/agencies/{paginate}',[ListController::class,'listAgency']);
    Route::get('list/buses',[ListController::class,'listBus']);
    Route::get('list/paths/{paginate}',[ListController::class,'listPath']);
    Route::get('list/schedules/{paginate}',[ListController::class,'listSchedule']);
    Route::get('list/travels/{paginate}',[ListController::class,'listTravel']);
    Route::get('list/subAgencies/{id}',[ListController::class,'listSubagencies']);
    Route::get('placeIsBusy/{travel_id}',[PassengerController::class,'listPlace']);
    Route::get('image/{path}', [ImageController::class, 'getImage']);
    Route::get("search/{term}",[SearchController::class,'search']);
    Route::get('list/brandAmbassadors',[ListController::class,'listAmbassadors']);
    Route::get('listAgencyByPath/{departure}/{arrival}',[ListController::class,'listAgencyWithPath']);
    Route::get('listTravelByAgency/{agency_id}',[ListTravelController::class,'list']);
    Route::post('listTravelWithDateAndClass/{id}/{localisation}',[ListTravelController::class,'listTravelWithDateAndClass']);
    Route::get('listTravelWithLocalisation/{id}/{localisation}',[ListTravelController::class,'listTravelWithLocalisation']);
    Route::post('generate',[GenerateTicket::class,'generateTicket']);
    Route::post('generate/token',[GenerateTicket::class,'generateToken']);



    //Services

    Route::post('add/passengers/{id}/{sub_agency_id}',[AddPassengerController::class,'add']);

   // All endpoints for admin
    Route::middleware('auth:api-admin')->prefix('v1')->group(function(){

        Route::apiResource('travels',TravelController::class);
        Route::apiResource('brands',BrandAmbassadorController::class);
        Route::apiResource('buses',BusController::class);
        Route::apiResource('Schedules',ScheduleController::class);
        Route::apiResource('paths',PathController::class);
        Route::apiResource('users',UsersController::class);
        Route::apiResource('agencies',AgencyController::class);
        Route::get('brandGirls/details',[BrandAmbassadorController::class,'details']);
        Route::post('logout/adm/private',[AdminController::class,'logout']);

        Route::get('routes',[CustomerController::class,'routeList']);
        Route::get('agencyCount',[AgencyController::class,'countAllAgency']);
        Route::get('details/admin',[DetailAdminController::class,'infosAdmin']);
        Route::get('adm/resource',[DetailAdminController::class,'CountResource']);
        Route::get('list/users/byAmbassadors/{AmbassadorId}',[ListController::class,'ambassadorsWithUser']);
    });


    // All endpoints for agents
    Route::middleware('auth:api-agent')->prefix('v1')->group(function(){

        //endPoint agent-agencies
        Route::patch('update/MyOwnAgency/{id}',[AgentAgencyController::class,'update']);

        //endPoint agent-buses

        Route::patch('update/MyOwnBuses/{id}',[AgentBusController::class,'update']);
        Route::post('store/bus',[AgentBusController::class,'store']);
        Route::delete('destroy/MyOwnBus/{id}',[AgentBusController::class,'destroy']);

        //endPoint agent-paths

        Route::patch('update/MyOwnPaths/{id}',[AgentPathController::class,'update']);
        Route::post('store/path',[AgentPathController::class,'store']);
        Route::delete('destroy/MyOwnPath/{id}',[AgentPathController::class,'destroy']);

        //endPoint agent-schedules


        Route::patch('update/MyOwnSchedule/{id}',[AgentScheduleController::class,'update']);
        Route::post('store/MyOwnSchedule',[AgentScheduleController::class,'store']);
        Route::delete('destroy/MyOwnSchedule/{id}',[AgentScheduleController::class,'destroy']);


        //endPoint agent-travel

        Route::patch('update/MyOwnTravel/{id}',[AgentTravelController::class,'update']);
        Route::post('store/MyOwnTravel',[AgentTravelController::class,'store']);
        Route::delete('destroy/MyOwnTravel/{id}',[AgentTravelController::class,'destroy']);

        Route::post('logout/agt/private',[AgentController::class,'logout']);

        Route::get('details/agent',[DetailAgentController::class,'infosAgent']);

        Route::get('list/ticket',[TicketController::class,'listTickets']);
        Route::get('list/ticketsOfTravel/{id}',[TicketController::class,'listTicketsOfTravel']);
        Route::get('list/tickets/recents',[TicketController::class,'listTicketsPaginate']);

        Route::get('count/resources',[DetailsAppsResourceController::class,'CountResource']);
        Route::get('details/subAgent',[DetailSubAgencyController::class,'detailSubAgency']);
        Route::get('details/AgencyBySubAgent',[DetailSubAgencyController::class,'detailAgencyBySubAgency']);

    });


    // All endpoints for users
    Route::middleware('auth:api')->prefix('v1')->group(function(){

        Route::post('logout',[CustomerController::class,'logout']);
        Route::get('details/user',[DetailUserLoginController::class,'infosUser']);
        Route::post('stripe/test/payment/{id}/{price}/{codePromo}/{subId}',[StripeController::class,'stripeTestPayment']);
        Route::get('list/passengers/{id}',[PassengerController::class,'listPassenger']);
        Route::post('add/passengers/{travel_id}/{subAgencyId}',[PassengerController::class,'addPassenger']);
        Route::post('updatePlace/{payment_id}',[PassengerController::class,'updatePlace']);
        Route::get('list/travels/buy',[PassengerController::class,'listTravelsOfUser']);
        Route::get('list/tickets',[TicketTicketController::class,'listTicket']);
        Route::get('get/qrCode/{id}',[TicketTicketController::class,'getQrCode']);
        Route::get('ToApply/promoCode/{code}/{price}',[TestCodePromoController::class,'testCodePost']);
        Route::post('sendReview/{agency_id}',[ReviewController::class,'SendReview']);
        Route::post('pay/withOrangeMoney/{number}/{amount}/{subId}',[OrangeMoneyController::class,'pay']);
        Route::get('getPayment/status/{token}/{payToken}/{id}/{codePromo}/{subId}/{price}',[OrangeMoneyController::class,'getPaymentStatus']);
        Route::post('delete/Account',[CustomerController::class,'deleteAccount']);
        Route::put('update/passengers/{id}',[PassengerController::class,'update']);
        Route::get('getTicket/{id}',[TicketTicketController::class,'getTicket']);
    });




// Route::get('bus',[BusController::class,'index']);
// Route::get('path',[PathController::class,'index']);
// Route::get('travel',[TravelController::class,'index']);

Route::get('/test', function(Request $request){
    return "Authenticated";
});

