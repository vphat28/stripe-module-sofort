<?php

namespace Stripeofficial\SOFORT\Model\Ui;

use Magento\Checkout\Model\ConfigProviderInterface;
use Magento\Store\Model\ScopeInterface;
use Stripeofficial\Core\Helper\Data;

/**
 * Class ConfigProvider
 */
final class ConfigProvider implements ConfigProviderInterface
{
    const CODE = 'stripesofort';

    /**
     * @var Data
     */
    protected $data;

    /**
     * ConfigProvider constructor.
     * @param Data $data
     */
    public function __construct(
        Data $data
    ) {
        $this->data = $data;
    }

    /**
     * Retrieve assoc array of checkout configuration
     *
     * @return array
     */
    public function getConfig()
    {
        $scopeConfig = $this->data->getScopeConfig();

        return [
            'payment' => [
                self::CODE => [
                    'active' => $scopeConfig->isSetFlag('payment/stripesofort/active', ScopeInterface::SCOPE_STORE),
                    'title' => $scopeConfig->getValue('payment/stripesofort/title', ScopeInterface::SCOPE_STORE),
                    'country_code' => $scopeConfig->getValue('general/country/default', ScopeInterface::SCOPE_STORE),
                    'public_key' => $this->data->getAPIKey(),
                    'is_test' => $this->data->getTestMode(),
                    'allowspecific' => $scopeConfig->getValue('payment/stripesofort/allowspecific', ScopeInterface::SCOPE_STORE),
                    'specificcountry' => $scopeConfig->getValue('payment/stripesofort/specificcountry', ScopeInterface::SCOPE_STORE),
                ]
            ]
        ];
    }
}
