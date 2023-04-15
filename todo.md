- eslint/tsfix not detecting plugins
- markdownlint config is ignored ?
```shell
 docker run --rm -it -v $PWD:/analyze quality-test markdownlint README.md
README.md:1: MD002 First header should be a top level header
README.md:6: MD012 Multiple consecutive blank lines
README.md:19: MD012 Multiple consecutive blank lines
README.md:7: MD013 Line length
README.md:9: MD013 Line length
README.md:17: MD013 Line length
README.md:24: MD013 Line length
README.md:11: MD032 Lists should be surrounded by blank lines
README.md:28: MD033 Inline HTML
README.md:22: MD034 Bare URL used
README.md:48: MD034 Bare URL used
README.md:30: MD046 Code block style
README.md:48: MD047 File should end with a single newline character
```