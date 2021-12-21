<?php

namespace App\Services;

use App\Models\Item;
use App\Models\PurchaseAttempt;
use Carbon\Carbon;

class PayfastService {

    private static function details() {

        $testing = true;

        if (env('APP_ENV') == 'production') {
            $testing = false;
        }

        $actual_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

        $details = [
            'testing'       => $testing,
            'website_url'   => $actual_url,
            'merchant_id'   => $testing ? '10000100' : '18786136',
            'merchant_key'  => $testing ? '46f0cd694581a' : '6bxovo6vi299m',
            'pf_url'        => $testing ? 'https://sandbox.payfast.co.za/eng/process' : 'https://payfast.co.za/eng/process'
        ];

        return $details;
    }

    public static function form($amount, $payment_id = 'F#1', $item_name = 'Davening', $email = null, $name_first = null, $name_last = null) {
        $data = self::data($amount,$payment_id,$item_name,$email,$name_first,$name_last);
        $out = '<form method="post" action="' . $data['url'] . '" id="payfast-form">';
        foreach ($data['form_input'] as $name => $value) {
            $out .= "<input name='$name' value='$value' />";
        }
        //$out .= '<input type="submit"></form>';
        return $out;
    }

    public static function data($amount, $payment_id = 'F#1', $item_name = 'Davening', $email = null, $name_first = null, $name_last = null) {

        $details = PayfastService::details();
        # $amount = 10.00;// This amount needs to be sourced from your application


        $id_info = explode('#', $payment_id);
        $is_item = false;

        if ($id_info[0] == 'PA') {
            $is_item = true;
            $purchase_attempt = PurchaseAttempt::findOrFail($id_info[1]);
            $item_id = $purchase_attempt->item_id;
        }

        $return_url = ($is_item) ? $details['website_url'] . '/thankyou/' . $item_id : $details['website_url'] . '/thankyou';

        $data = array(
            // Merchant details
            'merchant_id'       => $details['merchant_id'],
            'merchant_key'      => $details['merchant_key'],
            'return_url'        => $return_url,
            'cancel_url'        => $details['website_url'] . '/payfast/cancel',
            'notify_url'        => $details['website_url'] . '/payfast/notify',

            // Buyer details
            'name_first'        => $name_first,
            'name_last'         => $name_last,
            'email_address'     => $email,

            // Transaction details
            'm_payment_id'      => $payment_id, //Unique payment ID to pass through to notify_url
            'amount'            => number_format( sprintf( '%.2f', $amount ), 2, '.', '' ),
            'item_name'         => $item_name
        );

        if (empty($email)) {
            unset($data['email_address']);
        }

        if (empty($name_first)) {
            unset($data['name_first']);
        }

        if (empty($name_last)) {
            unset($data['name_last']);
        }

        $signature = PayfastService::signature($data);
        $data['signature'] = $signature;

        return [
            'url'           => $details['pf_url'],
            'form_input'    => $data,
        ];

    }

    private static function signature($data, $passPhrase = null) {
        // Create parameter string
        $pfOutput = '';
        foreach( $data as $key => $val ) {
            if($val !== '') {
                $pfOutput .= $key .'='. urlencode( trim( $val ) ) .'&';
            }
        }
        // Remove last ampersand
        $getString = substr( $pfOutput, 0, -1 );
        if( $passPhrase !== null ) {
            $getString .= '&passphrase='. urlencode( trim( $passPhrase ) );
        }
        return md5( $getString );
    }

    public static function notify() {
        header( 'HTTP/1.0 200 OK' );
        flush();

        $details = self::details();

        $pfHost = $details['testing'] ? 'sandbox.payfast.co.za' : 'www.payfast.co.za';

        $pfData = $_POST;

        // Strip any slashes in data
        foreach( $pfData as $key => $val ) {
            $pfData[$key] = stripslashes( $val );
        }

        $pfParamString = '';

        // Convert posted variables to a string
        foreach( $pfData as $key => $val ) {
            if( $key !== 'signature' ) {
                $pfParamString .= $key .'='. urlencode( $val ) .'&';
            } else {
                break;
            }
        }

        $pfParamString = substr($pfParamString, 0, -1);
        $amount = $pfData['amount_gross'];

        $id_info = explode('#', $pfData['m_payment_id']);
        $is_item = false;

        if ($id_info[0] == 'PA') {
            $is_item = true;
            $purchase_attempt = PurchaseAttempt::findOrFail($id_info[1]);
            $item_id = $purchase_attempt->item_id;
            $item = Item::findOrFail($item_id);
            $amount = $item->price;
        }

        $check1 = PayfastService::pfValidSignature($pfData, $pfParamString);
        $check2 = PayfastService::pfValidIP();
        $check3 = PayfastService::pfValidPaymentData($amount, $pfData);
        $check4 = PayfastService::pfValidServerConfirmation($pfParamString, $pfHost);

        if($check1 && $check2 && $check3 && $check4) {
            print('success');
            // All checks have passed, the payment is successful

            if ($is_item) {
                if (!$item->purchased()) {
                    $purchase_attempt->update([
                        'completed_at' => Carbon::now(),
                    ]);
                    $item->update(['purchased_at' => Carbon::now()]);
                } else {
                    print("Item already purchased by someone else.");
                }
            }
        } else {
            print('fail');
            // Some checks have failed, check payment manually and log for investigation
        }
    }

    static function pfValidSignature($pfData, $pfParamString, $pfPassphrase = null) {
        // Calculate security signature
        if($pfPassphrase === null) {
            $tempParamString = $pfParamString;
        } else {
            $tempParamString = $pfParamString.'&passphrase='.urlencode( $pfPassphrase );
        }

        $signature = md5( $tempParamString );
        return ( $pfData['signature'] === $signature );
    }

    static function pfValidIP() {
        // Variable initialization
        $validHosts = array(
            'www.payfast.co.za',
            'sandbox.payfast.co.za',
            'w1w.payfast.co.za',
            'w2w.payfast.co.za',
        );

        $validIps = [];

        foreach( $validHosts as $pfHostname ) {
            $ips = gethostbynamel( $pfHostname );

            if( $ips !== false )
                $validIps = array_merge( $validIps, $ips );
        }

        // Remove duplicates
        $validIps = array_unique( $validIps );
        $referrerIp = gethostbyname(parse_url($_SERVER['HTTP_REFERER'])['host']);
        if( in_array( $referrerIp, $validIps, true ) ) {
            return true;
        }
        return false;
    }

    static function pfValidPaymentData( $cartTotal, $pfData ) {
        return !(abs((float)$cartTotal - (float)$pfData['amount_gross']) > 0.01);
    }

    static function pfValidServerConfirmation( $pfParamString, $pfHost = 'sandbox.payfast.co.za', $pfProxy = null ) {
        // Use cURL (if available)
        if( in_array( 'curl', get_loaded_extensions(), true ) ) {
            // Variable initialization
            $url = 'https://'. $pfHost .'/eng/query/validate';

            // Create default cURL object
            $ch = curl_init();

            // Set cURL options - Use curl_setopt for greater PHP compatibility
            // Base settings
            curl_setopt( $ch, CURLOPT_USERAGENT, NULL );  // Set user agent
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );      // Return output as string rather than outputting it
            curl_setopt( $ch, CURLOPT_HEADER, false );             // Don't include header in output
            curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 2 );
            curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, true );

            // Standard settings
            curl_setopt( $ch, CURLOPT_URL, $url );
            curl_setopt( $ch, CURLOPT_POST, true );
            curl_setopt( $ch, CURLOPT_POSTFIELDS, $pfParamString );
            if( !empty( $pfProxy ) )
                curl_setopt( $ch, CURLOPT_PROXY, $pfProxy );

            // Execute cURL
            $response = curl_exec( $ch );
            curl_close( $ch );
            if ($response === 'VALID') {
                return true;
            }
        }
        return false;
    }

}
