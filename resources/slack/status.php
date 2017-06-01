<?
require_once("../classes/systems.php");
date_default_timezone_set('UTC');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(405);
  die();
}

if (
  !isset($_POST["text"])
) {
  http_response_code(400);
  die();
}

$systems = new Systems();

foreach ($systems->get()->systems as $index => $system) {
  if (strtolower($system->solarSystemName) == strtolower(trim($_POST["text"]))){
    $percent = $system->victoryPoints / $system->victoryPointThreshold * 100;
    $percent = number_format($percent, 2, '.', '');
    echo ($system->solarSystemName. ' is held by the '.$system->occupyingFactionName.' and is '.$percent.'% contested.');
    die();
  }
}

echo ($_POST["text"]. ' not found.');