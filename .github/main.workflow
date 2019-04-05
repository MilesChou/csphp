workflow "CSPHP workflow" {
  on = "push"
  resolves = [
    "Send Discord message",
  ]
}

action "Composer Install" {
  uses = "MilesChou/composer-action@master"
  args = "install --prefer-dist"
}

action "Code Sniffer" {
  uses = "docker://php:7.1"
  needs = ["Composer Install"]
  args = "php vendor/bin/phpcs"
}

action "Test" {
  uses = "docker://php:7.1"
  needs = ["Composer Install"]
  args = "php vendor/bin/phpunit"
}

action "Send Discord message" {
  uses = "appleboy/discord-action@master"
  needs = [
    "Code Sniffer",
    "Test",
  ]
  secrets = [
    "WEBHOOK_ID",
    "WEBHOOK_TOKEN",
  ]
  args = "A new commit has been push to `MilesChou/csphp`."
}
