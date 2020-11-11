<?php

require "src/DirectoryScanner.php";
require "src/FileUnzipper.php";
require "src/Response.php";

use app\src\DirectoryScanner;
use app\src\FileUnzipper;
use app\src\Response;

$dirPath = dirname(__FILE__) . "/public";

$directory = new DirectoryScanner($dirPath);
$dirFiles = $directory->findFiles();

if (isset($_GET['action'])) {
    echo $_GET['action'];
}

if (isset($_POST['btnRefresh'])) {
    $dirFiles = $directory->findFiles();

    echo Response::success("Success", $dirFiles);
    return;
}

if (isset($_POST['btnUnzip'])) {
    $fileUnzipper = new FileUnzipper();

    $fileName = isset($_POST['zipFile']) ? strip_tags($_POST['zipFile']) : '';
    $filePath = "{$directory->getDirPath()}/{$fileName}";
    $response = $fileUnzipper::unzip($filePath, $directory->getDirPath());

    echo json_encode($response);
    return;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>PHP Unzipper</title>
</head>
<body>

<div>
    <main>

        <select id="zipFile">
            <?php foreach ($dirFiles as $file): ?>
                <option><?php echo $file ?></option>
            <?php endforeach ?>
        </select>

        <button type="submit" id="btnUnzip">
            Unzip
        </button>

        <button type="button" id="btnRefresh">
            Refresh
        </button>

    </main>
</div>
<script>
    const btnUnzip = document.querySelector('button#btnUnzip');
    const btnRefresh = document.querySelector('button#btnRefresh');

    function request(data) {
        console.log('Sending data');

        const XHR = new XMLHttpRequest();

        let urlEncodedData = "",
            urlEncodedDataPairs = [],
            name;

        // Turn the data object into an array of URL-encoded key/value pairs.
        for (name in data) {
            urlEncodedDataPairs.push(encodeURIComponent(name) + '=' + encodeURIComponent(data[name]));
        }

        // Combine the pairs into a single string and replace all %-encoded spaces to
        // the '+' character; matches the behaviour of browser form submissions.
        urlEncodedData = urlEncodedDataPairs.join('&').replace(/%20/g, '+');

        // Define what happens on successful data submission
        XHR.addEventListener('load', function (event) {
            console.log(event.target.responseText)
            let response = JSON.parse(event.target.responseText);
            alert(response.message);
        });

        // Define what happens in case of error
        XHR.addEventListener('error', function (event) {
            alert('Oops! Something went wrong.');
        });

        // Set up our request
        XHR.open('POST', '');

        // Add the required HTTP header for form data POST requests
        XHR.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        // Finally, send our data.
        XHR.send(urlEncodedData);
    }

    btnUnzip.addEventListener('click', function () {
        request({
            btnUnzip: '1',
            zipFile: document.getElementById('zipFile').value
        });
    })

    btnRefresh.addEventListener('click', function () {
        request({
            btnRefresh: '1',
        });
    });
</script>
</body>
</html>

