# TelegramBotSDK
Library for Telegram Bot API on PHP.

# Using
## Create Telegram client
```php
$tg = new Telegram\Client("___BOT_API_SECRET___");
```

## Set webhook
This should be done only once.
```php
$tg->performSingleMethod(new Telegram\Method\SetWebhookInfo("http://example.com/handler.php"));
```

## Get message from webhook
```php
$tg->onMessage(function(Telegram\Client $tg, Telegram\Model\Message $message) {
    $fromUserId = $message->getFrom()->getId();
    // do something...
);
```

## Reply to message
```php
$reply = new Telegram\Method\SendMessage($toId, $text);
$tg->performSingleMethod($reply);
```
or, if reply using in listener webhook...
```php
$tg->onMessage(function(Telegram\Client $tg, Telegram\Model\Message $message) {
    
    $reply = new Telegram\Method\SendMessage($message->getChatId());
    
    $text = getSomeText(); // TODO
    $reply->setText($text);
 
    // If need, we can set parse mode - markdown or html   
    $reply->setParseMode(ParseMode::MARKDOWN);
    
    $tg->performHookMethod($reply);
    exit; // prevent output unnecessary data and stop script
});
```