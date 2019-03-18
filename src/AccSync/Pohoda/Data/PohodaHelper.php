<?php

namespace AccSync\Pohoda\Data;

class PohodaHelper
{
    /**
     * Formats the date for request
     *
     * @param \DateTime $date
     * @param bool      $includeTime
     *
     * @return string|null
     */
    public static function formatDate(\DateTime $date = NULL, $includeTime = TRUE)
    {
        if (empty($date))
        {
            return NULL;
        }

        $formattedDate = $date->format('Y-m-d');

        if ($includeTime)
        {
            $formattedDate = $formattedDate . 'T' . $date->format('H:i:s');
        }

        return $formattedDate;
    }

    /**
     * Get the date from string
     *
     * @param string $date
     *
     * @return \DateTime|null
     */
    public static function getDate($date)
    {
        if (empty($date))
        {
            return NULL;
        }

        try
        {
            $newDate = new \DateTime($date);
        }
        catch (\Exception $e)
        {
            $newDate = NULL;
        }

        return $newDate;
    }
}