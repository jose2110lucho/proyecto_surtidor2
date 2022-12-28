<?php

namespace App\Http\Traits;

trait ReporteTrait
{
    protected function intToLiteralMonth($month_number)
    {
        switch ($month_number) {
            case '1':
                return 'enero';
                break;
            case '2':
                return 'febrero';
                break;
            case '3':
                return 'marzo';
                break;
            case '4':
                return 'abril';
                break;
            case '5':
                return 'mayo';
                break;
            case '6':
                return 'junio';
                break;
            case '7':
                return 'julio';
                break;
            case '8':
                return 'agosto';
                break;
            case '9':
                return 'septiembre';
                break;
            case '10':
                return 'octubre';
                break;
            case '11':
                return 'noviembre';
                break;
            case '12':
                return 'diciembre';
                break;
            default:
                break;
        }
    }
}
