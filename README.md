# VTP
The VTP server stores votes/question suggestions that the Wii sends to it. It also has a time server the Wii uses to sync the time with.

- `suggest.cgi` is the script that stores question suggestions.
- `time.cgi` returns a Last-Modified header with the latest time.
- `vote.cgi` is the script that stores votes.

Unfortunately, if you set up the Everybody Votes Channel and try to vote or suggest a question, you get an error like 231000 or 000000. We're trying things to get the errors to go away, and as of right now the scripts are not connected to SSL.
