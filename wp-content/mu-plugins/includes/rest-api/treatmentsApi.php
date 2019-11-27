<?php

add_action('rest_api_init', 'treatmentsApiRoute');

function treatmentsApiRoute()
{
    //wp-json/aesthetiq-api/v1/{params or payload}
    register_rest_route('aesthetiq-api/v1', '/treatments', [
        'methods' => 'GET', 'callback' => 'getTreatmentsApi'
    ]);
}

function getTreatmentsApi()
{

    $treatments = [
        ['FACIAL TREATMENTS' => [
            ['options' => 'AQ Clean'],
            ['options' => 'AQ Pure'],
            ['options' => 'AQ Fresh'],
            ['options' => 'AQ Clear'],
            ['options' => 'AQ Hydra Glow'],
            ['options' => 'Dermalogica - Basic Skincare Treatment'],
            ['options' => 'Dermalogica - Relaxing Skin Treatment'],
            ['options' => 'Dermalogica - Deep Cleansing Treatment'],
            ['options' => 'Dermalogica - Anti-Aging Skin Treatment'],
            ['options' => 'Wish Pro - Calming'],
            ['options' => 'Wish Pro - Hyaluronic'],
            ['options' => 'Wish Pro - Whitening'],
            ['options' => 'Wish Pro - Neo-Revive'],
            ['options' => 'Wish Pro - BTX'],
            ['options' => 'AQ Cryo Bright'],
            ['options' => 'AQ L`age Revive'],
            ['options' => 'AQ Visage Radiance'],
            ['options' => 'MACHINE - Indiba Age Smart'],
            ['options' => 'MACHINE - Foculift'],
            ['options' => 'MACHINE - Photodynamic Therapy']
        ]],
        ['WELLNESS' => [
            ['options' => 'AQ Relax'],
            ['options' => 'AQ Indulge'],
            ['options' => 'AQ Balance'],
            ['options' => 'AQ Banana Leaf'],
            ['options' => 'AQ Back Massage'],
            ['options' => 'AQ Nourish'],
            ['options' => 'Foot Reflex'],
            ['options' => 'Foot Spa'],
            ['options' => 'Hand Spa'],
            ['options' => 'Hand Paraffin'],
            ['options' => 'Foot Paraffin']
        ]],
        ['BODY TREATMENTS' => [
            ['options' => 'BREAKING - G5'],
            ['options' => 'BREAKING - Slenderize Massage'],
            ['options' => 'BREAKING - AQ Lipo Wrap'],
            ['options' => 'DETOXIFYING - Lymphatic Drainage Massage'],
            ['options' => 'DETOXIFYING - AQ Detox Wrap'],
            ['options' => 'DETOXIFYING - AQ Seaweed Wrap'],
            ['options' => 'FIRMING & CONTOURING - Sexytone'],
            ['options' => 'FIRMING & CONTOURING - Thermshape'],
            ['options' => 'FIRMING & CONTOURING - Indiba Body'],
            ['options' => 'HAIR REMOVAL - Hair Waxing'],
            ['options' => 'HAIR REMOVAL - LASER Super Hair Removal'],
            ['options' => 'NAILS - Manicure'],
            ['options' => 'NAILS - Pedicure'],
            ['options' => 'NAILS - Gel Mani'],
            ['options' => 'NAILS - Gel Pedi'],
            ['options' => 'NAILS - Nail Art']
        ]],
        ['DERMATOLOGICAL PROCEDURES' => [
            ['options' => 'Classic Warts Removal'],
            ['options' => 'Iv Push - Glutathione'],
            ['options' => 'Iv Push - Collagen'],
            ['options' => 'Iv Push - Placenta'],
            ['options' => 'Iv Push - L Carnitine'],
            ['options' => 'Iv Drip'],
            ['options' => 'Automatic Derma Roller'],
            ['options' => 'Botox'],
            ['options' => 'Botulax'],
            ['options' => 'Fillers - Voluma'],
            ['options' => 'Fillers - Volift'],
            ['options' => 'Fillers - Volbella'],
            ['options' => 'Ultra V Thread Lift'],
            ['options' => 'Hiko Nose Lift'],
            ['options' => 'Mesolipo'],
            ['options' => 'Mesopeel'],
            ['options' => 'Mesowhite'],
            ['options' => 'Sclerotherapy'],
            ['options' => 'Firexel Fractional LASER'],
            ['options' => 'Firexel Syringoma Removal'],
            ['options' => 'Clearlift Face & Neck'],
            ['options' => 'Clearlift Underarm'],
            ['options' => 'Clearlift Tattoo Removal'],
            ['options' => 'Clearvein Varicose Veins'],
            ['options' => 'IPixel Fractional Resurfacing'],
            ['options' => 'IPixel Spot Removal'],
            ['options' => 'LASER Slim']
        ]]
    ];

    // 
    $terms = get_terms([
        'taxonomy' => 'service_category', 
        'hide_empty' => false,
        'exclude' => [13] // exclude featured signature treatments
    ]);

    $testArr = [];

    // $i = 0;
    // foreach ($terms as $term) {

    // }

    return wp_send_json([
        'success' => true,
        'treatments' => $treatments,
        'test' => $testArr
    ], 200);
}
