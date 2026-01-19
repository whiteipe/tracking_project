

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
$creativeUrl = $_GET['creative'] ?? '';
$headlineParam = $_GET['headline'] ?? '';

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
    '726207246412' => '4041724951222077555',
    '722222959854' => '4041724951222077555',
    '734221246056' => '2869917146979596386',
    '729438912638' => '4041724951222077555',
    '734308203598' => '2869917146979596386',
    '733914691878' => '2869917146979596386',
    '734259129838' => '2869917146979596386',
    '734178711113' => '2869917146979596386',
    '725128775199' => '1616492019523741769',
    '734101936225' => '2869917146979596386',
    '732272117238' => '3973136102687867937'
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

$link = "https://trk.bugmd.com/preclick";

switch (true) {
    case ($source === 'newsbreak' || $medium === 'newsbreak'):
        $redtrack = "68a83b90c916c0ae7d5423d9";
        $lp1 = "VMS-Bacteria-A6-08-22-25-News";
        break;
    case ($source === 'mediago' || $medium === 'mediago'):
        $redtrack = "68a83c8af6c843440f8374c0";
        $lp1 = "VMS-Bacteria-A6-08-22-25-MediaGo";
        break;
    case ($source === 'taboola' || $medium === 'taboola'):
        $redtrack = "68c2d33d008b795031bc392b";
        $lp1 = "VMS-Bacteria-A6-09-11-25-Taboola";
        break;
    default:
        $redtrack = "689601bc4b66f089e8976ac6";
        $lp1 = "VMS-A6-Bacteria-08-08-25-facebook";
}


$htmlFile = 'index.html';
$defaultHeadline = "Top Dr. Warns: Got Mice? Check Your Cupboard for This 1 Ingredient (You May Already Have It)";


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