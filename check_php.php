<?php
echo "Current PHP Version: " . phpversion();
if (version_compare(phpversion(), '8.3.0', '<')) {
    echo "<br><span style='color:red'>Error: Your PHP version is too old. Please upgrade to 8.3.0 or higher in your hosting panel.</span>";
} else {
    echo "<br><span style='color:green'>Success: Your PHP version is compatible!</span>";
}
?>
