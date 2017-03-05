#!/bin/bash

API="o.KEDsgavxE0StXldVfqIFVqlWWsBS0nP9"
MSG="Server Message:
$1"
if [ "$1" == "" ] ; then
	echo ""
else 
	curl -k -u $API: https://api.pushbullet.com/v2/pushes -d type=note -d title="Kleinanzeigen" -d body="$MSG"
fi
