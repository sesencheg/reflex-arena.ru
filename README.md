# reflex-arena.ru
Reflex server with duel statistics

To patch reflexded.exe:
1. 0001D36D change 74 to 75
2. "http://reflexmm-149202.appspot.com/_priv_matchresult" change to the address of your statistics server. Don't forget to add 00 so that we don't have an offset and the length of the lines is the same
