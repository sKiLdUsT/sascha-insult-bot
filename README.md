# sascha-insult-bot
*Simple Twitter Bot for the [SaschaBeleidigungsGenerator](https://kontrollraum.org/SaschaBeleidigungsGenerator/)*

## Usage

Just simply clone this repo and run the `setup.php` to set up everything.

After that you can set up an cron job to let the bot tweet automatically.
You could use something like this:

```sh
*/10 * * * * /usr/bin/php /path/to/generator.php >/dev/null 2>&1
```