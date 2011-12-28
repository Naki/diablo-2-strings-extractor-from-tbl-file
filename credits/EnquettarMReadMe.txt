Readme File for EnquettarM.pl

Mephansteras: June 2001

First off: This is a slightly modified version of the Enquettar perl script. Ondo made
the original script, so most of the credit goes to him! I just changed it so that it'll
do what I want. ;)

This is a small program to take the diablo string table and output it to a txt file
that can be loaded into excel for easy editing. The program then takes the txt file
and creates a new table file with it.

Basic Usage:

Usage: perl EnquettarM.pl -[e|i] [string.tbl to export from or txt file to import from]
         -e extract to txt file or -i import from txt file anything else will  this message
     ex: perl EnquettarM.pl -e mystring.tbl
     
     Special notes: newlines are converted to the } symbol in the txt file, so if you want to
     use returns and blank lines, put that in instead. Also, don't try to put in tabs or leading
     or trailing quote (") symbols. They mess everything up.
     Currently, the txt file created is named ModString.txt and the table ModString.tbl.
     If you want to change that, just edit the beginning of the script. There are two variables
     $outputtext and $outputtable. Change their respective values to whatever you want.
     
That should do it. I do reccomend making a backup of your string table and your string txt files 
as you go. You never know when you'll want to revert to an earlier version!

Happy Modding!

If you need help with this, go to www.planetdiablo.com/phrozenkeep. Someone there should be
able to help you out. I also frequent the Forums there, so I'll be able to answer your questions
as well.