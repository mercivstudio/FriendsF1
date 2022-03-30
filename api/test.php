<?
/**
 * v 1.0.3
 * Copyright 2015, Honkytonk Films
 * http://www.klynt.net
 * */

function row($label, $value, $info, $valid) {
	echo "<tr>\n";
	echo "\t<td>" . $label . "</td>\n";
	echo "\t<td class='" . ($valid ? "ok" : "error") . "'>" . $value . "</td>\n";
	echo "\t<td>" . $info . "</td>\n";
	echo "</tr>\n";
}

function paramStatus($param) {
	if ($param != NULL && strlen(constant($param)) > 0) {
		return "Set (" . strlen(constant($param)) . " Chars)";
	} else {
		return "Not Set";
	}
}

function paramDefined($param) {
	return defined($param) && strlen(constant($param)) > 0;
}
?>

<html>
<head>
<title>Klynt Video Api - v 1.0.3</title>
<style type="text/css">
	.ok {
		color: green;
	}
	.error {
		color: red;
	}
	td {
		padding-left: 16px;
		padding-right: 16px;
	}
</style>
</head>
<body>
<center>
<h1>Server Configuration</h1>
<table>
<tbody>
<?
	$recentVersion = (PHP_MAJOR_VERSION == 5 && PHP_MINOR_VERSION >= 3) || PHP_MAJOR_VERSION > 5;
	row("PHP Version", PHP_VERSION, "5.3.0 or newer required", $recentVersion);
	row("CURL", function_exists('curl_version') ? "Enabled" : "Non enabled", "Required", function_exists('curl_version'));
	row("JSON", function_exists('json_encode') ? "Enabled" : "Non enabled", "Required", function_exists('json_encode'));
?>
</tbody>
</table>
<?
	
?>
<h1>Script Files</h1>
<table>
<tbody>
<?
	$apiFile = "klynt-video-api.php";
	$configFile = "klynt-video-api-config.php";
	include_once($configFile);

	row("Script File", file_exists($apiFile) ? "Found" : "Not found", $apiFile, file_exists($apiFile));
	row("Configuration File", file_exists($configFile) ? "Found" : "Not found", $configFile, file_exists($configFile));
?>
</tbody>
</table>
<h1>Vimeo</h1>
<table>
<tbody>
<?
	$vimeoFile = "klynt/klynt-vimeopro.php";

	row("Client Id", paramStatus("VIMEO_CLIENT_ID"), "Required", paramDefined("VIMEO_CLIENT_ID"));
	row("Client Secret", paramStatus("VIMEO_CLIENT_SECRET"), "Required", paramDefined("VIMEO_CLIENT_SECRET"));
	row("Access Token", paramStatus("VIMEO_CLIENT_ACCESS_TOKEN"), "Required", paramDefined("VIMEO_CLIENT_ACCESS_TOKEN"));
	row("Vimeo Script File", file_exists($vimeoFile) ? "Found" : "Not found", $vimeoFile, file_exists($vimeoFile));
?>
</tbody>
</table>
</center>
</body>
</html>