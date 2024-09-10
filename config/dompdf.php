<?php

return [
    /*
     * The location of the DOMPDF binary on the server.
     * This will be used for rendering and for generating PDFs.
     */
    'dompdf_path' => env('DOMPDF_PATH', base_path('vendor/dompdf/dompdf')),

    /*
     * The default options for DOMPDF.
     * For a full list of options, see the DOMPDF documentation.
     */
    'options' => [
        'defaultPaperSize' => 'A4',
        'isHtml5ParserEnabled' => true,
        'isPhpEnabled' => false,
        'isRemoteEnabled' => true, // Habilitar carregamento remoto de imagens
    ],
];
