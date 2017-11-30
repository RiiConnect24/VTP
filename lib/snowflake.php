<?php

/**
 * SnowFlake ID Generator
 * Based on Twitter Snowflake to generate unique ID across multiple
 * datacenters and databases without having duplicates.
 *
 *
 * SnowFlake Layout
 *
 * 1 sign bit -- 0 is positive, 1 is negative
 * 41 bits -- milliseconds since epoch
 * 5 bits -- datacenter ID
 * 5 bits -- machine ID
 * 12 bits -- sequence number
 *
 * Total 64 bit integer/string
 */

class SnowFlake {
    /**
     * Offset from Unix Epoch
     * Unix Epoch : January 1 1970 00:00:00 GMT
     * Epoch Offset : January 1 2000 00:00:00 GMT
     */
    CONST EPOCH_OFFSET = 9466848000000;

    /**
     * @var mixed
     */
    private $datacenter_id;

    /**
     * @var mixed
     */
    private $machine_id;

    /**
     * @var null|int
     */
    private $lastTime = null;

    /**
     * @var int
     */
    private $sequence  = 1;

    /**
     * Constructor to set required paremeters
     *
     * @param mixed $datacenter_id    Unique ID for datacenter (if multiple locations are used)
     * @param mixed $machine_id       Unique ID for machine (if multiple machines are used)
     */
    public function __construct($datacenter_id, $machine_id)
    {
        $this->datacenter_id = $datacenter_id;
        $this->machine_id = $machine_id;
    }

    /**
     * Generate an unique ID based on SnowFlake
     *
     * @return string  Unique ID
     */
    public function generateID() {
        $sign = 0; // default 0

        $time = (int)($this->getUnixTimestamp() - self::EPOCH_OFFSET);

        $sequence = $this->getNextSequence($time);

        $this->lastTime = $time;

        $id = ($sign << 1) | ($time << 41) | ($this->datacenter_id << 5) | ($this->machine_id << 5) | ($sequence << 12) ;
        return (string)$id;
    }

    /**
     * Get UNIX timestamp in microseconds
     *
     * @return int  Timestamp in microseconds
     */
    private function getUnixTimestamp()
    {
        return floor(microtime(true) * 1000);
    }

    /**
     * Get the next sequence number if $time
     * was already used
     *
     * @param  int $time    (micro)timestamp from EPOCH_OFFSET
     * @return int          Sequence number
     */
    private function getNextSequence($time)
    {
        if($time === $this->lastTime) {
            return ++$this->sequence;
        }
        return $this->sequence;
    }
}