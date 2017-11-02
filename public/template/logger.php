<?php
/**
 * Php library to create logs easily and store them in Json format.
 *
 * @author     Josantonius - hello@josantonius.com
 * @copyright  Copyright (c)
 * @license    https://opensource.org/licenses/MIT - The MIT License (MIT)
 * @link       https://github.com/Josantonius/PHP-Logger
 * @since      1.1.2
 */

use Josantonius\Logger\Logger;
?>

<div class="jst-logger jst-card-log">

    <div class="jst-logs">

        <?php foreach (Logger::get() as $number => $log) :
            $type      = $log['type'];
            $date      = $log['date'];
            $hour      = $log['hour'];
            $message   = $log['message'];
            $lowerType = strtolower($type);

            unset($log['type'], $log['date'], $log['hour'], $log['message']);
        ?>

            <p class="jst-log"> 
                <span id="log-<?= $number ?>" class="jst-log-line">
                    <span class="jst-c-gray">[<?= $date ?>] </span> 
                    <span class="jst-c-gray">[<?= $hour ?>]</span> 
                    <span class="jst-c-<?= $lowerType ?> jst-uppercase"><?= $type ?></span> 
                    <span class="jst-message"><?= $message ?></span>
                </span>
                
                <?php foreach ($log as $key => $value) : ?>
                    <span class="jst-c-gray jst-no-display" data-log-<?= $number ?>=""><br>[<?= $date ?>] </span> 
                    <span class="jst-c-gray jst-no-display" data-log-<?= $number ?>="">[<?= $hour ?>]</span> 
                    <span class="jst-c-<?= $lowerType ?> jst-no-display jst-uppercase" data-log-<?= $number ?>="">
                        <?= $key ?>
                    </span>
                    <span class="jst-c-gray jst-no-display" data-log-<?= $number ?>=""> → </span>
                    <span class="jst-no-display jst-message" data-log-<?= $number ?>=""><?= $value ?></span>

                <?php endforeach; ?>

            </p>

        <?php endforeach; ?>

        <div class="jst-clear"></div>

    </div>

</div>