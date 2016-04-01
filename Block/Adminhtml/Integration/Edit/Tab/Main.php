<?php

/**
 * This file is part of Glugox.
 *
 * (c) Glugox <glugox@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glugox\Integration\Block\Adminhtml\Integration\Edit\Tab;

use Glugox\Integration\Model\Integration as IntegrationModel;

/**
 * Main Integration info edit form
 *
 */
class Main extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface {
    /*     * #@+
     * Form elements names.
     */

    const HTML_ID_PREFIX = 'glugox_integration_properties_';
    const DATA_ID = 'integration_id';
    const DATA_INTEGRATION_CODE = 'integration_code';
    const DATA_NAME = 'name';
    const DATA_STATUS = 'status';
    const DATA_SERVICE_URL = 'service_url';

    const DATA_CA_FILE = 'ca_file';
    const DATA_CLIENT_FILE = 'client_file';
    const DATA_KEY_FILE = 'key_file';
    const DATA_CERT_PASS = 'cert_pass';

    /*     * #@- */

    /**
     * Set form id prefix, declare fields for integration info
     *
     * @return $this
     */
    protected function _prepareForm() {
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix(self::HTML_ID_PREFIX);
        $integrationData = $this->_coreRegistry->registry(IntegrationModel::CURRENT_INTEGRATION_KEY);
        $this->_addGeneralFieldset($form, $integrationData);
        $form->setValues($integrationData);
        $this->setForm($form);
        return $this;
    }


    /**
     * Prepare label for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabLabel() {
        return __('Integration Info');
    }


    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle() {
        return $this->getTabLabel();
    }


    /**
     * Returns status flag about this tab can be showen or not
     *
     * @return true
     */
    public function canShowTab() {
        return true;
    }


    /**
     * Returns status flag about this tab hidden or not
     *
     * @return true
     */
    public function isHidden() {
        return false;
    }


    /**
     * Add fieldset with general integration information.
     *
     * @param \Magento\Framework\Data\Form $form
     * @param array $integrationData
     * @return void
     */
    protected function _addGeneralFieldset($form, $integrationData) {
        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('General')]);

        $disabled = false;
        if (isset($integrationData[self::DATA_ID])) {
            $fieldset->addField(self::DATA_ID, 'hidden', ['name' => 'id']);
        }

        $fieldset->addField(
                self::DATA_INTEGRATION_CODE, 'text', [
            'label' => __('Code'),
            'name' => self::DATA_INTEGRATION_CODE,
            'required' => true,
            'disabled' => $disabled,
            'maxlength' => '255'
                ]
        );

        $fieldset->addField(
                self::DATA_NAME, 'text', [
            'label' => __('Name'),
            'name' => self::DATA_NAME,
            'required' => true,
            'disabled' => $disabled,
            'maxlength' => '255'
                ]
        );

        $fieldset->addField(
                self::DATA_SERVICE_URL, 'text', [
            'label' => __('Service URL'),
            'name' => self::DATA_SERVICE_URL,
            'disabled' => $disabled,
            'note' => __(
                    'Main service URL'
            )
                ]
        );

        $fieldset->addField(
                self::DATA_CA_FILE, 'text', [
            'label' => __('CA File'),
            'name' => self::DATA_CA_FILE,
            'disabled' => $disabled,
            'note' => __(
                    'CA File'
            )
                ]
        );

        $fieldset->addField(
                self::DATA_CLIENT_FILE, 'text', [
            'label' => __('Client File'),
            'name' => self::DATA_CLIENT_FILE,
            'disabled' => $disabled,
            'note' => __(
                    'Client File'
            )
                ]
        );

        $fieldset->addField(
                self::DATA_KEY_FILE, 'text', [
            'label' => __('Key File'),
            'name' => self::DATA_KEY_FILE,
            'disabled' => $disabled,
            'note' => __(
                    'Key File'
            )
                ]
        );

        $fieldset->addField(
                self::DATA_CERT_PASS, 'text', [
            'label' => __('Cert Pass'),
            'name' => self::DATA_CERT_PASS,
            'disabled' => $disabled,
            'note' => __(
                    'Cert Pass'
            )
                ]
        );

        $fieldset->addField(
                self::DATA_STATUS, 'select', [
            'name' => self::DATA_STATUS,
            'label' => __('Status'),
            'options' => [
                \Glugox\Integration\Model\Integration::STATUS_INACTIVE => __('Inactive'),
                \Glugox\Integration\Model\Integration::STATUS_ACTIVE => __('Active'),
            ]
                ]
        );
    }


}
