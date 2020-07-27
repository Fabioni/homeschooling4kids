<?php

function getMarkusVideos() {
	/**
	 * Sample PHP code for youtube.search.list
	 * See instructions for running these code samples locally:
	 * https://developers.google.com/explorer-help/guides/code_samples#php
	 */

	if ( ! file_exists( get_template_directory() . '/vendor/autoload.php' ) ) {
		throw new Exception( sprintf( 'Please run "composer require google/apiclient:~2.0" in "%s"', __DIR__ ) );
	}
	require_once get_template_directory() . '/vendor/autoload.php';

	$client = new Google_Client();
	$client->setApplicationName( 'API code samples' );
	$client->setDeveloperKey( "AIzaSyAzO6j4I9CjTPSgoc2i2HNd-M21daPU-xM" );
	$client->setScopes( [
		'https://www.googleapis.com/auth/youtube.force-ssl',
	] );

// TODO: For this request to work, you must replace
//       "YOUR_CLIENT_SECRET_FILE.json" with a pointer to your
//       client_secret.json file. For more information, see
//       https://cloud.google.com/iam/docs/creating-managing-service-account-keys
//$client->setAuthConfig( 'YOUR_CLIENT_SECRET_FILE.json' );
//$client->setAccessType( 'offline' );

// Request authorization from the user.
//$authUrl = $client->createAuthUrl();
//printf( "Open this link in your browser:\n%s\n", $authUrl );
//print( 'Enter verification code: ' );
//$authCode = trim( fgets( STDIN ) );

// Exchange authorization code for an access token.
//$accessToken = $client->fetchAccessTokenWithAuthCode( $authCode );
//$client->setAccessToken( $accessToken );

// Define service object for making API requests.
	$service = new Google_Service_YouTube( $client );

	$queryParams = [
		'channelId' => 'UC-sEEfQ1ZZ81mCr4aljHb_A',
		'order'     => 'date',
		'type'      => 'video'
	];

	$response = $service->search->listSearch( 'snippet', $queryParams );
//print_r( $response["items"] );

	$videos = [];
	$ids = "";
	foreach ( $response["items"] as $item ) {
		$ids .= $item["id"]["videoId"] . ",";
	}
	$ids = substr($ids, 0, -1);

	$queryParams = [
		'id' => $ids
	];

	$response = $service->videos->listVideos('snippet', $queryParams);
	foreach ( $response["items"] as $item ) {
		$videos[] = array(
			"id"         => $item["id"],
			"title"       => $item["snippet"]["title"],
			"description" => $item["snippet"]["description"],
		);
	}

	return $videos;
}
