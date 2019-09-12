#!/usr/bin/env bash
docker login registry.gitlab.com
echo "Building Testing Image ..."
docker build -t registry.gitlab.com/kaamit/certiapp/certiapp-api:test -f Dockerfile ../../../.
docker push registry.gitlab.com/kaamit/certiapp/certiapp-api:test
