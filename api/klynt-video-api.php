<?php

/**
 * v 1.0.3
 * Copyright 2015, Honkytonk Films
 * http://www.klynt.net
 * */

header('content-type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

require('klynt-video-api-config.php');

if (CACHE_ENABLED) {
	require('lib/brightcove/bc-mapi-cache.php');
	$bc_cache = new BCMAPICache('file', CACHE_DURATION, CACHE_DIRECTORY, CACHE_EXTENSION);
} else {
	$bc_cache = NULL;
}

if (isset($_REQUEST["platform"]) && isset($_REQUEST["video_id"])) {
	$platform = $_REQUEST["platform"];
	$videoId = $_REQUEST["video_id"];

	$result = getCachedVideoInfo($videoId, $platform, $bc_cache);

	if ($result == FALSE) {
		try {
			require('klynt/klynt-'.$platform.'.php');
			$result = requestVideoInfo($videoId);
		} catch (Exception $error) {
			echo $error;
			die();
		}
		cacheVideoInfo($videoId, $platform, $result, $bc_cache);
	}
	echo str_replace('\/', '/', json_encode($result));
} else {
	echo 'Klynt video api is available at this url';
}

function getCachedVideoInfo($videoId, $platform, $bc_cache) {
	// Brightcove api already implements cache, so here we cache the result of other platforms.
	if (CACHE_ENABLED && $platform != 'brightcove' && class_exists('BCMAPICache')) {
		$info = $bc_cache->get($platform.'-'.$videoId);

		if($info !== FALSE) {
			return json_decode($info);
		}
	}

	return null;
}

function cacheVideoInfo($videoId, $platform, $info, $bc_cache) {
	// Brightcove api already implements cache, so here we cache the result of other platforms.
	if (CACHE_ENABLED && $platform != 'brightcove' && class_exists('BCMAPICache') && $info) {
		$bc_cache->set($platform.'-'.$videoId, $info);
	}
}
?>
