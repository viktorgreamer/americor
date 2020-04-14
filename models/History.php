<?php

namespace app\models;

use app\models\traits\ObjectNameTrait;
use app\widgets\common\CallHistoryItemWidget;
use app\widgets\common\ChangeQualityHistoryItemWidget;
use app\widgets\common\ChangeTypeHistoryItemWidget;
use app\widgets\common\CommonHistoryItemWidget;
use app\widgets\common\FaxHistoryItemWidget;
use app\widgets\common\SmsHistoryItemWidget;
use app\widgets\common\TaskHistoryItemWidget;
use Yii;

/**
 * This is the model class for table "{{%history}}".
 *
 * @property integer $id
 * @property string $ins_ts
 * @property integer $customer_id
 * @property string $event
 * @property string $object
 * @property integer $object_id
 * @property string $message
 * @property string $detail
 * @property integer $user_id
 *
 * @property string $eventText
 *
 * @property Customer $customer
 * @property User $user
 * @property mixed fax
 * @property mixed task
 * @property mixed call
 * @property mixed sms
 */
class History extends \yii\db\ActiveRecord
{
    use ObjectNameTrait;

    const EVENT_CREATED_TASK = 'created_task';
    const EVENT_UPDATED_TASK = 'updated_task';
    const EVENT_COMPLETED_TASK = 'completed_task';

    const EVENT_INCOMING_SMS = 'incoming_sms';
    const EVENT_OUTGOING_SMS = 'outgoing_sms';

    const EVENT_INCOMING_CALL = 'incoming_call';
    const EVENT_OUTGOING_CALL = 'outgoing_call';

    const EVENT_INCOMING_FAX = 'incoming_fax';
    const EVENT_OUTGOING_FAX = 'outgoing_fax';

    const EVENT_CUSTOMER_CHANGE_TYPE = 'customer_change_type';
    const EVENT_CUSTOMER_CHANGE_QUALITY = 'customer_change_quality';


    /**
     *  Widget Class reference
     * @return array
     */
    public static function widgetClassReference()
    {
        return [
            self::EVENT_CREATED_TASK => TaskHistoryItemWidget::class,
            self::EVENT_UPDATED_TASK => TaskHistoryItemWidget::class,
            self::EVENT_COMPLETED_TASK => TaskHistoryItemWidget::class,

            self::EVENT_INCOMING_SMS => SmsHistoryItemWidget::class,
            self::EVENT_OUTGOING_SMS => SmsHistoryItemWidget::class,

            self::EVENT_INCOMING_CALL => CallHistoryItemWidget::class,
            self::EVENT_OUTGOING_CALL => CallHistoryItemWidget::class,

            self::EVENT_INCOMING_FAX => FaxHistoryItemWidget::class,
            self::EVENT_OUTGOING_FAX => FaxHistoryItemWidget::class,

            self::EVENT_CUSTOMER_CHANGE_TYPE => ChangeTypeHistoryItemWidget::class,
            self::EVENT_CUSTOMER_CHANGE_QUALITY => ChangeQualityHistoryItemWidget::class,
        ];
    }

    /**
     * get Widget Class from reference
     * @return mixed|string
     */
    public function getWidgetClass()
    {
        return self::widgetClassReference()[$this->event] ?? CommonHistoryItemWidget::class;
    }


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%history}}';
    }

    /**
     * @return bool
     */
    public function isTaskRelatedEvent()
    {
        return in_array($this->event, [
            self::EVENT_CREATED_TASK,
            self::EVENT_UPDATED_TASK,
            self::EVENT_COMPLETED_TASK,
        ]);
    }

    /**
     * @return bool
     */
    public function isSmsRelatedEvent()
    {
        return in_array($this->event, [
            self::EVENT_INCOMING_SMS,
            self::EVENT_OUTGOING_SMS
        ]);
    }

    /**
     * @return bool
     */
    public function isCallRelatedEvent()
    {
        return in_array($this->event, [
            self::EVENT_INCOMING_CALL,
            self::EVENT_OUTGOING_CALL
        ]);
    }

    /**
     * @return bool
     */
    public function isChangeTypeRelatedEvent()
    {
        return in_array($this->event, [
            self::EVENT_CUSTOMER_CHANGE_TYPE
        ]);
    }

    /**
     * @return bool
     */
    public function isChangeQualityRelatedEvent()
    {
        return in_array($this->event, [
            self::EVENT_CUSTOMER_CHANGE_QUALITY
        ]);
    }

    /**
     * @return bool
     */
    public function isFaxRelatedEvent()
    {
        return in_array($this->event, [
            self::EVENT_INCOMING_FAX,
            self::EVENT_OUTGOING_FAX
        ]);
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ins_ts'], 'safe'],
            [['customer_id', 'object_id', 'user_id'], 'integer'],
            [['event'], 'required'],
            [['message', 'detail'], 'string'],
            [['event', 'object'], 'string', 'max' => 255],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'ins_ts' => Yii::t('app', 'Ins Ts'),
            'customer_id' => Yii::t('app', 'Customer ID'),
            'event' => Yii::t('app', 'Event'),
            'object' => Yii::t('app', 'Object'),
            'object_id' => Yii::t('app', 'Object ID'),
            'message' => Yii::t('app', 'Message'),
            'detail' => Yii::t('app', 'Detail'),
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return array
     */
    public static function getEventTexts()
    {
        return [
            self::EVENT_CREATED_TASK => Yii::t('app', 'Task created'),
            self::EVENT_UPDATED_TASK => Yii::t('app', 'Task updated'),
            self::EVENT_COMPLETED_TASK => Yii::t('app', 'Task completed'),

            self::EVENT_INCOMING_SMS => Yii::t('app', 'Incoming message'),
            self::EVENT_OUTGOING_SMS => Yii::t('app', 'Outgoing message'),

            self::EVENT_CUSTOMER_CHANGE_TYPE => Yii::t('app', 'Type changed'),
            self::EVENT_CUSTOMER_CHANGE_QUALITY => Yii::t('app', 'Property changed'),

            self::EVENT_OUTGOING_CALL => Yii::t('app', 'Outgoing call'),
            self::EVENT_INCOMING_CALL => Yii::t('app', 'Incoming call'),

            self::EVENT_INCOMING_FAX => Yii::t('app', 'Incoming fax'),
            self::EVENT_OUTGOING_FAX => Yii::t('app', 'Outgoing fax'),
        ];
    }

    /**
     * @param $event
     * @return mixed
     */
    public static function getEventTextByEvent($event)
    {
        return static::getEventTexts()[$event] ?? $event;
    }

    /**
     * @return mixed|string
     */
    public function getEventText()
    {
        return static::getEventTextByEvent($this->event);
    }


    /**
     * @param $attribute
     * @return null
     */
    public function getDetailChangedAttribute($attribute)
    {
        $detail = json_decode($this->detail);
        return isset($detail->changedAttributes->{$attribute}) ? $detail->changedAttributes->{$attribute} : null;
    }

    /**
     * @param $attribute
     * @return null
     */
    public function getDetailOldValue($attribute)
    {
        $detail = $this->getDetailChangedAttribute($attribute);
        return isset($detail->old) ? $detail->old : null;
    }

    /**
     * @param $attribute
     * @return null
     */
    public function getDetailNewValue($attribute)
    {
        $detail = $this->getDetailChangedAttribute($attribute);
        return isset($detail->new) ? $detail->new : null;
    }

    /**
     * @param $attribute
     * @return null
     */
    public function getDetailData($attribute)
    {
        $detail = json_decode($this->detail);
        return isset($detail->data->{$attribute}) ? $detail->data->{$attribute} : null;
    }
}
