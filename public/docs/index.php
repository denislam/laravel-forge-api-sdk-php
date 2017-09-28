<?php
/*
 * Laravel Forge API SDK for PHP Documenation
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
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>PHP SDK Documentation</title>

    <link rel="icon" type="image/png" href="/docs/assets/images/favicon.png">
    <link href="/docs/assets/css/font-awesome.min.css" rel="stylesheet" media="screen">
    <link href="/docs/assets/css/screen.css" rel="stylesheet" media="screen">

    <script src="/docs/assets/js/lib/jquery.min.js"></script>
    <script src="/docs/assets/js/lib/jquery_ui.js"></script>
    <script src="/docs/assets/js/lib/energize.js"></script>
    <script src="/docs/assets/js/lib/renderjson.js"></script>
    <script src="/docs/assets/js/lib/jquery.highlight.js"></script>
    <script src="/docs/assets/js/lib/jquery.tocify.js"></script>
    <script src="/docs/assets/js/lib/lunr.js"></script>
    <script src="/docs/assets/js/script.js"></script>
</head>

<body class="index">

  <a href="#" id="nav-button">
      <span>NAV<img src="/docs/assets/images/navbar.png"/></span>
  </a>

  <div class="tocify-wrapper">
    <div class="logo-container">
      <img src="/docs/assets/images/forge-logo.svg" style="width: 200px;margin-left: 27px;">
      <span style="color:#fff;">API PHP SDK Documentation</span>
      <p class="credits">
        &copy; <?php echo date('Y');?> <a href="http://denislam.com" target="_blank">Denis Lam</a>
        <a href="https://github.com/denislam/laravel-forge-api-php-sdk" target="_blank"><i class="fa fa-github"></i></a>
        <a href="https://linkedin.com/in/denislam" target="_blank"><i class="fa fa-linkedin"></i></a>
        <a href="https://angel.co/denislam" target="_blank"><i class="fa fa-angellist"></i></a>
        <a href="https://instagram.com/denislamofficial" target="_blank"><i class="fa fa-instagram"></i></a>
      </p>
    </div>
    <div class="search">
      <input type="text" class="search" id="input-search" placeholder="Search">
    </div>
    <ul class="search-results"></ul>
    <div id="toc" class="tocify"></div>
  </div>

  <div class="page-wrapper">
      <div class="dark-box"></div>

      <div class="content">

        <h1 id="introduction">Introduction</h1>
        <p>The Forge API PHP SDK is a PHP HTTP client library that allows you to
           create and interact with servers and sites on Laravel Forge using
           Forge's <a href="https://forge.laravel.com/api-documentation" target="_blank">official REST API</a>.</p>
        <p>Be sure to <a href="demo.php">check out the demo</a> to see the SDK and API in action!</p>

        <h1 id="quickstart">Quickstart</h1>
        <blockquote>
            <p>composer.json</p>
        </blockquote>
        <pre><code> {
   "require": {
      "guzzlehttp/guzzle": "~6.0"
   }
}</code></pre>
        <blockquote>
            <p>SDK Namespaces Quick Reference:</p>
        </blockquote>
        <pre>use Laravel_Forge_API_SDK_PHP\Forge;
use Laravel_Forge_API_SDK_PHP\Actions\Servers;
use Laravel_Forge_API_SDK_PHP\Actions\Sites;
use Laravel_Forge_API_SDK_PHP\Actions\SSLCertificates;
use Laravel_Forge_API_SDK_PHP\Actions\ACTION_CLASS_NAME;</pre>
        <ol>
          <li>Guzzle must be set as a dependency in your project's <code>composer.json</code></li>
          <li>After installing your dependencies, you need to require Composer's autoloader: <code>require __DIR__ . 'vendor/autoload.php';</code></li>
          <li>Make sure you are using the required PHP namespaces in your code. Namespaces should be the same as the SDK Actions class names.</li>
          <li>Be sure to set your Forge API token in your code (<a href="#authentication">see below</a>).</li>
          <li>Refer to the SDK's <a href="https://github.com/denislam/laravel-forge-api-php-sdk" target="_blank">GitHub repository</a> and <a href="https://github.com/denislam/laravel-forge-api-php-sdk/readme.md" target="_blank">README.md</a> for detailed, step-by-step installation instructions.</li>
        </ol>

        <h1 id="authentication">Authentication</h1>
        <p>In order to use the API, you should authenticate your request by including your
            API key as a bearer token value:</p>
        <p><code>Forge::setToken(API_KEY_HERE);</code></p>

        <h1 id="clients">HTTP Clients</h1>
        <p>By default, this SDK uses the <a href="http://guzzlephp.org" target="_blank">Guzzle</a>
        client to handle all API requests. However, <a href="https://curl.haxx.se">cURL</a>
        is also fully supported.</p>
        <p>If you want to switch to using the cURL client for your code...</p>
        <ol>
          <li>Open <code>Forge.php</code></li>
          <li>Change the value of <code>const PHP_HTTP_CLIENT</code> to <code>Curl</code>
          (capitalization does not matter).
          <li>Save the file and you are done!</li>
        </ol>
        <p>The SDK will automatically use the HTTP client handler located in the
        <code>../HttpHandlers/</code> folder for your API calls. You are welcome
        to code your own custom client if you wish using this dynamic switching
        feature.</p>

        <h1 id="errors">Errors</h1>
        <p>Forge uses conventional HTTP response codes to indicate the success
        or failure of an API request. The table below contains a summary of the
        typical response codes:</p>

        <table>
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>200</td>
                    <td>Everything is ok.</td>
                </tr>
                <tr>
                    <td>400</td>
                    <td>Valid data was given but the request has failed.</td>
                </tr>
                <tr>
                    <td>401</td>
                    <td>No valid API Key was given.</td>
                </tr>
                <tr>
                    <td>404</td>
                    <td>The request resource could not be found.</td>
                </tr>
                <tr>
                    <td>422</td>
                    <td>The payload has missing required parameters or invalid data was given.</td>
                </tr>
                <tr>
                    <td>429</td>
                    <td>Too many attempts.</td>
                </tr>
                <tr>
                    <td>500</td>
                    <td>Request failed due to an internal error in Forge.</td>
                </tr>
                <tr>
                    <td>503</td>
                    <td>Forge is offline for maintenance.</td>
                </tr>
            </tbody>
        </table>

        <h2 id="custom-error-handling">Custom Error Handling</h2>

        <blockquote>
            <p>../Exceptions/Errors.php</p>
        </blockquote>
        <pre>private static function errors($id)
{
  $data = [
    // HTTP response code errors
    '302' => ['context'  => '302 Error Message' ],
    '400' => ['context'  => '400 Error Message' ],
    '401' => ['context'  => '401 Error Message'],
    '404' => ['context'  => '404 Error Message'],

    // Custom errors
    'CUSTOM_TRIGGER' => ['context' => 'Your custom message'],
    //..
  ]
  return $data[$id];
}</pre>
        <p>The SDK's custom error messages may be modified inside <code>../Exceptions/Errors.php</code></p>
        <p>Here's how you can call a custom error message:</p>
        <p><code>if(...) { return Errors::get('CUSTOM_TRIGGER'); }</code></p>

        <h1 id="servers">Servers</h1>

        <h2 id="create-server">Create Server</h2>

        <blockquote>
            <p>PHP Payload</p>
        </blockquote>
        <pre>$payload = array(
    "provider" => "ocean2",
    "credential_id" => 1,
    "name" => "test-via-api",
    "size" => "512MB",
    "database" => "test123",
    "php_version" => "php71",
    "region" => "ams2"
);</pre>
        <blockquote>
            <p>Payload</p>
        </blockquote>
        <pre><code>{
    "provider": "ocean2",
    "credential_id": 1,
    "name": "test-via-api",
    "size": "512MB",
    "database": "test123",
    "php_version": "php71",
    "region": "ams2"
}</code></pre>
        <blockquote>
            <p>Response</p>
        </blockquote>
        <pre><code>{
    "server": {
        "id": 16,
        "credential_id": 1,
        "name": "test-via-api",
        "size": "512MB",
        "region": "Amsterdam 2",
        "php_version": "php71",
        "ip_address": null,
        "private_ip_address": null,
        "blackfire_status": null,
        "papertrail_status": null,
        "revoked": false,
        "created_at": "2016-12-15 15:04:05",
        "is_ready": false,
        "network": []
    },
    "sudo_password": "baracoda",
    "database_password": "spotted_eagle_ray"
}</code></pre>

        <h3>Usage</h3>
        <p><code>&lt;?php $response = <em>Servers</em>::create($payload); ?&gt;</code></p>

        <h3>Parameters</h3>
        <p><code>$payload</code>
        <br /><span style="margin-left: 1em;"><em>(array) (required)</em> The JSON parameters.</span>
        <br /><span style="margin-left: 1em;">Default: <em>None</em></span></p>

        <table id="server_parameters">
            <thead>
                <tr>
                    <th>Key</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>provider</td>
                    <td>The server provider. Valid values are <code>ocean2</code> for Digital
                        Ocean, <code>linode</code>, <code>aws</code>, and <code>custom</code>.</td>
                </tr>
                <tr>
                    <td>credential_id</td>
                    <td>This is only required when the provider is not <code>custom</code>.</td>
                </tr>
                <tr>
                    <td>region</td>
                    <td>The name of the region where the server will be created. This value
                        is not required you are building a Custom VPS server. <a href="/api-documentation#regions">Valid region identifiers</a>.</td>
                </tr>
                <tr>
                    <td>ip_address</td>
                    <td>The IP Address of the server. Only required when the provider is
                        <code>custom</code>.</td>
                </tr>
                <tr>
                    <td>private_ip_address</td>
                    <td>The Private IP Address of the server. Only required when the provider
                        is <code>custom</code>.</td>
                </tr>
                <tr>
                    <td>php_version</td>
                    <td>Valid values are <code>php71</code>, <code>php70</code>, and <code>php56</code>.</td>
                </tr>
                <tr>
                    <td>database</td>
                    <td>The name of the database Forge should create when building the server.
                        If omitted, <code>forge</code> will be used.</td>
                </tr>
                <tr>
                    <td>maria</td>
                    <td>Indicates if MariaDB should be installed. Otherwise, MySQL will be
                        installed.
                    </td>
                </tr>
                <tr>
                    <td>load_balancer</td>
                    <td>Determines if the server should be provisioned as a load balancer.</td>
                </tr>
                <tr>
                    <td>network</td>
                    <td>An array of server IDs that the server should be able to connect
                        to.
                    </td>
                </tr>
            </tbody>
        </table>

        <h3>Server Status</h3>
        <p><strong>Usage</strong></p>
        <p><code>&lt;?php $status = <em>Servers</em>::is_ready($server_id) ?&gt;</code></p>

        <p><strong>Parameters</strong></p>
        <p><code>$server_id</code>
          <br /><span style="margin-left: 1em;"><em>(integer) (required)</em>
          The server ID number.</span>
          <br /><span style="margin-left: 1em;">Default: <em>None</em></span></p>

        <p><strong>Return Values</strong></p>
        <p><code>boolean</code></p>

        <p><strong>Notes</strong></p>
        <p>Servers take about 10 minutes to provision. Once the server is ready
           to be used, the <code>is_ready</code> parameter on the server will be
           <code>true</code>. <strong>You should not repeatedly ping the Forge
           API asking if the server is ready. Instead, consider pinging the
           endpoint once every 2 minutes.</strong></p>
        <h3>Valid Sizes</h3>
        <p>Forge accepts a human readable size and then validates it according
           to the acceptable values for each provider, a sample of valid sizes
           can be: <code>512MB</code>, <code>1GB</code>, <code>15GB</code>, ...</p>
        <p>Digital Ocean offers "high memory" servers. Forge supports creating
           these kinds of servers by passing any of the following values in the
           <code>size</code> parameter: <code>m-16GB</code>, <code>m-32GB</code>,
           and <code>m-64GB</code>.</p>
        <h3>Custom VPS</h3>
        <p>While creating a custom VPS, the response of this endpoint will
          contain a <code>provision_command</code> attribute:</p>
        <pre><code>{
    "provision_command": "wget -O forge.sh https://..."
}</code></pre>

        <h2 id="list-servers">List Servers</h2>

        <blockquote>
            <p>Response</p>
        </blockquote>
        <pre><code>{
    "servers": [
       {
            "id": 1,
            "credential_id": 1,
            "name": "test-via-api",
            "size": "512MB",
            "region": "Amsterdam 2",
            "php_version": "php71",
            "ip_address": "37.139.3.148",
            "private_ip_address": "10.129.3.252",
            "blackfire_status": null,
            "papertrail_status": null,
            "revoked": false,
            "created_at": "2016-12-15 18:38:18",
            "is_ready": true,
            "network": []
        }
    ]
}</code></pre>

        <h3>Usage</h3>
        <p><code>&lt;?php $servers = <em>Servers</em>::list(); ?&gt;</code></p>

        <h2 id="get-server">Get Server</h2>

        <blockquote>
            <p>PHP Payload</p>
        </blockquote>
        <pre>$payload = array(
    "provider" => "ocean2",
    "credential_id" => 1,
    "name" => "test-via-api",
    "size" => "512MB",
    "database" => "test123",
    "php_version" => "php71",
    "region" => "ams2"
);</pre>
        <blockquote>
            <p>Response</p>
        </blockquote>
        <pre><code>{
    "server": {
        "id": 1,
        "credential_id": 1,
        "name": "test-via-api",
        "size": "512MB",
        "region": "Amsterdam 2",
        "php_version": "php71",
        "ip_address": "37.139.3.148",
        "private_ip_address": "10.129.3.252",
        "blackfire_status": null,
        "papertrail_status": null,
        "revoked": false,
        "created_at": "2016-12-15 18:38:18",
        "is_ready": true,
        "network": []
    }
}</code></pre>

        <h3>Usage</h3>
        <p><code>&lt;?php $response = <em>Servers</em>::get($server_id);
          ?&gt;</code></p>

        <h3>Parameters</h3>
        <p><code>$server_id</code>
          <br /><span style="margin-left: 1em;"><em>(integer) (required)</em>
            The server ID number.</span>
          <br /><span style="margin-left: 1em;">Default: <em>None</em></span></p>

        <h2 id="update-server">Update Server</h2>

        <blockquote>
            <p>PHP Payload</p>
        </blockquote>
        <pre>$payload = array(
    "name" => "renamed-server",
    "size" => "512MB",
    "ip_address" => "192.241.143.108",
    "private_ip_address" => "10.136.8.40",
    "max_upload_size" => 123,
    "network" => array(2, 3)
);</code></pre>
        <blockquote>
            <p>Payload</p>
        </blockquote>
        <pre><code>{
    "name": "renamed-server",
    "size": "512MB",
    "ip_address": "192.241.143.108",
    "private_ip_address": "10.136.8.40",
    "max_upload_size": 123,
    "network": [
        2,
        3
    ]
}</code></pre>
        <blockquote>
            <p>Response</p>
        </blockquote>
        <pre><code>{
    "server": {
        "id": 16,
        "credential_id": 1,
        "name": "test-via-api",
        "size": "512MB",
        "region": "Amsterdam 2",
        "php_version": "php71",
        "ip_address": null,
        "private_ip_address": null,
        "blackfire_status": null,
        "papertrail_status": null,
        "revoked": false,
        "created_at": "2016-12-15 15:04:05",
        "is_ready": false,
        "network": [
            2,
            3
        ]
    }
}</code></pre>

        <h3>Usage</h3>
        <p><code>&lt;?php $server = <em>Servers</em>::update($server_id, $payload);
          ?&gt;</code></p>

        <h3>Parameters</h3>
        <p><code>$server_id</code>
          <br /><span style="margin-left: 1em;"><em>(integer) (required)</em>
            The server ID number.</span>
          <br /><span style="margin-left: 1em;">Default: <em>None</em></span></p>
        <p><code>$payload</code>
          <br /><span style="margin-left: 1em;"><em>(array) (required)</em> The
            JSON parameters.</span>
          <br /><span style="margin-left: 1em;">Default: <em>None</em></span></p>
        <p><a href="#server_parameters">See above</a> for server
          <code>$payload</code> array parameter options.</p>

        <h2 id="update-database-password">Update Database Password</h2>

        <blockquote>
            <p>PHP Payload</p>
        </blockquote>
        <pre>$payload = array(
    "password" => "maeve"
);</pre>
        <blockquote>
            <p>Payload</p>
        </blockquote>
        <pre><code>{
    "password": "maeve"
}</code></pre>
        <h3>Usage</h3>
        <p><code><em>Servers</em>::update_database_password($payload);</code></p>

        <h3>Notes</h3>
        <p>This endpoint will update Forge's copy of the primary database password which
            should be used to authenticate the creation of new databases and database
            users. This is typically only needed if you are working with a Forge server
            that was built before database administration was added to Forge.</p>

        <h3>Parameters</h3>
        <p><code>$payload</code>
          <br /><span style="margin-left: 1em;"><em>(array) (required)</em> The
            JSON parameters.</span>
          <br /><span style="margin-left: 1em;">Default: <em>None</em></span></p>

        <h2 id="delete-server">Delete Server</h2>

        <h3>Usage</h3>
        <p><code>&lt;?php <em>Servers</em>::delete($server_id);
          ?&gt;</code></p>

        <h3>Parameters</h3>
        <p><code>$server_id</code>
          <br /><span style="margin-left: 1em;"><em>(integer) (required)</em> The server ID number.</span>
          <br /><span style="margin-left: 1em;">Default: <em>None</em></span></p>

        <h2 id="reboot-server">Reboot Server</h2>

        <h3>Usage</h3>
        <p><code>&lt;?php <em>Servers</em>::reboot($server_id);
          ?&gt;</code></p>

        <h3>Parameters</h3>
        <p><code>$server_id</code>
          <br /><span style="margin-left: 1em;"><em>(integer) (required)</em> The server ID number.</span>
          <br /><span style="margin-left: 1em;">Default: <em>None</em></span></p>

        <h2 id="revoke-forge-access-to-server">Revoke Forge access to server</h2>

        <h3>Usage</h3>
        <p><code>&lt;?php <em>Servers</em>::revoke($server_id);
          ?&gt;</code></p>

        <h3>Parameters</h3>
        <p><code>$server_id</code>
          <br /><span style="margin-left: 1em;"><em>(integer) (required)</em> The server ID number.</span>
          <br /><span style="margin-left: 1em;">Default: <em>None</em></span></p>

        <h2 id="reconnect-revoked-server">Reconnect revoked server</h2>

        <blockquote>
            <p>Response</p>
        </blockquote>
        <pre><code>{
    "public_key": "CONTENT_OF_THE_PUBLIC_KEY"
}</code></pre>

        <h3>Usage</h3>
        <p><code>&lt;?php <em>Servers</em>::reconnect($server_id);
          ?&gt;</code></p>

        <h3>Parameters</h3>
        <p><code>$server_id</code>
          <br /><span style="margin-left: 1em;"><em>(integer) (required)</em> The server ID number.</span>
          <br /><span style="margin-left: 1em;">Default: <em>None</em></span></p>

        <h3>Notes</h3>
        <p>This endpoint will return an SSH key which you will need to add to the server.
            Once the key has been added to the server, you may "reactivate" it.</p>

        <h2 id="reactivate-revoked-server">Reactivate revoked server</h2>

        <h3>Usage</h3>
        <p><code>&lt;?php <em>Servers</em>::reactivate($server_id);
          ?&gt;</code></p>

        <h3>Parameters</h3>
        <p><code>$server_id</code>
          <br /><span style="margin-left: 1em;"><em>(integer) (required)</em> The server ID number.</span>
          <br /><span style="margin-left: 1em;">Default: <em>None</em></span></p>

        <h1 id="services">Services</h1>

        <h2 id="reboot-mysql">Reboot MySQL</h2>

        <h3>Usage</h3>
        <p><code>&lt;?php $response = <em>Services</em>::reboot_mysql($server_id);
          ?&gt;</code></p>

        <h3>Parameters</h3>
        <p><code>$server_id</code>
          <br /><span style="margin-left: 1em;"><em>(integer) (required)</em>
            The server ID number.</span>
          <br /><span style="margin-left: 1em;">Default: <em>None</em></span></p>

        <h2 id="stop-mysql">Stop MySQL</h2>

        <h3>Usage</h3>
        <p><code>&lt;?php $response = <em>Services</em>::stop_mysql($server_id);
          ?&gt;</code></p>

        <h3>Parameters</h3>
        <p><code>$server_id</code>
          <br /><span style="margin-left: 1em;"><em>(integer) (required)</em>
            The server ID number.</span>
          <br /><span style="margin-left: 1em;">Default: <em>None</em></span></p>

        <h2 id="reboot-nginx">Reboot Nginx</h2>

        <h3>Usage</h3>
        <p><code>&lt;?php $response = <em>Services</em>::reboot_nginx($server_id);
          ?&gt;</code></p>

        <h3>Parameters</h3>
        <p><code>$server_id</code>
          <br /><span style="margin-left: 1em;"><em>(integer) (required)</em>
            The server ID number.</span>
          <br /><span style="margin-left: 1em;">Default: <em>None</em></span></p>

        <h2 id="stop-nginx">Stop Nginx</h2>
        <h3>Usage</h3>
        <p><code>&lt;?php $response = <em>Services</em>::stop_nginx($server_id);
          ?&gt;</code></p>

        <h3>Parameters</h3>
        <p><code>$server_id</code>
          <br /><span style="margin-left: 1em;"><em>(integer) (required)</em>
            The server ID number.</span>
          <br /><span style="margin-left: 1em;">Default: <em>None</em></span></p>

        <h2 id="reboot-postgres">Reboot Postgres</h2>
        <h3>Usage</h3>
        <p><code>&lt;?php $response = <em>Services</em>::reboot_postgres($server_id);
          ?&gt;</code></p>

        <h3>Parameters</h3>
        <p><code>$server_id</code>
          <br /><span style="margin-left: 1em;"><em>(integer) (required)</em>
            The server ID number.</span>
          <br /><span style="margin-left: 1em;">Default: <em>None</em></span></p>

        <h2 id="stop-postgres">Stop Postgres</h2>
        <h3>Usage</h3>
        <p><code>&lt;?php $response = <em>Services</em>::stop_postgrest($server_id);
          ?&gt;</code></p>

        <h3>Parameters</h3>
        <p><code>$server_id</code>
          <br /><span style="margin-left: 1em;"><em>(integer) (required)</em>
            The server ID number.</span>
          <br /><span style="margin-left: 1em;">Default: <em>None</em></span></p>

        <h2 id="install-blackfire">Install Blackfire</h2>

        <blockquote>
            <p>PHP Payload</p>
        </blockquote>
        <pre>$payload = array(
    "server_id" => "..."
    "server_token" => "..."
);</pre>
        <blockquote>
            <p>Payload</p>
        </blockquote>
        <pre><code>{
    "server_id": "...",
    "server_token": "..."
}</code></pre>
        <h3>Usage</h3>
        <p><code>&lt;?php <em>Services</em>::install_blackfire($payload);
          ?&gt;</code></p>
        <h3>Parameters</h3>
        <p><code>$payload</code>
        <br /><span style="margin-left: 1em;"><em>(array) (required)</em> The
          JSON parameters.</span>
        <br /><span style="margin-left: 1em;">Default: <em>None</em></span></p>

        <h2 id="install-papertrail">Install Papertrail</h2>
        <blockquote>
            <p>PHP Payload</p>
        </blockquote>
        <pre>$payload = array(
    "host" => "192.241.143.108
);</pre>
        <blockquote>
            <p>Payload</p>
        </blockquote>
        <pre><code>{
    "host": "192.241.143.108"
}</code></pre>
        <h3>Usage</h3>
        <p><code>&lt;?php <em>Services</em>::remove_papertrail($payload);
        ?&gt;</code></p>
        <h3>Parameters</h3>
        <p><code>$payload</code>
        <br /><span style="margin-left: 1em;"><em>(array) (required)</em> The
          JSON parameters.</span>
        <br /><span style="margin-left: 1em;">Default: <em>None</em></span></p>

        <h2 id="remove-papertrail">Remove Papertrail</h2>
        <blockquote>
            <p>PHP Payload</p>
        </blockquote>
        <pre>$payload = array(
    "host" => "192.241.143.108
);</pre>
        <blockquote>
            <p>Payload</p>
        </blockquote>
        <pre><code>{
    "host": "192.241.143.108"
}</code></pre>
        <h3>Usage</h3>
        <p><code>&lt;?php <em>Services</em>::delete_papertrail($payload);
        ?&gt;</code></p>
        <h3>Parameters</h3>
        <p><code>$payload</code>
        <br /><span style="margin-left: 1em;"><em>(array) (required)</em> The
          JSON parameters.</span>
        <br /><span style="margin-left: 1em;">Default: <em>None</em></span></p>

        <h1 id="daemons">Daemons</h1>

        <h2 id="create-daemon">Create Daemon</h2>
        <blockquote>
            <p>PHP Payload</p>
        </blockquote>
        <pre>$payload = array(
    "command" => "COMMAND",
    "user" => "root"
);</pre>
        <blockquote>
            <p>Payload</p>
        </blockquote>
        <pre><code>{
    "command": "COMMAND",
    "user": "root"
}</code></pre>
        <blockquote>
            <p>Response</p>
        </blockquote>
        <pre><code>{
    "daemon": {
        "id": 1,
        "command": "COMMAND",
        "user": "root",
        "status": "installing",
        "created_at": "2016-12-16 15:46:22"
    }
}</code></pre>
        <h3>Usage</h3>
        <p><code>&lt;?php <em>Daemons</em>::create($server_id, $payload);
        ?&gt;</code></p>
        <h3>Parameters</h3>
        <p><code>$server_id</code>
        <br /><span style="margin-left: 1em;"><em>(integer) (required)</em> The
          server ID number.</span>
        <br /><span style="margin-left: 1em;">Default: <em>None</em></span></p>
        <p><code>$payload</code>
        <br /><span style="margin-left: 1em;"><em>(array) (required)</em> The
          JSON parameters.</span>
        <br /><span style="margin-left: 1em;">Default: <em>None</em></span></p>

        <h2 id="list-daemons">List Daemons</h2>
        <blockquote>
            <p>Response</p>
        </blockquote>
        <pre><code>{
    "daemons": [
       {
            "id": 1,
            "command": "COMMAND",
            "user": "root",
            "status": "installing",
            "created_at": "2016-12-16 15:46:22"
        }
    ]
}</code></pre>
        <h3>Usage</h3>
        <p><code>&lt;?php <em>Daemons</em>::list($server_id);
        ?&gt;</code></p>
        <h3>Parameters</h3>
        <p><code>$server_id</code>
        <br /><span style="margin-left: 1em;"><em>(integer) (required)</em> The
          server ID number.</span>
        <br /><span style="margin-left: 1em;">Default: <em>None</em></span></p>

        <h2 id="get-daemon">Get Daemon</h2>
        <blockquote>
            <p>Response</p>
        </blockquote>
        <pre><code>{
    "daemon": {
        "id": 1,
        "command": "COMMAND",
        "user": "root",
        "status": "installing",
        "created_at": "2016-12-16 15:46:22"
    }
}</code></pre>
        <h3>Usage</h3>
        <p><code>&lt;?php <em>Daemons</em>::get($server_id, $daemon_id);
        ?&gt;</code></p>
        <h3>Parameters</h3>
        <p><code>$server_id</code>
        <br /><span style="margin-left: 1em;"><em>(integer) (required)</em> The
          server ID number.</span>
        <br /><span style="margin-left: 1em;">Default: <em>None</em></span></p>
        <p><code>$daemon_id</code>
        <br /><span style="margin-left: 1em;"><em>(integer) (required)</em> The
          daemon ID number.</span>
        <br /><span style="margin-left: 1em;">Default: <em>None</em></span></p>

        <h2 id="delete-daemon">Delete Daemon</h2>
        <h3>Usage</h3>
        <p><code>&lt;?php <em>Daemons</em>::delete($server_id, $daemon_id);
        ?&gt;</code></p>
        <h3>Parameters</h3>
        <p><code>$server_id</code>
        <br /><span style="margin-left: 1em;"><em>(integer) (required)</em> The
          server ID number.</span>
        <br /><span style="margin-left: 1em;">Default: <em>None</em></span></p>
        <p><code>$daemon_id</code>
        <br /><span style="margin-left: 1em;"><em>(integer) (required)</em> The
          daemon ID number.</span>
        <br /><span style="margin-left: 1em;">Default: <em>None</em></span></p>

        <h2 id="restart-daemon">Restart Daemon</h2>
        <h3>Usage</h3>
        <p><code>&lt;?php <em>Daemons</em>::restart($server_id, $daemon_id);
        ?&gt;</code></p>
        <h3>Parameters</h3>
        <p><code>$server_id</code>
        <br /><span style="margin-left: 1em;"><em>(integer) (required)</em> The
          server ID number.</span>
        <br /><span style="margin-left: 1em;">Default: <em>None</em></span></p>
        <p><code>$daemon_id</code>
        <br /><span style="margin-left: 1em;"><em>(integer) (required)</em> The
          daemon ID number.</span>
        <br /><span style="margin-left: 1em;">Default: <em>None</em></span></p>

        <h1 id="firewall-rules">Firewall Rules</h1>

        <h2 id="create-rule">Create Rule</h2>
        <blockquote>
            <p>PHP Payload</p>
        </blockquote>
        <pre>$payload = array(
    "name" => "rule name",
    "port" => 88
);</pre>
        <blockquote>
            <p>Payload</p>
        </blockquote>
        <pre><code>{
    "name": "rule name",
    "port": 88
}</code></pre>
        <blockquote>
            <p>Response</p>
        </blockquote>
        <pre><code>{
    "rule": {
        "id": 4,
        "name": "rule",
        "port": 123,
        "ip_address": null,
        "status": "installing",
        "created_at": "2016-12-16 15:50:17"
    }
}</code></pre>
        <h3>Usage</h3>
        <p><code>&lt;?php <em>FirewallRules</em>::create($server_id, $payload);
        ?&gt;</code></p>
        <h3>Parameters</h3>
        <p><code>$server_id</code>
        <br /><span style="margin-left: 1em;"><em>(integer) (required)</em> The
          server ID number.</span>
        <br /><span style="margin-left: 1em;">Default: <em>None</em></span></p>
        <p><code>$payload</code>
        <br /><span style="margin-left: 1em;"><em>(array) (required)</em> The
          JSON parameters.</span>
        <br /><span style="margin-left: 1em;">Default: <em>None</em></span></p>

        <h2 id="list-rules">List Rules</h2>
        <blockquote>
            <p>Response</p>
        </blockquote>
        <pre><code>{
    "rules": [
       {
            "id": 4,
            "name": "rule",
            "port": 123,
            "ip_address": null,
            "status": "installing",
            "created_at": "2016-12-16 15:50:17"
        }
    ]
}</code></pre>
        <h3>Usage</h3>
        <p><code>&lt;?php <em>FirewallRules</em>::list($server_id);
        ?&gt;</code></p>
        <h3>Parameters</h3>
        <p><code>$server_id</code>
        <br /><span style="margin-left: 1em;"><em>(integer) (required)</em> The
          server ID number.</span>
        <br /><span style="margin-left: 1em;">Default: <em>None</em></span></p>

        <h2 id="get-rule">Get Rule</h2>
        <blockquote>
            <p>Response</p>
        </blockquote>
        <pre><code>{
    "rule": {
        "id": 4,
        "name": "rule",
        "port": 123,
        "ip_address": null,
        "status": "installing",
        "created_at": "2016-12-16 15:50:17"
    }
}</code></pre>
        <h3>Usage</h3>
        <p><code>&lt;?php <em>FirewallRules</em>::get($server_id, $rule_id);
        ?&gt;</code></p>
        <h3>Parameters</h3>
        <p><code>$server_id</code>
        <br /><span style="margin-left: 1em;"><em>(integer) (required)</em> The
          server ID number.</span>
        <br /><span style="margin-left: 1em;">Default: <em>None</em></span></p>
        <p><code>$rule_id</code>
        <br /><span style="margin-left: 1em;"><em>(integer) (required)</em> The
          firewall rule ID number.</span>
        <br /><span style="margin-left: 1em;">Default: <em>None</em></span></p>

        <h2 id="delete-rule">Delete Rule</h2>
        <h3>Usage</h3>
        <p><code>&lt;?php <em>FirewallRules</em>::delete($server_id, $rule_id);
        ?&gt;</code></p>
        <h3>Parameters</h3>
        <p><code>$server_id</code>
        <br /><span style="margin-left: 1em;"><em>(integer) (required)</em> The
          server ID number.</span>
        <br /><span style="margin-left: 1em;">Default: <em>None</em></span></p>
        <p><code>$rule_id</code>
        <br /><span style="margin-left: 1em;"><em>(integer) (required)</em> The
          firewall rule ID number.</span>
        <br /><span style="margin-left: 1em;">Default: <em>None</em></span></p>

        <h1 id="scheduled-jobs">Scheduled Jobs</h1>

        <h2 id="create-job">Create Job</h2>
        <blockquote>
            <p>PHP Payload</p>
        </blockquote>
        <pre>$payload = array(
    "command" => "COMMAND_THE_JOB_RUNS",
    "frequency" => "custom",
    "user" => "root",
    "minute" => "*",
    "hour" => "*",
    "day" => "*",
    "month" => "*",
    "weekday" => "*"
);</pre>
        <blockquote>
            <p>Payload</p>
        </blockquote>
        <pre><code>{
    "command": "COMMAND_THE_JOB_RUNS",
    "frequency": "custom",
    "user": "root",
    "minute": "*",
    "hour": "*",
    "day": "*",
    "month": "*",
    "weekday": "*"
}</code></pre>
        <blockquote>
            <p>Response</p>
        </blockquote>
        <pre><code>{
    "job": {
        "id": 2,
        "command": "COMMAND_THE_JOB_RUNS",
        "user": "root",
        "frequency": "Nightly",
        "cron": "0 0 * * *",
        "status": "installing",
        "created_at": "2016-12-16 15:56:59"
    }
}</code></pre>
        <h3>Usage</h3>
        <p><code>&lt;?php <em>ScheduledJobs</em>::create($server_id, $payload);
        ?&gt;</code></p>
        <h3>Parameters</h3>
        <p><code>$server_id</code>
        <br /><span style="margin-left: 1em;"><em>(integer) (required)</em> The
          server ID number.</span>
        <br /><span style="margin-left: 1em;">Default: <em>None</em></span></p>
        <p><code>$payload</code>
        <br /><span style="margin-left: 1em;"><em>(array) (required)</em> The
          JSON parameters.</span>
        <br /><span style="margin-left: 1em;">Default: <em>None</em></span></p>
        <h3>Parameters</h3>
        <table>
            <thead>
                <tr>
                    <th>Key</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>frequency</td>
                    <td>The frequency in which the job should run. Valid values are <code>minutely</code>,
                        <code>hourly</code>, <code>nightly</code>, <code>weekly</code>,
                        <code>monthly</code>, and <code>custom</code>
                    </td>
                </tr>
                <tr>
                    <td>minute</td>
                    <td>Required if the frequency is <code>custom</code>.</td>
                </tr>
                <tr>
                    <td>hour</td>
                    <td>Required if the frequency is <code>custom</code>.</td>
                </tr>
                <tr>
                    <td>day</td>
                    <td>Required if the frequency is <code>custom</code>.</td>
                </tr>
                <tr>
                    <td>month</td>
                    <td>Required if the frequency is <code>custom</code>.</td>
                </tr>
                <tr>
                    <td>weekday</td>
                    <td>Required if the frequency is <code>custom</code>.</td>
                </tr>
            </tbody>
        </table>

        <h2 id="list-jobs">List Jobs</h2>
        <blockquote>
            <p>Response</p>
        </blockquote>
        <pre><code>{
    "jobs": [
       {
            "id": 2,
            "command": "COMMAND_THE_JOB_RUNS",
            "user": "root",
            "frequency": "nightly",
            "cron": "0 0 * * *",
            "status": "installing",
            "created_at": "2016-12-16 15:56:59"
        }
    ]
}</code></pre>
        <h3>Usage</h3>
        <p><code>&lt;?php <em>ScheduledJobs</em>::list($server_id);
        ?&gt;</code></p>
        <h3>Parameters</h3>
        <p><code>$server_id</code>
        <br /><span style="margin-left: 1em;"><em>(integer) (required)</em> The
          server ID number.</span>
        <br /><span style="margin-left: 1em;">Default: <em>None</em></span></p>

        <h2 id="get-job">Get Job</h2>
        <blockquote>
            <p>Response</p>
        </blockquote>
        <pre><code>{
    "job": {
        "id": 2,
        "command": "COMMAND_THE_JOB_RUNS",
        "user": "root",
        "frequency": "Nightly",
        "cron": "0 0 * * *",
        "status": "installing",
        "created_at": "2016-12-16 15:56:59"
    }
}</code></pre>
        <h3>Usage</h3>
        <p><code>&lt;?php <em>ScheduledJobs</em>::get($server_id, $job_id);
        ?&gt;</code></p>
        <h3>Parameters</h3>
        <p><code>$server_id</code>
        <br /><span style="margin-left: 1em;"><em>(integer) (required)</em> The
          server ID number.</span>
        <br /><span style="margin-left: 1em;">Default: <em>None</em></span></p>
        <p><code>$job_id</code>
        <br /><span style="margin-left: 1em;"><em>(integer) (required)</em> The
          scheduled job ID number.</span>
        <br /><span style="margin-left: 1em;">Default: <em>None</em></span></p>

        <h2 id="delete-job">Delete Job</h2>
        <h3>HTTP Request</h3>
        <h3>Usage</h3>
        <p><code>&lt;?php <em>ScheduledJobs</em>::delete($server_id, $job_id);
        ?&gt;</code></p>
        <h3>Parameters</h3>
        <p><code>$server_id</code>
        <br /><span style="margin-left: 1em;"><em>(integer) (required)</em> The
          server ID number.</span>
        <br /><span style="margin-left: 1em;">Default: <em>None</em></span></p>
        <p><code>$job_id</code>
        <br /><span style="margin-left: 1em;"><em>(integer) (required)</em> The
          scheduled job ID number.</span>
        <br /><span style="margin-left: 1em;">Default: <em>None</em></span></p>

        <h1 id="mysql-databases">MySQL Databases</h1>

        <h2 id="create-database">Create Database</h2>
        <blockquote>
            <p>Payload</p>
        </blockquote>
        <pre><code>{
    "name": "forge",
    "user": "forge",
    "password": "dolores"
}</code></pre>
        <blockquote>
            <p>Response</p>
        </blockquote>
        <pre><code>{
    "database": {
        "id": 1,
        "name": "forge",
        "status": "installing",
        "created_at": "2016-12-16 16:12:22"
    }
}</code></pre>
        <h3>HTTP Request</h3>
        <p><code>POST /api/v1/servers/{serverId}/mysql</code>
        </p>
        <h3>Parameters</h3>
        <table>
            <thead>
                <tr>
                    <th>Key</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>user</td>
                    <td>This field is optional. If passed, it will be used to create a new
                        MySQL user with access to the newly created database.
                    </td>
                </tr>
                <tr>
                    <td>password</td>
                    <td>This field is only required when a <code>user</code> value is given.</td>
                </tr>
            </tbody>
        </table>

        <h2 id="list-databases">List Databases</h2>
        <blockquote>
            <p>Response</p>
        </blockquote>
        <pre><code>{
    "databases": [
       {
            "id": 1,
            "name": "forge",
            "status": "installing",
            "created_at": "2016-12-16 16:12:22"
        }
    ]
}</code></pre>
        <h3>HTTP Request</h3>
        <p><code>GET /api/v1/servers/{serverId}/mysql</code>
        </p>

        <h2 id="get-database">Get Database</h2>
        <blockquote>
            <p>Response</p>
        </blockquote>
        <pre><code>{
    "database": {
        "id": 1,
        "name": "forge",
        "status": "installing",
        "created_at": "2016-12-16 16:12:22"
    }
}</code></pre>
        <h3>HTTP Request</h3>
        <p><code>GET /api/v1/servers/{serverId}/mysql/{databaseId}</code>
        </p>

        <h2 id="delete-database">Delete Database</h2>
        <h3>HTTP Request</h3>
        <p><code>DELETE /api/v1/servers/{serverId}/mysql/{databaseId}</code>
        </p>

        <h1 id="mysql-database-users">MySQL Database Users</h1>

        <h2 id="create-user">Create User</h2>
        <blockquote>
            <p>Payload</p>
        </blockquote>
        <pre><code>{
    "name": "forge",
    "password": "dolores",
    "databases": [
        1
    ]
}</code></pre>
        <blockquote>
            <p>Response</p>
        </blockquote>
        <pre><code>{
    "user": {
        "id": 2,
        "name": "forge",
        "status": "installing",
        "created_at": "2016-12-16 16:19:01",
        "databases": [
            1
        ]
    }
}</code></pre>
        <h3>HTTP Request</h3>
        <p><code>POST /api/v1/servers/{serverId}/mysql-users</code>
        </p>
        <h3>Parameters</h3>
        <table>
            <thead>
                <tr>
                    <th>Key</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>databases</td>
                    <td>An array of database IDs referencing the databases the user has access
                        to.
                    </td>
                </tr>
            </tbody>
        </table>

        <h2 id="list-users">List Users</h2>
        <blockquote>
            <p>Response</p>
        </blockquote>
        <pre><code>{
    "users": [
       {
            "id": 2,
            "name": "forge",
            "status": "installing",
            "created_at": "2016-12-16 16:19:01",
            "databases": [
                1
            ]
        }
    ]
}</code></pre>
        <h3>HTTP Request</h3>
        <p><code>GET /api/v1/servers/{serverId}/mysql-users</code>
        </p>

        <h2 id="get-user">Get User</h2>
        <blockquote>
            <p>Response</p>
        </blockquote>
        <pre><code>{
    "user": {
        "id": 2,
        "name": "forge",
        "status": "installing",
        "created_at": "2016-12-16 16:19:01",
        "databases": [
            1
        ]
    }
}</code></pre>
        <h3>HTTP Request</h3>
        <p><code>GET /api/v1/servers/{serverId}/mysql-users/{userId}</code>
        </p>

        <h2 id="update-user">Update User</h2>
        <blockquote>
            <p>Payload</p>
        </blockquote>
        <pre><code>{
    "databases": [
        2
    ]
}</code></pre>
        <blockquote>
            <p>Response</p>
        </blockquote>
        <pre><code>{
    "user": {
        "id": 2,
        "name": "forge",
        "status": "installing",
        "created_at": "2016-12-16 16:19:01",
        "databases": [
            1
        ]
    }
}</code></pre>
        <h3>HTTP Request</h3>
        <p><code>PUT /api/v1/servers/{serverId}/mysql-users/{userId}</code>
        </p>
        <p>This endpoint may be used to update the databases the MySQL user has access to.</p>

        <h2 id="delete-user">Delete User</h2>
        <h3>HTTP Request</h3>
        <p><code>DELETE /api/v1/servers/{serverId}/mysql-users/{userId}</code>
        </p>

        <h1 id="sites">Sites</h1>

        <h2 id="create-site">Create Site</h2>
        <blockquote>
            <p>Payload</p>
        </blockquote>
        <pre><code>{
    "domain": "site.com",
    "project_type": "php",
    "directory": "/test"
}</code></pre>
        <blockquote>
            <p>Response</p>
        </blockquote>
        <pre><code>{
    "site": {
        "id": 2,
        "name": "site.com",
        "directory": "/test",
        "wildcards": false,
        "status": "installing",
        "repository": null,
        "repository_provider": null,
        "repository_branch": null,
        "repository_status": null,
        "quick_deploy": false,
        "project_type": "php",
        "app": null,
        "app_status": null,
        "hipchat_room": null,
        "slack_channel": null,
        "created_at": "2016-12-16 16:38:08"
    }
}</code></pre>
        <h3>HTTP Request</h3>
        <p><code>POST /api/v1/servers/{serverId}/sites</code>
        </p>
        <h3>Available site types</h3>
        <table>
            <thead>
                <tr>
                    <th>Key</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>php</td>
                    <td>General PHP/Laravel Application.</td>
                </tr>
                <tr>
                    <td>html</td>
                    <td>Static HTML site.</td>
                </tr>
                <tr>
                    <td>Symfony</td>
                    <td>Symfony Application.</td>
                </tr>
                <tr>
                    <td>symfony_dev</td>
                    <td>Symfony (Dev) Application.</td>
                </tr>
            </tbody>
        </table>

        <h2 id="list-sites">List Sites</h2>
        <blockquote>
            <p>Response</p>
        </blockquote>
        <pre><code>{
    "sites": [
       {
            "id": 2,
            "name": "site.com",
            "directory": "/test",
            "wildcards": false,
            "status": "installing",
            "repository": null,
            "repository_provider": null,
            "repository_branch": null,
            "repository_status": null,
            "quick_deploy": false,
            "project_type": "php",
            "app": null,
            "app_status": null,
            "hipchat_room": null,
            "slack_channel": null,
            "created_at": "2016-12-16 16:38:08"
        }
    ]
}</code></pre>
        <h3>HTTP Request</h3>
        <p><code>GET /api/v1/servers/{serverId}/sites</code>
        </p>

        <h2 id="get-site">Get Site</h2>
        <blockquote>
            <p>Response</p>
        </blockquote>
        <pre><code>{
    "site": {
        "id": 2,
        "name": "site.com",
        "directory": "/test",
        "wildcards": false,
        "status": "installing",
        "repository": null,
        "repository_provider": null,
        "repository_branch": null,
        "repository_status": null,
        "quick_deploy": false,
        "project_type": "php",
        "app": null,
        "app_status": null,
        "hipchat_room": null,
        "slack_channel": null,
        "created_at": "2016-12-16 16:38:08"
    }
}</code></pre>
        <h3>HTTP Request</h3>
        <p><code>GET /api/v1/servers/{serverId}/sites/{siteId}</code>
        </p>

        <h2 id="update-site">Update Site</h2>
        <blockquote>
            <p>Payload</p>
        </blockquote>
        <pre><code>{
    "directory": "/some/path"
}</code></pre>
        <blockquote>
            <p>Response</p>
        </blockquote>
        <pre><code>{
    "site": {
        "id": 2,
        "name": "site.com",
        "directory": "/some/path",
        "wildcards": false,
        "status": "installing",
        "repository": null,
        "repository_provider": null,
        "repository_branch": null,
        "repository_status": null,
        "quick_deploy": false,
        "project_type": "php",
        "app": null,
        "app_status": null,
        "hipchat_room": null,
        "slack_channel": null,
        "created_at": "2016-12-16 16:38:08"
    }
}</code></pre>
        <h3>HTTP Request</h3>
        <p><code>PUT /api/v1/servers/{serverId}/sites/{siteId}</code>
        </p>
        <p>This endpoint may be used to update the "web directory" for a given site.</p>

        <h2 id="delete-site">Delete Site</h2>
        <h3>HTTP Request</h3>
        <p><code>DELETE /api/v1/servers/{serverId}/sites/{siteId}</code>
        </p>

        <h2 id="load-balancing">Load Balancing</h2>
        <blockquote>
            <p>Payload</p>
        </blockquote>
        <pre><code>{
    "servers": [
        2,
        3
    ]
}</code></pre>
        <h3>HTTP Request</h3>
        <p><code>POST /api/v1/servers/{serverId}/sites/{siteId}/balancing</code>
        </p>
        <p>If the server is a load balancer, this endpoint may be used to specify the servers
            the load balancer should send traffic to.
        </p>

        <h1 id="ssl-certificates">SSL Certificates</h1>

        <h2 id="create-certificate">Create Certificate</h2>
        <blockquote>
            <p>Payload</p>
        </blockquote>
        <pre><code>{
    "type": "new",
    "domain": "domain.com",
    "country": "US",
    "state": "NY",
    "city": "New York",
    "organization": "Company Name",
    "department": "IT"
}</code></pre>
        <blockquote>
            <p>Response</p>
        </blockquote>
        <pre><code>{
    "certificate": {
        "domain": "domain.com",
        "request_status": "creating",
        "created_at": "2016-12-17 07:02:35",
        "id": 3,
        "existing": false,
        "active": false
    }
}</code></pre>
        <h3>HTTP Request</h3>
        <p><code>POST /api/v1/servers/{serverId}/sites/{siteId}/certificates</code>
        </p>

        <h2 id="installing-an-existing-certificate">Installing An Existing Certificate</h2>
        <blockquote>
            <p>Payload</p>
        </blockquote>
        <pre><code>{
    "type": "existing",
    "key": "PRIVATE_KEY_HERE",
    "certificate": "CERTIFICATE_HERE"
}</code></pre>
        <blockquote>
            <p>Response</p>
        </blockquote>
        <pre><code>{
    "certificate": {
        "domain": "domain.com",
        "request_status": "creating",
        "created_at": "2016-12-17 07:02:35",
        "id": 3,
        "existing": false,
        "active": false
    }
}</code></pre>
        <h3>HTTP Request</h3>
        <p><code>POST /api/v1/servers/{serverId}/sites/{siteId}/certificates</code>
        </p>

        <h2 id="cloning-an-existing-certificate">Cloning An Existing Certificate</h2>
        <blockquote>
            <p>Payload</p>
        </blockquote>
        <pre><code>{
    "type": "clone",
    "certificate_id": 1
}</code></pre>
        <blockquote>
            <p>Response</p>
        </blockquote>
        <pre><code>{
    "certificate": {
        "domain": "domain.com",
        "request_status": "creating",
        "created_at": "2016-12-17 07:02:35",
        "id": 3,
        "existing": false,
        "active": false
    }
}</code></pre>
        <h3>HTTP Request</h3>
        <p><code>POST /api/v1/servers/{serverId}/sites/{siteId}/certificates</code>
        </p>

        <h2 id="obtain-a-letsencrypt-certificate">Obtain A Let's Encrypt Certificate</h2>
        <blockquote>
            <p>Payload</p>
        </blockquote>
        <pre><code>{
    "domains": [
        "www.site.com"
    ]
}</code></pre>
        <blockquote>
            <p>Response</p>
        </blockquote>
        <pre><code>{
    "certificate": {
        "domain": "www.test.com",
        "type": "letsencrypt",
        "request_status": "created",
        "status": "installing",
        "created_at": "2017-02-09 17:14:34",
        "id": 1,
        "existing": true,
        "active": false
    }
}</code></pre>
        <h3>HTTP Request</h3>
        <p><code>POST /api/v1/servers/{serverId}/sites/{siteId}/letsencrypt</code>
        </p>

        <h2 id="list-certificates">List Certificates</h2>
        <blockquote>
            <p>Response</p>
        </blockquote>
        <pre><code>{
    "certificates": [
       {
            "domain": "domain.com",
            "request_status": "creating",
            "created_at": "2016-12-17 07:02:35",
            "id": 3,
            "existing": false,
            "active": false
        }
    ]
}</code></pre>
        <h3>HTTP Request</h3>
        <p><code>GET /api/v1/servers/{serverId}/sites/{siteId}/certificates</code>
        </p>

        <h2 id="get-certificate">Get Certificate</h2>
        <blockquote>
            <p>Response</p>
        </blockquote>
        <pre><code>{
    "certificate": {
        "domain": "domain.com",
        "request_status": "creating",
        "created_at": "2016-12-17 07:02:35",
        "id": 3,
        "existing": false,
        "active": false
    }
}</code></pre>
        <h3>HTTP Request</h3>
        <p><code>GET /api/v1/servers/{serverId}/sites/{siteId}/certificates/{id}</code>
        </p>

        <h2 id="get-signing-request">Get Signing Request</h2>
        <h3>HTTP Request</h3>
        <p><code>GET /api/v1/servers/{serverId}/sites/{siteId}/certificates/{id}/csr</code>
        </p>
        <p>This endpoint may be used to get the full certificate signing request content.</p>

        <h2 id="install-certificate">Install Certificate</h2>
        <blockquote>
            <p>Payload</p>
        </blockquote>
        <pre><code>{
    "certificate": "certificate content",
    "add_intermediates": false
}</code></pre>
        <h3>HTTP Request</h3>
        <p><code>POST /api/v1/servers/{serverId}/sites/{siteId}/certificates/{id}/install</code>
        </p>

        <h2 id="activate-certificate">Activate Certificate</h2>
        <h3>HTTP Request</h3>
        <p><code>POST /api/v1/servers/{serverId}/sites/{siteId}/certificates/{id}/activate</code>
        </p>

        <h2 id="delete-certificate">Delete Certificate</h2>
        <h3>HTTP Request</h3>
        <p><code>DELETE /api/v1/servers/{serverId}/sites/{siteId}/certificates/{id}</code>
        </p>

        <h1 id="ssh-keys">SSH Keys</h1>

        <h2 id="create-key">Create Key</h2>
        <blockquote>
            <p>Payload</p>
        </blockquote>
        <pre><code>{
    "name": "test-key",
    "key": "KEY_CONTENT_HERE"
}</code></pre>
        <blockquote>
            <p>Response</p>
        </blockquote>
        <pre><code>{
    "key": {
        "id": 9,
        "name": "test-key",
        "status": "installing",
        "created_at": "2016-12-16 16:31:16"
    }
}</code></pre>
        <h3>HTTP Request</h3>
        <p><code>POST /api/v1/servers/{serverId}/keys</code>
        </p>

        <h2 id="list-keys">List Keys</h2>
        <blockquote>
            <p>Response</p>
        </blockquote>
        <pre><code>{
    "keys": [
       {
            "id": 9,
            "name": "test-key",
            "status": "installing",
            "created_at": "2016-12-16 16:31:16"
        }
    ]
}</code></pre>
        <h3>HTTP Request</h3>
        <p><code>GET /api/v1/servers/{serverId}/keys</code>
        </p>

        <h2 id="get-key">Get Key</h2>
        <blockquote>
            <p>Response</p>
        </blockquote>
        <pre><code>{
    "key": {
        "id": 9,
        "name": "test-key",
        "status": "installing",
        "created_at": "2016-12-16 16:31:16"
    }
}</code></pre>
        <h3>HTTP Request</h3>
        <p><code>GET /api/v1/servers/{serverId}/keys/{keyId}</code>
        </p>

        <h2 id="delete-key">Delete Key</h2>
        <h3>HTTP Request</h3>
        <p><code>DELETE /api/v1/servers/{serverId}/keys/{keyId}</code>
        </p>

        <h1 id="workers">Workers</h1>

        <h2 id="create-worker">Create Worker</h2>
        <blockquote>
            <p>Payload</p>
        </blockquote>
        <pre><code>{
    "connection": "sqs",
    "timeout": 90,
    "sleep": 60,
    "tries": null,
    "daemon": true
}</code></pre>
        <blockquote>
            <p>Response</p>
        </blockquote>
        <pre><code>{
    "worker": {
        "id": 1,
        "connection": "rule",
        "command": "php /home/forge/default/artisan queue:work rule --sleep=60 --daemon --quiet --timeout=90",
        "queue": null,
        "timeout": 90,
        "sleep": 60,
        "tries": null,
        "environment": null,
        "daemon": 1,
        "status": "installing",
        "created_at": "2016-12-17 07:15:03"
    }
}</code></pre>
        <h3>HTTP Request</h3>
        <p><code>POST /api/v1/servers/{serverId}/sites/{siteId}/workers</code>
        </p>

        <h2 id="list-workers">List Workers</h2>
        <blockquote>
            <p>Response</p>
        </blockquote>
        <pre><code>{
    "workers": [
       {
            "id": 1,
            "connection": "rule",
            "command": "php /home/forge/default/artisan queue:work rule --sleep=60 --daemon --quiet --timeout=90",
            "queue": null,
            "timeout": 90,
            "sleep": 60,
            "tries": null,
            "environment": null,
            "daemon": 1,
            "status": "installing",
            "created_at": "2016-12-17 07:15:03"
        }
    ]
}</code></pre>
        <h3>HTTP Request</h3>
        <p><code>GET /api/v1/servers/{serverId}/sites/{siteId}/workers</code>
        </p>

        <h2 id="get-worker">Get Worker</h2>
        <blockquote>
            <p>Response</p>
        </blockquote>
        <pre><code>{
    "worker": {
        "id": 1,
        "connection": "rule",
        "command": "php /home/forge/default/artisan queue:work rule --sleep=60 --daemon --quiet --timeout=90",
        "queue": null,
        "timeout": 90,
        "sleep": 60,
        "tries": null,
        "environment": null,
        "daemon": 1,
        "status": "installing",
        "created_at": "2016-12-17 07:15:03"
    }
}</code></pre>
        <h3>HTTP Request</h3>
        <p><code>GET /api/v1/servers/{serverId}/sites/{siteId}/workers/{id}</code>
        </p>

        <h2 id="delete-worker">Delete Worker</h2>
        <h3>HTTP Request</h3>
        <p><code>DELETE /api/v1/servers/{serverId}/sites/{siteId}/workers/{id}</code>
        </p>

        <h2 id="restart-worker">Restart Worker</h2>
        <h3>HTTP Request</h3>
        <p><code>POST /api/v1/servers/{serverId}/sites/{siteId}/workers/{id}/restart</code>
        </p>

        <h1 id="deployment">Deployment</h1>

        <h2 id="enable-quick-deployment">Enable Quick Deployment</h2>
        <h3>HTTP Request</h3>
        <p><code>POST /api/v1/servers/{serverId}/sites/{siteId}/deployment</code>
        </p>

        <h2 id="disable-quick-deployment">Disable Quick Deployment</h2>
        <h3>HTTP Request</h3>
        <p><code>DELETE /api/v1/servers/{serverId}/sites/{siteId}/deployment</code>
        </p>

        <h2 id="get-deployment-script">Get Deployment Script</h2>
        <p>The response is a string for this request.</p>
        <h3>HTTP Request</h3>
        <p><code>GET /api/v1/servers/{serverId}/sites/{siteId}/deployment/script</code>
        </p>

        <h2 id="update-deployment-script">Update Deployment Script</h2>
        <blockquote>
            <p>Payload</p>
        </blockquote>
        <pre><code>{
    "content": "CONTENT_OF_THE_SCRIPT"
}</code></pre>
        <h3>HTTP Request</h3>
        <p><code>PUT /api/v1/servers/{serverId}/sites/{siteId}/deployment/script</code>
        </p>

        <h2 id="deploy-now">Deploy Now</h2>
        <h3>HTTP Request</h3>
        <p><code>POST /api/v1/servers/{serverId}/sites/{siteId}/deployment/deploy</code>
        </p>

        <h2 id="reset-deployment-status">Reset Deployment Status</h2>
        <h3>HTTP Request</h3>
        <p><code>POST /api/v1/servers/{serverId}/sites/{siteId}/deployment/reset</code>
        </p>

        <h2 id="get-deployment-log">Get Deployment Log</h2>
        <p>The response is a string for this request.</p>
        <h3>HTTP Request</h3>
        <p><code>GET /api/v1/servers/{serverId}/sites/{siteId}/deployment/log</code>
        </p>

        <h1 id="configuration-files">Configuration Files</h1>

        <h2 id="get-nginx-configuration">Get Nginx Configuration</h2>
        <p>The response is a string for this request.</p>
        <h3>HTTP Request</h3>
        <p><code>GET /api/v1/servers/{serverId}/sites/{siteId}/nginx</code>
        </p>

        <h2 id="update-nginx-configuration">Update Nginx Configuration</h2>
        <blockquote>
            <p>Payload</p>
        </blockquote>
        <pre><code>{
    "content": "CONTENT"
}</code></pre>
        <h3>HTTP Request</h3>
        <p><code>PUT /api/v1/servers/{serverId}/sites/{siteId}/nginx</code>
        </p>

        <h2 id="get-env-file">Get .env File</h2>
        <p>The response is a string for this request.</p>
        <h3>HTTP Request</h3>
        <p><code>GET /api/v1/servers/{serverId}/sites/{siteId}/env</code>
        </p>

        <h2 id="update-env-file">Update .env File</h2>
        <blockquote>
            <p>Payload</p>
        </blockquote>
        <pre><code>{
    "content": "CONTENT"
}</code></pre>
        <h3>HTTP Request</h3>
        <p><code>PUT /api/v1/servers/{serverId}/sites/{siteId}/env</code>
        </p>

        <h1 id="git-projects">git Projects</h1>

        <h2 id="install-new">Install New</h2>
        <blockquote>
            <p>Payload</p>
        </blockquote>
        <pre><code>{
    "provider": "github",
    "repository": "username/repository"
}</code></pre>
        <h3>HTTP Request</h3>
        <p><code>POST /api/v1/servers/{serverId}/sites/{siteId}/git</code>
        </p>

        <h2 id="remove-project">Remove Project</h2>
        <h3>HTTP Request</h3>
        <p><code>DELETE /api/v1/servers/{serverId}/sites/{siteId}/git</code>
        </p>

        <h1 id="wordpress">WordPress</h1>

        <h2 id="install">Install</h2>
        <blockquote>
            <p>Payload</p>
        </blockquote>
        <pre><code>{
    "database": "forge",
    "user": "forge"
}</code></pre>
        <h3>HTTP Request</h3>
        <p><code>POST /api/v1/servers/{serverId}/sites/{siteId}/wordpress</code>
        </p>

        <h2 id="uninstall-wordpress">Uninstall WordPress</h2>
        <h3>HTTP Request</h3>
        <p><code>DELETE /api/v1/servers/{serverId}/sites/{siteId}/wordpress</code>
        </p>
        <p>This endpoint will uninstall WordPress and revert the site back to a default
            state.
        </p>

        <h1 id="recipes">Recipes</h1>

        <h2 id="create-recipe">Create Recipe</h2>
        <blockquote>
            <p>Payload</p>
        </blockquote>
        <pre><code>{
    "name": "Recipe Name",
    "user": "root",
    "script": "SCRIPT_CONTENT"
}</code></pre>
        <blockquote>
            <p>Response</p>
        </blockquote>
        <pre><code>{
    "recipe": {
        "id": 1,
        "name": "Recipe Name",
        "user": "root",
        "script": "SCRIPT_CONTENT",
        "created_at": "2016-12-16 16:24:05"
    }
}</code></pre>
        <h3>HTTP Request</h3>
        <p><code>POST /api/v1/recipes</code>
        </p>

        <h2 id="list-recipes">List Recipes</h2>
        <blockquote>
            <p>Response</p>
        </blockquote>
        <pre><code>{
    "recipes": [
       {
            "id": 1,
            "name": "Recipe Name",
            "user": "root",
            "script": "SCRIPT_CONTENT",
            "created_at": "2016-12-16 16:24:05"
        }
    ]
}</code></pre>
        <h3>HTTP Request</h3>
        <p><code>GET /api/v1/recipes</code>
        </p>

        <h2 id="get-recipe">Get Recipe</h2>
        <blockquote>
            <p>Response</p>
        </blockquote>
        <pre><code>{
    "recipe": {
        "id": 1,
        "name": "Recipe Name",
        "user": "root",
        "script": "SCRIPT_CONTENT",
        "created_at": "2016-12-16 16:24:05"
    }
}</code></pre>
        <h3>HTTP Request</h3>
        <p><code>GET /api/v1/recipes/{recipeId}</code>
        </p>

        <h2 id="update-recipe">Update Recipe</h2>
        <blockquote>
            <p>Payload</p>
        </blockquote>
        <pre><code>{
    "name": "Recipe Name",
    "user": "root",
    "script": "SCRIPT_CONTENT"
}</code></pre>
        <blockquote>
            <p>Response</p>
        </blockquote>
        <pre><code>{
    "recipe": {
        "id": 1,
        "name": "Recipe Name",
        "user": "root",
        "script": "SCRIPT_CONTENT",
        "created_at": "2016-12-16 16:24:05"
    }
}</code></pre>
        <h3>HTTP Request</h3>
        <p><code>PUT /api/v1/recipes/{recipeId}</code>
        </p>

        <h2 id="delete-recipe">Delete Recipe</h2>
        <h3>HTTP Request</h3>
        <p><code>DELETE /api/v1/recipes/{recipeId}</code>
        </p>

        <h2 id="run-recipe">Run Recipe</h2>
        <blockquote>
            <p>Payload</p>
        </blockquote>
        <pre><code>{
    "servers": [
        1,
        2
    ]
}</code></pre>
        <h3>HTTP Request</h3>
        <p><code>POST /api/v1/recipes/{recipeId}/run</code>
        </p>

        <h1 id="regions">Regions</h1>

        <h2 id="digital-ocean-regions">Digital Ocean Regions</h2>
        <table>
            <thead>
                <tr>
                    <th>Key</th>
                    <th>Region</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>ams2</td>
                    <td>Amsterdam 2</td>
                </tr>
                <tr>
                    <td>ams3</td>
                    <td>Amsterdam 3</td>
                </tr>
                <tr>
                    <td>blr1</td>
                    <td>Bangalore</td>
                </tr>
                <tr>
                    <td>lon1</td>
                    <td>London</td>
                </tr>
                <tr>
                    <td>fra1</td>
                    <td>Frankfurt</td>
                </tr>
                <tr>
                    <td>nyc1</td>
                    <td>New York 1</td>
                </tr>
                <tr>
                    <td>nyc2</td>
                    <td>New York 2</td>
                </tr>
                <tr>
                    <td>nyc3</td>
                    <td>New York 3</td>
                </tr>
                <tr>
                    <td>sfo1</td>
                    <td>San Francisco 1</td>
                </tr>
                <tr>
                    <td>sfo2</td>
                    <td>San Francisco 2</td>
                </tr>
                <tr>
                    <td>sgp1</td>
                    <td>Singapore</td>
                </tr>
                <tr>
                    <td>tor1</td>
                    <td>Toronto</td>
                </tr>
            </tbody>
        </table>

        <h2 id="aws-regions">AWS Regions</h2>
        <table>
            <thead>
                <tr>
                    <th>Key</th>
                    <th>Region</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>us-west-1</td>
                    <td>California</td>
                </tr>
                <tr>
                    <td>eu-west-1</td>
                    <td>Ireland</td>
                </tr>
                <tr>
                    <td>eu-central-1</td>
                    <td>Frankfurt</td>
                </tr>
                <tr>
                    <td>ap-south-1</td>
                    <td>Mumbai</td>
                </tr>
                <tr>
                    <td>us-west-2</td>
                    <td>Oregon</td>
                </tr>
                <tr>
                    <td>sa-east-1</td>
                    <td>Sao Paulo</td>
                </tr>
                <tr>
                    <td>ap-northeast-2</td>
                    <td>Seoul</td>
                </tr>
                <tr>
                    <td>ap-southeast-1</td>
                    <td>Singapore</td>
                </tr>
                <tr>
                    <td>ap-southeast-2</td>
                    <td>Sydney</td>
                </tr>
                <tr>
                    <td>ap-northeast-1</td>
                    <td>Tokyo</td>
                </tr>
                <tr>
                    <td>us-east-1</td>
                    <td>Virginia</td>
                </tr>
            </tbody>
        </table>

        <h2 id="linode-regions">Linode Regions</h2>
        <table>
            <thead>
                <tr>
                    <th>Key</th>
                    <th>Region</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>4</td>
                    <td>Atlanta</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Dallas</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Frankfurt</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Fremont</td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>London</td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>Newark</td>
                </tr>
                <tr>
                    <td>9</td>
                    <td>Singapore</td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>Tokyo</td>
                </tr>
            </tbody>
        </table>

        <h2 id="rackspace-regions">Rackspace Regions</h2>
        <table>
            <thead>
                <tr>
                    <th>Key</th>
                    <th>Region</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>ORD</td>
                    <td>Chicago</td>
                </tr>
                <tr>
                    <td>DFW</td>
                    <td>Dallas</td>
                </tr>
                <tr>
                    <td>HKG</td>
                    <td>Hong Kong</td>
                </tr>
                <tr>
                    <td>LON</td>
                    <td>London</td>
                </tr>
                <tr>
                    <td>IAD</td>
                    <td>Virginia</td>
                </tr>
                <tr>
                    <td>SYD</td>
                    <td>Sydney</td>
                </tr>
            </tbody>
        </table>

        <h1 id="server-sizes">Server Sizes</h1>

        <h2 id="digital-ocean">Digital Ocean</h2>
        <table>
            <thead>
                <tr>
                    <th>Key</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>512MB</td>
                    <td>512MB RAM - 1 CPU Core - 20GB SSD</td>
                </tr>
                <tr>
                    <td>1GB</td>
                    <td>1GB RAM - 1 CPU Core - 30GB SSD</td>
                </tr>
                <tr>
                    <td>2GB"</td>
                    <td>2GB RAM - 2 CPU Cores - 40GB SSD</td>
                </tr>
                <tr>
                    <td>4GB</td>
                    <td>4GB RAM - 2 CPU Cores - 60GB SSD</td>
                </tr>
                <tr>
                    <td>8GB</td>
                    <td>8GB RAM - 4 CPU Cores - 80GB SSD</td>
                </tr>
                <tr>
                    <td>16GB</td>
                    <td>16GB RAM - 8 CPU Cores - 160GB SSD</td>
                </tr>
                <tr>
                    <td>m-16GB</td>
                    <td>16GB RAM (High Memory) - 2 CPU Cores - 30GB SSD</td>
                </tr>
                <tr>
                    <td>32GB</td>
                    <td>32GB RAM - 12 CPU Cores - 320GB SSD</td>
                </tr>
                <tr>
                    <td>m-32GB</td>
                    <td>32GB RAM (High Memory) - 4 CPU Cores - 90GB SSD</td>
                </tr>
                <tr>
                    <td>64GB</td>
                    <td>64GB RAM - 20 CPU Cores - 640GB SSD</td>
                </tr>
                <tr>
                    <td>m-64GB</td>
                    <td>64GB RAM (High Memory) - 8 CPU Cores - 200GB SSD</td>
                </tr>
            </tbody>
        </table>

        <h2 id="aws">AWS</h2>
        <table>
            <thead>
                <tr>
                    <th>Key</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>512MB</td>
                    <td>0.5 GiB RAM - 1 vCPU</td>
                </tr>
                <tr>
                    <td>1GB</td>
                    <td>1 GiB RAM - 1 vCPU</td>
                </tr>
                <tr>
                    <td>2GB</td>
                    <td>2 GiB RAM - 1 vCPU</td>
                </tr>
                <tr>
                    <td>4GB</td>
                    <td>4 GiB RAM - 2 vCPUs</td>
                </tr>
                <tr>
                    <td>8GB</td>
                    <td>8 GiB RAM - 2 vCPUs</td>
                </tr>
                <tr>
                    <td>16GB</td>
                    <td>16 GiB RAM - 4 vCPUs</td>
                </tr>
                <tr>
                    <td>32GB</td>
                    <td>32 GiB RAM - 8 vCPUs</td>
                </tr>
                <tr>
                    <td>64GB</td>
                    <td>64 GiB RAM - 16 vCPUs</td>
                </tr>
            </tbody>
        </table>

        <h2 id="linode">Linode</h2>
        <table>
            <thead>
                <tr>
                    <th>Key</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1GB</td>
                    <td>1GB RAM - 1 CPU Cores - 20GB SSD</td>
                </tr>
                <tr>
                    <td>2GB</td>
                    <td>2GB RAM - 1 CPU Cores - 30GB SSD</td>
                </tr>
                <tr>
                    <td>4GB</td>
                    <td>4GB RAM - 2 CPU Cores - 48GB SSD</td>
                </tr>
                <tr>
                    <td>8GB</td>
                    <td>8GB RAM - 4 CPU Cores - 96GB SSD</td>
                </tr>
                <tr>
                    <td>12GB</td>
                    <td>12GB RAM - 6 CPU Cores - 192GB SSD</td>
                </tr>
                <tr>
                    <td>16GB</td>
                    <td>16GB RAM - 1 CPU Cores - 20GB SSD</td>
                </tr>
                <tr>
                    <td>32GB</td>
                    <td>32GB RAM - 2 CPU Cores - 40GB SSD</td>
                </tr>
                <tr>
                    <td>60GB</td>
                    <td>60GB RAM - 4 CPU Cores - 90GB SSD</td>
                </tr>
                <tr>
                    <td>100GB</td>
                    <td>100GB RAM - 8 CPU Cores - 100GB SSD</td>
                </tr>
                <tr>
                    <td>200GB</td>
                    <td>200GB RAM - 16 CPU Cores - 340GB SSD</td>
                </tr>
            </tbody>
        </table>

        <h1 id="credentials">Credentials</h1>

        <h2 id="list">List</h2>
        <blockquote>
            <p>Response</p>
        </blockquote>
        <pre><code>{
  "credentials": [
    {
      "id": 1,
      "type": "ocean2",
      "name": "Personal"
    }
  ]
}</code></pre>
        <h3>HTTP Request</h3>
        <p><code>GET /api/v1/credentials</code>
        </p>
    </div>

  <div class="dark-box"></div>
  </div>
  <script type="application/javascript">
    $('pre code').each(function (i, block) {
        var json = JSON.parse($(block).html());
        renderjson.set_show_to_level('all');
        renderjson.set_max_string_length(30);
        $(block).html(renderjson(json));
    });
  </script>
</body>
</html>
