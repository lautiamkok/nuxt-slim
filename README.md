# Nuxt + Slim

> A basic concept using Nuxt and Slim to decouple controllers and views in a PHP application.

Read the post [here](https://coderwall.com/p/gyxbca/decoupling-the-view-and-controller-in-your-php-application-introducing-nuxt) about this repository.

## Nuxt Setup

``` bash
# Dependencies
$ npm install

# Production
$ npm start
```

Then, access it at http://localhost:3000/

## Slim Setup

``` bash
# Dependencies
$ composer update

# Production
$ cd [my-app-name]
$ php -S 0.0.0.0:8181 -t public
```

Then, access it at http://localhost:8181/

## Dependencies

1. Node

* [Nuxt.js](https://nuxtjs.org/)
* [axios](https://github.com/mzabriskie/axios)

2. PHP

* [Slim](https://www.slimframework.com/docs/)
* [Monolog](https://github.com/Seldaek/monolog)

## Notes

1. Using this approach, you must run two apps concurrently on different ports.

2. [Operation timed out (IPv6 issues)](https://getcomposer.org/doc/articles/troubleshooting.md#operation-timed-out-ipv6-issues-). On linux, it seems that running this command helps to make ipv4 traffic have a higher prio than ipv6, which is a better alternative than disabling ipv6 entirely:

```
$ sudo sh -c "echo 'precedence ::ffff:0:0/96 100' >> /etc/gai.conf"
```
