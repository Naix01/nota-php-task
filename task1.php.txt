<?php

/**
 * Find and list files in the /datafiles folder with specific criteria.
 *
 * This script searches for files in the /datafiles folder with names consisting of numbers and letters
 * of the Latin alphabet and having the .ixt extension. It then displays the names of these files
 * ordered by name.
 *
 * @param string $folderPath The path to the folder to search for files.
 * @param string $pattern    Regular expression pattern to match file names.
 */
function listMatchingFiles($folderPath, $pattern) {
    // Check if the folder exists
    if (!is_dir($folderPath)) {
        echo "Folder does not exist: $folderPath";
        return;
    }

    // Use glob to find files in the folder
    $files = glob("$folderPath/*.ixt");

    if (empty($files)) {
        echo "No matching files found in $folderPath";
        return;
    }

    // Initialize an array to store matching file names
    $matchingFileNames = [];

    // Iterate through the files and filter by the given pattern
    foreach ($files as $file) {
        $fileName = basename($file);
        if (preg_match($pattern, $fileName)) {
            $matchingFileNames[] = $fileName;
        }
    }

    // Sort the matching file names alphabetically
    sort($matchingFileNames);

    // Display the sorted file names
    echo "Matching files in $folderPath:\n";
    foreach ($matchingFileNames as $name) {
        echo "$name\n";
    }
}

// Define the folder path and regular expression pattern
$folderPath = '/datafiles';
$pattern = '/^[a-zA-Z0-9]+\.ixt$/';

// Call the function to list matching files
listMatchingFiles($folderPath, $pattern);
