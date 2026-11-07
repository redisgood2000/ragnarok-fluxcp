# Ragnarok Online — FluxCP deployment

This repository builds a containerized [rAthena FluxCP](https://github.com/rathena/FluxCP) control panel for Railway.

## Architecture
- FluxCP source is fetched from the official rAthena repository during the Docker build.
- Apache + PHP run as the web service.
- MariaDB remains a separate private Railway service. The panel connects over Railway's private network.
- Credentials are supplied through Railway environment variables; no database passwords belong in Git.

## Railway setup
1. Deploy this repository as a service in the existing **Ragnarok Online** Railway project, branch `main`.
2. Add the variables listed below, using Railway service references for the MariaDB values.
3. Generate a public domain for the web service.
4. Wait for the image build and health check to pass.

| Variable | Value |
|---|---|
| `DB_HOST` | `${{MariaDB.MARIADB_HOST}}` |
| `DB_PORT` | `${{MariaDB.MARIADB_PORT}}` |
| `DB_NAME` | `${{MariaDB.MARIADB_DATABASE}}` |
| `DB_USER` | `${{MariaDB.MARIADB_USER}}` |
| `DB_PASSWORD` | `${{MariaDB.MARIADB_PASSWORD}}` |
| `CP_SERVER_ADDRESS` | Your Railway public domain, without `https://` |
| `CP_INSTALLER_PASSWORD` | A unique long random password |
| `LOGIN_SERVER_ADDRESS` | Public game login hostname (later) |
| `CHAR_SERVER_ADDRESS` | Public game character hostname (later) |
| `MAP_SERVER_ADDRESS` | Public game map hostname (later) |

Set `DB_PORT` to the MariaDB private port exposed by the template. Keep MariaDB's public TCP proxy disabled.

## Important database note
The MariaDB service is running, but the rAthena schema has not yet been imported. FluxCP will not be fully functional until the official rAthena SQL tables (login, char, map, logs, and web) are installed. Do not run the FluxCP installer against an empty database before that schema is ready.

## Local validation
The Docker image exposes Apache on port 80. Railway supplies `PORT`; the container entrypoint configures Apache to listen on it.

## Security
- Never commit secrets or real player data.
- Keep MariaDB private; only the web and game services should access it over Railway private networking.
- Change the installer password before making the panel public.
- Keep FluxCP debug mode disabled in production.

## Upstream
FluxCP is maintained by the rAthena project. See its upstream README and documentation for license and installation details: https://github.com/rathena/FluxCP
