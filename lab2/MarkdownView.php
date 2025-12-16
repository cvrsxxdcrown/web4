<?php
class MarkdownView {
    public function render(array $users): void {
        foreach ($users as $user) {
            echo "- <b>{$user['name']}</b> ({$user['email']})<br>";
        }
    }
}
