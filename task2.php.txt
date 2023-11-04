<?php

// Configuration for the database connection
$databaseHost = 'your_db_host';
$databaseName = 'your_db_name';
$databaseUser = 'your_db_user';
$databasePassword = 'your_db_password';

try {
    // Connect to the database
    $db = new PDO("mysql:host=$databaseHost;dbname=$databaseName", $databaseUser, $databasePassword);

    // Set the PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Download the webpage
    $url = 'https://www.wikipedia.org/';
    $html = file_get_contents($url);

    // Create a DOMDocument
    $doc = new DOMDocument;
    @$doc->loadHTML($html);

    // Create a DOMXPath object
    $xpath = new DOMXPath($doc);

    // Extract and store sections data
    $sections = $xpath->query('//h2 | //h3');
    $dateCreated = date('Y-m-d H:i:s');
    
    foreach ($sections as $section) {
        $title = $section->textContent;
        $url = ''; // You can fill this if you have relevant URLs for each section
        $picture = ''; // You can fill this if you have relevant pictures for each section
        $abstract = ''; // You can fill this if you have relevant abstracts for each section
        
        // Insert data into the database
        $stmt = $db->prepare("INSERT INTO wiki_sections (date_created, title, url, picture, abstract) VALUES (:dateCreated, :title, :url, :picture, :abstract)");
        $stmt->bindParam(':dateCreated', $dateCreated);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':url', $url);
        $stmt->bindParam(':picture', $picture);
        $stmt->bindParam(':abstract', $abstract);
        $stmt->execute();
    }

    echo "Data has been extracted and saved to the database.";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>
