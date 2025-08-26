<p align="center">
    <img src="docs/example.png" width="100%">
</p>

<p align="center">
  <a href="https://github.com/ohdearapp/ohdear-cli/actions/workflows/static.yml"><img src="https://img.shields.io/github/actions/workflow/status/ohdearapp/ohdear-cli/static.yml?style=flat-square&label=static%20analysis" alt="Static Analysis status"/></a>
    <a href="https://packagist.org/packages/ohdearapp/ohdear-cli"><img src="https://img.shields.io/packagist/v/ohdearapp/ohdear-cli.svg?style=flat-square&label=stable" alt="Latest Stable Version"/></a>
  <a href="https://packagist.org/packages/ohdearapp/ohdear-cli"><img src="https://img.shields.io/packagist/l/ohdearapp/ohdear-cli.svg?style=flat-square" alt="License"/></a>
</p>

## About Oh Dear CLI

Oh Dear CLI was created by [Nuno Maduro](https://github.com/nunomaduro) and [Owen Voke](https://github.com/owenvoke), and is an Oh Dear CLI tool written in PHP with Laravel Zero.

## Install

> **Requires [PHP 8.2+](https://php.net/releases)**

Via Composer

```shell
composer global require ohdearapp/ohdear-cli
```

Via [Docker](https://docker.com)

```shell
docker run --rm ghcr.io/ohdearapp/ohdear-cli:latest
```

Via [Homebrew](https://formulae.brew.sh/formula/ohdear-cli)

```shell
brew install ohdear-cli
```

If Brew can't find the formula, try running `brew update`.

Once the Oh Dear CLI is installed, set your API key in the `OHDEAR_API_TOKEN` environment variable, you can generate one from [the API access page](https://ohdear.app/user/api-tokens).

## Usage

```shell
ohdear list
```

### Available commands

#### Account

- `ohdear me`  
  Display details about the currently authenticated user

#### Application Health Monitoring

- `ohdear application-health:show [id]`   
  Display application health for a specific monitor

#### Broken Links

- `ohdear broken-link:show [monitor-id]`  
  Display broken links for a specific monitor

#### Certificate Health

- `ohdear certificate-health:show [monitor-id] [--checks] [--issuers]`  
  Display certificate health for a specific monitor (use `--checks` or `--issuers` for additional information)

#### Checks

- `ohdear check:disable [id]`  
  Disable a specific check
- `ohdear check:enable [id]`  
  Enable a specific check
- `ohdear check:request-run [id]`  
  Request a new run for a specific check
- `ohdear check:show [monitor-id]`  
  Display checks for a specific monitor

#### Cron Job Monitoring

- `ohdear cron-check:add [monitor-id] [name] [frequency-or-expression] [--grace-time=5] [--description=] [--timezone=UTC]`  
  Add a new cron check for a monitor
- `ohdear cron-check:delete [id]`  
  Delete a cron check
- `ohdear cron-check:show [monitor-id]`  
  Display the cron checks for a specific monitor

#### DNS Monitoring

- `ohdear dns-history:list [monitor-id]`  
  Display a list of DNS history items and their summary
- `ohdear dns-history:show [monitor-id] [id]`  
  Display details about a specific DNS history item

#### Lighthouse SEO Reports

- `ohdear lighthouse-report:list [monitor-id]`  
  Display a list of Lighthouse reports and their summary
- `ohdear lighthouse-report:show [monitor-id]`  
  Display details about the latest Lighthouse report
- `ohdear lighthouse-report:show [monitor-id] [id]`  
  Display details about a specific Lighthouse report

#### Maintenance Windows

- `ohdear maintenance-period:add [monitor-id] [start-date] [end-date]`  
  Add a new maintenance period for a monitor
- `ohdear maintenance-period:delete [id]`  
  Delete a maintenance period
- `ohdear maintenance-period:show [id]`  
  Display maintenance periods for a specific monitor
- `ohdear maintenance-period:start [monitor-id] [seconds]`  
  Start a new maintenance period for a monitor
- `ohdear maintenance-period:stop [monitor-id]`  
  Stop the currently active maintenance period for a monitor

#### Mixed Content

- `ohdear mixed-content:show [monitor-id]`  
  Display mixed content for a specific monitor

#### Performance

- `ohdear performance:show [id] [start-date?] [end-date?] [--limit=5] [--timeframe=1h]`  
  Display performance details for a specific monitor

#### Monitors

- `ohdear monitors:add [url]`  
  Add a new monitor to Oh Dear
- `ohdear monitors:list`  
  Display a list of monitors and their current status
- `ohdear monitors:show [id]`  
  Display details about a specific monitor

#### Status Pages

- `ohdear status-pages:list`  
  Display a list of status pages and their current status
- `ohdear status-pages:show [id]`  
  Display details about a specific status page
- `ohdear status-page-updates:add [status-page-id] [title] [text] [--severity=info] [--pinned] [--time=]`  
  Add a new update for a status page
- `ohdear status-page-updates:list [status-page-id]`  
  Display updates for a status page
- `ohdear status-page-updates:delete [id]`  
  Delete a status page update

#### Uptime

- `ohdear uptime:show [monitor-id] [start-date?] [end-date?] [--limit=10] [--timeframe=hour]`  
  Display the uptime for a specific monitor
- `ohdear downtime:show [monitor-id] [start-date?] [end-date?] [--limit=10]`  
  Display the downtime for a specific monitor

## Contributing

Thank you for considering contributing to Oh Dear CLI. All contributions are welcome via pull requests.

You can have a look at the [CHANGELOG](CHANGELOG.md) for constant updates & detailed information about the changes.

## License

Oh Dear CLI is an open-sourced software licensed under the [MIT license](LICENSE.md).
