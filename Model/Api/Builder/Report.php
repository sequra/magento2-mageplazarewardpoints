<?php

/**
 * Copyright © 2021 SeQura Engineering. All rights reserved.
 */

namespace Sequra\MageplazaRewardpoints\Model\Api\Builder;

class Report extends \Sequra\Core\Model\Api\Builder\Report
{
    public function extraItems()
    {
        $items = parent::extraItems();
        //RewardPoints
        $discount = round(-100 * $this->order->getMpRewardBaseDiscount());
        if ($discount < 0) {
            $items[] = [
                'type' => 'other_payment',
                'reference' => 'rewardpoints',
                'name' => $this->order->getMpRewardSpent() . ' reward points spent',
                'total_with_tax' => $discount,
            ];
        }
        //StoreCredit
        $discount = round(-100 * $this->order->getMpStoreCreditBaseDiscount());
        if ($discount < 0) {
            $items[] = [
                'type' => 'other_payment',
                'reference' => 'storecredit',
                'name' => 'StoreCreit used',
                'total_with_tax' => $discount,
            ];
        }
        return $items;
    }
}
