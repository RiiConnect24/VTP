# VTP
The VTP server stores Everybody Votes Channel votes/question suggestions that the Wii sends to it. It also has a time server the Wii uses to sync the time with.

- `suggest.cgi` is the script that stores question suggestions.
- `time.cgi` returns a Last-Modified header with the latest time.
- `vote.cgi` is the script that stores votes.

This script works now the problem has the response need to be 100 so now you dont get anymore error code 231000 now need to make code that store votes and suggestions
 the are not connected to SSL.
