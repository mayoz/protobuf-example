#!/usr/bin/env bash

set -e

function generate {
  target=${1%/}

  if [ -f .protolangs ]; then
    rm -Rf ../build/${target}

    while read lang; do
      mkdir -p ../build/${target}/${lang}

      protoc --${lang}_out=../build/${target}/${lang} --plugin=protoc-gen-grpc=`which grpc_${lang}_plugin` ${target}.proto

      echo "done ${lang}!"
    done < .protolangs
  fi
}

echo "Buidling service's protocol buffers"
for d in */; do
  pushd $d > /dev/null
  generate $d
  popd > /dev/null
done
