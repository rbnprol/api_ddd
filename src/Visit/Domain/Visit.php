<?php

namespace App\Visit\Domain;

use DateTime;

final class Visit
{
    protected int $projectId;

    public function __construct(
        private int      $id,
        private int      $shopId,
        private string   $shop,
        private string   $employee,
        private DateTime $date,
        private string   $comments,
        private string   $timeStart,
        private string   $timeEnd,
        private bool     $isComplete
    )
    {
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getShopId(): int
    {
        return $this->shopId;
    }

    /**
     * @return string
     */
    public function getShop(): string
    {
        return $this->shop;
    }

    /**
     * @return string
     */
    public function getEmployee(): string
    {
        return $this->employee;
    }

    /**
     * @return DateTime
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getComments(): string
    {
        return $this->comments;
    }

    /**
     * @return string
     */
    public function getTimeStart(): string
    {
        return $this->timeStart;
    }

    /**
     * @return string
     */
    public function getTimeEnd(): string
    {
        return $this->timeEnd;
    }

    /**
     * @return bool
     */
    public function isComplete(): bool
    {
        return $this->isComplete;
    }
}
