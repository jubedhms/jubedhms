<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

// For Web application
$route['default_controller'] = 'signin';
$route['404_override'] = 'signin';
$route['translate_uri_dashes'] = FALSE;
// End

// For Mobile App version 1
$route['v1/get-token'] = 'api_soap/generate_token';

$route['v1/app.api/app-version'] = 'api_v1/app_info_setting/app_version';
$route['v1/app.api/basic-details'] = 'api_v1/app_info_setting/get_list';

$route['v1/app-banner.api/list'] = 'api_v1/app_banner/get_list';
$route['v1/app-banner.api/push-notification-list'] = 'api_v1/app_banner/get_push_notification_list';
$route['v1/app-banner.api/home-list'] = 'api_v1/app_banner/get_home_list';

$route['v1/countries.api/list'] = 'api_v1/countries/get_list';
$route['v1/cities.api/list'] = 'api_v1/cities/get_list';
$route['v1/districts.api/list'] = 'api_v1/districts/get_list';

$route['v1/generic-notification.api/list'] = 'api_v1/generic_notification/get_list';
$route['v1/generic-notification.api/search'] = 'api_v1/generic_notification/loadDataByID';

$route['v1/advance-notification.api/list'] = 'api_v1/advance_notification/get_list';
$route['v1/advance-notification.api/add-seen'] = 'api_v1/advance_notification/seen_notification';
$route['v1/advance-notification.api/add-click'] = 'api_v1/advance_notification/click_notification';

$route['v1/patient.api/basic-details'] = 'api_v1/patient/get_basic_details';
$route['v1/patient.api/select-option-list'] = 'api_v1/patient/get_select_box';
$route['v1/patient.api/health-info'] = 'api_v1/patient/patient_health_info';
$route['v1/patient.api/search'] = 'api_v1/patient/get_profile';
$route['v1/patient.api/isexist'] = 'api_v1/patient/checkExistUsername';
$route['v1/patient.api/otp-verification'] = 'api_v1/patient/otp_verification';
$route['v1/patient.api/signup-social-media'] = 'api_v1/patient/add_patient_without_otp';    // for signup authontication via social sites
$route['v1/patient.api/add'] = 'api_v1/patient/add_patient';
$route['v1/patient.api/update'] = 'api_v1/patient/update_patient';
$route['v1/patient.api/update-patient-group'] = 'api_v1/patient/update_patient_group';
$route['v1/patient.api/update-notification-token'] = 'api_v1/patient/update_notification_token';
$route['v1/patient.api/update-health-info'] = 'api_v1/patient/update_patient_health_info';
$route['v1/patient.api/account-verification'] = 'api_v1/patient/account_verification';
$route['v1/patient.api/reset-password'] = 'api_v1/patient/reset_patient_password';
$route['v1/patient.api/update-password'] = 'api_v1/patient/update_patient_password';
$route['v1/patient.api/update-image'] = 'api_v1/patient/update_patient_image';
$route['v1/patient.api/login'] = 'api_v1/patient/login';
$route['v1/patient.api/login-social-media'] = 'api_v1/patient/checkLoginSocialMedia';	// for signin authontication via social sites
$route['v1/patient.api/update-prn'] = 'api_v1/patient/update_patient_prn';
$route['v1/patient.api/logout'] = 'api_v1/patient/logout';

$route['v1/sub-patient.api/list'] = 'api_v1/sub_patient/get_list';
$route['v1/sub-patient.api/health-info'] = 'api_v1/sub_patient/sub_patient_health_info';
$route['v1/sub-patient.api/search'] = 'api_v1/sub_patient/get_profile';
$route['v1/sub-patient.api/add'] = 'api_v1/sub_patient/add_sub_patient';
$route['v1/sub-patient.api/update'] = 'api_v1/sub_patient/update_sub_patient';
$route['v1/sub-patient.api/update-health-info'] = 'api_v1/sub_patient/update_sub_patient_health_info';
$route['v1/sub-patient.api/update-image'] = 'api_v1/sub_patient/update_sub_patient_image';
$route['v1/sub-patient.api/delete'] = 'api_v1/sub_patient/delete_sub_patient';

$route['v1/hospital-locations.api/list'] = 'api_v1/hospital_locations/get_list';

$route['v1/doctor-speciality.api/list'] = 'api_v1/doctor_specialization/get_list';

$route['v1/doctor.api/list'] = 'api_v1/doctor/get_list';
$route['v1/doctor.api/search'] = 'api_v1/doctor/loadDataByMCR';
$route['v1/doctor.api/select-option-list'] = 'api_v1/doctor/get_select_box';
$route['v1/doctor.api/time-schedule'] = 'api_v1/doctor/get_time_schedule';

$route['v1/doctor.api/next-available-slots'] ='api_v1/doctor/get_doctor_available_slots';

$route['v1/doctor-appointment.api/list'] = 'api_v1/doctor_appointment/get_list';
$route['v1/doctor-appointment.api/search'] = 'api_v1/doctor_appointment/loadDataById';
$route['v1/doctor-appointment.api/add'] = 'api_v1/doctor_appointment/add_appointment';
$route['v1/doctor-appointment.api/update'] = 'api_v1/doctor_appointment/update_appointment';
$route['v1/doctor-appointment.api/delete'] = 'api_v1/doctor_appointment/delete_appointment';

$route['v1/vaccine.api/vaccine-list'] = 'api_v1/vaccination/get_vaccine_list';
$route['v1/vaccine.api/dose-list'] = 'api_v1/vaccination/get_dose_list';
$route['v1/vaccine.api/vaccine-search'] = 'api_v1/vaccination/vaccine_search';

$route['v1/vaccine-appointment.api/list'] = 'api_v1/vaccine_appointment/get_list';
$route['v1/vaccine-appointment.api/search'] = 'api_v1/vaccine_appointment/loadDataById';
$route['v1/vaccine-appointment.api/add'] = 'api_v1/vaccine_appointment/add_appointment';
$route['v1/vaccine-appointment.api/update'] = 'api_v1/vaccine_appointment/update_appointment';
$route['v1/vaccine-appointment.api/delete'] = 'api_v1/vaccine_appointment/delete_appointment';

$route['v1/pregnancy-period.api/list'] = 'api_v1/pregnancy_period/get_list';

$route['v1/due-date.api/search'] = 'api_v1/due_date/loadDataByWeek';

$route['v1/awareness.api/categories-list'] = 'api_v1/awareness/get_categories_list';
$route['v1/awareness.api/list'] = 'api_v1/awareness/get_list';

$route['v1/bookmark-awareness.api/list'] = 'api_v1/bookmark_awareness/get_list';
$route['v1/bookmark-awareness.api/toggle-bookmark'] = 'api_v1/bookmark_awareness/toggle_bookmark';

$route['v1/fertility.api/list'] = 'api_v1/fertility/get_list';
$route['v1/fertility.api/add-fertility'] = 'api_v1/fertility/add_fertility';

$route['v1/emergency-call.api/add'] = 'api_v1/emergency_call/add_emergency_call';

$route['v1/feedback.api/add_feedback'] = 'api_v1/feedback/add_feedback';
$route['v1/feedback.api/add_feedback_services'] = 'api_v1/feedback/add_feedback_services';
$route['v1/feedback.api/add_feedback_medical_staff'] = 'api_v1/feedback/add_feedback_medical_staff';
$route['v1/feedback.api/add_doctor_feedback'] = 'api_v1/feedback/add_doctor_feedback';
$route['v1/feedback.api/get_doctor_feedback'] = 'api_v1/feedback/get_doctor_feedback';

$route['v1/chatbot.api/query'] = 'api_v1/chatbot/query_from_patient';
$route['v1/chatbot.api/result'] = 'api_v1/chatbot/revert_from_user';
$route['v1/chatbot.api/chatBotOption'] = 'api_v1/chatbot/chatBotOption';
$route['v1/chatbot.api/openChat'] = 'api_v1/chatbot/openChat';

$route['v1/chatbot.api/queryn'] = 'api_v1/chatbotn/query_from_patient';
$route['v1/chatbot.api/resultn'] = 'api_v1/chatbotn/revert_from_user';
$route['v1/chatbot.api/chatBotOptionn'] = 'api_v1/chatbotn/chatBotOption';
$route['v1/chatbot.api/openChatn'] = 'api_v1/chatbotn/openChat'; 



$route['v1/notification.api/total-count'] = 'api_v1/notification/get_total_notification';
$route['v1/notification.api/list'] = 'api_v1/notification/get_list';
$route['v1/notification.api/search'] = 'api_v1/notification/loadDataById';
$route['v1/notification.api/mark-read'] = 'api_v1/notification/update_as_read';

$route['v1/vaccine.api/vaccine-searchPRN'] = 'api_v1/vaccination/vaccine_searchPRN';
$route['v1/vaccine.api/duedays'] = 'api_v1/vaccination/duedays';
$route['v1/vaccine.api/user-duedays'] = 'api_v1/vaccination/user_duedays';
$route['v1/vaccine.api/user-saveStartkick'] = 'api_v1/vaccination/user_saveStartkick';
$route['v1/vaccine.api/user-saveStopkick'] = 'api_v1/vaccination/user_saveStopkick';
$route['v1/vaccine.api/user-getkickData'] = 'api_v1/vaccination/user_getkickData';
$route['v1/vaccine.api/user-Todaykickdata'] = 'api_v1/vaccination/user_Todaykickdata';
$route['v1/vaccine.api/user-schedule'] = 'api_v1/vaccination/user_schedule';
$route['v1/vaccine.api/user-getSaveSchedule'] = 'api_v1/vaccination/get_SaveSchedule';

$route['v1/special-offer.api/list'] = 'api_v1/special_offer/get_list';
$route['v1/special-offer.api/search'] = 'api_v1/special_offer/loadDataByCode';

$route['v1/product.api/list'] = 'api_v1/product/get_list';
$route['v1/product.api/search'] = 'api_v1/product/loadDataByCode';

$route['v1/food-beverage.api/list'] = 'api_v1/food_beverage/get_list';
$route['v1/food-beverage.api/search'] = 'api_v1/food_beverage/loadDataByCode';

$route['v1/cart.api/list'] = 'api_v1/cart/get_list';
$route['v1/cart.api/add'] = 'api_v1/cart/add_item';
$route['v1/cart.api/delete'] = 'api_v1/cart/remove_item';
// End


