# VTP
The VTP server stores Everybody Votes Channel votes/question suggestions that the Wii sends to it. It also has a time server the Wii uses to sync the time with.

# Setup
1. Import schema.sql to a database on your MySQL server.
2. Run `composer update` to ensure Sentry is installed.
3. Edit the config to give the Sentry URL, MySQL Username/Pass/DB.
4. Publish the scripts to the appropiate folders.

If you do not require Sentry, comment out lines 4 and 5 in `vote.php` and `suggest.php`

RiiConnect24 will not provide support for these scripts or setup, unless the issue is our own fault/bug