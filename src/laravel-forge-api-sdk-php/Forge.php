<?php
/*
 * Laravel Forge API SDK for PHP
 * PHP client library for accessing the official Laravel Forge API
 *
 * Copyright © 2017 Denis Lam, FullStackPros.io <denis@fullstackpros.io>
 * Laravel is a trademark Of Taylor Otwell and copyright © Laravel LLC
 * Licensed under the MIT License
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */
namespace Laravel_Forge_API_SDK_PHP;

/**
 * The Laravel Forge API Client
 * https://github.com/denislam/laravel-forge-api-sdk-php
 */
class Forge
{
	const LIBVER = '0.1';
	const USER_AGENT_SUFFIX = 'laravel-forge-api-sdk-php/';
	const API_BASE_URL = 'https://forge.laravel.com/api/v1/';
	const PHP_HTTP_CLIENT = 'Guzzle';	// Guzzle or Curl currently supported

	private static $token;

	/**
	* Get a string containing the version of the library.
	*/
	public static function getLibraryVersion()
	{
		return self::LIBVER;
	}

	/**
	* Set the Forge API token.
	*/
	public static function setToken($token)
	{
		self::$token = $token;
	}

	/**
	* Get the Forge API token.
	*/
	public static function getToken()
	{
		return self::$token;
	}

	/**
	* Get the PHP http client class full namespace path.
	*/
	public static function getClient()
	{
		return 'Laravel_Forge_API_SDK_PHP\HttpHandlers\\' . ucfirst(self::PHP_HTTP_CLIENT);
	}

	/**
	* Make a JSON string pretty and readable.
	*/
	public static function pretty($json)
	{
		return json_encode($json, JSON_PRETTY_PRINT);
	}

	/**
	* Check if string is JSON (i.e. to separate it from Configuration Files).
	*/
	public static function isJson($string) {
 		json_decode($string);
 		return (json_last_error() == JSON_ERROR_NONE);
	}
}
