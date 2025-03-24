<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


if (!function_exists('message_box')) {
    function message_box()
    {
        $CI = &get_instance();
        $CI->load->view("alert");
    }
}

if (!function_exists('set_message')) {
    function set_message($type, $message)
    {
        $CI = &get_instance();
        $CI->session->set_flashdata($type, $message);
    }
}

if (!function_exists('userData')) {
    function userData(){
        $CI = &get_instance();
        if (!empty($CI->session->userdata('login_user'))) {
            $id = $CI->session->userdata('login_user')['id'];
            $email = $CI->session->userdata('login_user')['email'];
            return  $CI->db->select('users.*, user_details.*')->where('users.id',$id)->where('users.email',$email)->join('user_details', 'user_details.user_id = users.id')->get('users')->row();
        }
    }
}

if (!function_exists('userProfileImage')) {
    function userProfileImage($thumb=NULL){
        if (empty(userData()->image)) {
            return base_url().'assets/dashboard/img/user.png';
        }else{
            if (!empty($thumb)) {
                return base_url().'uploads/users/thumbnail/'.userData()->image;
            }else{
                return base_url().'uploads/users/'.userData()->image;
            }
        }
    }
}

if (!function_exists('get_token')) {
    function get_token($length){
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet.= "0123456789";
        $max = strlen($codeAlphabet); 

        for ($i=0; $i < $length; $i++) {
            $token .= $codeAlphabet[rand(0, $max-1)];
        }
        return $token;
    }
}

if (!function_exists('app_hasher')) {
    function app_hasher()
    {
        global $app_hasher;
        if (empty($app_hasher)) {
            require_once(APPPATH . 'third_party/phpass.php');
            $app_hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
        }
        return $app_hasher;
    }
}

if (!function_exists('get_features')) {
    function get_features(){
        $CI = &get_instance();
        return $CI->db->where('status',1)->order_by('name','ASC')->get('features')->result();
    }
}

if (!function_exists('get_integrations')) {
    function get_integrations(){
        $CI = &get_instance();
        return $CI->db->where('status',1)->order_by('name','ASC')->get('integrations')->result();
    }
}

if (!function_exists('getCart')) {
    function getCart(){
        $CI     = &get_instance();
        $userId = userData()->id;
        return $CI->db->where('user_id', $userId)->get('cart')->row();
    }
}

if (!function_exists('getSubdomain')) {
    function getSubdomain(){
        $CI     = &get_instance();
        $userId = userData()->id;
        return $CI->db->where('user_id', $userId)->get('subdomains')->row();
    }
}

if (!function_exists('checkPayment')) {
    function checkPayment(){
        $CI     = &get_instance();
        $userId = userData()->id;
        return $CI->db->where('user_id', $userId)->get('payments')->row();
    }
}

if (!function_exists('subDomainUrl')) {
    function subDomainUrl(){
        $CI     = &get_instance();
        $userId = userData()->id;
        $query =  $CI->db->where('id', $userId)->get('users')->row();
        $subDomainUrl = 'https://'.$query->account_name.'.eazedesk.com';
        return $subDomainUrl;
    }
}

if (!function_exists('getPlans')) {
    function getPlans($plan_id=NULL){
        $CI = &get_instance();
        if (!empty($plan_id)) {
            $query = $CI->db->where('id', $plan_id)->get('plans')->row();
        }else{
            $query = $CI->db->where('status', 1)->get('plans')->result();
        }
        return $query;
    }
}

if (!function_exists('cartTotalamount')) {
    function cartTotalamount(){
        $CI = &get_instance();
        $userId = userData()->id;
        $cartDetails = $CI->db->where('user_id',$userId)->get('cart')->row();

        if (!empty($cartDetails)) {
            $basePrice          = $cartDetails->base_price;
            $totalPlanAmount    = $basePrice;
        }else{
            $totalPlanAmount = 0;
        }
        return $totalPlanAmount;
    }
}

if (!function_exists('getLastPayment')) {
    function getLastPayment(){
        $CI     = &get_instance();
        $userId = userData()->id;
        return $CI->db->where('user_id', $userId)->order_by('payment_id ',"desc")->limit(1)->get('payments')->row();
    }
}

if (!function_exists('planTotalDays')) {
    function planRemainingDays(){
        $CI     = &get_instance();
        $getLastPayment = getLastPayment();

        if (!empty($getLastPayment)) {
            $PlanTotalDays = getPlans($getLastPayment->product_id)->plan_days;
            $paymentCreatedDate = $getLastPayment->created_at;

            $dateCreated   = new DateTime($paymentCreatedDate);
            $dateToday     = new DateTime(date('Y-m-d'));
            $TotalDays     = $dateCreated->diff($dateToday)->days;

            $daysReamining = $PlanTotalDays-$TotalDays;
            $is_free       = 0;
            $plan_id       = getPlans($getLastPayment->product_id)->id;
        }else{
            $subdomainCreatedDate = getSubdomain()->created_at;

            $dateCreated   = new DateTime($subdomainCreatedDate);
            $dateToday     = new DateTime(date('Y-m-d'));
            $TotalDays     = $dateCreated->diff($dateToday)->days;

            $daysReamining = 14-$TotalDays;
            $is_free       = 1;
            $plan_id       = 0;
        }

        if ($daysReamining < 0) { $daysReamining = 0; }

        if ($daysReamining > 0) {
            $plan_status = 1;
        }else{
            $plan_status = 0;
        }

        $currentPlanData = array(
            'plan_id'        => $plan_id,
            'is_free'        => $is_free,
            'remaining_days' => $daysReamining,
            'plan_status'    => $plan_status
        );

        return $currentPlanData;
    }
}

if (!function_exists('planExpiringDate')) {
    function planExpiringDate(){
        $CI     = &get_instance();
        $getLastPayment = getLastPayment();

        if (!empty($getLastPayment)) {
            $paymentDate = date('Y-m-d',strToTime($getLastPayment->created_at));
            $paymentDays = $getLastPayment->plan_years;
            $newEndingDate = date("Y-m-d", strtotime($paymentDate . " + ".$paymentDays." days"));
        }else{
            $subdomainCreatedDate = date('Y-m-d',strToTime(getSubdomain()->created_at));
            $newEndingDate = date("Y-m-d", strtotime($subdomainCreatedDate . " + 14 days"));
        }
        return $newEndingDate;
    }
}