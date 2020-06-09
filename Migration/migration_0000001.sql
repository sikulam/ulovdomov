-- user_admin --
CREATE TABLE IF NOT EXISTS `user_admin`
(
    `id`     int(11) unsigned NOT NULL,
    `name`   varchar(64)      NOT NULL,
    `rights` text             NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

ALTER TABLE `user_admin`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `user_admin`
    MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;

-- village --
CREATE TABLE IF NOT EXISTS `village`
(
    `id`   int(11) unsigned NOT NULL,
    `name` varchar(64)      NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

ALTER TABLE `village`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `village`
    MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;

-- user_admin_rights --
CREATE TABLE IF NOT EXISTS `user_admin_rights`
(
    `id`            int(11) unsigned NOT NULL,
    `type_id`       int(11) unsigned NOT NULL,
    `village_id`    int(11) unsigned NOT NULL,
    `user_admin_id` int(11) unsigned NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

ALTER TABLE `user_admin_rights`
    ADD PRIMARY KEY (`id`),
    ADD KEY `type_id` (`type_id`),
    ADD KEY `village_id` (`village_id`),
    ADD KEY `user_admin_id` (`user_admin_id`);

ALTER TABLE `user_admin_rights`
    MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
ALTER TABLE `user_admin_rights`
    ADD CONSTRAINT `user_admin_rights_ibfk_1` FOREIGN KEY (`village_id`) REFERENCES `village` (`id`),
    ADD CONSTRAINT `user_admin_rights_ibfk_2` FOREIGN KEY (`user_admin_id`) REFERENCES `user_admin` (`id`);