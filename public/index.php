<?php
/*
 * Laravel Forge API SDK for PHP Sandbox
 * SDK for PHP for the official Laravel Forge API
 *
 * Copyright © 2017 Denis Lam <denis@fullstackpros.io>
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
require dirname(__DIR__) . '/vendor/autoload.php';

use Laravel_Forge_API_SDK_PHP\Forge;
use Laravel_Forge_API_SDK_PHP\Actions\ConfigurationFiles;
use Laravel_Forge_API_SDK_PHP\Actions\Credentials;
use Laravel_Forge_API_SDK_PHP\Actions\Daemons;
use Laravel_Forge_API_SDK_PHP\Actions\Daployment;
use Laravel_Forge_API_SDK_PHP\Actions\FirewallRules;
use Laravel_Forge_API_SDK_PHP\Actions\GitProjects;
use Laravel_Forge_API_SDK_PHP\Actions\MySQLDatabases;
use Laravel_Forge_API_SDK_PHP\Actions\MySQLDatabaseUsers;
use Laravel_Forge_API_SDK_PHP\Actions\Recipes;
use Laravel_Forge_API_SDK_PHP\Actions\ScheduledJobs;
use Laravel_Forge_API_SDK_PHP\Actions\Servers;
use Laravel_Forge_API_SDK_PHP\Actions\Sites;
use Laravel_Forge_API_SDK_PHP\Actions\SSHKeys;
use Laravel_Forge_API_SDK_PHP\Actions\SSLCertificates;
use Laravel_Forge_API_SDK_PHP\Actions\Wordpress;
use Laravel_Forge_API_SDK_PHP\Actions\Workers;
use Laravel_Forge_API_SDK_PHP\Extensions\LetsEncrypt;

// Set your Forge API token

Forge::setToken('INSERT_YOUR_TOKEN_HERE');

echo '<h1>Laravel Forge API PHP SDK Sandbox</h1>';
echo '<p>Please set your API token in index.php before using.</p><br \>';

$data = Servers::list();
//$data = SSLCertificates::list(125984,306956);
//$data = LetsEncrypt::get_ssl_ids(125984,306956);
//$data = Sites::list(118367);
//$data = '<pre>'.$data.'</pre>';


/*
$server_id = 125984;
$site_id = 306956;
$add_domains = array(
);
$delete_domains = array(
);
*/
//$data = LetsEncrypt::letsencrypt_aggregator($server_id, $site_id, $add_domains, $delete_domains, true);

echo '<pre>'.Forge::pretty($data).'</pre>';

