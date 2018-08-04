<?php
/**
 * Created by Someshwer Bandapally <bsomeshwer89@gmail.com>.
 * User: Someshwer
 * Date: 05/08/2018
 * Time: 12:54 AM IST
 */

return [

    /**
     * This option enables or disables database use.
     * If you want to use database for this package then set it to TRUE.
     *
     * NOTE: For now this package does not provide database option.
     * It will be implementation soon.
     */
    'database' => false,

    /**
     * This option enables or disables pagination option for iso codes, states and cities.
     */
    'pagination' => [

        /**
         * To enable pagination for iso codes set this to TRUE
         */
        'iso_codes' => false,

        /**
         * To enable pagination for states set this to TRUE
         * To disable pagination for states set this to FALSE.
         */
        'states' => false,

        /**
         *To enable pagination for cities set this to TRUE
         * Or set it FALSE to disable pagination for cities.
         *
         * Note: For better performance t is recommended to set pagination option to TRUE for cities
         * because it returns more than three thousand(3000) records
         */
        'cities' => false

    ]

];