<?php
/*
 * Laravel Forge API SDK for SDK Demo
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
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>PHP SDK Demo</title>

    <link rel="icon" type="image/png" href="/docs-assets/images/favicon.png">
    <link href="/docs-assets/css/font-awesome.min.css" rel="stylesheet" media="screen">
    <link href="/docs-assets/css/screen.css" rel="stylesheet" media="screen">

    <script src="/docs-assets/js/lib/jquery.min.js"></script>
    <script src="/docs-assets/js/lib/jquery_ui.js"></script>
    <script src="/docs-assets/js/lib/energize.js"></script>
    <script src="/docs-assets/js/lib/renderjson.js"></script>
    <script src="/docs-assets/js/lib/jquery.highlight.js"></script>
    <script src="/docs-assets/js/lib/jquery.tocify.js"></script>
    <script src="/docs-assets/js/lib/lunr.js"></script>
    <script src="/docs-assets/js/script.js"></script>
</head>

<body class="index">

  <a href="#" id="nav-button">
      <span>NAV<img src="/docs-assets/images/navbar.png"/></span>
  </a>

  <div class="tocify-wrapper">
    <div class="logo-container">
      <img src="/docs-assets/images/forge-logo.svg" style="width: 200px;margin-left: 27px;">
      <span style="color:#fff;">API PHP SDK Live Demo</span>
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
        <p>This live demo will use the SDK to interact with the servers and
        sites on your Laravel Forge account using Forge's <a href="https://forge.laravel.com/api-documentation" target="_blank">official REST API</a>. Due to API request limits, we will
        limit the number of simultaneous live API calls and not show every
        possible action.</p>

        <h1 id="authentication">Authentication</h1>
<?php $token = isset($_GET['token']) ? $_GET['token'] : ''; ?>
        <pre><span class="wrap">&lt;?php
use Laravel_Forge_API_SDK_PHP\<em>Forge</em>;

<em>Forge</em>::setToken('<?php if(empty($token)) { echo 'YOUR_API_TOKEN'; } else { echo $_GET['token']; } ?>');
?&gt;</span></pre>

        <p>In order to use this demo, copy and paste your Forge API token below:</p>

        <form method="GET" style="margin-left: 28px;">
        <p><textarea rows="6" cols="55" name="token" placeholder="COPY AND PASTE YOUR FORGE API TOKEN HERE" autofocus="autofocus" style="resize: none; padding: 5px;"><?php echo $token; ?></textarea></p>
        <p><input type="submit" name="submit" value="Set Your API Token" style="padding: 5px;"></p>
        </form>
<?php
if(isset($_GET['submit'])) {
   $token = isset($token) ? $token : $_GET['token'];
   Forge::setToken($token);
 }
?>
        <br />
        <p>We will first set your Forge API token using the PHP code to the right.</p>
        <p>Now, on to the fun part...</p>
        <p>Check out the actual <strong>live responses</strong> from
        your Forge account with all the different "actions" below.</p>
        <h1 id="servers">Servers</h1>

        <h2 id="list-servers">List Servers</h2>

        <blockquote>
            <p>Live Response</p>
        </blockquote>
        <pre><code><?php echo Forge::pretty(Servers::list()); ?></code></pre>

        <h3>Usage</h3>
        <p><code>&lt;?php $servers = <em>Servers</em>::list(); ?&gt;</code></p>

        <h2 id="get-server">Get Server</h2>
        <blockquote>
            <p>Live Response</p>
        </blockquote>
        <?php $server_id = empty(Servers::list()['servers']) ? 'NULL' : Servers::list()['servers'][0]['id']; ?>
        <pre><code><?php echo Forge::pretty(Servers::get($server_id)); ?></code></pre>

        <h3>Usage</h3>
        <p><code>&lt;?php $response = <em>Servers</em>::get(<?php echo $server_id; ?>);
          ?&gt;</code></p>

        <h3>Parameters</h3>
        <p><code>$server_id</code>
          <br /><span style="margin-left: 1em;"><em>(integer) (required)</em>
            The server ID number.</span>
          <br /><span style="margin-left: 1em;">Default: <em>None</em></span>
        </p>

        <h1 id="daemons">Daemons</h1>

        <h2 id="list-daemons">List Daemons</h2>
        <blockquote>
            <p>Live Response</p>
        </blockquote>
        <pre><code><?php echo Forge::pretty(Daemons::list($server_id));?></code></pre>

        <h3>Usage</h3>
        <p><code>&lt;?php $response = <em>Daemons</em>::list(<?php echo $server_id; ?>);
          ?&gt;</code></p>

        <h3>Parameters</h3>
        <p><code>$server_id</code>
          <br /><span style="margin-left: 1em;"><em>(integer) (required)</em>
            The server ID number.</span>
          <br /><span style="margin-left: 1em;">Default: <em>None</em></span>
        </p>

        <h2 id="get-daemon">Get Daemon</h2>
        <blockquote>
            <p>Live Response</p>
        </blockquote>
        <?php $daemon_id = empty(Daemons::list($server_id)['daemons']) ? 'NULL' : Daemons::list($server_id)['daemons'][0]['id']; ?>
        <pre><code><?php echo Forge::pretty(Daemons::get($server_id, $daemon_id)); ?></code></pre>

        <h3>Usage</h3>
        <p><code>&lt;?php $response = <em>Daemons</em>::get(<?php echo $server_id . ', ' . $daemon_id; ?>);
          ?&gt;</code></p>

        <h3>Parameters</h3>
        <p><code>$server_id</code>
          <br /><span style="margin-left: 1em;"><em>(integer) (required)</em>
            The server ID number.</span>
          <br /><span style="margin-left: 1em;">Default: <em>None</em></span>
        </p>

        <h1 id="firewall-rules">Firewall Rules</h1>

        <h2 id="list-rules">List Rules</h2>
        <blockquote>
            <p>Live Response</p>
        </blockquote>
        <pre><code><?php echo Forge::pretty(FirewallRules::list($server_id)); ?></code></pre>

        <h3>Usage</h3>
        <p><code>&lt;?php $response = <em>FirewallRules</em>::list(<?php echo $server_id; ?>);
          ?&gt;</code></p>

        <h3>Parameters</h3>
        <p><code>$server_id</code>
          <br /><span style="margin-left: 1em;"><em>(integer) (required)</em>
            The server ID number.</span>
          <br /><span style="margin-left: 1em;">Default: <em>None</em></span>
        </p>

        <h2 id="get-rule">Get Rule</h2>
        <blockquote>
            <p>Live Response</p>
        </blockquote>
        <?php $rule_id = empty(FirewallRules::list($server_id)['rules']) ? 'NULL' : FirewallRules::list($server_id)['rules'][0]['id']; ?>
        <pre><code><?php echo Forge::pretty(FirewallRules::get($server_id, $rule_id)); ?></code></pre>

        <h3>Usage</h3>
        <p><code>&lt;?php $response = <em>FirewallRules</em>::get(<?php echo $server_id . ', ' . $rule_id; ?>);
          ?&gt;</code></p>

        <h3>Parameters</h3>
        <p><code>$server_id</code>
          <br /><span style="margin-left: 1em;"><em>(integer) (required)</em>
            The server ID number.</span>
          <br /><span style="margin-left: 1em;">Default: <em>None</em></span>
        </p>
        <p><code>$rule_id</code>
          <br /><span style="margin-left: 1em;"><em>(integer) (required)</em>
            The firewall rule ID number.</span>
          <br /><span style="margin-left: 1em;">Default: <em>None</em></span>
        </p>

        <h1 id="scheduled-jobs">Scheduled Jobs</h1>

        <h2 id="list-jobs">List Jobs</h2>
        <blockquote>
            <p>Live Response</p>
        </blockquote>
        <pre><code><?php echo Forge::pretty(ScheduledJobs::list($server_id)); ?></code></pre>

        <h3>Usage</h3>
        <p><code>&lt;?php $response = <em>ScheduledJobs</em>::list(<?php echo $server_id; ?>);
          ?&gt;</code></p>

        <h3>Parameters</h3>
        <p><code>$server_id</code>
          <br /><span style="margin-left: 1em;"><em>(integer) (required)</em>
            The server ID number.</span>
          <br /><span style="margin-left: 1em;">Default: <em>None</em></span>
        </p>

        <h2 id="get-job">Get Job</h2>
        <blockquote>
            <p>Live Response</p>
        </blockquote>
        <?php $job_id = empty(ScheduledJobs::list($server_id)['jobs']) ? 'NULL' : ScheduledJobs::list($server_id)['jobs'][0]['id']; ?>
        <pre><code><?php echo Forge::pretty(ScheduledJobs::get($server_id, $job_id)); ?></code></pre>

        <h3>Usage</h3>
        <p><code>&lt;?php $response = <em>ScheduledJobs</em>::get(<?php echo $server_id . ', ' . $job_id; ?>);
          ?&gt;</code></p>

        <h3>Parameters</h3>
        <p><code>$server_id</code>
          <br /><span style="margin-left: 1em;"><em>(integer) (required)</em>
            The server ID number.</span>
          <br /><span style="margin-left: 1em;">Default: <em>None</em></span>
        </p>
        <p><code>$job_id</code>
          <br /><span style="margin-left: 1em;"><em>(integer) (required)</em>
            The scheduled job ID number.</span>
          <br /><span style="margin-left: 1em;">Default: <em>None</em></span>
        </p>

        <h1 id="mysql-databases">MySQL Databases</h1>

        <h2 id="list-databases">List Databases</h2>
        <blockquote>
            <p>Live Response</p>
        </blockquote>
        <pre><code><?php echo Forge::pretty(MySQLDatabases::list($server_id)); ?></code></pre>

        <h3>Usage</h3>
        <p><code>&lt;?php $response = <em>MySQLDatabases</em>::list(<?php echo $server_id; ?>);
          ?&gt;</code></p>

        <h3>Parameters</h3>
        <p><code>$server_id</code>
          <br /><span style="margin-left: 1em;"><em>(integer) (required)</em>
            The server ID number.</span>
          <br /><span style="margin-left: 1em;">Default: <em>None</em></span>
        </p>

        <h2 id="get-database">Get Database</h2>
        <blockquote>
            <p>Live Response</p>
        </blockquote>

        <?php $database_id = empty(MySQLDatabases::list($server_id)['databases']) ? 'NULL' : MySQLDatabases::list($server_id)['databases'][0]['id']; ?>
        <pre><code><?php echo Forge::pretty(MySQLDatabases::get($server_id, $database_id)); ?></code></pre>

        <h3>Usage</h3>
        <p><code>&lt;?php $response = <em>MySQLDatabases</em>::get(<?php echo $server_id . ', ' . $database_id; ?>);
          ?&gt;</code></p>

        <h3>Parameters</h3>
        <p><code>$server_id</code>
          <br /><span style="margin-left: 1em;"><em>(integer) (required)</em>
            The server ID number.</span>
          <br /><span style="margin-left: 1em;">Default: <em>None</em></span>
        </p>
        <p><code>$database_id</code>
          <br /><span style="margin-left: 1em;"><em>(integer) (required)</em>
            The MySQL database ID number.</span>
          <br /><span style="margin-left: 1em;">Default: <em>None</em></span>
        </p>

        <h1 id="mysql-database-users">MySQL Database Users</h1>

        <h2 id="list-users">List Users</h2>
        <blockquote>
            <p>Live Response</p>
        </blockquote>
        <pre><code><?php echo Forge::pretty(MySQLDatabaseUsers::list($server_id)); ?></code></pre>

        <h3>Usage</h3>
        <p><code>&lt;?php $response = <em>MySQLDatabaseUsers</em>::list(<?php echo $server_id; ?>);
          ?&gt;</code></p>

        <h3>Parameters</h3>
        <p><code>$server_id</code>
          <br /><span style="margin-left: 1em;"><em>(integer) (required)</em>
            The server ID number.</span>
          <br /><span style="margin-left: 1em;">Default: <em>None</em></span>
        </p>

        <h2 id="get-user">Get User</h2>
        <blockquote>
            <p>Live Response</p>
        </blockquote>
        <?php $user_id = empty(MySQLDatabaseUsers::list($server_id)['users']) ? 'NULL' : MySQLDatabaseUsers::list($server_id)['users'][0]['id']; ?>
        <pre><code><?php echo Forge::pretty(MySQLDatabaseUsers::get($server_id, $user_id)); ?></code></pre>

        <h3>Usage</h3>
        <p><code>&lt;?php $response = <em>MySQLDatabaseUsers</em>::get(<?php echo $server_id . ', ' . $user_id; ?>);
          ?&gt;</code></p>

        <h3>Parameters</h3>
        <p><code>$server_id</code>
          <br /><span style="margin-left: 1em;"><em>(integer) (required)</em>
            The server ID number.</span>
          <br /><span style="margin-left: 1em;">Default: <em>None</em></span>
        </p>
        <p><code>$user_id</code>
          <br /><span style="margin-left: 1em;"><em>(integer) (required)</em>
            The MySQL database user ID number.</span>
          <br /><span style="margin-left: 1em;">Default: <em>None</em></span>
        </p>

        <h1 id="sites">Sites</h1>

        <h2 id="list-sites">List Sites</h2>
        <blockquote>
            <p>Live Response</p>
        </blockquote>
        <pre><code><?php echo Forge::pretty(Sites::list($server_id)); ?></code></pre>

        <h3>Usage</h3>
        <p><code>&lt;?php $response = <em>Sites</em>::list(<?php echo $server_id; ?>);
          ?&gt;</code></p>

        <h3>Parameters</h3>
        <p><code>$server_id</code>
          <br /><span style="margin-left: 1em;"><em>(integer) (required)</em>
            The server ID number.</span>
          <br /><span style="margin-left: 1em;">Default: <em>None</em></span>
        </p>

        <h2 id="get-site">Get Site</h2>
        <blockquote>
            <p>Live Response</p>
        </blockquote>
        <?php $site_id = empty(Sites::list($server_id)['sites']) ? 'NULL' : Sites::list($server_id)['sites'][0]['id']; ?>
        <pre><code><?php echo Forge::pretty(Sites::get($server_id, $site_id)); ?></code></pre>

        <h3>Usage</h3>
        <p><code>&lt;?php $response = <em>Sites</em>::get(<?php echo $server_id . ', ' . $site_id; ?>);
          ?&gt;</code></p>

        <h3>Parameters</h3>
        <p><code>$server_id</code>
          <br /><span style="margin-left: 1em;"><em>(integer) (required)</em>
            The server ID number.</span>
          <br /><span style="margin-left: 1em;">Default: <em>None</em></span>
        </p>
        <p><code>$site_id</code>
          <br /><span style="margin-left: 1em;"><em>(integer) (required)</em>
            The site ID number.</span>
          <br /><span style="margin-left: 1em;">Default: <em>None</em></span>
        </p>

        <h1 id="ssl-certificates">SSL Certificates</h1>

        <h2 id="list-certificates">List Certificates</h2>
        <blockquote>
            <p>Live Response</p>
        </blockquote>
        <pre><code><?php echo Forge::pretty(SSLCertificates::list($server_id, $site_id)); ?></code></pre>

        <h3>Usage</h3>
        <p><code>&lt;?php $response = <em>SSLCertificates</em>::list(<?php echo $server_id . ', ' . $site_id; ?>);
          ?&gt;</code></p>

        <h3>Parameters</h3>
        <p><code>$server_id</code>
          <br /><span style="margin-left: 1em;"><em>(integer) (required)</em>
            The server ID number.</span>
          <br /><span style="margin-left: 1em;">Default: <em>None</em></span>
        </p>
        <p><code>$site_id</code>
          <br /><span style="margin-left: 1em;"><em>(integer) (required)</em>
            The site ID number.</span>
          <br /><span style="margin-left: 1em;">Default: <em>None</em></span>
        </p>

        <h2 id="get-certificate">Get Certificate</h2>
        <blockquote>
            <p>Live Response</p>
        </blockquote>
        <?php $certificate_id = empty(SSLCertificates::list($server_id, $site_id)['certificates']) ? 'NULL' : SSLCertificates::list($server_id, $site_id)['certificates'][0]['id']; ?>
        <pre><code><?php echo Forge::pretty(SSLCertificates::get($server_id, $site_id, $certificate_id)); ?></code></pre>

        <h3>Usage</h3>
        <p><code>&lt;?php $response = <em>SSLCertificates</em>::get(<?php echo $server_id . ', ' . $site_id . ', ' . $certificate_id; ?>);
          ?&gt;</code></p>

        <h3>Parameters</h3>
        <p><code>$server_id</code>
          <br /><span style="margin-left: 1em;"><em>(integer) (required)</em>
            The server ID number.</span>
          <br /><span style="margin-left: 1em;">Default: <em>None</em></span>
        </p>
        <p><code>$site_id</code>
          <br /><span style="margin-left: 1em;"><em>(integer) (required)</em>
            The site ID number.</span>
          <br /><span style="margin-left: 1em;">Default: <em>None</em></span>
        </p>
        <p><code>$certificate_id</code>
          <br /><span style="margin-left: 1em;"><em>(integer) (required)</em>
            The SSL certificate ID number.</span>
          <br /><span style="margin-left: 1em;">Default: <em>None</em></span>
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
