# VTP
The VTP server stores Everybody Votes Channel votes/question suggestions that the Wii sends to it. It also has a time server the Wii uses to sync the time with.

- `suggest.cgi` is the script that stores question suggestions.
- `time.cgi` returns a Last-Modified header with the latest time.
- `vote.cgi` is the script that stores votes.

As of right now the scripts are not connected to SSL.
