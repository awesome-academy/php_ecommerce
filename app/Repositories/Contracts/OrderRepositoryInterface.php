<?php

namespace App\Repositories\Contracts;

interface OrderRepositoryInterface extends RepositoryInterface
{
    public function storeOrder(array $request, $oldCart);

    public function getOrderWithUserAndPayment();

    public function updateOrderAndSendEvent(array $request, $id);

    public function countWithStatus($status);

    public function getCharts();

    public function createChart($data, $title, $label, $type);

    public function ajaxDetailOrder($id);
}
