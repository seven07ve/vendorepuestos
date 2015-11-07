<?php

/**
 * PaymentOrder filter form base class.
 *
 * @package    ptoventavr
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePaymentOrderFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'element_id'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'element_type'         => new sfWidgetFormChoice(array('choices' => array('' => '', 'product' => 'product', 'store' => 'store'))),
      'system_action'        => new sfWidgetFormChoice(array('choices' => array('' => '', 'new' => 'new', 'edit' => 'edit'))),
      'amount'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'order_id'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'order_status'         => new sfWidgetFormChoice(array('choices' => array('' => '', 'unprocessed' => 'unprocessed', 'processing' => 'processing', 'success' => 'success', 'fail' => 'fail', 'timeout' => 'timeout', 'timeout_fail' => 'timeout_fail'))),
      'transaction_status'   => new sfWidgetFormChoice(array('choices' => array('' => '', 'NOV' => 'NOV', 'INV' => 'INV', 'PPC' => 'PPC', 'PPN' => 'PPN', 'CON' => 'CON', 'NEG' => 'NEG', 'CAN' => 'CAN', 'ERR' => 'ERR', 'BLQ' => 'BLQ', 'TBE' => 'TBE', 'TNB' => 'TNB'))),
      'response_code'        => new sfWidgetFormFilterInput(),
      'merchant_usn'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'customer_id'          => new sfWidgetFormFilterInput(),
      'customer_email'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'card_number'          => new sfWidgetFormFilterInput(),
      'nit'                  => new sfWidgetFormFilterInput(),
      'customer_receipt'     => new sfWidgetFormFilterInput(),
      'merchant_receipt'     => new sfWidgetFormFilterInput(),
      'authorizer_id'        => new sfWidgetFormFilterInput(),
      'acquirer'             => new sfWidgetFormFilterInput(),
      'authorization_number' => new sfWidgetFormFilterInput(),
      'esitef_usn'           => new sfWidgetFormFilterInput(),
      'host_usn'             => new sfWidgetFormFilterInput(),
      'message'              => new sfWidgetFormFilterInput(),
      'created_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'element_id'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'element_type'         => new sfValidatorChoice(array('required' => false, 'choices' => array('product' => 'product', 'store' => 'store'))),
      'system_action'        => new sfValidatorChoice(array('required' => false, 'choices' => array('new' => 'new', 'edit' => 'edit'))),
      'amount'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'order_id'             => new sfValidatorPass(array('required' => false)),
      'order_status'         => new sfValidatorChoice(array('required' => false, 'choices' => array('unprocessed' => 'unprocessed', 'processing' => 'processing', 'success' => 'success', 'fail' => 'fail', 'timeout' => 'timeout', 'timeout_fail' => 'timeout_fail'))),
      'transaction_status'   => new sfValidatorChoice(array('required' => false, 'choices' => array('NOV' => 'NOV', 'INV' => 'INV', 'PPC' => 'PPC', 'PPN' => 'PPN', 'CON' => 'CON', 'NEG' => 'NEG', 'CAN' => 'CAN', 'ERR' => 'ERR', 'BLQ' => 'BLQ', 'TBE' => 'TBE', 'TNB' => 'TNB'))),
      'response_code'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'merchant_usn'         => new sfValidatorPass(array('required' => false)),
      'customer_id'          => new sfValidatorPass(array('required' => false)),
      'customer_email'       => new sfValidatorPass(array('required' => false)),
      'card_number'          => new sfValidatorPass(array('required' => false)),
      'nit'                  => new sfValidatorPass(array('required' => false)),
      'customer_receipt'     => new sfValidatorPass(array('required' => false)),
      'merchant_receipt'     => new sfValidatorPass(array('required' => false)),
      'authorizer_id'        => new sfValidatorPass(array('required' => false)),
      'acquirer'             => new sfValidatorPass(array('required' => false)),
      'authorization_number' => new sfValidatorPass(array('required' => false)),
      'esitef_usn'           => new sfValidatorPass(array('required' => false)),
      'host_usn'             => new sfValidatorPass(array('required' => false)),
      'message'              => new sfValidatorPass(array('required' => false)),
      'created_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('payment_order_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PaymentOrder';
  }

  public function getFields()
  {
    return array(
      'id'                   => 'Number',
      'element_id'           => 'Number',
      'element_type'         => 'Enum',
      'system_action'        => 'Enum',
      'amount'               => 'Number',
      'order_id'             => 'Text',
      'order_status'         => 'Enum',
      'transaction_status'   => 'Enum',
      'response_code'        => 'Number',
      'merchant_usn'         => 'Text',
      'customer_id'          => 'Text',
      'customer_email'       => 'Text',
      'card_number'          => 'Text',
      'nit'                  => 'Text',
      'customer_receipt'     => 'Text',
      'merchant_receipt'     => 'Text',
      'authorizer_id'        => 'Text',
      'acquirer'             => 'Text',
      'authorization_number' => 'Text',
      'esitef_usn'           => 'Text',
      'host_usn'             => 'Text',
      'message'              => 'Text',
      'created_at'           => 'Date',
      'updated_at'           => 'Date',
    );
  }
}
