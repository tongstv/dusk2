<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->browse(function (Browser $browser) {

            $body = $browser->visit('https://remitano.com/usdt/vn');
            $mua = $body->elements('.text-danger .amount');
            $ban = $body->elements('.text-success .amount');


            echo "mua\n";
            $muas = [];
            $bans = [];
            foreach ($mua AS $el) {
                $price = $el->getAttribute('innerHTML');

                $muas[] = preg_replace('/[^0-9.]/', '', $price);
            }
            echo "ban\n";

            foreach ($ban AS $el) {
                $price = $el->getAttribute('innerHTML');
                $bans[] = preg_replace('/[^0-9.]/', '', $price);
            }

            print_r($bans);
            print_r($muas);


            $sauban = $bans[5] - ($bans[5] * 1 / 100);
            $saumua = $muas[5] + ($muas[5] * 1 / 100);
            echo "Lai: " . ($sauban - $saumua);


        });
    }
}
