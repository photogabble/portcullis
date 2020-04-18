<?php

if (! function_exists('registration')) {

    /**
     * @return \Photogabble\Portcullis\Registration
     */
    function registration()
    {
        return app(\Photogabble\Portcullis\Registration::class);
    }
}
