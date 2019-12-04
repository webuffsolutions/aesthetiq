<?php

/*
    ==========================================
    submit appointment
    ==========================================
*/

date_default_timezone_set("Asia/Manila");

function submitAppointment()
{
    $postData = [
        'post_type'   => 'appointment',
        'post_status' => 'publish'
    ];

    $postID = wp_insert_post($postData);

    // store acf fields
    update_field('full_name', $_POST['full_name'], $postID);
    update_field('email', $_POST['email'], $postID);
    update_field('gender', $_POST['gender'], $postID);
    update_field('mobile_no', $_POST['mobile_no'], $postID);
    update_field('birth_month', $_POST['birth_month'], $postID);
    update_field('birth_date', $_POST['birth_date'], $postID);
    update_field('birth_year', $_POST['birth_year'], $postID);
    update_field('treatment', $_POST['treatment'], $postID);
    update_field('preferred_branch', $_POST['preferred_branch'], $postID);
    update_field('preferred_date', $_POST['preferred_date'], $postID);
    update_field('preferred_time', $_POST['preferred_time'], $postID);
    update_field('preferred_time_suffix', $_POST['preferred_time_suffix'], $postID);
    update_field('message', $_POST['message'], $postID);

    $to = 'aq.appointments@gmail.com';
    $subject = $_POST['full_name'] . ' has booked an appointment.';

    $message = '
        <h3>Booking Details:</h3>
        <p>Full Name: ' . $_POST['full_name'] . '</p>
        <p>Email: ' . $_POST['email'] . '</p>
        <p>Mobile No: ' . $_POST['mobile_no'] . '</p>
        <p>Treatment: ' . $_POST['treatment'] . '</p>
        <p>Preferred Branch: ' . $_POST['preferred_branch'] . '</p>
        <p>Preferred Date/Time: ' . $_POST['preferred_date'] . ' ' . $_POST['preferred_time'] . ' ' . $_POST['preferred_time_suffix'] . '</p>
        <p>Message: ' . $_POST['message'] . '</p>
    ';

    $headers[] = 'Content-Type: text/html; charset-UTF-8';
    $mail = wp_mail($to, $subject, $message, $headers);
    echo json_encode(['success' => true]);
}

add_action('wp_ajax_submitAppointment', 'submitAppointment');
add_action('wp_ajax_nopriv_submitAppointment', 'submitAppointment');
