<?php
/**
 * # NOTICE OF LICENSE
 * This work is licensed under a ***Creative Commons Attribution-NonCommercial-
 * NoDerivs 3.0 Unported License*** http://creativecommons.org/licenses/by-nc-nd/3.0
 *
 * ## Authors
*
 * Iván Miranda @deivanmiranda
 */
namespace Sincco\HidePriceForGuests\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Sincco\HidePriceForGuests\Helper\Data as HidePriceForGuestsHelper;

/**
 * Salable Observer
 */
class SalableObserver implements ObserverInterface
{
    /**
     * HidePriceForGuests Helper
     *
     * @var \Sincco\HidePriceForGuests\Helper\Data
     */
    protected $_helper; 
	
    /**
     * Initialize Observer
     *
     * @param HidePriceForGuestsHelper $helper
     */
    public function __construct(
		HidePriceForGuestsHelper $helper
    ) {
		$this->_helper = $helper;
    }
	
    /**
     * Handler For Product Salable Event
     *
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
		if (!$this->_helper->isAvailableAddToCart()) {
			$salable = $observer->getEvent()->getSalable();		
			$salable->setIsSalable(false);
		}
    }
} 