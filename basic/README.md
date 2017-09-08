# Nuxt.js + Slim (PHP)

> ES6 Nuxt.js project using Slim as API.

## Build Setup (Nuxt)

``` bash
# Dependencies
$ npm install

# Production build
$ npm start
```

Then, access it at http://localhost:3000/

## Build Setup (Slim/ API)

``` bash
# Dependencies
$ composer update -vvv --profile

# Production build
$ cd [my-app-name]
$ php -S 0.0.0.0:8181 -t public
```

Then, access it at http://localhost:8181/

## Notes

1. For this approach, you must run these two apps concurrently.

2. [Operation timed out (IPv6 issues)](https://getcomposer.org/doc/articles/troubleshooting.md#operation-timed-out-ipv6-issues-). On linux, it seems that running this command helps to make ipv4 traffic have a higher prio than ipv6, which is a better alternative than disabling ipv6 entirely:

`$ sudo sh -c "echo 'precedence ::ffff:0:0/96 100' >> /etc/gai.conf"`

## Docs

### Node
* [Nuxt.js](https://nuxtjs.org/)
* [Vue.js](https://vuejs.org/)

### PHP
* [Slim](https://www.slimframework.com/docs/)
* [Monolog](https://github.com/Seldaek/monolog) - Sends your logs to files, sockets, inboxes, databases and various web services

## References

* https://stackoverflow.com/documentation/slim/6878/getting-started-with-slim#t=201709081512288989331
* https://www.codediesel.com/php/how-to-manually-install-slim-framework/
