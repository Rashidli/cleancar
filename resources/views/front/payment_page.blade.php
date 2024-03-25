@extends('front.layouts.master')
@section('content')
    <style>
        /* Style for the table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto;
        }
        /* Style for form fields */
        input[type="hidden"] {
            display: none;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        /* Style for table rows */
        tr {
            background-color: #f2f2f2;
        }
        /* Style for table headers */
        th {
            text-align: left;
            padding: 8px;
        }
        /* Style for table data */
        td {
            padding: 8px;
        }
    </style>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="maintxt">

        <center><table border="0" cellpadding="5" cellspacing="5" width="590">
                <form ACTION="https://mpi.3dsecure.az/cgi-bin/cgi_link" METHOD="POST">

                    <tbody>
                    <tr>
                        <td colspan="3" valign="top"><center><font size="4">Form.</font></center></td>
                    </tr>
                    <tr>
                        <td colspan="3" valign="top"><font size="3"></font></td>
                    </tr>
                    <tr bgcolor="#808080">
                        <td colspan="3" class="copybd" valign="top">Details.</td>
                    </tr>

                    <?php

                    error_reporting(E_ALL);
                    ini_set("display_errors", 1);
                    $washing_id = request('washing_id');
                    $package_id = request('package_id');
                    $package = \App\Models\Package::findOrFail($package_id);
                    $price = $package->price;


// Getting required fields

                    // These fields can change in every request
                    //$db_row['AMOUNT'] = $_POST["AMOUNT"];
                    $db_row['AMOUNT'] = $price;
                    $db_row['CURRENCY'] = 'AZN';
                    //$db_row['ORDER'] = $formattedNumber;
                    $db_row['ORDER'] = gmdate("YmdHis");
                    $package_pivot = \App\Models\WashingPayment::where('washing_id', $washing_id)
                        ->where('package_id', $package_id)
                        ->orderBy('id', 'desc')
                        ->first();
                    $package_pivot->order_id =$db_row['ORDER'];
                    $package_pivot->save();


                        // These fields will be always static
                    $db_row['DESC'] = 'Monthly payment';
                    $db_row['MERCH_NAME'] = 'Cleancar';
                    $db_row['MERCH_URL'] = 'https://cleancar.az/';  //Home url of merchant or domain
                    $db_row['TERMINAL'] = '17203638';			// That is your personal ID in payment system
                    $db_row['EMAIL'] = 'info@cleancar.az';       // email can be static or dynamic but must be
                    $db_row['TRTYPE'] = '1';					// That is the type of operation, 1 - Authorization and checkout, 0 - Authorization  block amount
                    $db_row['COUNTRY'] = 'AZ';
                    $db_row['MERCH_GMT'] = '+4';
                    $db_row['BACKREF'] = 'https://cleancar.az/callback';
                    $db_row['LANG'] = 'AZ';  // according to AZ, EN and RU request card details page will change language
                    //$db_row['P_SIGN'] = '';
                    //$db_row['MAC'] = '';

                    //These fields are generated automaticaly every request
//                    $oper_time=date("YmdHis");			// Date and time UTC
                    $nonce=substr(md5(rand()),0,16);		// Random data
                    $oper_time = date("YmdHis");
// Create DateTime object from the provided date and time
                    $oper_time_dt = DateTime::createFromFormat('YmdHis', $oper_time);
// Subtract 4 hours
                    $oper_time_dt->sub(new DateInterval('PT4H'));
// Format the result as desired
                    $new_oper_time = $oper_time_dt->format('YmdHis');
                    $oper_time = $new_oper_time;
// ------------------------------

                    foreach($db_row as $key => $value){
                        echo "<tr><td>$key"." = "."$value</td></tr>\n";
                        #echo "<input name=\"$key\" value=\"$value\" type=\"hidden\">";
                    }

// Creating form hidden fields

                    echo "
	<input name=\"AMOUNT\" value=\"{$db_row['AMOUNT']}\" type=\"hidden\">
    <input name=\"CURRENCY\" value=\"{$db_row['CURRENCY']}\" type=\"hidden\">
	<input name=\"ORDER\" value=\"{$db_row['ORDER']}\" type=\"hidden\">
	<input name=\"DESC\" value=\"{$db_row['DESC']}\" type=\"hidden\">
    <input name=\"MERCH_NAME\" value=\"{$db_row['MERCH_NAME']}\" type=\"hidden\">
    <input name=\"MERCH_URL\" value=\"{$db_row['MERCH_URL']}\" type=\"hidden\">
    <input name=\"TERMINAL\" value=\"{$db_row['TERMINAL']}\" type=\"hidden\">
    <input name=\"EMAIL\" value=\"{$db_row['EMAIL']}\" type=\"hidden\">
    <input name=\"TRTYPE\" value=\"{$db_row['TRTYPE']}\" type=\"hidden\">
    <input name=\"COUNTRY\" value=\"{$db_row['COUNTRY']}\" type=\"hidden\">
	<input name=\"MERCH_GMT\" value=\"{$db_row['MERCH_GMT']}\" type=\"hidden\">
	<input name=\"TIMESTAMP\" value=\"{$oper_time}\" type=\"hidden\">
	<input name=\"NONCE\" value=\"{$nonce}\" type=\"hidden\">
	<input name=\"BACKREF\" value=\"{$db_row['BACKREF']}\" type=\"hidden\">
	<input name=\"LANG\" value=\"{$db_row['LANG']}\" type=\"hidden\">
	";

// ------------------------------------------------

// Making P_SIGN (MAC)	-         Checksum of request
// All following fields must be equal with hidden fields above

                    $privateKey = file_get_contents('private_key.pem');   // here should be your privet key directory
                    $publicKey = file_get_contents('public_key.pem');   // here should be your public key directory


                    $to_sign = strlen($db_row['AMOUNT']).$db_row['AMOUNT']
                        .strlen($db_row['CURRENCY']).$db_row['CURRENCY']
                        .strlen($db_row['TERMINAL']).$db_row['TERMINAL']
                        .strlen($db_row['TRTYPE']).$db_row['TRTYPE']
                        .strlen($oper_time).$oper_time
                        .strlen($nonce).$nonce
                        .strlen($db_row['MERCH_URL']).$db_row['MERCH_URL'];

                    $db_row['MAC'] = $to_sign;

                    $P_SIGN = '';
                    openssl_sign($to_sign, $P_SIGN, $privateKey, OPENSSL_ALGO_SHA256);

                    $ok = openssl_verify($to_sign, $P_SIGN, $publicKey, OPENSSL_ALGO_SHA256);
                    $db_row['P_SIGN'] = bin2hex($P_SIGN);

                    echo "<input name=\"P_SIGN\" value=\"{$db_row['P_SIGN']}\" type=\"hidden\">";
// ----------------------------------------------------

                    ?>

                    <table border="0" cellpadding="5" cellspacing="5" width="590" align="center">
                        <input alt="Submit" type="submit">
                    </tbody></table>
            </form>

    </table>
    <br><center><hr WIDTH="100%"></center>
@endsection


