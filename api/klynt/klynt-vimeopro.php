<?php

/**
 * v 1.0.3
 * Copyright 2015, Honkytonk Films
 * http://www.klynt.net
 * */

function requestVideoInfo($videoId) {
	require_once('lib/vimeo/autoload.php');

	$vimeo = new Vimeo\Vimeo(VIMEO_CLIENT_ID, VIMEO_CLIENT_SECRET, VIMEO_CLIENT_ACCESS_TOKEN );

	$video = $vimeo->request('/videos/'.$videoId);

	if ($video == NULL || !isset($video['body'])) {
		echo "No response received from vimeo.\n";
		return null;
	}

	$body = $video['body'];
	$error = isset($body['error']) ? $body['error'] : NULL;
	if ($error != NULL) {
		echo "Vimeo Error: " . $error . "\n";
	}

	$tags = array();
	if (isset($body['tags'])) {
		foreach ($body['tags'] as $tag) {
			array_push($tags, $tag['tag']);
		}
	}

	$max_thumbnail_size = 0;
	$thumbnail = '';
	if (isset($body['pictures']) && isset($body['pictures']['sizes'])) {
		foreach ($body['pictures']['sizes'] as $size) {
			if (isset($size['width']) && isset($size['link']) && $size['width'] > $max_thumbnail_size) {
				$max_thumbnail_size = $size['width'];
				$thumbnail = $size['link'];
			}
		}
	}

	$urls = array();
	$qualities = array("sd", "hd", "mobile");
	foreach ($body['files'] as $file) {
		if (in_array($file['quality'], $qualities)) {
			$rate = intval($file['size'] / $body['duration'] * 8);
			$urls[strval($rate)] = $file['link'];
		}
	}
	
	return array(
		'name' => isset($body['name']) ? $body['name'] : '',
		'duration' => isset($body['duration']) ? $body['duration'] : 0,
		'width' => isset($body['width']) ? $body['width'] : 0,
		'height' => isset($body['height']) ? $body['height'] : 0,
		'description' => isset($body['description']) ? $body['description'] : '',
		'tags' => join(',', $tags),
		'thumbnail' => $thumbnail,
		'urls' => $urls
	);
}

?>