## 	v 1.0.3
	Copyright 2015, Honkytonk Films
	http://www.klynt.net	

About
=====

This program is used as in interface between Klynt and external video platforms. It allows Klynt to communicate with these platforms to retrieve necessary video information, and at the same time, it allows the protection of the platform identification tokens.

Configuration
=============

* Add the required configuration information to the file `klynt-video-api-config.php`.
* Upload this folder to your php server (See requirements below for more information).
* Visit the uploaded `test.php` page on a browser and check that all requirements are validated.
* Copy the url of the file `klynt-video-api.php` in the settings of your project (example: http://yourwebsite.com/klynt-video-api-config.php.)
 
Vimeo Pro configuration
-----------------------

The following parameters are required to use Vimeo Pro videos.

* `VIMEO_CLIENT_ID`: Vimeo Client Id.
* `VIMEO_CLIENT_SECRET`: Vimeo Client Secret.
* `VIMEO_CLIENT_ACCESS_TOKEN`: Vimeo Auth 2 Access Token.
 
Dailymotion Cloud configuration
-------------------------------

The following parameters are required to use Dailymotion Cloud videos.

* `DMCLOUD_USER_ID`: The DM Cloud user id.
* `DMCLOUD_API_KEY`: The DM Cloud api key.
 
Brightcove configuration
------------------------

The following parameter is required to use Brightcove videos.

* `BCMAPI_READ_API_TOKEN`: The Brightcove api token. This token should have *URL ACCESS* enabled.
 
Cache configuration
-------------------

It is recommended to enable the cache. This allows both reducing the number of calls to the platform api and speeding the response times. If cache is enabled, The cache directory defined below **MUST** be created manually. Also don't use long cache durations because the cached information (such as urls) may expire.

* `CACHE_ENABLED`: `true` or `false`.
* `CACHE_DURATION`: The duration of the cached information in seconds.
* `CACHE_EXTENSION`: The extension of the cache files.
* `CACHE_DIRECTORY`: The directory where cache files will be created. This directory must be created manually.

Requirements
============

* PHP version 5.3 or greater
* JSON (JavaScript Object Notation). For more information on the JSON package, please
visit the [PHP JSON](http://www.php.net/json) package website.
* cURL (Curl URL Request Library). For more information on the cURL package, please
visit the [PHP CURL](http://www.php.net/curl) package website.
