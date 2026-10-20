<?php

require __DIR__ . "/vendor/autoload.php";

use Dompdf\Dompdf;
use Dompdf\Options;

// Safely access POST data
$blotterSeries = $_POST["blotterSeries"] ?? "No blotterSeries";
$date = $_POST["date"] ?? "No date";
$complainantName = $_POST["complainantName"] ?? "No complainantName";
$complainantAddress = $_POST["complainantAddress"] ?? "No complainantAddress";
$complainantContact = $_POST["complainantContact"] ?? "No complainantContact";
$complainantAge = $_POST["complainantAge"] ?? "No complainantAge";

$defendantName = $_POST["defendantName"] ?? "No defendantName";
$defendantAddress = $_POST["defendantAddress"] ?? "No defendantAddress";
$defendantContact = $_POST["defendantContact"] ?? "No defendantContact";
$defendantAge = $_POST["defendantAge"] ?? "No defendantAge";

$complaints = $_POST["complaints"] ?? "No complaints";
$blotterDate = $_POST["blotterDate"] ?? "No blotterDate";
$blotterTime = $_POST["blotterTime"] ?? "No blotterTime";
$blotterPlace = $_POST["blotterPlace"] ?? "No blotterPlace";

$narrative = $_POST["narrative"] ?? "No narrative";
$officerName = $_POST["officerName"] ?? "No officerName";
$position = $_POST["position"] ?? "No position";


// Set Dompdf options
$options = new Options();
$options->setChroot(__DIR__);
$options->set('isHtml5ParserEnabled', true);      // Enable HTML5 parsing
$options->set('isRemoteEnabled', true);           // Allow loading external files (e.g. images, fonts)
$options->set('defaultMediaType', 'screen');      // Ensure screen styles apply
$options->set('isPhpEnabled', true);              // If using PHP inside templates (optional)
$options->set('dpi', 96);                         // Set resolution for rendering
$options->set('isFontSubsettingEnabled', true);   // Improve font rendering

// Initialize Dompdf with options
$dompdf = new Dompdf($options);

// Load and process HTML template
$html = file_get_contents("adminBlotterTemplate.html");
$html = str_replace(
    ["{{ complainantName }}", "{{ complainantAddress }}", "{{ complainantContact }}", "{{ complainantAge }}", "{{ defendantName }}", "{{ defendantAddress }}", "{{ defendantContact }}", "{{ defendantAge }}", "{{ complaints }}", "{{ blotterDate }}", "{{ blotterTime }}", "{{ blotterPlace }}", "{{ narrative }}", "{{ officerName }}", "{{ position }}", "{{ blotterSeries }}", "{{ date }}"],
    [$complainantName, $complainantAddress, $complainantContact, $complainantAge, $defendantName, $defendantAddress, $defendantContact, $defendantAge, $complaints, $blotterDate, $blotterTime, $blotterPlace, $narrative, $officerName, $position, $blotterSeries, $date],
    $html
);

$dompdf->loadHtml($html);
$dompdf->render();

// Set PDF metadata
$dompdf->addInfo("Title", "Blotter Form");

// Stream PDF in browser
$dompdf->stream("blotter.pdf", ["Attachment" => 0]);

?>
