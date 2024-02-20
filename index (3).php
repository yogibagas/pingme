<?php

// Replace the websites with your actual URLs
$websites = [
    'https://www.coastcoplumbing.com.au/',
];

date_default_timezone_set('Australia/Sydney');

foreach ($websites as $website) {
    // Create a unique log file for each website
     $logFile = __DIR__ .'/ping_log_' . md5($website) . '.txt';
    $ch = curl_init($website);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

        // Process the result
        $logMessage = date('Y-m-d H:i:s') . " - ".$website." - ";

        if ($response !== false) {
            // Website is reachable
            $logMessage .= "Website is reachable\n";
        } else {
            // Website is not reachable
            $logMessage .= "Website is not reachable\n";
        }

        // Write the result to the log file
        file_put_contents($logFile, $logMessage, FILE_APPEND);
        // echo $logFile;
}
