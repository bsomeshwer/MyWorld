<?php

namespace Someshwer\WorldCountries\Helpers;

/**
 * Created by Someshwer<bsomeshwer89@gmail.com>.
 * User: Someshwer
 * Date: 07/08/2018
 * Time: 12:40 AM IST.
 */
class MyPaginate
{
    /**
     * @author Someshwer
     *
     * Makes pagination data and links
     *
     * @param $request_url
     * @param $page_number
     * @param $per_page
     * @param $ceil_val
     * @param $total_records
     *
     * @return array
     */
    public static function getPagination($request_url, $page_number, $per_page, $ceil_val, $total_records)
    {
        $to = $page_number * $per_page;
        if ($page_number == 1) {
            $from = 1;
            $prev_page_url = null;
        } else {
            $from = ($page_number * $per_page) - $per_page;
            $prev_page_url = $request_url.'?page='.($page_number - 1);
        }
        if ($page_number >= $ceil_val) {
            $next_page_url = null;
        } else {
            $next_page_url = $request_url.'?page='.($page_number + 1);
        }

        return [
            'current_page'   => (int) $page_number,
            'first_page_url' => $request_url.'?page=1',
            'from'           => $from,
            'last_page'      => $ceil_val,
            'last_page_url'  => $request_url.'?page='.$ceil_val,
            'next_page_url'  => $next_page_url,
            'path'           => $request_url,
            'per_page'       => $per_page,
            'prev_page_url'  => $prev_page_url,
            'to'             => $to,
            'total'          => $total_records,
        ];
    }
}
