# Laravel Forge API SDK for PHP
#
## Automating tasks on Laravel Forge has never been so easy

The **Laravel Forge API SDK for PHP** makes it easy for developers to access
[Laravel Forge][forge] in their PHP code via Forge's [official REST API][forge-api], and
build robust applications and software to automatically provision, manage, and
deploy unlimited PHP applications on AWS, DigitalOcean, Linode, etc. You can get
started in minutes by [installing the SDK through Composer](#installation) or by
downloading a single zip or phar file from our [latest release][latest-release].

* [Installation](#installation)
	- [Require the Composer Autoloader](#require-the-composer-autoloader)
	- [Set Your Forge API Token](#set-your-forge-api-token)
* [Usage](#usage)
    - [Functions Quick Reference](#functions-quick-reference)
	- [Complete Documentation](#complete-documentation)
	- [Live Demo](#live-demo)
	- [Code Sandbox](#code-sandbox)
* [Bonus Features](#bonus-features)
    - [Multiple HTTP Client Support](#multiple-http-client-support)
    - [Instant Dynamic HTTP Client Switching](#instant-dynamic-http-client-switching)
    - [Custom Exceptions Handling](#custom-exceptions-handling)
* [Am I Missing an Essential Feature?](#am-i-missing-an-essential-feature)
* [Contributing](#contributing)
* [License](#license)
* [Donate](#donate)

## Installation

The Laravel Forge API SDK for PHP can be installed via [Composer][composer] by requiring the
`guzzlehttp/guzzle` package (see: [GuzzleHTTP][guzzle]) and registering a PSR-4 autoloader
for the `Laravel_Forge_API_PHP_SDK` namespace in your project's `composer.json`.

```
{
    "require": {
		"guzzlehttp/guzzle": "~6.0"
    },
	"autoload": {
		"psr-4": {
			"Laravel_Forge_API_PHP_SDK\\": "src/laravel-forge-api-php-sdk/"
	}
}
```

Then run a composer update:
```sh
composer update
```

### Require the Composer Autoloader
In your code, require the Composer autoloader `vendor/autoload.php`.
```php
require __DIR__ . '/vendor/autoload.php';
```
Change the directory path to match your code's architecture if needed.

### Set Your Forge API Token
Create a new API Token from your [Forge account settings][forge-set-api].

Then copy and paste your API token into a `Forge::setToken()` function and place
this inside your code.
```php
Forge::setToken('COPY AND PASTE YOUR FORGE API TOKEN HERE');
```

## Usage

Here are a few examples of what you can do. Server responses are in a JSON
string format.

List all your servers:
```php
echo Servers::list();
```
Get information about a specific server:
```php
echo Servers::get($server_id);
```
List all your sites on a specific server:
```php
echo Sites::list($server_id);
```
Create a new server:
```php
Servers::create($payload);

$payload = array(
  "provider"            => $provider,           // string
  "credential_id"       => $credential_id,      // boolean
  "region"              => $region,             // string
  "ip_address"          => $ip_address,         // string
  "private_ip_address"  => $private_ip_address, // string
  "php_version"         => $php_version,        // string
  "database"            => $database,           // string
  "maria"               => $maria,              // boolean
  "load_balancer"       => $load_balancer,      // boolean
  "network"             => $network             // array
);
```

### Functions Quick Reference
Please visit our [SDK API documentation][sdk-docs] for a complete reference of what
classes and functions are available.

* Servers
  * `Servers::create($payload = [])`
  * `Servers::list()`
  * `Servers::get($server_id)`
  * `Servers::update($server_id)`
  * `Serverse::update_database_password($payload = [])`
  * `Servers::delete($server_id)`
  * `Servers::reboot($server_id)`
  * `Servers::revoke($server_id)`
  * `Servers::reconnect($server_id)`
  * `Servers::reactivate($server_id)`  
* Services
  * `Services::reboot_mysql($server_id)`
	* `Services::stop_mysql($server_id)`
	* `Services::reboot_nginx($server_id)`
	* `Services::stop_nginx($server_id)`
	* `Services::reboot_postgres($server_id)`
	* `Services::stop_postgres($server_id)`
	* `Services::install_blackfire($payload = [])`
	* `Services::install_papertrail($payload = [])`
	* `Services::remove_papertrail($payload = [])`
* Daemons
	* `Daemons::create($server_id, $payload = [])`
	* `Daemons::list($server_id)`
	* `Daemons::get($server_id, $daemon_id)`
	* `Daemons::delete($server_id, $daemon_id)`
	* `Daemons::restart($server_id, $daemon_id)`
* Firewall Rules
	* `FirewallRules::create($server_id, $payload = [])`
	* `FirewallRules::list($server_id)`
	* `FirewallRules::get($server_id, $rule_id)`
	* `FirewallRules::delete($server_id, $rule_id)`
* Scheduled Jobs
	* `ScheduledJobs::create($server_id, $payload = [])`
	* `ScheduledJobs::list($server_id)`
	* `ScheduledJobs::get($server_id, $job_id)`
	* `ScheduledJobs::delete($server_id, $job_id)`
* MySQL Databases
	* `MySQLDatabases::create($server_id, $payload = [])`
	* `MySQLDatabases::list($server_id)`
	* `MySQLDatabases::get($server_id, $database_id)`
	* `MySQLDatabases::delete($server_id, $database_id)`
* MySQL Database Users
	* `MySQLDatabaseUsers::create($server_id, $payload = [])`
	* `MySQLDatabaseUsers::list($server_id)`
	* `MySQLDatabaseUsers::get($server_id, $user_id)`
	* `MySQLDatabaseUsers::update($server_id, $user_id, $payload = [])`
	* `MySQLDatabaseUsers::delete($server_id, $user_id)`
* Sites
	* `Sites::create($server_id, $payload = [])`
	* `Sites::list($server_id)`
	* `Sites::get($server_id, $site_id)`
	* `Sites::update($server_id, $site_id, $payload = [])`
	* `Sites::delete($server_id, $site_id)`
	* `Sites::balancing($server_id, $site_id, $payload = [])`
* SSL Certificates
	* `SSLCertificates::create($server_id, $site_id, $payload = [])`
	* `SSLCertificates::install_existing($server_id, $site_id, $payload = [])`
	* `SSLCertificates::clone($server_id, $site_id, $payload = [])`
	* `SSLCertificates::letsencrypt($server_id, $site_id, $payload = [])`
	* `SSLCertificates::list($server_id, $site_id)`
	* `SSLCertificates::get($server_id, $site_id, $ssl_id)`
	* `SSLCertificates::install($server_id, $site_id, $ssl_id, $payload = [])`
	* `SSLCertificates::activate($server_id, $site_id, $ssl_id)`
	* `SSLCertificates::delete($server_id, $site_id, $ssl_id)`
* SSH Keys
	* `SSHKeys::create($server_id, $payload = [])`
	* `SSHKeys::list($server_id)`
	* `SSHKeys::get($server_id, $key_id)`
	* `SSHKeys::delete($server_id, $key_id)`
* Workers
	* `Workers::create($server_id, $site_id, $payload = [])`
	* `Workers::list($server_id, $site_id)`
	* `Workers::get($server_id, $site_id, $worker_id)`
	* `Workers::delete($server_id, $site_id, $worker_id)`
	* `Workers::restart($server_id, $site_id, $worker_id)`
* Deployment
	* `Deployment::enable($server_id, $site_id)`
	* `Deployment::disable($server_id, $site_id)`
	* `Deployment::get_script($server_id, $site_id)`
	* `Deployment::update($server_id, $site_id, $payload = [])`
	* `Deployment::deploy($server_id, $site_id)`
	* `Deployment::reset($server_id, $site_id)`
	* `Deployment::get_log($server_id, $site_id)`
* Configuration Files
	* `ConfigurationFiles::get_nginx($server_id, $site_id)`
	* `ConfigurationFiles::update_nginx($server_id, $site_id, $payload = [])`
	* `ConfigurationFiles::get_env($server_id, $site_id)`
	* `ConfigurationFiles::update_env($server_id, $site_id, $payload = [])`
* git Projects
	* `GitProjects::install($server_id, $site_id, $payload = [])`
	* `GitProjects::remove($server_id, $site_id)`
* WordPress
	* `WordPress::install($server_id, $site_id, $payload = [])`
	* `WordPress::uninstall($server_id, $site_id)`
* Recipes
	* `Recipes::create($payload = [])`
	* `Recipes::list()`
	* `Recipes::get($recipe_id)`
	* `Recipes::get($recipe_id, $payload = [])`
	* `Recipes::delete($recipe_id)`
	* `Recipes::run($recipe_id, $payload = [])`
* Credentials
	* `Credentials::list()`

### Complete Documentation
Check out `../public/docs/index.php` for a complete reference of the SDK's
available API functions.

### Live Demo
Check out `../public/docs/demo.php` for a live demo of more usage examples.

### Code Sandbox
Use the framework set up in `../public/index.php` to test your code.

## Bonus Features

### Multiple HTTP Client Support
The SDK includes handlers for two of the most powerful PHP HTTP clients:

* [Guzzle 6][guzzle]
* [cURL 7][curl]

By default, the Guzzle client is used to handle all Forge API requests.

### Instant Dynamic HTTP Client Switching
If you desire to add other clients or change between clients, you can do so in
a matter of seconds:

1. Open `Forge.php`
2. Change `const PHP_HTTP_CLIENT` on line 35 to the client you want.
3. Save the file and you're done! The SDK will automatically use the HTTP client
class located within `../HttpHandlers/` to make API requests.

### Custom Exceptions Handling
The SDK makes it easy to create and trigger custom exceptions in your code.
Here's all you have to do:

1. Open `../Exceptions/Errors.php`.
2. Enter your custom error reference ID and message into the
 ` errors($id)` function array. The message ID may contain spaces and numbers.

```php
$data = [
  //..
  'Custom Error ID 1' => ['context'  => 'Your custom error message.' ],
  'custom_error_id_2' => ['context'  => 'Another custom error message.' ],
  //..
];
```

3. To return a custom error message in your code, simply use the `get()`
function of the `Errors` base class like this:

```php
return Errors::get('Custom Error ID 1');
```

4. That's it!

## Am I Missing An Essential Feature?
* *Nothing is impossible!*
* [Open an issue][open-issue] and let's make the SDK better together!
* Bug reports, feature requests, fixes, and well-wishes are always welcome.
* Want to say thanks or buy me a beer? [Donations](#donations) are welcome. ☺

## Contributing
1. Create an issue and describe your idea.
2. [Fork it][fork]
3. Create your feature branch (`git checkout -b my-new-feature`)
4. Commit your changes (`git commit -am 'Add some feature'`)
5. Publish the branch (`git push origin my-new-feature`)
6. Create a new Pull Request

*To test your workflow, you can use my [test repo][test-repo].*

## License
Laravel Forge API SDK for PHP is released under the [MIT License][mit]

## Donate
Buy me a few beers if you feel this SDK saved you a few jars of sweat or put a
smile on your face. Cheers! ☺

### Bitcoin
You can send Bitcoin donations to [1BM3kt5UKe4v6Rb8sQBXA9pnFgJdMGCwWq](bitcoin:1BM3kt5UKe4v6Rb8sQBXA9pnFgJdMGCwWq) or via [Coinbase](https://blockchain.info/payment_request?address=1BM3kt5UKe4v6Rb8sQBXA9pnFgJdMGCwWq) by clicking on the button below.
 
[![coinbase](https://blockchain.info/Resources/buttons/donate_64.png)](https://blockchain.info/payment_request?address=16opr7qrueNVi2sSKwTLF5VqyyuMX54H2T)

### PayPal
Credit cards are also accepted here:

[![PayPal](https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif "Donate with PayPal")][paypal]

### Flattr
[![flattr](https://button.flattr.com/flattr-badge-large.png "Donate with Flattr")][flattr]

[latest-release]: #
[sdk-docs]: http://github.com/denislam/laravel-forge-api-php-sdk/wiki
[open-issue]: https://github.com/denislam/laravel-forge-api-php-sdk
[fork]: https://github.com/denislam/laravel-forge-api-php-sdk/fork
[test-repo]: https://github.com/denislam/test-repo/

[forge]: https://forge.laravel.com
[forge-api]: https://forge.laravel.com/api-documentation
[forge-set-api]: https://forge.laravel.com/user/profile#/api
[composer]: http://getcomposer.org
[guzzle]: http://guzzlephp.org
[curl]: https://curl.haxx.se
[mit]: http://www.opensource.org/licenses/MIT

[bitcoin]: bitcoin:1BM3kt5UKe4v6Rb8sQBXA9pnFgJdMGCwWq
[coinbase]: https://blockchain.info/payment_request?address=1BM3kt5UKe4v6Rb8sQBXA9pnFgJdMGCwWq
[paypal]: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=REBCNDWH2KWHJ
[flattr]: https://flattr.com/submit/auto?fid=elv702&url=https%3A%2F%2Fgithub.com%2Fdenislam%2Flaravel-forge-api-php-sdk
