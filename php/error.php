<?php
echo '
    <body style="color: #fff; background: #222;"></body>
    <h2 style="display: flex; justify-content: center; align-items: center">This is an error site</h2>
';

if (isset($_GET['errorMsg'])) {
    $errorMsg = $_GET['errorMsg'];
    echo '<h4 style="display: flex; justify-content: center; align-items: center">' . htmlspecialchars($errorMsg) . '</div>';
} else {
    echo '<h4 style="display: flex; justify-content: center; align-items: center">Error occurred</h3>';
}