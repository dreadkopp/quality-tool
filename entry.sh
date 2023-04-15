#!/bin/ash

if [[ $1 == 'fix-php' ]]; then
  shift 1
  echo 'rector first run'
  php -dmemory_limit=-1 ~/.composer/vendor/bin/rector process \
      --config=/config/rector.php \
       "$@"
  # run rector twice since added return types might not be imported but FQCN
  echo 'rector second run'
  php -dmemory_limit=-1 ~/.composer/vendor/bin/rector process \
      --config=/config/rector.php \
       "$@"
  echo 'cs fixer run'
  php -dmemory_limit=-1 ~/.composer/vendor/bin/php-cs-fixer fix \
      --diff \
      --using-cache=yes \
      --config=/config/php-cs-fixer.php \
      --path-mode=intersection \
      --cache-file=/tmp/csfixercache \
       "$@"
  exit
fi

if [[ $1 == 'rector' ]]; then
    shift 1
    php -dmemory_limit=-1 ~/.composer/vendor/bin/rector process \
      --config=/config/rector.php
      "$@"
    exit
fi

if [[ $1 == 'php-cs-fixer' ]]; then
    shift 1
    php -dmemory_limit=-1 ~/.composer/vendor/bin/php-cs-fixer fix \
      --diff \
      --config=/config/php-cs-fixer.php \
      --using-cache=yes \
      --path-mode=intersection \
      --cache-file=/tmp/csfixercache \
      "$@"
    exit
fi

if [[ $1 == 'phpinsights' ]]; then
  shift 1
  php -dmemory_limit=-1 ~/.composer/vendor/bin/phpinsights \
    --config-path=/config/phpinsights.php \
    analyse \
    "$@"
  exit
fi

# uses default config OR local phpstan-dev.neon if present
if [[ $1 == 'phpstan' ]]; then
  shift 1
  CONFIG_PATH=/config/phpstan.neon
  if [[ -f phpstan-dev.neon ]]; then
    CONFIG_PATH=./phpstan-dev.neon
  fi
  php -dmemory_limit=-1 ~/.composer/vendor/bin/phpstan analyse \
    -c $CONFIG_PATH \
    "$@"
  exit
fi

# uses default config OR local phpstan-prod.neon if present
if [[ $1 == 'phpstan-prod' ]]; then
  shift 1
  CONFIG_PATH=/config/phpstan.neon
  if [[ -f phpstan-prod.neon ]]; then
    CONFIG_PATH=./phpstan-prod.neon
  fi
  php -dmemory_limit=-1 ~/.composer/vendor/bin/phpstan -V
  php -dmemory_limit=-1 ~/.composer/vendor/bin/phpstan analyse \
  -c $CONFIG_PATH \
  "$@"
  exit
fi

if [[ $1 == 'prettier' ]]; then
  shift 1
  PLACED_EC=false
  # prettier will parse and check for .editorconfig in project, thus temporarily place it there
  if [[ ! -f .editorconfig ]]; then
    cp /config/.editorconfig .editorconfig
    PLACED_EC=true;
  fi
  /usr/local/bin/prettier --config /config/.prettierrc \
    -c \
    --write \
    "$@"
  if [[ $PLACED_EC != false ]]; then
    rm .editorconfig
  fi
  exit
fi


if [[ $1 == 'eslint' ]]; then
  shift 1
  /usr/local/bin/eslint -c /config/.eslintrc.js --ext .ts,.vue  "$@"
  /usr/local/bin/vue-tsc --noemit "$@"
  exit
fi

if [[ $1 == 'tsfix' ]]; then
  shift 1
  /usr/local/bin/eslint -c /config/.eslintrc.js --ext .ts,.vue --fix "$@"
  exit
fi

if [[ $1 == 'markdownlint' ]]; then
  shift 1
  mdl -c /config/.markdownlint.jsonc "$@"
  exit
fi

if [[ $1 == 'djlint' ]]; then
  shift 1
 djlint \
 --reformat \
 --configuration=/config/.djlintrc \
 --preserve-leading-space \
 --extension=*.twig \
 --warn \
 --statistics \
  "$@"
  exit
fi

echo 'Please provide the analyzer to use. Possible options are:'
echo 'fix-php (will use rector and php-cs-fixer to patch the crappy code you wrote)'
echo 'rector (php formatter + upgrade helper)'
echo 'php-cs-fixer (php formatter)'
echo 'phpinsights (metrics about how bad your project is written)'
echo 'phpstan (errors when your project is really bad)'
echo 'phpstan-prod (errors when your project is really bad but looks for phpstan-prod.neon)'
echo 'prettier (js and css formatter)'
echo 'eslint (like stan, but for vue and ts)'
echo 'tsfix (ts and vue formatter)'
echo 'markdownlint (questions the syntax of your markdown files)'
echo 'djlint (twig formatter)'
exit 1
