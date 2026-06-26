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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::any('/v1/all-speakers', ['as' => 'all-speakers', 'uses' => 'API\V1\SpeakerController@allSpeakers']);

Route::any('/v1/all-focus-sectors', ['as' => 'all-focus-sectors', 'uses' => 'API\V1\SectorController@allFocusSectors']);

Route::any('/v1/all-objectives', ['as' => 'all-objectives', 'uses' => 'API\V1\ObjectiveController@allObjective']);

Route::any('/v1/all-hotels', ['as' => 'all-hotels', 'uses' => 'API\V1\AccomadationController@allHotels']);

Route::any('/v1/all-schedule-dates', ['as' => 'all-schedule-dates', 'uses' => 'API\V1\ScheduleController@allScheduleDates']);

Route::any('/v1/all-schedule', ['as' => 'all-schedule', 'uses' => 'API\V1\ScheduleController@allSchedule']);

Route::any('/v1/all-state-progress', ['as' => 'all-state-progress', 'uses' => 'API\V1\EaseOfDoingController@allStateProgress']);

Route::any('/v1/incentive-concession', ['as' => 'incentive-concession', 'uses' => 'API\V1\EaseOfDoingController@incentivesConcessionDetails']);

Route::any('/v1/act-and-rules', ['as' => 'act-and-rules', 'uses' => 'API\V1\EaseOfDoingController@actsRules']);

Route::any('/v1/all-media-gallery', ['as' => 'all-media-gallery', 'uses' => 'API\V1\MediaGalleryController@allMediaGallery']);

Route::any('/v1/all-sectoral-session', ['as' => 'all-sectoral-session', 'uses' => 'API\V1\SectorController@allSectors']);

Route::any('/v1/industrial-profile', ['as' => 'industrial-profile', 'uses' => 'API\V1\IndustrialProfileController@allIndustrialProfile']);

Route::any('/v1/industrial-profile-highlights', ['as' => 'industrial-profile-highlights', 'uses' => 'API\V1\IndustrialProfileController@allIndustrialProfileHighlights']);

Route::any('/v1/all-stats', ['as' => 'all-stats', 'uses' => 'API\V1\WhyHimachalController@allStats']);

Route::any('/v1/all-partner-countries', ['as' => 'all-partner-countries', 'uses' => 'API\V1\PartnersController@allPartners']);

Route::any('/v1/all-organizers', ['as' => 'all-organizers', 'uses' => 'API\V1\PartnersController@allOrganisersListing']);

Route::any('/v1/individual-register', ['as' => 'individual-register', 'uses' => 'API\V1\RegisterController@individualRegister']);

Route::any('/v1/bgmeeting-register', ['as' => 'bgmeeting-register', 'uses' => 'API\V1\RegisterController@bGMeetingRegister']);

Route::any('/v1/individual', ['as' => 'individual', 'uses' => 'API\V1\RegisterController@individualRegister']);

Route::any('/v1/bgmeeting', ['as' => 'bgmeeting', 'uses' => 'API\V1\RegisterController@bGMeetingRegister']);

Route::any('/v1/enquiry', ['as' => 'enquiry', 'uses' => 'API\V1\EnquiryController@enquiry']);

Route::any('/v1/overview', ['as' => 'overview', 'uses' => 'API\V1\ObjectiveController@aboutRisingHimachal']);

Route::any('/v1/policies', ['as' => 'overview', 'uses' => 'API\V1\WhyHimachalController@policies']);

Route::any('/v1/all-policies', ['as' => 'overview', 'uses' => 'API\V1\WhyHimachalController@new_policies']);

Route::any('/v1/add-partners', ['as' => 'add-partners', 'uses' => 'API\V1\PartnerInProgressController@addPartners']);


Route::any('/v1/add-partners-logos', ['as' => 'add-partners-logos', 'uses' => 'API\V1\PartnerInProgressController@addPartnersLogos']);

Route::any('/v1/all-partner-in-progress', ['as' => 'all-partner-in-progress', 'uses' => 'API\V1\PartnerInProgressController@allPartners']);

Route::any('/v1/add-album', ['as' => 'add-album', 'uses' => 'API\V1\AlbumController@addAlbum']);

Route::any('/v1/add-album-images', ['as' => 'add-album-images', 'uses' => 'API\V1\AlbumController@addAlbumImages']);

Route::any('/v1/all-albums', ['as' => 'all-albums', 'uses' => 'API\V1\AlbumController@allAlbums']);

Route::any('/v1/all-album-images', ['as' => 'all-album-images', 'uses' => 'API\V1\AlbumController@allAlbumsImages']);

Route::any('/v1/add-venue-detail', ['as' => 'add-venue-detail', 'uses' => 'API\V1\VenueDetailController@addVenueDetail']);

Route::any('/v1/all-venue-detail', ['as' => 'all-venue-detail', 'uses' => 'API\V1\VenueDetailController@allVenueDetails']);

Route::any('/v1/add-investible-projects', ['as' => 'add-investible-projects', 'uses' => 'API\V1\InvestibleProjectController@addInvestibleProject']);

Route::any('/v1/add-investment-opportunity', ['as' => 'add-investment-opportunity', 'uses' => 'API\V1\InvestibleProjectController@addInvestmentOpportunity']);

Route::any('/v1/all-investible-projects', ['as' => 'all-investible-projects', 'uses' => 'API\V1\InvestibleProjectController@allInvestibleProject']);


Route::any('/v1/all-investment-opportunity', ['as' => 'all-investment-opportunity', 'uses' => 'API\V1\InvestibleProjectController@allInvestmentOpportunity']);

Route::any('/v1/add-faq-heading', ['as' => 'add-faq-heading', 'uses' => 'API\V1\FaqHeadingController@addFaqHeading']);

Route::any('/v1/add-faq-question', ['as' => 'add-faq-question', 'uses' => 'API\V1\FaqHeadingController@addFaqQuestion']);

Route::any('/v1/all-faq-question', ['as' => 'all-faq-question', 'uses' => 'API\V1\FaqHeadingController@allFaqQuestion']);

Route::any('/v1/add-location', ['as' => 'add-location', 'uses' => 'API\V1\LocationController@addLocation']);

Route::any('/v1/all-location', ['as' => 'all-location', 'uses' => 'API\V1\LocationController@allLocation']);

Route::any('/v1/add-cii-location', ['as' => 'add-cii-location', 'uses' => 'API\V1\LocationController@addCiiLocation']);

Route::any('/v1/all-cii-location', ['as' => 'all-cii-location', 'uses' => 'API\V1\LocationController@allCiiLocation']);

Route::any('/v1/upload-mou', ['as' => 'upload-mou', 'uses' => 'API\V1\MouFormController@addMouForms']);

Route::any('/v1/sell-lease-land', ['as' => 'sell-lease-land', 'uses' => 'API\V1\SellAndLeaseController@addSellLeaseForm']);


Route::any('/v1/add-media-album', ['as' => 'add-media-album', 'uses' => 'API\V1\MediaAlbumController@addMediaAlbum']);

Route::any('/v1/add-album-images', ['as' => 'add-album-images', 'uses' => 'API\V1\MediaAlbumController@addMediaAlbumImages']);

Route::any('/v1/all-media-album', ['as' => 'all-media-album', 'uses' => 'API\V1\MediaAlbumController@allMediaGalleryAlbums']);

Route::any('/v1/all-media-images', ['as' => 'all-media-images', 'uses' => 'API\V1\MediaAlbumController@allMediaGalleryAlbumsImages']);



Route::any('/v1/all-main-event', ['as' => 'all-main-event', 'uses' => 'API\V1\EventController@allEventMain']);



Route::any('/v1/all-sub-event', ['as' => 'all-sub-event', 'uses' => 'API\V1\EventController@allEventMainSubCategory']);



Route::any('/v1/all-sub-detail', ['as' => 'all-sub-detail', 'uses' => 'API\V1\EventController@allEventSection']);

Route::any('/v1/store-mou-upload', ['as' => 'store-mou-upload', 'uses' => 'API\V1\RegisterController@uploadMouForm']);

Route::any('/v1/intend-to-invest', ['as' => 'intend-to-invest', 'uses' => 'API\V1\RegisterController@intentToInvest']);