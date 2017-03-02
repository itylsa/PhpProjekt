#!/bin/bash

API="o.UPOIdVHjWHKxgrYwSrpCgGhrOJ88dynn"
MSG="Name: $1 $2
Email: $3

Nachricht:
$4"
curl -k -u $API: https://api.pushbullet.com/v2/pushes -d type=note -d title="Kleinanzeigen" -d body="$MSG"