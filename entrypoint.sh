#!/bin/sh
set -e

# Start nginx process
nohup nginx -g "daemon off;" &

# Run the default command
exec "$@"