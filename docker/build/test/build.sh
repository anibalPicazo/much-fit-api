#!/usr/bin/env bash
docker login registry.gitlab.com
echo "Building Testing Image ..."
docker build -t registry.gitlab.com/kaamit/core-api/test-image -f Dockerfile ../../../.
docker push registry.gitlab.com/kaamit/core-api/test-image
