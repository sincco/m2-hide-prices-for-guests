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
namespace Sincco\HidePriceForGuests\Helper;

use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Customer\Model\Session;

/**
 * Sincco HidePriceForGuests Data helper
 */
class Data extends AbstractHelper
{
    /**
     * Hide Add To Cart Config Path
     */
    const XML_CONFIG_HIDE_ADD_TO_CART = 'catalog/available/hide_add_to_cart';
	
    /**
     * Hide From Groups Config Path
     */
    const XML_CONFIG_HIDE_ADD_TO_CART_GROUPS = 'catalog/available/hide_add_to_cart_groups';
	
    /**
     * Hide Price Config Path
     */
    const XML_CONFIG_HIDE_PRICE = 'catalog/available/hide_price';
	
    /**
     * Hide From Groups Config Path
     */
    const XML_CONFIG_HIDE_PRICE_GROUPS = 'catalog/available/hide_price_groups';
	
    /**
	 * Customer Session
	 *
     * @var \Magento\Customer\Model\Session
     */
    protected $_session;

    /**
     * Initialize Helper
	 *
     * @param Context $context
     * @param Session $session
     */
    public function __construct(
        Context $context,
        Session $session
    ) {
        $this->_session = $session;
		
        parent::__construct(
			$context
		);
    }

    /**
     * Check Whether The Customer Allows Add To Cart
     *
     * @return bool
     */
    public function isAvailableAddToCart()
    {
		if ($this->_getConfig(self::XML_CONFIG_HIDE_ADD_TO_CART)) {
			return !in_array(
				$this->_session->getCustomerGroupId(), 
				explode(',', $this->_getConfig(self::XML_CONFIG_HIDE_ADD_TO_CART_GROUPS))
			);			
		}
		return true;
    }	

    /**
     * Check Whether The Customer Allows Price
     *
     * @return bool
     */
    public function isAvailablePrice()
    {
		if ($this->_getConfig(self::XML_CONFIG_HIDE_PRICE)) {
			return !in_array(
				$this->_session->getCustomerGroupId(), 
				explode(',', $this->_getConfig(self::XML_CONFIG_HIDE_PRICE_GROUPS))
			);			
		}
		return true;
    }	 
	
    /**
     * Retrieve Store Configuration Data
     *
     * @param   string $path
     * @return  string|null
     */
    protected function _getConfig($path)
    {
        return $this->scopeConfig->getValue($path, ScopeInterface::SCOPE_STORE);
    }      
}
