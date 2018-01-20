<?php
/**
 * Created by PhpStorm.
 * User: nursultan
 * Date: 1/17/18
 * Time: 10:48 PM
 */

namespace App\Console\Commands;


use Illuminate\Console\Command;

abstract class BaseCrawlerCommand extends Command
{
    protected $hostname = 'https://exist.ru';
}