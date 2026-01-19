<?php

srand((double) microtime() * 1000000);
$ch = (rand(1, 100));

$campaignid = $_GET['campaignid'];
$adgroup = $_GET['adgroup'];
$creative = $_GET['ad'];

$source = $_GET['utm_source'];
$medium = $_GET['utm_medium'];
$campaign = $_GET['utm_campaign'];
$term = $_GET['utm_term'];
$content = $_GET['utm_content'];
$thumbnail = $_GET['creative'];

$h1 = $_GET['h1'];
$img = $_GET['img'];

// Define utm_term to img mappings
$utmImgMappings = [
    '725911281268' => '4041724951222077555',
    '727963665503' => '4041724951222077555',
    '725703846874' => '4041724951222077555',
    '729974140006' => '1616492019523741769',
    '729463292584' => '1616492019523741769',
    '733983381569' => '4041724951222077555',
    '733964602959' => '4041724951222077555',
    '732976287972' => '4041724951222077555',
    '729418732035' => '4041724951222077555',
    '734068307919' => '4041724951222077555',
    '733964602962' => '4041724951222077555',
    '709967551096' => '4041724951222077555',
    '732976287996' => '4041724951222077555',
    '733818182158' => '9254039730442041372',
    '733094241245' => '9254039730442041372',
    '733581302824' => '9254039730442041372',
    '733786526127' => '9254039730442041372',
    '733964602953' => '9254039730442041372',
    '726207246412' => '4041724951222077555'
];

// Determine final img value
if (empty($img) && !empty($term) && array_key_exists($term, $utmImgMappings)) {
    $img = $utmImgMappings[$term];
    $imageUrl = "https://tpc.googlesyndication.com/simgad/{$img}";
} elseif (!empty($img)) {
    $imageUrl = "https://tpc.googlesyndication.com/simgad/{$img}";
} else {
    $img = ''; // No img value for tracking
    $imageUrl = '';
}

//get domain
$domain = "bugmd.com";




//RedTrack
$redtrack = "65d559021b14e2000101b4c7";
$link = "https://trk.bugmd.com/preclick";


// Step 1: Get or assign variant
if (isset($_GET['variant'])) {
    $variant = (int) $_GET['variant'];
} else {
    srand((double) microtime() * 1000000);
    $ch = rand(1, 100);
    
    if ($ch < 10) {
        $variant = 1; // Mice Bacteria A8
    } elseif ($ch < 70) {
        $variant = 2; // Optimized V3
    } else {
        $variant = 3; // B13
    }
}

// Step 2: Set content based on variant
if ($variant === 1) {
    // 10% Mice Bacteria A8 (new)
    $lp1 = "VMS-Mice-Bacteria-A8-08-29-25";
    $htmlFile = 'mice-bacteria/a8/index.html';
    $defaultHeadline = "Don't Try Anything Else for Mice Until You See This'";

} elseif ($variant === 2) {
    // 60%
    $lp1 = "BugMD-Facebook-LP-KT-DMG-NewHr-OPTIMIZED-V3-05-05-25";
    include('index-hero-optimized-v3-1.html');
    exit;

} else { // $variant === 3
    // 30%
    $lp1 = "BugMD-B13-VMS-09-25-25";
    $htmlFile = 'b13/index.html';
    $defaultHeadline = 'Stop Mice in Their Tracks... FAST!';
}

// Step 3: Redirect if headline not set
if (!isset($_GET['headline']) || empty($_GET['headline'])) {
    $urlParams = $_GET;
    $urlParams['headline'] = $defaultHeadline;
    $urlParams['variant'] = $variant; // PRESERVE VARIANT!
    $newUrl = '?' . http_build_query($urlParams);
    header("Location: $newUrl");
    exit;
}

// Step 4: Use headline from URL (but don't overwrite $defaultHeadline)
$headlineParam = $_GET['headline'];

// Step 5: Load HTML content
ob_start();
include($htmlFile);
$htmlContent = ob_get_clean();

// Step 6: Output the HTML
echo $htmlContent;



?>