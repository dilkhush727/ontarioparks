<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['signup']                = 'auth/signup';
// $route['signuprequest']         = 'auth/register';
$route['signin']                = 'auth/index';
// $route['signinrequest']         = 'auth/login';
// $route['forgotpassword']        = 'auth/forgotPassword';
// $route['requesttoforgot']       = 'auth/requestToForgot';
// $route['resetpassword/(:any)']  = 'auth/resetPassword/$1';
// $route['requesttoreset/(:any)'] = 'auth/requestToReset/$1';

// $route['profile']            = 'users/profile';
// $route['editProfile']        = 'users/editProfile';
// $route['uploadUserImage']    = 'users/uploadUserImage';
// $route['user/features']      = 'users/userPlanFeatures';
// $route['activateFeatures']   = 'users/activateFeatures';

// $route['about']                = 'cms/pages';
// $route['features']             = 'cms/pages';
// $route['integrations']         = 'cms/pages';
$route['registerd']            = 'cms/pages';
// $route['privacy-policy']       = 'cms/pages';
// $route['terms-and-conditions'] = 'cms/pages';
// $route['refund-policy']        = 'cms/pages';

// $route['pricing']              = 'cms/pricing';

$route['dashboard']          = 'dashboard/index';
$route['get-started']           = 'users/getStarted';
// $route['chooseAccName']      = 'users/chooseAccName';
$route['logout']             = 'auth/logout';
// $route['profileGetS']        = 'auth/profileGetS';
// $route['checkAccName']       = 'auth/checkAccName';
// $route['saveAccName']        = 'auth/saveAccName';

$route['verifyEmail/(:any)'] = 'auth/verification/$1';

// $route['paymentCart']        = 'payments/paymentCart';
// $route['addCart/(:any)']     = 'payments/addCart/$1';
// $route['updateCartYears']    = 'payments/updateCartYears';
// $route['payments']           = 'payments/payments';

// $route['checkout']           = 'razorpay/checkout';

// $route['razorCallback']      = 'razorpay/callback';
// $route['razorSuccess']       = 'razorpay/success';
// $route['razorFailed']        = 'razorpay/failed';

// $route['paymentDetails/(:any)'] = 'payments/paymentDetails/$1';
// $route['activateAccount']       = 'payments/activateAccount';

$route['contact-us']             = 'Frontend/contactUs';
// $route['emailUnsubscribe']      = 'Frontend/emailUnsubscribe';

$route['onboarding'] = 'users/onBoarding';
$route['add-friends'] = 'users/addNewFriends';
$route['addfriend'] = 'users/addFriend';
$route['removefriend'] = 'users/removeFriend';
// $route['addBooking'] = 'booking/addBooking';
$route['gear-guide'] = 'Gearguide/index';
$route['gear-guide-pricing/(:any)'] = 'Gearguide/pricing/$1';

$route['add-to-cart'] = 'Gearguide/addToCart';
$route['checkout'] = 'Payments/checkout';
$route['payment-status/(:any)'] = 'Payments/success/$1';