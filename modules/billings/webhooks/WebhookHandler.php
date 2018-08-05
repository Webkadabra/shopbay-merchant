<?php
/**
 * This file is part of Shopbay.org (http://shopbay.org)
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code. 
 */
/**
 * Description of WebhookHandler
 *
 * @author kwlok
 */
interface WebhookHandler
{
    public function handleNotification($notification);
}
