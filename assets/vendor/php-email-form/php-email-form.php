<?php

class PHP_Email_Form {
    public $to = '';
    public $from_name = '';
    public $from_email = '';
    public $subject = '';
    public $messages = [];

    public function add_message($content, $label, $priority = 1) {
        $this->messages[] = [
            'label' => $label,
            'content' => $content,
            'priority' => $priority
        ];
    }

    public function send() {
        $message_body = '';
        foreach ($this->messages as $message) {
            $message_body .= $message['label'] . ": " . $message['content'] . "\n";
        }

        $headers = 'From: ' . $this->from_name . ' <' . $this->from_email . '>' . "\r\n" .
                   'Reply-To: ' . $this->from_email . "\r\n" .
                   'X-Mailer: PHP/' . phpversion();

        return mail($this->to, $this->subject, $message_body, $headers);
    }
}

?>
