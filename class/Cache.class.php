<?php

/**
 * Class Cache
 */
class Cache implements CacheInterface
{
    /**
     * @var array Cached key data
     */
    private $data = [];

    /**
     * @var int Order of items
     */
    private $position = 0;

    /**
     * @var int Limit for last used/created element in cache
     */
    private $limit;

    /**
     * Cache constructor.
     * @param int $limit
     */
    public function __construct(int $limit = 2)
    {
        $this->limit = $limit;
    }

    /**
     * Returns item and refreshes element in the cache
     * @param string $key
     * @return mixed|null
     */
    public function get(string $key)
    {
        if (!isset($this->data[$key])) {
            // element not exist
            return null;
        }
        // refresh element in cache
        $keyData = $this->data[$key];
        $this->set($key, $keyData['value']);

        // return element
        return $keyData['value'] ? $keyData['value'] : null;
    }

    /**
     * Save element to cache
     * @param string $key
     * @param $value
     */
    public function set(string $key, $value): void
    {
        if (isset($this->data[$key])) {
            // new value for old key
            $this->data[$key] = ['value' => $value, 'position' => $this->position()];
            return;
        }

        if ($this->isLimit()) {
            // check limit, if exceeded remove oldest key
            $this->remove($this->getOldestKey());
        }

        // save new key and value
        $this->data[$key] = ['value' => $value, 'position' => $this->position()];
    }

    /**
     * Remove element form cache
     * @param string|null $key
     */
    public function remove(?string $key): void
    {
        if ($key !== null) {
            unset($this->data[$key]);
        }
    }

    /**
     * Returns the oldest item
     * @return string|null
     */
    private function getOldestKey(): ?string
    {
        $oldestKey = null;
        $lowestPosition = null;
        foreach ($this->data as $index => $dataKey) {
            if ($lowestPosition === null || $lowestPosition > $dataKey['position']) {
                $lowestPosition = $dataKey['position'];
                $oldestKey = $index;
            }
        }

        return $oldestKey;
    }

    /**
     * Shows whether exceeded limit elements in cache
     * @return bool
     */
    private function isLimit(): bool
    {
        if (count($this->data) === $this->limit) {
            return true;
        }
        return false;
    }

    /**
     * Elements iterator
     * @return int
     */
    private function position(): int
    {
        return $this->position++;
    }

}
