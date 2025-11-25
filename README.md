# Alphavel Events

> Event dispatcher with pub/sub pattern

[![PHP Version](https://img.shields.io/badge/php-%3E%3D8.4-blue.svg)](https://php.net)
[![License](https://img.shields.io/badge/license-MIT-green.svg)](LICENSE)

## ✨ Features

- 📢 **Event dispatcher** - Pub/sub pattern
- 🎯 **Laravel-compatible** - Familiar API
- 🔄 **Multiple listeners** - Per event
- 🚀 **Swoole-safe** - Coroutine-compatible

## 📦 Installation

```bash
composer require alphavel/events
```

## 🚀 Quick Start

```php
use Event;

// Listen
Event::listen('user.created', function($user) {
    Log::info('New user', ['id' => $user->id]);
});

// Dispatch
Event::dispatch('user.created', $user);
```

## 📚 Documentation

**Full documentation**: https://github.com/alphavel/documentation/blob/master/packages/events/README.md

## 📄 License

MIT License
