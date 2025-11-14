<?php

namespace Alphavel\Events;

class EventDispatcher
{
    private array $listeners = [];

    public function listen(string $event, callable $listener, int $priority = 0): void
    {
        if (! isset($this->listeners[$event])) {
            $this->listeners[$event] = [];
        }

        $this->listeners[$event][] = [
            'callback' => $listener,
            'priority' => $priority,
        ];

        usort($this->listeners[$event], fn ($a, $b) => $b['priority'] <=> $a['priority']);
    }

    public function dispatch(string $event, mixed $data = null): mixed
    {
        if (! isset($this->listeners[$event])) {
            return $data;
        }

        foreach ($this->listeners[$event] as $listener) {
            $result = $listener['callback']($data);

            if ($result === false) {
                break;
            }

            if ($result !== null) {
                $data = $result;
            }
        }

        return $data;
    }

    public function forget(string $event): void
    {
        unset($this->listeners[$event]);
    }

    public function has(string $event): bool
    {
        return isset($this->listeners[$event]) && count($this->listeners[$event]) > 0;
    }

    public function flush(): void
    {
        $this->listeners = [];
    }

    public function getListeners(string $event): array
    {
        return $this->listeners[$event] ?? [];
    }
}
