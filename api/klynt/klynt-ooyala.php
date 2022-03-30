<?php

/**
 * v 1.0.3
 * Copyright 2015, Honkytonk Films
 * http://www.klynt.net
 * */

function requestVideoInfo($videoId) {
	require('lib/ooyala/OoyalaApi.php');
	
	$api = new OoyalaApi(OOYALA_API_KEY, OOYALA_API_SECRET);

	try {
		$video = $api->get('assets/'.$videoId);
		$streams = $api->get('assets/'.$videoId.'/streams');
	} catch (Exception $error) {
		echo $error;
		return null;
	}

	if ($video && $streams) {
		$urls = array();
		$width = 1280;
		$height = 720;
		foreach ($streams as $stream) {
			$useStream = strtolower($stream->muxing_format) == "mp4";
			if ($stream->is_source) {
				$width = $stream->video_width;
				$height = $stream->video_height;
				if (preg_match("/\.mp4$/i", $video->original_file_name) &&
					$stream->stream_type == "single" &&
					$stream->video_codec == "h264" &&
					strtolower($stream->muxing_format) == "na") {
					$useStream = true;
				}
			}

			if ($useStream) {
				$urls[$stream->average_video_bitrate] = $stream->url;
			}
		}

		return array(
			'name' => $video->name,
			'duration' => $video->duration / 1000,
			'width' => $width,
			'height' => $height,
			'description' => $video->description,
			//'tags' => '',
			'thumbnail' => $video->preview_image_url,
			'urls' => $urls
		);
	} else {
		return null;
	}
}

?>