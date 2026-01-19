<?php 
// Set up randomization for split test
srand((double)microtime() * 1000000);
$ch = rand(1, 100); // Generates a random number between 1 and 100

// URL parameters
$campaignid = $_GET['campaignid'] ?? '';
$adgroup = $_GET['adgroup'] ?? '';
$creative = $_GET['ad'] ?? '';

$source = $_GET['utm_source'] ?? '';
$medium = $_GET['utm_medium'] ?? '';
$campaign = $_GET['utm_campaign'] ?? '';
$term = $_GET['utm_term'] ?? '';
$content = $_GET['utm_content'] ?? '';
$lp1 = $_GET['lp1'] ?? '';

$h1 = $_GET['h1'] ?? '';
$img = $_GET['img'] ?? '';
$creativeUrl = $_GET['creative'] ?? ''; // Added specific parameter for Taboola creative URL
$headlineParam = $_GET['headline'] ?? '';

// Define utm_term to img mappings
$utmMappings = [
    '731359155722' => '9360791172441033670',
    '732721398640' => '9360791172441033670',
    '719356815063' => '12000539875501642140',
    '718765741153' => '12000539875501642140',
    '718765741156' => '12000539875501642140',
    '718765741168' => '12000539875501642140',
    '718596297754' => '12000539875501642140'
];

// Determine final img value
if ($source === 'taboola' && !empty($creativeUrl)) {
    $imageUrl = $creativeUrl;  // Use the full URL from creative parameter
} elseif (empty($img) && !empty($term) && array_key_exists($term, $utmImgMappings)) {
    $img = $utmImgMappings[$term];
    $imageUrl = "https://tpc.googlesyndication.com/simgad/{$img}";
} elseif (!empty($img)) {
    $imageUrl = "https://tpc.googlesyndication.com/simgad/{$img}";
} else {
    $img = ''; // No img value for tracking
    $imageUrl = '';
}

// Prepare headline
$headlineSafe = '';
if (!empty($headlineParam)) {
    $decoded = html_entity_decode($headlineParam, ENT_QUOTES, 'UTF-8');
    $headlineSafe = htmlspecialchars($decoded);
}

$redtrack = "687e3777b14111afa1c866f7";
$link = "https://trk.bugmd.com/preclick";
$lp1 = "VMS-PTCS-Mice-Bacteria-07-21-25";
$htmlFile = 'index.html';
$defaultHeadline = 'Exterminator Reveals The Easy Way To Finally Stop Mice From Destroying Your Home';


// Step 2: Redirect if headline not set
if (!isset($_GET['headline']) || empty($_GET['headline'])) {
    $urlParams = $_GET;
    $urlParams['headline'] = $defaultHeadline;
    $newUrl = '?' . http_build_query($urlParams); // Clean URL without index.php
    header("Location: $newUrl");
    exit;
} else {
    $headlineParam = $_GET['headline'];
    $defaultHeadline = $headlineParam;
}

// Step 3: Load HTML content
ob_start();
include($htmlFile);
$htmlContent = ob_get_clean();

// Step 4: Output the HTML
echo $htmlContent;
?>