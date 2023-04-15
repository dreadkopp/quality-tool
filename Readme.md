bundled container that will lint and patch your code

included linters and fixers:

rector
php-cs-fixer
phpstan
phpinsights
markdownlint
eslint
prettier

Usage:

Build container
```shell

docker build -t quality-tool .

```

then run it:

```shell

docker run -it -v $PWD:/analyze quality-tool <tool> <optional-parameters>

```

i.e.

```shell

docker run -it -v $PWD:/analyze quality-tool php-cs-fixer ./app

```