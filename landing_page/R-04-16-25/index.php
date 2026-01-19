<?php 

srand((double)microtime()*1000000);
$ch = (rand(1,100));

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


    $redtrack = "";
    $link = "https://trk.bugmd.com/preclick";

    $lp1 = "";
    include('index.html');
       

?>