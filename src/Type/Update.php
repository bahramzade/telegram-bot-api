<?php
namespace Steelbot\TelegramBotApi\Type;

class Update
{
    const TYPE_MESSAGE = 'message';
    const TYPE_EDITED_MESSAGE = 'edited_message';
    const TYPE_CHANNEL_POST = 'channel_post';
    const TYPE_EDITED_CHANNEL_POST = 'edited_channel_post';
    const TYPE_INLINE_QUERY = 'inline_query';
    const TYPE_CHOSEN_INLINE_RESULT = 'chosen_inline_result';
    const TYPE_CALLBACK_QUERY = 'callback_query';

    /**
     * @var integer
     */
    public $updateId;

    /**
     * @var Message
     */
    public $message;

    /**
     * @var InlineQuery
     */
    public $inlineQuery;

    /**
     * @var ChosenInlineResult
     */
    public $chosenInlineResult;

    /**
     * @var CallbackQuery|null
     */
    public $callbackQuery;

    /**
     * @var array|null
     */
    protected $rawData;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->updateId = $data['update_id'];
        $this->message = isset($data['message']) ?
            new Message($data['message']) : null;
        $this->inlineQuery = isset($data['inline_query']) ?
            new InlineQuery($data['inline_query']) : null;
        $this->chosenInlineResult = isset($data['chosen_inline_result']) ?
            new ChosenInlineResult($data['chosen_inline_result']) : null;
        $this->callbackQuery = isset($data['callback_query']) ?
            new CallbackQuery($data['callback_query']) : null;

        $this->rawData = $data;
    }

    /**
     * @return array|null
     */
    public function getRawData()
    {
        return $this->rawData;
    }
}
