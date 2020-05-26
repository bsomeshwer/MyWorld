<?php
/**
 * Created by Someshwer<bsomeshwer89@gmail.com>.
 * User: Someshwer
 * Date: 06/08/2018
 * Time: 10:55 AM IST
 */


// This method is not using since had problem with auto-loading
// files using composer.json file inside package root folder.

if (!function_exists('getPaginate')) {

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
     * @return array
     */
    function getPaginate($request_url, $page_number, $per_page, $ceil_val, $total_records)
    {
        $to = $page_number * $per_page;
        if ($page_number == 1) {
            $from = 1;
            $prev_page_url = null;
        } else {
            $from = ($page_number * $per_page) - $per_page;
            $prev_page_url = $request_url . "?page=" . ($page_number - 1);
        }
        if ($page_number >= $ceil_val) {
            $next_page_url = null;
        } else {
            $next_page_url = $request_url . "?page=" . ($page_number + 1);
        }
        return [
            'current_page' => (int)$page_number,
            'first_page_url' => $request_url . "?page=1",
            'from' => $from,
            'last_page' => $ceil_val,
            'last_page_url' => $request_url . "?page=" . $ceil_val,
            'next_page_url' => $next_page_url,
            'path' => $request_url,
            'per_page' => $per_page,
            'prev_page_url' => $prev_page_url,
            'to' => $to,
            'total' => $total_records
        ];
    }

}
