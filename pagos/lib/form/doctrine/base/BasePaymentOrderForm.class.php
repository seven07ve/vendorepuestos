<?php

/**
 * PaymentOrder form base class.
 *
 * @method PaymentOrder getObject() Returns the current form's model object
 *
 * @package    ptoventavr
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePaymentOrderForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'element_id'           => new sfWidgetFormInputText(),
      'element_type'         => new sfWidgetFormChoice(array('choices' => array('product' => 'product', 'store' => 'store'))),
      'system_action'        => new sfWidgetFormChoice(array('choices' => array('new' => 'new', 'edit' => 'edit'))),
      'amount'               => new sfWidgetFormInputText(),
      'order_id'             => new sfWidgetFormInputText(),
      'order_status'         => new sfWidgetFormChoice(array('choices' => array('unprocessed' => 'unprocessed', 'processing' => 'processing', 'success' => 'success', 'fail' => 'fail', 'timeout' => 'timeout', 'timeout_fail' => 'timeout_fail'))),
      'transaction_status'   => new sfWidgetFormChoice(array('choices' => array('NOV' => 'NOV', 'INV' => 'INV', 'PPC' => 'PPC', 'PPN' => 'PPN', 'CON' => 'CON', 'NEG' => 'NEG', 'CAN' => 'CAN', 'ERR' => 'ERR', 'BLQ' => 'BLQ', 'TBE' => 'TBE', 'TNB' => 'TNB'))),
      'response_code'        => new sfWidgetFormInputText(),
      'merchant_usn'         => new sfWidgetFormInputText(),
      'customer_id'          => new sfWidgetFormInputText(),
      'customer_name'        => new sfWidgetFormInputText(),
      'customer_email'       => new sfWidgetFormInputText(),
      'card_number'          => new sfWidgetFormInputText(),
      'nit'                  => new sfWidgetFormInputText(),
      'customer_receipt'     => new sfWidgetFormTextarea(),
      'merchant_receipt'     => new sfWidgetFormTextarea(),
      'authorizer_id'        => new sfWidgetFormInputText(),
      'acquirer'             => new sfWidgetFormInputText(),
      'authorization_number' => new sfWidgetFormInputText(),
      'esitef_usn'           => new sfWidgetFormInputText(),
      'host_usn'             => new sfWidgetFormInputText(),
      'message'              => new sfWidgetFormTextarea(),
      'created_at'           => new sfWidgetFormDateTime(),
      'updated_at'           => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'element_id'           => new sfValidatorInteger(),
      'element_type'         => new sfValidatorChoice(array('choices' => array(0 => 'product', 1 => 'store'), 'required' => false)),
      'system_action'        => new sfValidatorChoice(array('choices' => array(0 => 'new', 1 => 'edit'), 'required' => false)),
      'amount'               => new sfValidatorInteger(),
      'order_id'             => new sfValidatorString(array('max_length' => 20)),
      'order_status'         => new sfValidatorChoice(array('choices' => array(0 => 'unprocessed', 1 => 'processing', 2 => 'success', 3 => 'fail', 4 => 'timeout', 5 => 'timeout_fail'), 'required' => false)),
      'transaction_status'   => new sfValidatorChoice(array('choices' => array(0 => 'NOV', 1 => 'INV', 2 => 'PPC', 3 => 'PPN', 4 => 'CON', 5 => 'NEG', 6 => 'CAN', 7 => 'ERR', 8 => 'BLQ', 9 => 'TBE', 10 => 'TNB'), 'required' => false)),
      'response_code'        => new sfValidatorInteger(array('required' => false)),
      'merchant_usn'         => new sfValidatorString(array('max_length' => 12)),
      'customer_id'          => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'customer_name'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'customer_email'       => new sfValidatorString(array('max_length' => 255)),
      'card_number'          => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'nit'                  => new sfValidatorString(array('max_length' => 64, 'required' => false)),
      'customer_receipt'     => new sfValidatorString(array('max_length' => 4000, 'required' => false)),
      'merchant_receipt'     => new sfValidatorString(array('max_length' => 4000, 'required' => false)),
      'authorizer_id'        => new sfValidatorString(array('max_length' => 3, 'required' => false)),
      'acquirer'             => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'authorization_number' => new sfValidatorString(array('max_length' => 6, 'required' => false)),
      'esitef_usn'           => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'host_usn'             => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'message'              => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'created_at'           => new sfValidatorDateTime(),
      'updated_at'           => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorDoctrineUnique(array('model' => 'PaymentOrder', 'column' => array('order_id'))),
        new sfValidatorDoctrineUnique(array('model' => 'PaymentOrder', 'column' => array('merchant_usn'))),
      ))
    );

    $this->widgetSchema->setNameFormat('payment_order[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PaymentOrder';
  }

}
