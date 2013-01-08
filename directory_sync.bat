@echo off
c:
cd %appdata%\.minecraft\screenshots
if not exist p:\public_html\pics\minecraft (
	echo Destination not ready. Exiting.
	break
) else (
	echo Preparing to copy screenshots...
	copy /y *.png p:\public_html\pics\minecraft\
	echo Copy complete.
)
