<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento\Framework\ObjectManager\Resetter;

use Magento\Framework\ObjectManager\ResetAfterRequestInterface;
use WeakReference;

/**
 * Data class used for hold reference and sort value
 */
class SortableReferenceObject implements ResetAfterRequestInterface
{
    /**
     * @param WeakReference $reference
     * @param int $sort
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * @phpcs:disable Magento2.CodeAnalysis.EmptyBlock.DetectedFunction
     */
    public function __construct(readonly WeakReference $reference, readonly int $sort)
    {
    }

    /**
     * Gets sorted object
     *
     * @return int
     */
    public function getSort() : int
    {
        return $this->sort;
    }

    /**
     * State reset
     *
     * @return void
     */
    public function _resetState(): void
    {
        $object = $this->reference->get();
        if (!$object || !($object instanceof ResetAfterRequestInterface)) {
            return;
        }
        $object->_resetState();
    }
}
